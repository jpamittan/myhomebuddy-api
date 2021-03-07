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
                        <td scope="row">ID</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <td scope="row">First Name</td>
                        <td>{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Middle Name</td>
                        <td>{{ $user->middle_name }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Last Name</td>
                        <td>{{ $user->last_name }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Status</td>
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
                                        <td scope="row">{{ ucfirst($key) }} {{ $k }}</td>
                                        <td>{{ $v }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td scope="row">{{ str_replace('_', ' ', ucfirst($key)) }}</td>
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
