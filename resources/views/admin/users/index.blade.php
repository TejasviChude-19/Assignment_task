
@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Manage Users</h1>
    <div class="row mb-2">
        <div class="col-6">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create User</a>
        </div>
    
    
      <div class="col-6">
      <a class="btn btn-sm btn-danger mb-3 p-2" href="{{url('logout')}}">
                            Logout
      </a>
        </div>
      </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @switch($user->roles)
                            @case('administrator')
                                <span class="badge bg-primary">Administrator</span>
                                @break
                            @case('teacher')
                                <span class="badge bg-success">Teacher</span>
                                @break
                            @case('student')
                                <span class="badge bg-info">Student</span>
                                @break
                            @case('parent')
                                <span class="badge bg-warning text-dark">Parent</span>
                                @break
                            @default
                                <span class="badge bg-secondary">Unknown</span>
                        @endswitch
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm ml-2">Edit</a>
                     
                 <a href="{{ route('admin.users.role', $user->id) }}" class="btn btn-info btn-sm rounded-button ml-2 assign-role-button">Assign Role</a>
                 <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline-block ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                 </form>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-responsive {
        margin-top: 1rem;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem; 
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.4rem;
        border-radius: 0.2rem;
    }

    .btn-edit {
        background-color: #ffc107; 
        color: #fff;
        border-radius: 0.25rem; 
        border: none;
        padding: 0.475rem 0.75rem; 
        font-size: 0.875rem; 
        display: inline-block;
        text-align: center; 
    }

    .btn-edit:hover {
        background-color: #e0a800; 
        color: #fff;
    }

    .btn-delete {
        background-color: #dc3545; 
        color: #fff;
        border-radius: 0.25rem; 
        border: none;
        padding: 0.475rem 0.75rem;
        font-size: 0.875rem; 
    }

    .btn-delete:hover {
        background-color: #c82333; 
        color: #fff;
    }

    .btn-role {
        background-color: #17a2b8; 
        color: #fff;
        border-radius: 0.25rem; 
        border: none;
        padding: 0.475rem 0.75rem;
        font-size: 0.875rem; 
    }

    .btn-role:hover {
        background-color: #138496; 
        color: #fff;
    }

    .btn {
        border-radius: 0.5rem;
        transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>
@endpush


