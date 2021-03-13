@extends('layouts.master')

@push('css')
    
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <h5>
            <i class="fas fa-code"></i> Debug
        </h5>
        <div id="debug-alert" class="mt-3" style="display: none;">
            <div id="debug-alert-content" class="alert alert-success" role="alert">
            </div>
        </div>
        <div class="mt-3">
            <ul>
                <li>
                    <i class="fas fa-users"></i> Users
                     <ul>
                        <li>
                            <a href="{{ route('debug.clearSellers') }}" class="btn btn-warning d-inline-block mt-2">
                                <i class="fas fa-user-times"></i> Clear sellers
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('debug.clearConsumers') }}" class="btn btn-warning d-inline-block mt-2">
                                <i class="fas fa-user-times"></i> Clear consumers
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        <div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const capitalize = (s) => {
                if (typeof s !== 'string') return ''
                return s.charAt(0).toUpperCase() + s.slice(1)
            }
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const clear = urlParams.get('clear');
            console.log(clear);
            if (clear) {
                $('#debug-alert').show();
                $('#debug-alert-content').html(`${capitalize(clear)} cleared successfully.`);
            }
        });
    </script>
@endpush
