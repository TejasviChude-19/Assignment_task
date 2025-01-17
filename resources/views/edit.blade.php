 @extends('layout.app')

 @section('title', 'Edit User')

@section('content')
<div class="container">
    <h2 class="my-4">Edit User</h2>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
            @error('name')<small class="text-danger">{{$message}}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
            @error('email')<small class="text-danger">{{$message}}</small>@enderror
        </div>

        <div class="mb-3">
            <label for="role">Select Role:</label>
            <select name="role" id="role" class="form-control">
                <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>Administrator</option>
                <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Student</option>
                <option value="parent" {{ old('role', $user->role) == 'parent' ? 'selected' : '' }}>Parent</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection 
 
