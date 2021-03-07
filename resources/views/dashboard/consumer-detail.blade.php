@extends('layouts.master')

@push('css')
    
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <h5>
            <a href="{{ route('dashboard.users') }}" class="text-decoration-none">
                <i class="fas fa-users"></i> Users Management 
            </a>
            ->
            <a href="{{ route('dashboard.consumers') }}" class="text-decoration-none">
                <i class="far fa-user"></i> Consumers
            </a>
            ->
            {{ $user->id }}
        </h5>
        <div class="table-responsive-md" style="width: 100%;">
            <table class="table table-striped table-bordered">
                <thead style="background-color: #1441a7; color: #FFFFFF;">
                    <tr>
                        <th scope="col">Property</th>
                        <th scope="col">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">ID</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">First Name</th>
                        <td>{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Middle Name</th>
                        <td>{{ $user->middle_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Last Name</th>
                        <td>{{ $user->last_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td>
                            @if ($user->is_activated)
                                <span class="badge rounded-pill bg-success">Activated</span>
                            @else
                                <span class="badge rounded-pill bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @if ($user->properties)
                        @foreach(json_decode($user->properties, true) as $key => $value)
                            @if (is_array($value))
                                @foreach($value as $k => $v)
                                    <tr>
                                        <th scope="row">{{ ucfirst($key) }} {{ $k }}</th>
                                        <td>{{ $v }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th scope="row">{{ str_replace('_', ' ', ucfirst($key)) }}</th>
                                    <td>{{ $value }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
