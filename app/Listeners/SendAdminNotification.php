<?php

namespace App\Listeners;

use App\Events\FormContactStored;
use App\Notifications\AdminNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAdminNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FormContactStored $event
     * @return void
     */
    public function handle(FormContactStored $event)
    {
        \Notification::route('mail', config('settings.email_feedback'))
            ->notify(new AdminNotification($event->form));
    }
}
