@extends('admin.layouts.app')

@section('content')

<div class="container">

<h2>Reviews</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">

<thead>
<tr>
    <th>#</th>
    <th>Product</th>
    <th>Name</th>
    <th>Rating</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@foreach($reviews as $review)
<tr>
    <td>{{ $review->id }}</td>
    <td>{{ $review->product->title ?? '' }}</td>
    <td>{{ $review->name }}</td>
    <td>
        @for($i=1;$i<=5;$i++)
            {{ $i <= $review->rating ? '⭐' : '☆' }}
        @endfor
    </td>

    <td>
        @if($review->status)
            <span class="badge bg-success">Approved</span>
        @else
            <span class="badge bg-warning">Pending</span>
        @endif
    </td>

    <td>
        @if(!$review->status)
        <a href="{{ route('admin.reviews.approve',$review->id) }}"
           class="btn btn-sm btn-success">Approve</a>
        @endif

        <a href="{{ route('admin.reviews.delete',$review->id) }}"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Delete?')">
           Delete
        </a>
    </td>
</tr>
@endforeach
</tbody>

</table>

</div>

@endsection