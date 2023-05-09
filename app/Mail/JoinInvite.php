<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class JoinInvite extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    public $actionText = 'Join';

    public $greeting='Hello!';

    public $salutation = 'Regards,';

    public $outroLines = [
        'Any challenges faced should be reported to the administration.',
        'If this email does not concern you, no further action is required.'
    ];

    public $introLines = [
        'You are receiving this email because WabaOne system admin invites you to create an account.'
    ];

    public $actionUrl;

    public $displayableActionUrl;

    public $level = 'success';

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $actionUrl)
    {
        //
        $this->user = $user;
        $this->actionUrl = $actionUrl;
        $this->displayableActionUrl = $actionUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address($this->user->email, $this->user->name),
            subject: 'WabaOne Join Invite',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invites.join',
        );
    }

    public function build()
    {
        return $this->markdown('emails.invites.join');
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
