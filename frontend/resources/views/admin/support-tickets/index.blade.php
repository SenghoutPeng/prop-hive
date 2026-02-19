@extends('layouts.app')

@section('title', 'Admin - Support Tickets - PropHive')

@push('styles')
    <style>
        .admin-tickets-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .page-header h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            color: #666;
            font-size: 1.1rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-pending { color: #856404; }
        .stat-in_progress { color: #004085; }
        .stat-resolved { color: #155724; }
        .stat-closed { color: #721c24; }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .tickets-table {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .table-header {
            background: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .table-header h2 {
            margin: 0;
            color: #333;
            font-size: 1.3rem;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }
        
        .table tr:hover {
            background: #f8f9fa;
        }
        
        .ticket-status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
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
        
        .btn-view {
            background: #007bff;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }
        
        .btn-view:hover {
            background: #0056b3;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }
        
        .empty-state h3 {
            margin-bottom: 1rem;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .admin-tickets-container {
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .table {
                font-size: 0.9rem;
            }
            
            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="admin-tickets-container">
        <div class="page-header">
            <h1>Support Tickets Management</h1>
            <p>Manage and respond to user support requests</p>
        </div>
        
        @php
            $pendingCount = $tickets->where('support_ticket_status', 'pending')->count();
            $inProgressCount = $tickets->where('support_ticket_status', 'in_progress')->count();
            $resolvedCount = $tickets->where('support_ticket_status', 'resolved')->count();
            $closedCount = $tickets->where('support_ticket_status', 'closed')->count();
        @endphp
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number stat-pending">{{ $pendingCount }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-in_progress">{{ $inProgressCount }}</div>
                <div class="stat-label">In Progress</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-resolved">{{ $resolvedCount }}</div>
                <div class="stat-label">Resolved</div>
            </div>
            <div class="stat-card">
                <div class="stat-number stat-closed">{{ $closedCount }}</div>
                <div class="stat-label">Closed</div>
            </div>
        </div>
        
        <div class="tickets-table">
            <div class="table-header">
                <h2>All Support Tickets ({{ $tickets->count() }})</h2>
            </div>
            
            @if($tickets->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Last Response</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>#{{ $ticket->support_ticket_id }}</td>
                                <td>
                                    <strong>{{ $ticket->support_ticket_subject }}</strong>
                                    <br>
                                    <small>{{ Str::limit($ticket->support_ticket_message, 50) }}</small>
                                </td>
                                <td>
                                    {{ $ticket->user_email }}
                                    <br>
                                    <small>User ID: {{ $ticket->user_id }}</small>
                                </td>
                                <td>
                                    <span class="ticket-status status-{{ $ticket->support_ticket_status }}">
                                        {{ ucfirst(str_replace('_', ' ', $ticket->support_ticket_status)) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $ticket->support_ticket_created_at ? $ticket->support_ticket_created_at->format('M d, Y H:i') : 'N/A' }}
                                </td>
                                <td>
                                    {{ $ticket->support_ticket_responded_at ? $ticket->support_ticket_responded_at->format('M d, Y H:i') : 'No response' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.support-tickets.show', $ticket->support_ticket_id) }}" class="btn-view">View & Respond</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <h3>No Support Tickets</h3>
                    <p>There are no support tickets in the system yet.</p>
                </div>
            @endif
        </div>
    </div>
@endsection 