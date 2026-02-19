@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Manage Consumer Utility Usage</h1>
        <p>Create, edit, or delete bills for water and electricity usage.</p>
    </div>
    <div class="utility-body">
        <div class="utility-list">
            <h2>Utility Bills</h2>
            <p>Overview of all active utility bills.</p>

            @if(session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    {{ session('success') }}
                </div>
            @endif

            @foreach($utilityBills as $bill)
                <div class="transaction-item">
                    <div class="transaction-icon-placeholder"></div>
                    <div class="transaction-details">
                        <p class="transaction-id">{{ $bill->user->user_name }}'s bill for {{ $bill->utility_bill_type }}</p>
                        <p class="transaction-status {{ strtolower($bill->utility_bill_status) }}">{{ $bill->utility_bill_status }}</p>
                    </div>
                    <div class="transaction-amount">${{ number_format($bill->utility_bill_amount, 2) }}</div>
                    <div class="transaction-actions">
                        <button type="button" class="btn btn-save" onclick="showDetails('utility-details-{{ $bill->utility_bill_id }}')">View Details</button>
                        <a href="{{ route('utility.edit', $bill->utility_bill_id) }}"><img src="{{ asset('images/edit-icon.png') }}" alt="Edit" class="action-icon"></a>
                        <form action="{{ route('utility.destroy', $bill->utility_bill_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" style="border:none; background:none; cursor:pointer; padding:0;">
                                <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="action-icon">
                            </button>
                        </form>
                    </div>
                </div>
                <div id="utility-details-{{ $bill->utility_bill_id }}" style="display:none;">
                    <h3>Utility Bill Details</h3>
                    <ul>
                        <li><strong>User:</strong> {{ $bill->user->user_name ?? '' }}</li>
                        <li><strong>Property:</strong> {{ $bill->property->property_title ?? '' }}</li>
                        <li><strong>Type:</strong> {{ $bill->utility_bill_type }}</li>
                        <li><strong>Status:</strong> {{ $bill->utility_bill_status }}</li>
                        <li><strong>Amount:</strong> {{ $bill->utility_bill_amount }}</li>
                        <li><strong>Usage:</strong> {{ $bill->utility_bill_usage }}</li>
                        <li><strong>Invoice Date:</strong> {{ $bill->utility_bill_date }}</li>
                        <li><strong>Due Date:</strong> {{ $bill->utility_bill_due_date }}</li>
                        <li><strong>Created At:</strong> {{ $bill->created_at ?? '' }}</li>
                    </ul>
                </div>
            @endforeach
        </div>
        <div class="form-card">
            <h2>Add Utility Bill</h2>
            @if ($errors->any())
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('utility.store') }}" method="POST">
                @csrf
                <div class="form-group"><label>User</label><select name="user_id">@foreach($users as $user)<option value="{{ $user->user_id }}">{{ $user->user_name }}</option>@endforeach</select></div>
                <div class="form-group"><label>Property</label><select name="property_id">@foreach($properties as $property)<option value="{{ $property->id }}">{{ $property->title }}</option>@endforeach</select></div>
                <div class="form-group"><label>Utility Type</label><select name="utility_bill_type">@foreach($types as $type)<option value="{{ $type }}">{{ $type }}</option>@endforeach</select></div>
                <div class="form-group"><label>Status</label><select name="utility_bill_status">@foreach($statuses as $status)<option value="{{ $status }}">{{ $status }}</option>@endforeach</select></div>
                <div class="form-group"><label>Amount</label><input type="text" name="utility_bill_amount" placeholder="Enter bill amount" value="{{ old('utility_bill_amount') }}"></div>
                <div class="form-group"><label>Usage</label><input type="text" name="utility_bill_usage" placeholder="Enter usage amount (e.g., 250)" value="{{ old('utility_bill_usage') }}"></div>
                <div class="form-group"><label>Invoice Date</label><input type="date" name="utility_bill_date" value="{{ old('utility_bill_date') }}"></div>
                <div class="form-group"><label>Due Date</label><input type="date" name="utility_bill_due_date" value="{{ old('utility_bill_due_date') }}"></div>
                <div class="form-actions"><button type="submit" class="btn btn-save">Save Bill</button></div>
            </form>
        </div>
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