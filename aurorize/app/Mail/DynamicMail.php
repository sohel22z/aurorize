<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DynamicMail extends Mailable
{
    use Queueable, SerializesModels;

    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->content['subject'])
            ->markdown('emails.dynamicEmail')
            ->with('content', $this->content['body']);

        if (isset($this->content['attachment']) && !empty($this->content['attachment'])) {
            if (is_array($this->content['attachment'])) {
                foreach ($this->content['attachment'] as $file) {
                    $this->attach($file);
                }
            } else {
                $this->attach($this->content['attachment']);
            }
        }

        return $this;
    }
}
