<?php

namespace App\Listeners;

use App\Events\FormContactStored;
use App\Notifications\VisitorThankNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendThankVisitorNotification
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
        \Notification::route('mail', $event->form->user->email ?? $event->form->email)
            ->notify((new VisitorThankNotification($event->form))->locale(\App::getLocale()));

    }
}
