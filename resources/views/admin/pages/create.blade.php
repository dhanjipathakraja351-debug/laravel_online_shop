@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>Create Page</h2>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.pages.store') }}">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Slug</label>
                <input type="text" id="slug" class="form-control" readonly>
            </div>

        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="8"></textarea>
        </div>

        <button class="btn btn-success">Create Page</button>
    </form>
</div>

{{-- AUTO SLUG SCRIPT --}}
<script>
document.getElementById('name').addEventListener('keyup', function () {
    let slug = this.value.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');
    document.getElementById('slug').value = slug;
});
</script>

@endsection