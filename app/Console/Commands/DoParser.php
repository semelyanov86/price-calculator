<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Lib\Scraper;

class DoParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Running parser through console';

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
        $scraper->handle();
        dd($scraper->results);
    }
}
