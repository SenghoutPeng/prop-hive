@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('ticket.index') }}" class="back-button">&#x2190;</a>
        <h1>Edit Support Ticket</h1>
    </div>
    <div class="edit-layout-container">
        <div class="edit-info-panel">
            <img src="{{ asset('images/avatar.png') }}" class="edit-info-avatar" alt="User Avatar">
            <h2>{{ $ticket->user_email }}</h2>
            <p>Subject: {{ $ticket->support_ticket_subject }}</p>
        </div>
        <div class="edit-form-panel">
            @if ($errors->any())
                <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form action="{{ route('ticket.update', $ticket->support_ticket_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group"><label>Status</label>
                    <select name="support_ticket_status" class="form-control">
                        <option value="Open" @if($ticket->support_ticket_status == 'Open') selected @endif>Open</option>
                        <option value="In Progress" @if($ticket->support_ticket_status == 'In Progress') selected @endif>In Progress</option>
                        <option value="Closed" @if($ticket->support_ticket_status == 'Closed') selected @endif>Closed</option>
                    </select>
                </div>
                <div class="form-group"><label>Message</label>
                    <textarea name="support_ticket_message" rows="5" class="form-control">{{ old('support_ticket_message', $ticket->support_ticket_message) }}</textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="window.location='{{ route('ticket.index') }}'">Cancel</button>
                    <button type="submit" class="btn btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 