@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between mb-3">
        <h2>Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                 <td>{{ $user->phone ?? '-' }}</td>
                

                <!-- STATUS -->
                <td>
                    @if($user->status == 1)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Blocked</span>
                    @endif
                </td>

                <td>{{ $user->created_at->format('d M Y') }}</td>

                <!-- ACTION -->
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('admin.users.delete', $user->id) }}" 
                          method="POST" 
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
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