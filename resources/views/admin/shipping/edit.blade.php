@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Edit Shipping</h3>

    <!-- FORM -->
    <form action="{{ route('admin.shipping.update', $shipping->id) }}" method="POST">
        @csrf

        <div class="row">

            <div class="col-md-4">
                <select name="country_id" class="form-control">
                    <option value="">Select a Country</option>

                    @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ $shipping->country_id == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-4">
                <input type="text"
                       name="amount"
                       value="{{ $shipping->amount }}"
                       class="form-control"
                       placeholder="Amount">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">Update</button>
            </div>

        </div>
    </form>

</div>

@endsection