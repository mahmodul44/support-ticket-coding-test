@extends('layouts.app')

@section('content')
<h1>Your Tickets</h1>
@foreach($tickets as $ticket)
    <div>
        <h3>{{ $ticket->subject }}</h3>
        <p>{{ $ticket->message }}</p>
        <p>Status: {{ $ticket->status }}</p>
    </div>
@endforeach

<a href="{{ route('tickets.create') }}">Create New Ticket</a>
@endsection
