<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FavoritesMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Array with Favorites Products ID's and Name's
     *
     * @var $favorites
     */
    public $favorites;

    /**
     * Create a new message instance.
     *
     * @param $favorites
     */
    public function __construct($favorites)
    {
        $this->favorites = $favorites;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->view('mails.favorites')
            ->text('mails.favorites_plain');
    }
}
