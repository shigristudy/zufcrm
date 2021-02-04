<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendReportNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return (new MailMessage)
                    ->line('Assalaamu Alaikum from Zia-Ul-Ummah Foundation')
                    ->line('Jazakumullahu Khayran for sponsoring one of our students. Please see attached the current report for this student.')
                    ->line('May Allah bless you for donating to this cause and we hope you continue to do so in shaa Allah.')
                    ->line('Zia-Ul-Ummah Foundation')
                    ->line('This email was sent from Zia-Ul-Ummah Foundation. Please visit our website for more information: https://www.zialulummahfoundation.org.ukvia');
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
