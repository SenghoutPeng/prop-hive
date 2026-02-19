@extends('layouts.app')

@section('title', 'Meet Our Team - PropHive')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/meet-our-team.css') }}">
@endpush

@section('content')
    <section class="team-hero">
        <div class="container text-center">
            <h2>Meet Our Team</h2>
            <p>A group of passionate individuals dedicated to excellence.</p>
        </div>
    </section>

    <section class="team-members">
        <div class="container">
            <h2 class="section-title">Team Members</h2>
            <p class="section-subtitle">Here are the key players behind our success.</p>
            <div class="team-grid">
                <div class="team-card">
                    <img src="{{ asset('image/kimchhay.jpg') }}" alt="Kimchhay Ea" class="team-avatar">
                    <h3 class="member-name">Kimchhay Ea</h3>
                    <p class="member-role">Project Manager</p>
                    <p class="member-bio">Back end Developer Of the Project.</p>
                </div>
                <div class="team-card">
                    <img src="{{ asset('image/songhy.jpg') }}" alt="Songhy Taing" class="team-avatar">
                    <h3 class="member-name">Songhy Taing</h3>
                    <p class="member-role">Lead Designer</p>
                    <p class="member-bio">API Developer Of the Projects.</p>
                </div>
                <div class="team-card">
                    <img src="{{ asset('image/sovira.jpg') }}" alt="Sovira Theng" class="team-avatar">
                    <h3 class="member-name">Sovira Theng</h3>
                    <p class="member-role">Software Engineer</p>
                    <p class="member-bio">Front End Developer Of the Project.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
