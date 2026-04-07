@extends('front.layouts.app')

@section('content')

<div class="container mt-5" style="max-width: 500px;">
    <h4>Reset Password</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('reset.password.update') }}">
        @csrf

        <div class="mb-3">
            <label>OTP</label>
            <input type="text" name="otp" class="form-control">
        </div>

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button class="btn btn-primary">Reset Password</button>
    </form>
</div>

@endsection