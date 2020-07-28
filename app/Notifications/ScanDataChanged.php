<?php

namespace App\Notifications;

use App\ScanDataCellular;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScanDataChanged extends Notification
{
    use Queueable;

    protected $scanDataModel;

    /**
     * Create a new notification instance.
     *
     * @param ScanDataCellular $scanDataModel
     */
    public function __construct(ScanDataCellular $scanDataModel)
    {
        $this->scanDataModel = $scanDataModel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/admin/scan-data-cellulars/' . $this->scanDataModel->id);
        return (new MailMessage)
            ->greeting('Hello!')
            ->line('Data was updated for line: ' . $this->scanDataModel->package_name)
            ->action('View Scan Data', $url)
            ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
