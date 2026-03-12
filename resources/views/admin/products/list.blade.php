@extends('admin.layouts.app')

@section('content')

<section class="content-header">					
<div class="container-fluid my-2">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Products</h1>
</div>

<div class="col-sm-6 text-right">
<a href="{{ route('admin.products.create') }}" class="btn btn-primary">
New Product
</a>
</div>

</div>
</div>
</section>


<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<div class="card-tools">

<div class="input-group" style="width: 250px;">
<input type="text" name="table_search" class="form-control float-right" placeholder="Search">

<div class="input-group-append">
<button type="submit" class="btn btn-default">
<i class="fas fa-search"></i>
</button>
</div>

</div>

</div>
</div>


<div class="card-body table-responsive p-0">

<table class="table table-hover text-nowrap">

<thead>

<tr>
<th width="60">ID</th>
<th width="80">Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>SKU</th>
<th width="100">Status</th>
<th width="120">Action</th>
</tr>

</thead>


<tbody>

@if ($products->isNotEmpty())

@foreach ($products as $product)

@php
$productImage = $product->product_images->first();
@endphp

<tr>

<td>{{ $product->id }}</td>

<td>
@if (!empty($productImage->image))
<img src="{{ asset('storage/products/'.$productImage->image) }}" class="img-thumbnail" width="50">
@endif
</td>

<td>
<a href="{{ route('admin.products.edit',$product->id) }}">
{{ $product->title }}
</a>
</td>

<td>{{ $product->price }}</td>

<td>{{ $product->qty }}</td>

<td>{{ $product->sku }}</td>


<td>

@if ($product->status == 1)
<span class="badge bg-success">Active</span>
@else
<span class="badge bg-danger">Blocked</span>
@endif

</td>


<td>

<a href="{{ route('admin.products.edit',$product->id) }}" class="btn btn-primary btn-sm">
<i class="fas fa-pen"></i>
</a>

<form action="{{ route('admin.products.destroy',$product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this product?')">
@csrf
@method('DELETE')

<button type="submit" class="btn btn-danger btn-sm">
<i class="fas fa-trash"></i>
</button>

</form>

</td>

</tr>

@endforeach

@else


<tr>
<td colspan="8" class="text-center">Records Not Found</td>
</tr>

@endif

</tbody>

</table>

</div>


<div class="card-footer clearfix">
{{ $products->links() }}
</div>

</div>

</div>

</section>

@endsection