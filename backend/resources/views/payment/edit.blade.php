@extends('layouts.app')
@section('content')
<div class="page-container">
    <div class="page-header">
         <a href="{{ route('payment.index') }}" class="back-button">&#x2190;</a>
        <h1>Editing Payment #{{ $payment->payment_id }}</h1>
    </div>
    <div class="form-card-full striped-form">
        <form action="{{ route('payment.update', $payment->payment_id) }}" method="POST">
             @csrf
             @method('PUT')

            {{-- User Dropdown --}}
            <div class="form-group-inline">
                <label>User</label>
                <select name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->user_id }}" @if($user->user_id == $payment->user_id) selected @endif>
                            {{ $user->user_id }} - {{ $user->user_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Property Dropdown --}}
            <div class="form-group-inline">
                <label>Property</label>
                <select name="property_id">
                    @foreach ($properties as $property)
                        <option value="{{ $property->id }}" @if($property->id == $payment->property_id) selected @endif>
                            {{ $property->id }} - {{ $property->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group-inline"><label>Payment Amount</label><input type="text" name="payment_amount" value="{{ $payment->payment_amount }}"></div>
            <div class="form-group-inline"><label>Payment Date</label><input type="date" name="payment_date" value="{{ $payment->payment_date }}"></div>
            <div class="form-group-inline"><label>Payment Status</label><input type="text" name="payment_status" value="{{ $payment->payment_status }}"></div>
            <div class="form-group-inline"><label>Payment Type</label><input type="text" name="payment_type" value="{{ $payment->payment_type }}"></div>
            <div class="form-actions-center">
                <button type="submit" class="btn btn-save">Save Change</button>
            </div>
        </form>
    </div>
</div>
@endsection