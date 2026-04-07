@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Pages</h2>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Add Page</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->name }}</td>
                <td>{{ $page->slug }}</td>

                <td>
                    <a href="{{ route('admin.pages.edit',$page->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.pages.delete',$page->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete?')">
                            Delete
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection