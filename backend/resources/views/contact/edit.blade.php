@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('contact.index') }}" class="back-button">&#x2190;</a>
        <h1>Edit Property Request</h1>
    </div>
    <div class="edit-layout-container">
        <div class="edit-info-panel">
            <img src="{{ asset('images/avatar.png') }}" class="edit-info-avatar" alt="User Avatar">
            <h2>{{ $contact->name }}</h2>
            <p>Subject: {{ $contact->subject }}</p>
            <p>Email: {{ $contact->email }}</p>
        </div>
        <div class="edit-form-panel">
            @if ($errors->any())
                <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group"><label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending" @if(strtolower($contact->status) == 'pending') selected @endif>Pending</option>
                        <option value="in_progress" @if(strtolower($contact->status) == 'in_progress') selected @endif>In Progress</option>
                        <option value="resolved" @if(strtolower($contact->status) == 'resolved') selected @endif>Resolved</option>
                        <option value="closed" @if(strtolower($contact->status) == 'closed') selected @endif>Closed</option>
                    </select>
                </div>
                <div class="form-group"><label>User Message</label>
                    <textarea rows="4" class="form-control" readonly>{{ str_contains($contact->message, '--- Admin Response ---') ? trim(explode('--- Admin Response ---', $contact->message, 2)[0]) : $contact->message }}</textarea>
                </div>
                <div class="form-group"><label>Response Message (Optional)</label>
                    <textarea name="response" rows="5" class="form-control" placeholder="Add your response to the user...">{{ old('response', str_contains($contact->message, '--- Admin Response ---') ? trim(explode('--- Admin Response ---', $contact->message, 2)[1]) : '') }}</textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="window.location='{{ route('contact.index') }}'">Cancel</button>
                    <button type="submit" class="btn btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
