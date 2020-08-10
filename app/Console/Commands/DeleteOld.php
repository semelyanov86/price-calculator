<?php

namespace App\Console\Commands;

use App\ScanDataCellular;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteOld extends Command
{
    const DAYS_SUBSTRACT = 2;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old cellular data';

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
        $dataScans = ScanDataCellular::all();
        $carbonNow = Carbon::now()->subDays(self::DAYS_SUBSTRACT);
        foreach ($dataScans as $dataScan) {
            $curDate = $dataScan->updated_at;
            if ($curDate->lt($carbonNow)) {
                $dataScan->delete();
            }
        }
        return 0;
    }
}
