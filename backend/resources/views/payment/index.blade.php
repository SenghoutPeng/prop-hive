@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>View and Manage Payment History</h1>
    </div>

    {{-- CREATE FORM --}}
    <div class="form-card-full striped-form">
        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="list-style-type: none; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            
            <div class="form-group-inline">
                <label>User</label>
                <select name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->user_id }}">{{ $user->user_id }} - {{ $user->user_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group-inline">
                <label>Property</label>
                <select name="property_id">
                    @foreach ($properties as $property)
                        <option value="{{ $property->id }}">{{ $property->id }} - {{ $property->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group-inline"><label>Payment Amount</label><input type="text" name="payment_amount" value="{{ old('payment_amount') }}"></div>
            <div class="form-group-inline"><label>Payment Date</label><input type="date" name="payment_date" value="{{ old('payment_date') }}"></div>
            
            <div class="form-group-inline">
                <label>Payment Status</label>
                <select name="payment_status">
                    @foreach ($paymentStatuses as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group-inline">
                <label>Payment Type</label>
                <select name="payment_type">
                    @foreach ($paymentTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-actions-center">
                <button type="submit" class="btn btn-save">Create</button>
            </div>
        </form>
    </div>

    {{-- LIST OF PAYMENTS --}}
    <div class="list-container">
        <h2>Payment Transactions</h2>
        @if(session('success'))
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        @foreach($payments as $payment)
            <div class="transaction-item">
                <div class="transaction-icon-placeholder"></div>
                <div class="transaction-details">
                    <p class="transaction-id">Payment ID: {{ $payment->payment_id }} | User: {{ optional($users->firstWhere('user_id', $payment->user_id))->user_name ?? $payment->user_id }}</p>
                    <p class="transaction-status {{ strtolower($payment->payment_status) }}">{{ $payment->payment_status }}</p>
                </div>
                <div class="transaction-amount">${{ number_format($payment->payment_amount, 2) }}</div>
                <div class="transaction-actions">
                    <button type="button" class="btn btn-save" onclick="showDetails('payment-details-{{ $payment->payment_id }}')">View Details</button>
                    <a href="{{ route('payment.edit', $payment->payment_id) }}">
                        <img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon">
                    </a>

                    <form action="{{ route('payment.destroy', $payment->payment_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this payment?')" style="border:none; background:none; cursor:pointer; padding:0;">
                            <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon">
                        </button>
                    </form>
                </div>
            </div>
            <div id="payment-details-{{ $payment->payment_id }}" style="display:none;">
                <h3>Payment Details</h3>
                <ul>
                    <li><strong>Payment ID:</strong> {{ $payment->payment_id }}</li>
                    <li><strong>User ID:</strong> {{ $payment->user_id }}</li>
                    <li><strong>Property ID:</strong> {{ $payment->property_id }}</li>
                    <li><strong>Amount:</strong> {{ $payment->payment_amount }}</li>
                    <li><strong>Date:</strong> {{ $payment->payment_date }}</li>
                    <li><strong>Status:</strong> {{ $payment->payment_status }}</li>
                    <li><strong>Type:</strong> {{ $payment->payment_type }}</li>
                    <li><strong>Created At:</strong> {{ $payment->created_at ?? '' }}</li>
                </ul>
            </div>
        @endforeach
    </div>
</div>
<!-- Modal for Viewing Details -->
<div id="details-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDetails()">&times;</span>
        <div id="details-content"></div>
    </div>
</div>
@push('scripts')
<script>
function showDetails(detailId) {
    document.getElementById('details-modal').style.display = 'block';
    document.getElementById('details-content').innerHTML = document.getElementById(detailId).innerHTML;
}
function closeDetails() {
    document.getElementById('details-modal').style.display = 'none';
}
</script>
@endpush
@endsection