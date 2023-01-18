<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompanyInvitation extends Notification
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

      $url = url('/accept-company-invitation/?token=' . $this->invitation->invitation_token . '&email=' . $this->invitation->email . '&company=' . $this->invitation->company_id);

        return (new MailMessage)
                    ->subject('Invitation to join a company')
                    ->greeting('Hello! You have been invited to join a company.')
                    ->line("Accept the invitation by clicking the button below. If you don't have an account, you will be asked to create one.")
                    ->action('Accept Invitation', $url)
                    ->line('If you did not expect to receive an invitation to this company, you may discard this email.');
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
