<?php

namespace App\Listeners\Forms;

use App\Events\Forms\ContactStored;
use App\Notifications\ThankForYourMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactSendNotifications implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContactStored $event
     * @return void
     */
    public function handle(ContactStored $event)
    {
        \Notification::route('mail', 'yarmatua@gmail.com')
            ->notify(new ThankForYourMessage());
    }
}
