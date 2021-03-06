@extends('layouts.auth')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center h-100">
            <div class="card" style="width: 320px;">
                <div class="card-header">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('auth') }}">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fas fa-user" style="width: 16px;"></i>
                            </div>
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fas fa-key" style="width: 16px;"></i>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        @if (!$authenticate)
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                Invalid credentials.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-group mt-3">
                            <input type="submit" value="Login" class="btn btn-primary float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
