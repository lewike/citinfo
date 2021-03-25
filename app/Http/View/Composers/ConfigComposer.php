<?php

namespace App\Http\View\Composers;

use App\Model\Config;
use Illuminate\View\View;

class ConfigComposer
{
    public $websiteConfig;

    public function __construct()
    {
        $this->websiteConfig = Config::value('website');
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('config', $this->websiteConfig);
    }
}
