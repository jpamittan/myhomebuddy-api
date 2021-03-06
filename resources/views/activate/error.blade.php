@extends('layouts.auth')

@push('css')
    
@endpush

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">
                        <i class="fas fa-times"></i> Error!
                    </h4>
                    <p>Invalid activation link.</p>
                    <hr>
                    <p class="mb-0">
                        <small>
                            Please check your email for the valid activation link.
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
