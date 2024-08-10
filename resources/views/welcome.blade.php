@extends('layout.app')
@section('title', 'Welcome')
@section('content')

<section class="bg-body-tertiary">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 p-3">
                        <div class="text-center">
                            <h5 class="text-success fw-semibold pb-2 pt-5">
                             Welcome {{ $user->name }} 
                            </h5>
                            <p class="text-secondary pb-2">
                                {{ $user->email }}
                            </p>
                            <a class="btn btn-sm btn-danger mb-5" href="{{url('logout')}}">
                            Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection