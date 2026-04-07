@extends('front.layouts.app')

@section('content')

<div class="container mt-5" style="max-width: 500px;">
    <h4>Forgot Password</h4>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('forgot.password.send') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <button class="btn btn-dark">Send OTP</button>
    </form>
</div>

@endsection