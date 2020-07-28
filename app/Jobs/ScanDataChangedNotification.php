<?php

namespace App\Jobs;

use App\Notifications\ScanDataChanged;
use App\ScanDataCellular;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScanDataChangedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scanDataModel;

    /**
     * Create a new job instance.
     *
     * @param ScanDataCellular $scanDataModel
     */
    public function __construct(ScanDataCellular $scanDataModel)
    {
        $this->scanDataModel = $scanDataModel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin_user = User::whereId(1)->first();
        $admin_user->notify(new ScanDataChanged($this->scanDataModel));
    }
}
