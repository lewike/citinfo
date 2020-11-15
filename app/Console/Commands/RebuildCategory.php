<?php

namespace App\Console\Commands;

use Illuminate\Support\Arr;
use App\Model\Category;
use Illuminate\Console\Command;

class RebuildCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citinfo:rebuild-cate';

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
        $categories = Category::all();
        $tmp = [];
        foreach($categories as $category) {
            if ($category['p_id'] == 0) {
                $tmp[$category['m_id']]['cate'] = $category; 
            } else {
                $tmp[$category['p_id']]['subcate'][] = $category;
            }
        }
        
        ksort($tmp);
        
        $id = 1;
        foreach($tmp as $t) {
            $cate = Category::create(Arr::except($t['cate']->toArray(), ['id']));
            $cate->update(['m_id' => $id, 'path' => '/0/'.$id, 'index_path' => '/0']);
            $id++;
            foreach($t['subcate'] as $subt) {
                $subCate = Category::create(Arr::except($subt->toArray(), ['id']));
                $subCate->update([
                    'm_id' => $id,
                    'path' => $cate->path.'/'.$id,
                    'index_path' => $cate->path,
                    'p_id' => $cate->m_id,
                ]);
                $id++;
            }
        }
        return 0;
    }
}
