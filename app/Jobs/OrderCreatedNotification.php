<?php

namespace App\Jobs;

use App\Notifications\NewOrderCreated;
use App\User;
use App\UserData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCreatedNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userDataModel;

    /**
     * Create a new job instance.
     *
     * @param UserData $userDataModel
     */
    public function __construct(UserData $userDataModel)
    {
        $this->userDataModel = $userDataModel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin_user = User::whereId(1)->first();
        $admin_user->notify(new NewOrderCreated($this->userDataModel));
    }
}
