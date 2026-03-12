@extends('admin.layouts.app')

@section('content')

<section class="content-header">
<div class="container-fluid my-2">
<div class="row mb-2">

<div class="col-sm-6">
<h1>Edit Category</h1>
</div>

<div class="col-sm-6 text-end">
<a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
Back
</a>
</div>

</div>
</div>
</section>

<section class="content">
<div class="container-fluid">

<form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="card">
<div class="card-body">

<div class="row">

<div class="col-md-6">
<div class="mb-3">
<label>Name</label>

<input type="text"
name="name"
id="name"
class="form-control @error('name') is-invalid @enderror"
value="{{ old('name', $category->name) }}"
placeholder="Category Name">

@error('name')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>


<div class="col-md-6">
<div class="mb-3">
<label>Slug</label>

<input type="text"
name="slug"
id="slug"
class="form-control @error('slug') is-invalid @enderror"
value="{{ old('slug', $category->slug) }}"
readonly>

@error('slug')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
</div>


<div class="col-md-6">
<div class="mb-3">
<label>Image</label>

<input type="file"
name="image"
id="image"
class="form-control">

@if($category->image)
<div class="mt-3">
<img width="200" src="{{ asset('storage/temp/'.$category->image) }}">
</div>
@endif

</div>
</div>


<div class="col-md-6">
<div class="mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option value="1"
{{ old('status',$category->status)==1 ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ old('status',$category->status)==0 ? 'selected' : '' }}>
Block
</option>

</select>

</div>
</div>

</div>

</div>
</div>


<div class="pt-3">

<button type="submit" class="btn btn-success">
Update Category
</button>

<a href="{{ route('admin.categories.index') }}" class="btn btn-outline-dark ms-3">
Cancel
</a>

</div>

</form>

</div>
</section>

@endsection


@section('customjs')

<script>

// Slug auto generation
$("#name").keyup(function(){

$.ajax({

url: "{{ route('admin.getSlug') }}",

type: "GET",

data: { title: $(this).val() },

success: function(response){

if(response.status){
$("#slug").val(response.slug);
}

}

});

});

</script>

@endsection