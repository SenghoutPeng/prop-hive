@extends('layouts.app')

@section('title', 'Payment History - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/payment-history.css') }}">
@endpush

@section('content')
    <main class="payment-history-page">
        <div class="container">
            <section class="payment-hero">
                <h2>Your Payment History</h2>
                <p>View all your transactions in one place.</p>
            </section>

            <div class="section-divider"></div>

            <section class="payments-section">
                <div class="payments-title-column">
                    <h3>Payments</h3>
                    <p>A detailed list of your payments.</p>
                </div>
                <div class="transaction-list-column">
                    <ul class="transaction-list">
                        @forelse($payments as $payment)
                            <li class="transaction-item">
                                <div class="transaction-main">
                                    <img src="{{ asset('image/creditcard.png') }}" class="transaction-icon" alt="Payment Icon">
                                    <div class="transaction-details">
                                        <h4>{{ $payment->description ?? ucfirst($payment->payment_type) }}</h4>
                                        <p class="status-{{ $payment->payment_status }}">{{ ucfirst($payment->payment_status) }}</p>
                                    </div>
                                </div>
                                <div class="transaction-amount @if($payment->payment_type === 'refund') refund @endif">
                                    <p>{{ $payment->payment_type === 'refund' ? '-' : '' }}${{ number_format($payment->payment_amount, 2) }}</p>
                                </div>
                                <div class="transaction-date">
                                    <small>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') : '' }}</small>
                                </div>
                            </li>
                        @empty
                            <li class="transaction-item">
                                <div class="transaction-details">
                                    <p>No payments found.</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </section>
        </div>
    </main>
@endsection
