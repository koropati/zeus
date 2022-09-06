<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ZeusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $toEmail;
    public $toName;
    public $fromEmail;
    public $fromName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toEmail, $toName, $fromEmail, $fromName)
    {
        $this->toEmail = $toEmail;
        $this->toName = $toName;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('zeus@admin.com')
        ->view('email.notice')
        ->with([
            'to_name' => $this->toName,
            'to_email' => $this->toEmail,
            'from_name' => $this->fromName,
            'from_email' => $this->fromEmail
        ]);
    }
}
