@extends('layouts.app')

@section('title', 'Admin - Support Ticket Details - PropHive')

@push('styles')
    <style>
        .admin-ticket-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            color: #333;
            font-size: 2rem;
            margin: 0;
        }
        
        .btn-back {
            background: #6c757d;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }
        
        .btn-back:hover {
            background: #545b62;
        }
        
        .ticket-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .ticket-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .ticket-subject {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .ticket-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-in_progress {
            background: #cce5ff;
            color: #004085;
        }
        
        .status-resolved {
            background: #d4edda;
            color: #155724;
        }
        
        .status-closed {
            background: #f8d7da;
            color: #721c24;
        }
        
        .ticket-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .meta-item {
            display: flex;
            flex-direction: column;
        }
        
        .meta-label {
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .meta-value {
            font-size: 1rem;
            color: #333;
            font-weight: 600;
        }
        
        .ticket-message {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 5px;
            border-left: 4px solid #007bff;
            margin-bottom: 1.5rem;
        }
        
        .message-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        
        .message-content {
            color: #555;
            line-height: 1.6;
            white-space: pre-wrap;
        }
        
        .response-form {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }
        
        .response-form h3 {
            margin-bottom: 1rem;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }
        
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0056b3;
        }
        
        .response-section {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e0e0e0;
        }
        
        .response-header {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }
        
        .no-response {
            color: #666;
            font-style: italic;
        }
        
        @media (max-width: 768px) {
            .admin-ticket-container {
                padding: 1rem;
            }
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
            
            .ticket-header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .ticket-meta {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <div class="admin-ticket-container">
        <div class="page-header">
            <h1>Support Ticket #{{ $ticket->support_ticket_id }}</h1>
            <a href="{{ route('admin.support-tickets.index') }}" class="btn-back">← Back to Tickets</a>
        </div>
        
        <div class="ticket-card">
            <div class="ticket-header">
                <h2 class="ticket-subject">{{ $ticket->support_ticket_subject }}</h2>
                <span class="ticket-status status-{{ $ticket->support_ticket_status }}">
                    {{ ucfirst(str_replace('_', ' ', $ticket->support_ticket_status)) }}
                </span>
            </div>
            
            <div class="ticket-meta">
                <div class="meta-item">
                    <span class="meta-label">Ticket ID</span>
                    <span class="meta-value">#{{ $ticket->support_ticket_id }}</span>
                </div>
                
                <div class="meta-item">
                    <span class="meta-label">User Email</span>
                    <span class="meta-value">{{ $ticket->user_email }}</span>
                </div>
                
                <div class="meta-item">
                    <span class="meta-label">User ID</span>
                    <span class="meta-value">{{ $ticket->user_id }}</span>
                </div>
                
                <div class="meta-item">
                    <span class="meta-label">Created</span>
                    <span class="meta-value">
                        {{ $ticket->support_ticket_created_at ? $ticket->support_ticket_created_at->format('M d, Y \a\t H:i') : 'N/A' }}
                    </span>
                </div>
                
                @if($ticket->support_ticket_responded_at)
                    <div class="meta-item">
                        <span class="meta-label">Last Response</span>
                        <span class="meta-value">
                            {{ $ticket->support_ticket_responded_at->format('M d, Y \a\t H:i') }}
                        </span>
                    </div>
                @endif
            </div>
            
            <div class="ticket-message">
                <div class="message-label">User's Message:</div>
                <div class="message-content">{{ $ticket->support_ticket_message }}</div>
            </div>
            
            @if(str_contains($ticket->support_ticket_message, '--- Admin Response ---'))
                <div class="response-section">
                    <div class="response-header">Previous Admin Response:</div>
                    <div class="message-content">
                        @php
                            $parts = explode('--- Admin Response ---', $ticket->support_ticket_message);
                            echo trim($parts[1] ?? '');
                        @endphp
                    </div>
                </div>
            @endif
            
            <form class="response-form" method="POST" action="{{ route('admin.support-tickets.update-status', $ticket->support_ticket_id) }}">
                @csrf
                @method('PATCH')
                
                <h3>Update Ticket Status & Respond</h3>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="pending" {{ $ticket->support_ticket_status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $ticket->support_ticket_status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $ticket->support_ticket_status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="closed" {{ $ticket->support_ticket_status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="response">Response Message (Optional)</label>
                    <textarea name="response" id="response" placeholder="Add your response to the user..."></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Ticket</button>
                </div>
            </form>
        </div>
    </div>
@endsection 