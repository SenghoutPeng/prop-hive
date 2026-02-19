@extends('layouts.app')

@section('title', 'My Support Tickets - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
@endpush

@section('content')
    <section class="contact-hero">
        <div class="container">
            <h1>My Support Tickets</h1>
            <p>Track and manage your support requests</p>
        </div>
    </section>

    <section class="contact-content">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-form-container animate-on-scroll" style="width:100%;max-width:700px;margin:auto;">
                    @auth
                        @if($tickets->count() > 0)
                            <div style="margin-bottom:2rem;text-align:right;">
                                <a href="{{ route('support-tickets.create') }}" class="btn btn-primary">Create New Ticket</a>
                            </div>
                            <div class="tickets-list">
                                @foreach($tickets as $ticket)
                                    <div class="ticket-card" style="margin-bottom:1.5rem;padding:1.5rem;border:1px solid #eee;border-radius:10px;background:#fff;">
                                        <div style="display:flex;justify-content:space-between;align-items:center;">
                                            <div>
                                                <strong>{{ $ticket->name ?? 'No Name' }}</strong>
                                                <span style="color:#888;font-size:0.95em;">({{ $ticket->user_email }})</span>
                                            </div>
                                            <span class="ticket-status status-{{ $ticket->support_ticket_status }}" style="padding:0.25rem 0.75rem;border-radius:20px;font-size:0.85rem;font-weight:500;">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->support_ticket_status)) }}
                                            </span>
                                        </div>
                                        <div style="margin-top:0.5rem;">
                                            <div style="color:#333;font-size:1.1em;margin-bottom:0.5rem;white-space:pre-line;">{{ $ticket->support_ticket_message }}</div>
                                            <div style="color:#888;font-size:0.95em;">
                                                <span>Created: {{ $ticket->support_ticket_created_at ? $ticket->support_ticket_created_at->format('M d, Y H:i') : 'N/A' }}</span>
                                                @if($ticket->support_ticket_responded_at)
                                                    | <span>Responded: {{ $ticket->support_ticket_responded_at->format('M d, Y H:i') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state" style="text-align:center;padding:3rem;color:#666;">
                                <h3>No Support Tickets Yet</h3>
                                <p>You haven't created any support tickets yet. Click below to create your first ticket.</p>
                                <a href="{{ route('support-tickets.create') }}" class="btn btn-primary">Create Support Ticket</a>
                            </div>
                        @endif
                    @else
                        <div class="empty-state" style="text-align:center;padding:3rem;color:#666;">
                            <h3>Please Log In</h3>
                            <p>You must be logged in to view your support tickets.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection 