@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="#">My Account</a>
            </li>
            <li class="breadcrumb-item">Change Password</li>
        </ol>
    </div>
</section>

<section class="section-11">
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-3">
                @include('front.account.includes.account-panel')
            </div>

            <div class="col-md-9">
                <div class="card">

                    <div class="card-header">
                        <h2 class="h5 mb-0">Change Password</h2>
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

                        <form method="POST" action="{{ route('password.update') }}">
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

                            <button class="btn btn-dark">Update Password</button>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection