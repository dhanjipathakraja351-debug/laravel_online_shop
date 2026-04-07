@extends('front.layouts.app')

@section('content')

<div class="container mt-4">

    <h3>My Wishlist</h3>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($items as $item)
            <tr>

           <td>
    <a href="{{ route('front.product', $item->product->slug ?? $item->product->id) }}">
        {{ $item->product->title }}
    </a>
</td>

                {{-- IMAGE --}}
                <td>
                    <img src="{{ asset('front-assets/images/'.$item->product->image) }}" width="60">
                </td>

                {{-- PRICE --}}
                <td>${{ $item->product->price }}</td>

                {{-- REMOVE --}}
                <td>
                    <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No items in wishlist</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection