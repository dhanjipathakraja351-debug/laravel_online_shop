@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Create Coupon Code</h3>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary">Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf

        <div class="card p-4">

            <div class="row">

                <!-- CODE -->
                <div class="col-md-6 mb-3">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}">
                    @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- NAME -->
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="description" class="form-control" placeholder="Coupon Code Name">
                </div>

                <!-- MAX USES -->
                <div class="col-md-6 mb-3">
                    <label>Max Uses</label>
                    <input type="number" name="max_uses" class="form-control">
                </div>

                <!-- TYPE -->
                <div class="col-md-6 mb-3">
                    <label>Type</label>
                    <select name="type" class="form-control">
                        <option value="percent">Percent</option>
                        <option value="fixed">Fixed</option>
                    </select>
                </div>

                <!-- DISCOUNT -->
                <div class="col-md-6 mb-3">
                    <label>Discount Amount</label>
                    <input type="text" name="discount_amount" class="form-control">
                    @error('discount_amount') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- STATUS -->
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- START -->
                <div class="col-md-6 mb-3">
                    <label>Starts At</label>
                    <input type="datetime-local" name="starts_at" class="form-control">
                </div>

                <!-- EXPIRE -->
                <div class="col-md-6 mb-3">
                    <label>Expires At</label>
                    <input type="datetime-local" name="expires_at" class="form-control">
                </div>

                <!-- DESCRIPTION -->
                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

            </div>

            <button class="btn btn-success">Create Coupon</button>

        </div>

    </form>

</div>

@endsection