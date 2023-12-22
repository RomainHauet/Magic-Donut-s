<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contenu;

    public function __construct($contenu)
    {
        $this->contenu = $contenu;
    }

    public function build()
    {
        return $this->view('emails.news')->with(['contenu' => $this->contenu]);
    }

}
