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
            @if($contact->assignedUser)
                <p>Assigned To: {{ $contact->assignedUser->user_name }}</p>
            @else
                <p>Assigned To: Unassigned</p>
            @endif
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
                        <option value="Open" @if($contact->status == 'Open') selected @endif>Open</option>
                        <option value="In Progress" @if($contact->status == 'In Progress') selected @endif>In Progress</option>
                        <option value="Closed" @if($contact->status == 'Closed') selected @endif>Closed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Assign To</label>
                    <select name="assigned_to" class="form-control">
                        <option value="">Unassigned</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $contact->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->user_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group"><label>Read At</label>
                    <input type="datetime-local" name="read_at" value="{{ old('read_at', $contact->read_at) }}">
                </div>
                <div class="form-group"><label>Replied At</label>
                    <input type="datetime-local" name="replied_at" value="{{ old('replied_at', $contact->replied_at) }}">
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