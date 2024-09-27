@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Support Ticket Details</h2>

    <div class="card mb-4">
        <div class="card-header">
            Support Ticket Information
        </div>
        <div class="card-body">
            <p><strong>Tracking No:</strong> {{ $ticket->tracking_no }}</p>
            <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
            <p><strong>Message:</strong> {{ $ticket->description }}</p>
            <p><strong>Submitted by:</strong> {{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
            <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
            <p><strong>Submitted on:</strong> {{ $ticket->created_at->format('d M Y, h:i:s A') }}</p>
            @if($ticket->status == 'closed')
            <p><strong>Admin Remarks:</strong> {{ $ticket->admin_remarks }}</p>
            <p><strong>Responsed on:</strong> {{ $ticket->updated_at->format('d M Y, h:i:s a') }}</p>
            @endif
        </div>
    </div>
            <a href="{{route('customer.tickets')}}" class="btn btn-info">Back to List</a>
            </form>
        </div>
    </div>
   
</div>
@endsection
