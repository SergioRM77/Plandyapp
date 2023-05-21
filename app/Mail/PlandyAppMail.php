<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PlandyAppMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Información de PlandyApp!!";
    protected $direccion;
    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $direccion, array $datosAsoc = [])
    {
        $this->direccion = $direccion;
        $this->datos = $datosAsoc;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Información de PlandyApp',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        
        return new Content(
            view: $this->direccion,
            with: [
                "datos" => $this->datos
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    // public function build(){
    //     return $this->view("emails.send");
    // }
}
