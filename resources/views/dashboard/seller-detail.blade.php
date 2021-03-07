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
            <a href="{{ route('dashboard.sellers') }}" class="text-decoration-none">
                <i class="fas fa-user-tie"></i> Sellers
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
                        <td scope="row">{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <td scope="row">First Name</td>
                        <td scope="row">{{ $user->first_name }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Middle Name</td>
                        <td scope="row">{{ $user->middle_name }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Last Name</td>
                        <td scope="row">{{ $user->last_name }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Email</td>
                        <td scope="row">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td scope="row">Status</td>
                        <td scope="row">
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
                                    @if ($k == "images")
                                        @foreach($v as $imageKey => $imageValue)
                                            <tr>
                                                <td scope="row">{{ ucfirst($key) }} {{ str_replace('_', ' ', ucfirst($imageKey)) }}</td>
                                                <td scope="row" class="p-3">
                                                    <a href="{{ $imageValue }}">
                                                        <img src="{{ $imageValue }}" style="width: 20%;"/>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td scope="row">{{ ucfirst($key) }} {{ $k }}</td>
                                            <td scope="row">{{ $v }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td scope="row">{{ str_replace('_', ' ', ucfirst($key)) }}</td>
                                    <td scope="row">{{ $value }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (!$user->is_activated)
                <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#activate-modal">
                    <i class="fas fa-check"></i> Activate account
                </button>
                <!-- Modal -->
                <div class="modal fade" id="activate-modal" tabindex="-1" aria-labelledby="activateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="activateModalLabel">Activate account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure to activate this account?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">No</button>
                                <a href="{{ route('activate.seller', ['user' => $user->id]) }}" class="btn btn-success">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')

@endpush
