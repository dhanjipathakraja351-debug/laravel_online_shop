@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Admin Profile</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-4">

        <div class="mb-3">
            <label><strong>Name:</strong></label>
            <p>{{ $admin->name }}</p>
        </div>

        <div class="mb-3">
            <label><strong>Email:</strong></label>
            <p>{{ $admin->email }}</p>
        </div>

        <div class="mb-3">
            <label><strong>Joined:</strong></label>
            <p>{{ $admin->created_at->format('d M Y') }}</p>
        </div>

        <a href="{{ route('admin.change.password') }}" class="btn btn-primary">
            Change Password
        </a>

    </div>

</div>

@endsection