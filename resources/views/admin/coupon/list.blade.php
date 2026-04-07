@extends('admin.layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Coupon Codes</h3>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
            Create Coupon
        </a>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success">
            ✔ {{ session('success') }}
        </div>
    @endif

    <div class="card p-3">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Discount</th>
                    <th>Max Uses</th>
                    <th>Status</th>
                    <th>Starts</th>
                    <th>Expires</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @if($coupons->count() > 0)

                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td><strong>{{ $coupon->code }}</strong></td>
                        <td>{{ $coupon->description ?? '-' }}</td>

                        <td>
                            @if($coupon->type == 'percent')
                                <span class="badge bg-info">Percent</span>
                            @else
                                <span class="badge bg-secondary">Fixed</span>
                            @endif
                        </td>

                        <td>
                            @if($coupon->type == 'percent')
                                {{ $coupon->discount_amount }}%
                            @else
                                ${{ $coupon->discount_amount }}
                            @endif
                        </td>

                        <td>{{ $coupon->max_uses ?? 'Unlimited' }}</td>

                        <td>
                            @if($coupon->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <td>
                            {{ $coupon->starts_at ? date('d M Y', strtotime($coupon->starts_at)) : '-' }}
                        </td>

                        <td>
                            {{ $coupon->expires_at ? date('d M Y', strtotime($coupon->expires_at)) : '-' }}
                        </td>

                        <td>
                            <!-- EDIT -->
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <a href="{{ route('admin.coupons.delete', $coupon->id) }}"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this coupon?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach

                @else

                    <tr>
                        <td colspan="10" class="text-center">
                            No Coupons Found
                        </td>
                    </tr>

                @endif

            </tbody>
        </table>

    </div>

</div>

@endsection