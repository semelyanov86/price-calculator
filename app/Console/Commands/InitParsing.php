<?php

namespace App\Console\Commands;

use App\Lib\Scraper;
use App\ScanQueue;
use Illuminate\Console\Command;

class InitParsing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get scheduler tasks and parse results';

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
        $scanModel = $this->getFirstQueue();
        if ($scanModel) {
            $scanModel->tries = $scanModel->tries + 1;
            $scanModel->save();
        }
        if ($scanModel) {
            $scraper = new Scraper($scanModel->scan_url);
            $scraper->initQueue($scanModel);
        } else {
            return 0;
        }
    }

    private function getFirstQueue()
    {
        return ScanQueue::where('scan_finished', '0')->where('tries', '<', config('services.parser.maxTries'))->first();
    }
}
