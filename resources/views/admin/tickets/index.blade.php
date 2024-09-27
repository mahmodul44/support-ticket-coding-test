@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Support Tickets</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Tickets
        </div>
        <div class="card-body">
            @if($tickets->isEmpty())
                <p>No tickets available.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tracking No </th>
                            <th>Customer</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->tracking_no }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ ucfirst($ticket->status) }}</td>
                                <td>{{ $ticket->created_at->format('d M Y, h:i:s A') }}</td>
                                <td>
                                    <a href="{{ route('admin.ticket.view', $ticket->id) }}" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
