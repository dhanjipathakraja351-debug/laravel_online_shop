@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Edit Coupon</h3>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary">Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf

        <div class="card p-4">

            <div class="row">

                <!-- CODE -->
                <div class="col-md-6 mb-3">
                    <label>Code</label>
                    <input type="text" name="code" class="form-control"
                           value="{{ old('code', $coupon->code) }}">
                    @error('code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- NAME -->
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="description" class="form-control"
                           value="{{ old('description', $coupon->description) }}">
                </div>

                <!-- MAX USES -->
                <div class="col-md-6 mb-3">
                    <label>Max Uses</label>
                    <input type="number" name="max_uses" class="form-control"
                           value="{{ old('max_uses', $coupon->max_uses) }}">
                </div>

                <!-- TYPE -->
                <div class="col-md-6 mb-3">
                    <label>Type</label>
                    <select name="type" class="form-control">
                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent</option>
                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                    </select>
                </div>

                <!-- DISCOUNT -->
                <div class="col-md-6 mb-3">
                    <label>Discount Amount</label>
                    <input type="text" name="discount_amount" class="form-control"
                           value="{{ old('discount_amount', $coupon->discount_amount) }}">
                </div>

                <!-- STATUS -->
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- START -->
                <div class="col-md-6 mb-3">
                    <label>Starts At</label>
                    <input type="datetime-local" name="starts_at" class="form-control"
                           value="{{ $coupon->starts_at ? date('Y-m-d\TH:i', strtotime($coupon->starts_at)) : '' }}">
                </div>

                <!-- EXPIRE -->
                <div class="col-md-6 mb-3">
                    <label>Expires At</label>
                    <input type="datetime-local" name="expires_at" class="form-control"
                           value="{{ $coupon->expires_at ? date('Y-m-d\TH:i', strtotime($coupon->expires_at)) : '' }}">
                </div>

                <!-- DESCRIPTION -->
                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ $coupon->description }}</textarea>
                </div>

            </div>

            <button class="btn btn-success">Update Coupon</button>

        </div>

    </form>

</div>

@endsection