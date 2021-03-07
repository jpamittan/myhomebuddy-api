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
            <i class="fas fa-user-tie"></i> Sellers
        </h5>
        <div class="table-responsive-md" style="width: 100%;">
            <table class="table table-striped table-bordered">
                <thead style="background-color: #1441a7; color: #FFFFFF;">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Middle Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users))
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->middle_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->is_activated)
                                        <span class="badge rounded-pill bg-success">Activated</span>
                                    @else
                                        <span class="badge rounded-pill bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('dashboard.seller.view', ['user' => $user->id]) }}" class="text-decoration-none ml-1 mr-1" title="View">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">No records.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
