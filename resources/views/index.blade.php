@extends('layouts.master')

@push('css')
    
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <a href="{{ route('dashboard.consumers') }}" class="text-decoration-none">
                    <div class="alert alert-primary mt-5" role="alert">
                        <h4 class="alert-heading">
                            <i class="fas fa-user"></i> Users
                        </h4>
                        <p>List of consumers and sellers</p>
                        <hr>
                        <p class="mb-0">Click to view</p>
                    </div>
                </a>
            </div>
            <div class="col-sm">
                <a href="{{ route('terms.index') }}" class="text-decoration-none">
                    <div class="alert alert-info mt-5" role="alert">
                        <h4 class="alert-heading">Terms</h4>
                        <p>
                            <i class="fas fa-file-alt"></i> Terms and conditions
                        </p>
                        <hr>
                        <p class="mb-0">Click to view</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
