@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Display success or error messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tickets List --}}
    <div class="card mb-4">
        <div class="card-header">
            Your Support Tickets
        </div>
        <div class="card-body">
            @if($tickets->isEmpty())
                <p>No tickets yet. Submit your ticket!</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tracking No </th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->tracking_no }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ ucfirst($ticket->status) }}</td>
                                <td>{{ $ticket->created_at->format('d M Y, h:i:s A') }}</td>
                                <td><a href="{{ route('customer.ticket.view', $ticket->id) }}" class="btn btn-info btn-sm">View</a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Submit a New Ticket --}}
    <div class="card">
        <div class="card-header">
            Submit a New Ticket
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tickets.store') }}">
                @csrf
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" required>
                    @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group pb-2">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" rows="4" required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit Ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
