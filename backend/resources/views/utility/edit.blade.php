@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
        <a href="{{ route('utility.index') }}" class="back-button">&#x2190;</a>
        <h1>Edit Utility Bill #{{ $utilityBill->utility_bill_id }}</h1>
    </div>
    <div class="form-card-full">
         @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        <form action="{{ route('utility.update', $utilityBill->utility_bill_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group"><label>User</label><select name="user_id">@foreach($users as $user)<option value="{{ $user->user_id }}" @if($user->user_id == $utilityBill->user_id) selected @endif>{{ $user->user_name }}</option>@endforeach</select></div>
            <div class="form-group"><label>Property</label><select name="property_id">@foreach($properties as $property)<option value="{{ $property->id }}" @if($property->id == $utilityBill->property_id) selected @endif>{{ $property->title }}</option>@endforeach</select></div>
            <div class="form-group"><label>Utility Type</label><select name="utility_bill_type">@foreach($types as $type)<option value="{{ $type }}" @if($type == $utilityBill->utility_bill_type) selected @endif>{{ $type }}</option>@endforeach</select></div>
            <div class="form-group"><label>Status</label><select name="utility_bill_status">@foreach($statuses as $status)<option value="{{ $status }}" @if($status == $utilityBill->utility_bill_status) selected @endif>{{ $status }}</option>@endforeach</select></div>
            <div class="form-group"><label>Amount</label><input type="text" name="utility_bill_amount" value="{{ $utilityBill->utility_bill_amount }}"></div>
            <div class="form-group"><label>Usage</label><input type="text" name="utility_bill_usage" value="{{ $utilityBill->utility_bill_usage }}"></div>
            <div class="form-group"><label>Invoice Date</label><input type="date" name="utility_bill_date" value="{{ $utilityBill->utility_bill_date }}"></div>
            <div class="form-group"><label>Due Date</label><input type="date" name="utility_bill_due_date" value="{{ $utilityBill->utility_bill_due_date }}"></div>
            <div class="form-actions-center"><button type="submit" class="btn btn-save">Save Changes</button></div>
        </form>
    </div>
</div>
@endsection