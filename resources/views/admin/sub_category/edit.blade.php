@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid my-2">
        <h1>Edit Sub Category</h1>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<form method="POST"
      action="{{ route('admin.sub-categories.update', $subcategory) }}">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Name</label>
                <input type="text"
                       name="name"
                       value="{{ $subcategory->name }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text"
                       name="slug"
                       value="{{ $subcategory->slug }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $subcategory->status == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ $subcategory->status == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                Update Sub Category
            </button>

        </div>
    </div>

</form>

</div>
</section>

@endsection