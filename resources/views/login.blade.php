@extends('layout.app')
@section('title', 'Login')
@section('content')


  <!-- Include Noty CSS -->
  <link href="https://cdn.jsdelivr.net/npm/noty/lib/noty.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/noty/lib/themes/mint.css" rel="stylesheet">

    <!-- Optional: Include Bootstrap for basic styling (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/noty/lib/noty.min.js"></script>
 
  <script>
        // Check for session messages and display them using Noty
        @if(session()->has('error'))
            new Noty({
                type: 'error',
                layout: 'topRight',
                text: '{{ session('error') }}',
                timeout: 3000,
                theme: 'mint', 
                progressBar: true 
            }).show();
        @endif

        @if(session()->has('success'))
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: '{{ session('success') }}',
                timeout: 3000,
                theme: 'mint',
                progressBar: true
            }).show();
        @endif
        </script>

<section class="bg-body-tertiary">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm py-3 px-4">
                        <div class="text-center py-2 mb-3">
                            <p class="mb-0 text-uppercase fw-bold text-secondary">
                                Welcome Back
                            </p>
                        </div>
                        <form class="row gy-3" action="{{url('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                            <label for="ame">Username</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                             @error('name')
                           <small class="text-danger">{{ $message }}</small>
                             @enderror
                             </div>

                            <div class="col-12">
                                <label for="passInp" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passInp" name="password">
                                @error('password')<small class="text-danger">{{$message}}</small>@enderror
                            </div>
                            <p class="mt-2">
                                <a class="fw-medium" href="{{ route('password.reset') }}">
                                    Forgot your password?
                                </a>
                            </p>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Login</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="mb-0">
                                I dont't have an account?
                                <a class="fw-medium" href="{{url('register')}}">
                                    Register
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