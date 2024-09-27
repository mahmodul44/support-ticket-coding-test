<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
     /* ************* Customer Part Start ************** */
    public function customerIndex()
    {
        $tickets = Ticket::where('user_id', Auth::id())->orderBy('id','desc')->get();
        return view('customer.tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

       $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'description' => $request->message,
        ]);
      
        Mail::to('mahmodul44.cse@gmail.com')->send(new TicketMail($ticket, 'submitted'));
        return redirect()->route('customer.tickets')->with('success', 'Ticket created successfully.');
    }

    public function viewCustTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
    
        return view('customer.tickets.view', compact('ticket'));
    }

    /* ************* Admin Part Start ************** */

    public function adminIndex()
    {
        $tickets = Ticket::orderBy('id','desc')->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function viewTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
    
        return view('admin.tickets.view', compact('ticket'));
    }
    
    public function updateTicket(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'remarks' => 'nullable|string|max:5000',
        ]);
    
        $ticket = Ticket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->admin_remarks = $request->remarks;
        $ticket->save();

        Mail::to($ticket->user->email)->send(new TicketMail($ticket,'closed'));

        return redirect()->route('admin.tickets')->with('success', 'Ticket updated successfully!');
    }
}
