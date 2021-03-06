@extends('layouts.auth')

@push('css')
    
@endpush

@section('content')
    <div class="container-fluid mt-5">
        <div class="text-center">
            <h4>Terms and Conditions for {{ $userType }}</h4>
        </div>
        <div class="text-left mt-5">
            {!! $term->content !!}
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
