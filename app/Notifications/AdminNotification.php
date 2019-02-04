<?php

namespace App\Notifications;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $form;


    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Application from the site - "' . config('app.name') . '".')
            ->from('no-reply@' . parse_url(config('app.url'), PHP_URL_HOST), 'Not Reply (Robot)')
            ->line('Author Name:' . $this->form->user->name ?? $this->form->name)
            ->line('Author E-mail:' . $this->form->user->email ?? $this->form->email)
            ->line('Author Message:' . $this->form->message)
            ->subject('Form from the ' . config('app.url'))
            ->action('Form Sent From', $this->form->url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
