@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ticket Details</h2>

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
            <p><strong>Submitted on:</strong> {{ $ticket->created_at->format('d M Y, h:i:s a') }}</p>
            @if($ticket->status == 'closed')
            <p><strong>Admin Remarks:</strong> {{ $ticket->admin_remarks }}</p>
            <p><strong>Responsed on:</strong> {{ $ticket->updated_at->format('d M Y, h:i:s a') }}</p>
            @endif
        </div>
    </div>

    {{-- Admin Response Form --}}
    @if($ticket->status == 'open' )
    <div class="card">
        <div class="card-header">
            Update Ticket Status
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.ticket.update', $ticket->id) }}">
                @csrf
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="" ></option>
                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group pb-3">
                    <label for="remarks">Remarks (Optional)</label>
                    <textarea name="remarks" id="remarks" class="form-control" rows="4">{{ old('remarks', $ticket->admin_remarks) }}</textarea>
                    @error('remarks')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
               
                <button type="submit" class="btn btn-primary">Update Ticket</button>
                @endif
                <a href="{{route('admin.tickets')}}" class="btn btn-info">Back to List</a>
            </form>
        </div>
    </div>
   
</div>
@endsection
