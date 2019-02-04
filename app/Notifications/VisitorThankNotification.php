<?php

namespace App\Notifications;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VisitorThankNotification extends Notification implements ShouldQueue
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
        $name = $this->form->user->name ?? $this->form->name;

        return (new MailMessage)
            ->salutation(__('notifications.regards') . ", \n" . config('app.name'))
            ->greeting(__('notifications.hello') . ', ' . $name)
            ->line(__('notifications.message_sent_success'))
            ->line(__('notifications.thank_using_app'))
            ->from('no-reply@' . parse_url(config('app.url'), PHP_URL_HOST), 'Not Reply (Robot)')
            ->subject(__('notifications.subjects.thank_for_your_message') . ', ' . $name);
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
