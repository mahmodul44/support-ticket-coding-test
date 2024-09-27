<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    public $notificationType;
    /**
     * Create a new message instance.
     */
    public function __construct(Ticket $ticket, $notificationType)
    {
        $this->ticket = $ticket;
        $this->notificationType = $notificationType;
    }
   
    public function build()
    {
        $user = Auth()->user();
        return $this->view('emails.ticket_notification')
                    ->subject($this->getSubject())
                    ->with([
                        'ticketTrackingNo' => $this->ticket->tracking_no,
                        'ticketSubject' => $this->ticket->subject,
                        'ticketDescription' => $this->ticket->description, 
                        'submittedByName' => $user->name, 
                        'submittedByEmail' => $user->email,
                        'ticketStatus' => $this->ticket->status,
                        'ticketRemarks' => $this->ticket->admin_remarks,

                        
                    ]);
    }

    protected function getSubject()
    {
        return $this->notificationType === 'closed' 
            ? 'Your Support Ticket has been closed' 
            : 'New Support Ticket submitted';
    }
}
