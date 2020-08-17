<?php

namespace App\Notifications;

use App\UserData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderCreated extends Notification
{
    use Queueable;

    protected $userDataModel;

    /**
     * Create a new notification instance.
     *
     * @param UserData $userData
     */
    public function __construct(UserData $userData)
    {
        $this->userDataModel = $userData;
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
        $url = url('admin/user-datas/' . $this->userDataModel->id);
        return (new MailMessage)
            ->subject('New order ' . $this->userDataModel->id)
            ->greeting('Hello!')
                    ->line('User ordered a product')
                    ->action('View Order', $url)
                    ->line('Thank you for using our application!');
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
