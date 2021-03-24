<?php

namespace App\Console\Commands;

use App\Model\Config;
use App\Model\CollectCarpool;
use App\Model\Carpool;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Console\Command;

class SpiderCarpool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citinfo:spider-carpool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->http = new Client(['timeout' => 10, 'allow_redirects' => true, 'debug' => false]);

        $config = Config::value('carpool');

        if (isset($config['vyuanid']) && $config['vyuanid']) {
            $this->spiderVyuan($config['vyuanid'], $config['vyuan_max'], $config['vyuan_keyword']);
        }

        if (isset($config['wuxi_host']) && $config['wuxi_host']) {
            $this->spiderWuxi($config['wuxi_host']);
        }

        return 0;
    }

    public function spiderVyuan($id, $maxCount, $keywords)
    {
        $url = 'https://www.vyuan8.com/vyuan/plugin.php?id=vyuan_pinche&pid='.$id;
        $response = $this->http->get($url, ['headers' => ['User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/7.0.12(0x17000c27) NetType/WIFI Language/zh_CN']]);
        $content = (string)$response->getBody();
        $content = preg_replace("/[\t\n\r]+/", "", $content);
        $content = iconv("GBK//IGNORE", "UTF-8", $content);
        $crawler = new Crawler();
        $crawler->addHtmlContent($content);
        $nodes = $crawler->filter('.carList');
        
        foreach ($nodes as $i => $node) {
            if ($i > $maxCount) {
                break;
            }
            try {
                $data = $this->parserVyuan($node);
                if (!empty($data)) {
                    if ($data['start_at'] > date('Y-m-d H:i:s')) {
                        if (!CollectCarpool::where('phone', $data['phone'])->where('start_at', '>', date('Y-m-d H:i:s'))->first()) {
                            CollectCarpool::create(array_merge($data, ['source_url' => $url]));
                            if (! isset($data['directions'])) {
                                $data['directions'] = '';
                            }
                            $direction = $data['direction_from'].' '.$data['direction_to'].' '.$data['directions'];
                            if (Str::contains($direction, $keywords)) {
                                if (!Carpool::where('phone', $data['phone'])->where('start_at', '>', date('Y-m-d H:i:s'))->exists()) {
                                    $data['source'] = '采集';
                                    $data['status'] = 'paid';
                                    $data['user_id'] = 1;
                                    Carpool::create($data);
                                }
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->info($e->getMessage());
                continue;   
            }
        }
    }

    public function parserVyuan($node)
    {
        $crawler = new Crawler($node);
        $nodes = $crawler->filter('.carli01');
        $carli = $nodes->getNode(0);
        if (!$carli) {
            return false;
        }
        $html = $carli->ownerDocument->saveHTML($carli);
        preg_match('/((车找人)|(人找车))+<\/i>([\s\S]*?)<\/li/', $html, $match);
        $data['type'] = ($match[1] == '人找车')? 'people': 'car';
        $direction = trim($match[4]);
        $directions = explode('<i class="carto "></i>', $direction);
        $data['direction_from'] = $directions[0];
        $data['direction_to'] = $directions[1];
        preg_match('/\(([\s\S]*?)\)/', $data['direction_to'], $match);
        if (isset($match[1])) {
            $data['directions'] = str_replace('途经：', '', $match[1]);
            $data['direction_to']= str_replace($match[0], '', $data['direction_to']);
        }

        $nodes = $crawler->filter('.carli02L');
        $carli = $nodes->getNode(0);
        $html = trim($carli->textContent);

        preg_match('/([\s\S]*?)\(周(.*?)[\s\S]*?(\d{2}\:\d{2})([\s\S]*?)出发$/', $html, $match);

        $today1 = date('Y-m-d ');
        $today2 = date('Y-m-d ', strtotime('+1 day'));
        $today3 = date('Y-m-d ', strtotime('+2 day'));
        $today4 = date('Y-m-d ', strtotime('-1 day'));
        $data['start_at'] = str_replace(['今天', '明天', '后天', '昨天', '月', '日'], [$today1, $today2, $today3, $today4, '-', ''], trim($match[1]));
        if (strlen($data['start_at']) < 10) {
            $data['start_at'] = date('Y-').$data['start_at'];
        }
        $data['start_at'] = preg_replace('/[^\d\-\:]/', '', $data['start_at']);
        $data['start_at'] = $data['start_at'].' '.trim($match[3]).':00';
        $data['additional'] = trim(str_replace(['(', ')'], '', $match[4]));
        
        $nodes = $crawler->filter('.carli03');
        $carli = $nodes->getNode(0);
        $data['description'] = str_replace('备注：', '', trim($carli->textContent));

        $nodes = $crawler->filter('.carbot1l');
        $carli = $nodes->getNode(0);
        $data['seat_cnt'] = trim($carli->textContent);
        $data['seat_cnt'] = preg_replace('/[^\d]/', '', $data['seat_cnt']);

        $nodes = $crawler->filter('.ctell');
        $carli = $nodes->getNode(0);
        $html = $carli->ownerDocument->saveHTML($carli);
        $data['phone'] = preg_replace('/[\s\S]*(\d{11})[\s\S]*/', '\\1', $html);
        
        return $data;
    }
 
    public function spiderWuxi($host)
    {
        $url = 'http://'.$host.'/index.php';
        $response = $this->http->get($url);
        $content = (string)$response->getBody();
        preg_match_all('/PCID\=(\d+)\&ID/', $content, $match);
        $ids = array_slice($match[1], 0, $this->config['spider']['wuxi']['max-count']);
        foreach ($ids as $id) {
            $url = 'http://'.$host.'/PinCheInfo.php?PCID='.$id;
            $this->getDetail($url);
        }
    }

    public function getDetail($url)
    {
        $response = $this->http->get($url);
        $content = (string)$response->getBody();
        $data = $this->parser($content);
        $keywords = explode(',', $this->config['spider']['keyword']);
        if (!empty($data)) {
            if ($data['start_at'] > date('Y-m-d H:i:s')) {
                if (!CollectCarpool::where('phone', $data['phone'])->where('start_at', '>', date('Y-m-d H:i:s'))->first()) {
                    CollectCarpool::create(array_merge($data, ['source_url' => $url]));
                    if (! isset($data['directions'])) {
                        $data['directions'] = '';
                    }
                    $direction = $data['direction_from'].' '.$data['direction_to'].' '.$data['directions'];
                    if (Str::contains($direction, $keywords)) {
                        if (!Carpool::where('phone', $data['phone'])->where('start_at', '>', date('Y-m-d H:i:s'))->exists()) {
                            $data['source'] = '采集';
                            $data['status'] = 'paid';
                            $data['user_id'] = 1;
                            Carpool::create($data);
                        }
                    }
                }
            }
        }
    }

    public function parser($content)
    {
        preg_match_all('/\<th[\s\S]*?\>([\s\S]*?)\<[\s\S]*?\<td[\s\S]*?\>([\s\S]*?)\<\/td/i', $content, $match);
        if (isset($match[0])) {
            $data = [];
            foreach ($match[1] as $idx => $th) {
                if (strpos($th, '拼车类型') !== false) {
                    if (strpos($match[2][$idx], '车找人') !== false ) {
                        $data['type'] = 'car';
                    } elseif (strpos($match[2][$idx], '人找车') !== false ) {
                        $data['type'] = 'people';
                    } else {
                        break;
                    }
                } elseif (strpos($th, '出发时间') !== false) {
                    $start = preg_replace('/[\s\S]*\>([\s\S]*?)\<[\s\S]*/i', '\\1', $match[2][$idx]);
                    $today1 = date('Y-m-d ');
                    $today2 = date('Y-m-d ', strtotime('+1 day'));
                    $today3 = date('Y-m-d ', strtotime('+2 day'));
                    $today4 = date('Y-m-d ', strtotime('-1 day'));
                    $data['start_at'] = str_replace(['今天', '明天', '后天', '昨天'], [$today1, $today2, $today3, $today4], $start);
                    if (strlen(trim($data['start_at'])) == 10) {
                        $data['start_at'] .= ' 00:00:00';
                    }
                    if (strlen(trim($data['start_at'])) == 16) {
                        $data['start_at'] .= ':00';
                    }
                } elseif (strpos($th, '时间补充') !== false) {
                    $data['additional'] = $match[2][$idx];
                } elseif (strpos($th, '出发地') !== false) {
                    $data['direction_from'] = $match[2][$idx];
                } elseif (strpos($th, '目的地') !== false) {
                    $data['direction_to'] = $match[2][$idx];
                } elseif (strpos($th, '途径') !== false) {
                    $data['directions'] = $match[2][$idx];
                } elseif (strpos($th, '车型') !== false) {
                    $data['car_type'] = $match[2][$idx];
                } elseif (strpos($th, '空位') !== false || strpos($th, '人数') !== false) {
                    $data['seat_cnt'] = str_replace(['人', '空位'], '', $match[2][$idx]);
                } elseif (strpos($th, '手机') !== false) {
                    $data['phone'] = preg_replace('/[\s\S]*\>([\s\S]*?)\<[\s\S]*/i', '\\1', $match[2][$idx]);
                } elseif (strpos($th, '更多') !== false) {
                    $data['description'] = $match[2][$idx];
                }
            }
            return $data;
        }
        return [];
    }
}
