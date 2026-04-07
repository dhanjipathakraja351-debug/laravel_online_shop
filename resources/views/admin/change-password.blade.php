@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card">
        <div class="card-header">
            <h4>Change Password</h4>
        </div>

        <div class="card-body">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.update.password') }}">
                @csrf

                <div class="mb-3">
                    <label>Old Password</label>
                    <input type="password" name="old_password" class="form-control">
                </div>

                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="new_password_confirmation" class="form-control">
                </div>

                <button class="btn btn-primary">Update Password</button>

            </form>

        </div>
    </div>

</div>

@endsection