@extends('layouts.auth')

@push('css')
    
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">
                        <i class="fas fa-sign-language"></i> Hurray!
                    </h4>
                    <p>Your account is now activated.</p>
                    <hr>
                    <p class="mb-0">
                        <small>
                            You may now login your account to MyHomeBuddy mobile application.
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
