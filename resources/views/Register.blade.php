@extends('layout.app')
@section('title', 'Register')
@section('content')

<section class="bg-body-tertiary">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm py-3 px-4">
                        <div class="text-center py-2 mb-3">
                            <p class="mb-0 text-uppercase fw-bold text-secondary">
                                Create new account
                            </p>
                        </div>
                        <form class="row gy-3" action="{{route('processregister')}}" method="post">
                            @csrf
                            <div class="col-12">
                                <label for="nameInp" class="form-label">Username</label>
                                <input type="text" class="form-control" id="nameInp" name="name"
                                    value="{{old('name')}}">
                                @error('name')<small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="col-12">
                                <label for="passInp" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passInp" name="password">
                                @error('password')<small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="col-12">
                                <label for="emailInp" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="emailInp" name="email"
                                    value="{{old('email')}}">
                                @error('email')<small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <div class="col-12">
                            <label for="role">Select Role:</label>
        <select name="role" id="role" class="form-control">
            <option value="select role" {{ old('role', $user->role ?? '') == 'select role' ? 'selected' : '' }}>Select role</option>
            <option value="administrator" {{ old('role', $user->role ?? '') == 'administrator' ? 'selected' : '' }}>Administrator</option>
            <option value="teacher" {{ old('role', $user->role ?? '') == 'teacher' ? 'selected' : '' }}>Teacher</option>
            <option value="student" {{ old('role', $user->role ?? '') == 'student' ? 'selected' : '' }}>Student</option>
            <option value="parent" {{ old('role', $user->role ?? '') == 'parent' ? 'selected' : '' }}>Parent</option>
        </select>
                            </div>
                           
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Register</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="mb-0">
                                Already have an account?
                                <a class="fw-medium" href="{{url('login')}}">
                                    Login
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection