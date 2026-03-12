@extends('admin.layouts.app')

@section('content')

<section class="content-header">
<div class="container-fluid my-2">

<div class="row mb-2">

<div class="col-sm-6">
<h1>Brands</h1>
</div>

<div class="col-sm-6 text-end">
<a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
<i class="fas fa-plus"></i> New Brand
</a>
</div>

</div>

</div>
</section>


<section class="content">
<div class="container-fluid">

<div class="card">

<div class="card-body table-responsive p-0">

<table class="table table-hover text-nowrap align-middle">

<thead>
<tr>
<th width="80">ID</th>
<th>Name</th>
<th width="120">Status</th>
<th width="120">Edit</th>
<th width="120">Delete</th>
</tr>
</thead>

<tbody>

@forelse ($brands as $brand)

<tr>

<td>{{ $brand->id }}</td>

<td>{{ $brand->name }}</td>

<td>

@if ($brand->status == 1)

<span class="badge bg-success">Active</span>

@else

<span class="badge bg-danger">Blocked</span>

@endif

</td>

<td>

<a href="{{ route('admin.brands.edit',$brand->id) }}" class="btn btn-sm btn-primary">
<i class="fas fa-edit"></i>
</a>

</td>

<td>

<form action="{{ route('admin.brands.destroy',$brand->id) }}" method="POST">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger" onclick="return confirm('Delete this brand?')">
<i class="fas fa-trash"></i>
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="5" class="text-center text-muted">
No records found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>


<div class="card-footer clearfix">

{{ $brands->withQueryString()->links() }}

</div>

</div>

</div>
</section>

@endsection