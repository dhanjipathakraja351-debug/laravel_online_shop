@extends('admin.layouts.app')

@section('content')

<div class="container">
    <h2>Edit User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" 
                   value="{{ $user->name }}" 
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" 
                   value="{{ $user->email }}" 
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" 
                   value="{{ $user->phone }}" 
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                    Active
                </option>
                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>
                    Block
                </option>
            </select>
        </div>

        <button class="btn btn-success">Update User</button>
    </form>
</div>

@endsection