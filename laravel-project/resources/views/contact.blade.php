@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background */
        font-family: 'Montserrat', sans-serif; /* Font style */
    }

    .container {
        margin-top: 100px; /* Space above the content */
        margin-bottom: 50px; /* Space below the content for footer */
        opacity: 0; /* Start with hidden */
        transform: translateY(20px); /* Start slightly below */
        animation: fadeIn 0.5s forwards; /* Animation on load */
    }

    @keyframes fadeIn {
        to {
            opacity: 1; /* Fully visible */
            transform: translateY(0); /* Move to original position */
        }
    }
</style>
<div class="container mt-5">
    <h1>Contact Us</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select class="form-control" id="subject" name="subject" required>
                <option value="">Select a subject</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Support Request">Support Request</option>
                <option value="Feedback">Feedback</option>
                <option value="Collaboration">Collaboration</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>
@endsection
