@extends('layout.app')
@section('title', 'Reset Password')
@section('content')

<section class="bg-body-tertiary">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm py-3 px-4">
                        <div class="text-center py-2 mb-3">
                            <p class="mb-0 text-uppercase fw-bold text-secondary">
                                Reset Password
                            </p>
                        </div>
                        <form class="row gy-3" action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Send Password Reset Link</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="mb-0">
                                <a class="fw-medium" href="{{ url('login') }}">
                                    Back to Login
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
