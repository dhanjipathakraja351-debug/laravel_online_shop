@extends('admin.layouts.app')

@section('content')

<div class="container">
    <h2>Edit Page</h2>

    <form method="POST" action="{{ route('admin.pages.update', $page->id) }}">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" id="name"
                       value="{{ $page->name }}" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Slug</label>
                <input type="text" id="slug"
                       value="{{ $page->slug }}" class="form-control" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="8">
{{ $page->content }}
            </textarea>
        </div>

        <button class="btn btn-primary">Update Page</button>
    </form>
</div>

<script>
document.getElementById('name').addEventListener('keyup', function () {
    let slug = this.value.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');
    document.getElementById('slug').value = slug;
});
</script>

@endsection