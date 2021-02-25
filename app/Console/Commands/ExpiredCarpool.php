<?php

namespace App\Console\Commands;

use App\Model\Carpool;
use Illuminate\Console\Command;

class ExpiredCarpool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'citinfo:expired-carpool';

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
        $this->expiredStick();
        $this->expiredCarpool();
        return 0;
    }

    public function expiredStick()
    {
        Carpool::where('sticky', 1)->where('sticky_expired_at', '<', date('Y-m-d H:i:s'))->update(['sticky' => 0]);
    }

    public function expiredCarpool()
    {
        Carpool::where('start_at', '<', date('Y-m-d H:i:s'))->delete();
    }
}
