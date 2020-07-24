<?php

namespace App\Console\Commands;

use App\Lib\Scraper;
use Illuminate\Console\Command;

class ScheduleParsing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate total pages and create cron task for future parsing';

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
        $scraper = new Scraper('https://www.smartcut.co.il/wp-content/themes/lmg/ajax/filterpackages.php');
        $scraper->schedule();
    }
}
