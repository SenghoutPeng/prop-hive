@extends('layouts.app')

@section('title', 'Create Support Ticket - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
    <style>
        .support-ticket-section {
            display: flex;
            gap: 2.5rem;
            max-width: 1100px;
            margin: 3rem auto 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.08);
            padding: 2.5rem 2rem;
        }
        .support-ticket-left {
            flex: 1 1 320px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-right: 1.5rem;
        }
        .support-ticket-left h2 {
            font-size: 2.1rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }
        .support-ticket-left p {
            color: #666;
            font-size: 1.1rem;
        }
        .support-ticket-form-col {
            flex: 1 1 400px;
            display: flex;
            align-items: center;
        }
        .modern-card-form {
            width: 100%;
            background: none;
            box-shadow: none;
            border-radius: 0;
            padding: 0;
            margin: 0;
        }
        .modern-card-form .form-group {
            margin-bottom: 1.5rem;
        }
        .modern-card-form label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }
        .modern-card-form .form-control {
            width: 100%;
            padding: 1rem 1.1rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1.08rem;
            background: #fafbfc;
            transition: border 0.2s;
        }
        .modern-card-form .form-control:focus {
            border: 1.5px solid #eab308;
            outline: none;
            background: #fffbe6;
        }
        .modern-card-form button {
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            background: #eab308;
            color: #222;
            font-size: 1.15rem;
            font-weight: 700;
            margin-top: 0.5rem;
            transition: background 0.2s;
        }
        .modern-card-form button:hover {
            background: #c59d07;
        }
        @media (max-width: 900px) {
            .support-ticket-section {
                flex-direction: column;
                padding: 1.5rem 0.5rem;
            }
            .support-ticket-left {
                padding-right: 0;
                margin-bottom: 2rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="contact-hero">
        <div class="container">
            <h1>Create Support Ticket</h1>
            <p>Submit a new support request to our team</p>
        </div>
    </section>
    <section class="support-ticket-section">
        <div class="support-ticket-left">
            <h2>Submit a Ticket</h2>
            <p>If your question isn't answered in our FAQs, please fill out the form to get in touch with our support team. You can use this as a guest or a registered user.</p>
        </div>
        <div class="support-ticket-form-col">
            <form class="modern-card-form" method="POST" action="{{ route('support-tickets.store') }}">
                @csrf
                @guest
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required class="form-control" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="user_email">Your Email</label>
                    <input type="email" id="user_email" name="user_email" required class="form-control" placeholder="Enter your email">
                </div>
                @endguest
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required class="form-control" placeholder="Describe your issue in detail"></textarea>
                </div>
                <button type="submit">Send Ticket</button>
            </form>
        </div>
    </section>
@endsection 