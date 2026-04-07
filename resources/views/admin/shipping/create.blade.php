@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">

    <h3>Shipping Management</h3>

    {{-- ✅ SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            ✔ {{ session('success') }}
        </div>
    @endif

    {{-- ✅ VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>⚠ {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('admin.shipping.store') }}" method="POST" class="mb-4">
        @csrf

        <div class="row">

            <div class="col-md-4">
                <select name="country_id" class="form-control">
                    <option value="">Select a Country</option>

                    @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-4">
                <input type="text"
                       name="amount"
                       class="form-control"
                       placeholder="Amount"
                       value="{{ old('amount') }}">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">Create</button>
            </div>

        </div>
    </form>

    <!-- TABLE -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($shippingCharges as $shipping)
            <tr>
                <td>{{ $shipping->id }}</td>
                <td>{{ $shipping->country->name ?? 'N/A' }}</td>
                <td>${{ $shipping->amount }}</td>

                <td>
                    <!-- EDIT -->
                    <a href="{{ route('admin.shipping.edit', $shipping->id) }}"
                       class="btn btn-sm btn-primary">
                        Edit
                    </a>

                    <!-- DELETE -->
                    <a href="{{ route('admin.shipping.delete',$shipping->id) }}"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this?')">
                       Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection