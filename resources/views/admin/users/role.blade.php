

@extends('layout.app')

@section('content')
<section class="bg-light">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm border-0 p-4" style="width: 100%; max-width: 500px;">
            <h2 class="text-center mb-4">Manage Role for {{ $user->name }}</h2>

            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select form-select-lg" id="role" name="role" required>
                        <option value="" disabled>Select Role</option>
                        <option value="administrator" {{ $user->roles == 'administrator' ? 'selected' : '' }}>Administrator</option>
                        <option value="teacher" {{ $user->roles == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="student" {{ $user->roles == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="parent" {{ $user->roles == 'parent' ? 'selected' : '' }}>Parent</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-lg">Update Role</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .bg-light {
        background-color: #f8f9fa; 
    }

    .card {
        background-color: #ffffff; 
    }

    .card.shadow-sm {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); 
    }

    .form-select-lg {
        height: calc(2.5rem + 2px); 
        font-size: 1.25rem; 
    }

    .btn-lg {
        padding: 0.75rem 1.25rem; 
        font-size: 1.25rem; 
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .container {
        max-width: 800px; 
    }
</style>
@endsection
