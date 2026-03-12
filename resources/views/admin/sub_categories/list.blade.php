@extends('admin.layouts.app')

@section('content')

<section class="content-header">
<div class="container-fluid my-2">

<div class="row mb-2">

<div class="col-sm-6">
<h1>Sub Categories</h1>
</div>

<div class="col-sm-6 text-end">
<a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary">
<i class="fas fa-plus"></i> New Sub Category
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
<th width="60">ID</th>
<th>Category</th>
<th>Name</th>
<th>Slug</th>
<th width="100">Status</th>
<th width="120">Edit</th>
<th width="120">Delete</th>
</tr>
</thead>

<tbody>

@forelse ($subcategories as $subcategory)

<tr>

<td>{{ $subcategory->id }}</td>

<td>{{ $subcategory->category->name ?? 'N/A' }}</td>

<td>{{ $subcategory->name }}</td>

<td>{{ $subcategory->slug }}</td>

<td>
@if ($subcategory->status == 1)
<span class="badge bg-success">Active</span>
@else
<span class="badge bg-danger">Blocked</span>
@endif
</td>

<td>
<a href="{{ route('admin.sub-categories.edit', $subcategory->id) }}" class="btn btn-sm btn-primary">
<i class="fas fa-edit"></i> Edit
</a>
</td>

<td>
<form action="{{ route('admin.sub-categories.destroy', $subcategory->id) }}"
method="POST"
onsubmit="return confirm('Are you sure you want to delete this sub category?');">

@csrf
@method('DELETE')

<button type="submit" class="btn btn-sm btn-danger">
<i class="fas fa-trash"></i> Delete
</button>

</form>
</td>

</tr>

@empty

<tr>
<td colspan="7" class="text-center text-muted">
No records found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

<div class="card-footer clearfix">
{{ $subcategories->withQueryString()->links() }}
</div>

</div>

</div>
</section>

@endsection