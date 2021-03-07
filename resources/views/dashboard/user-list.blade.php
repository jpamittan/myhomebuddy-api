@extends('layouts.master')

@push('css')
    
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <h5><i class="fas fa-users"></i> Users Management</h5>
        <div class="table-responsive-md" style="width: 100%;">
            <table class="table table-striped table-bordered">
                <thead style="background-color: #1441a7; color: #FFFFFF;">
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Consumers
                        </td>
                        <td class="text-center">
                            <a href="{{ route('dashboard.consumers') }}" class="text-decoration-none ml-1 mr-1" title="View">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Sellers
                        </td>
                        <td class="text-center">
                            <a href="{{ route('dashboard.sellers') }}" class="text-decoration-none ml-1 mr-1" title="View">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush
