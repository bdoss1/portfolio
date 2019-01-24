<?php

namespace App\Mail;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $form = $this->form;

        return $this->view('mail.contact_form')
            ->with(compact('form'))
            ->from('noreply@' . parse_url(config('app.url'), PHP_URL_HOST), 'Robot ' . config('app.name'))
            ->to(config('admin.user_email'), config('admin.user_name'));
    }
}
