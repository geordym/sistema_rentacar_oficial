@extends('layouts.app')
@php
    $profile=asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{__('Driver')}}

@endsection
@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}"><h1>{{__('Dashboard')}}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{__('Driver')}}
            </a>
        </li>
    </ul>
@endsection
@section('card-action-btn')
    @if(Gate::check('manage tenant'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('tenant.create') }}"
           data-title="{{__('Create Tenant')}}"> <i
                class="ti-plus mr-5"></i>
            {{__('Create Tenant')}}
        </a>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="display dataTable cell-border datatbl-advance">
                        <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Nationality')}}</th>
                            <th>{{__('Document Type')}}</th>
                            <th>{{__('Document Number')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('City')}}</th>
                            <th>{{__('Municipality')}}</th>
                            <th>{{__('License Number')}}</th>
                            @if(Gate::check('manage tenant') || Gate::check('create tenant') || Gate::check('show tenant'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tenants as $tenant)
                            <tr>
                                <td>{{ $tenant->id }}</td>
                                <td>{{ $tenant->name }}</td>
                                <td>{{ $tenant->nationality ?? '-' }}</td>
                                <td>{{ $tenant->document_type }}</td>
                                <td>{{ $tenant->document_number }}</td>
                                <td>{{ $tenant->residence_address }}</td>
                                <td>{{ $tenant->city ?? '-' }}</td>
                                <td>{{ $tenant->municipality ?? '-' }}</td>
                                <td>{{ $tenant->license_number ?? '-' }}</td>
                                @if(Gate::check('edit tenant') || Gate::check('delete tenant') || Gate::check('show tenant'))
                                    <td>
                                        <div class="cart-action">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['tenant.destroy', $tenant->id]]) !!}
                                            @can('show tenant')
                                                <a class="text-warning customModal" data-size="lg"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Show')}}" href="#"
                                                   data-url="{{ route('tenant.show',$tenant->id) }}"
                                                   data-title="{{__('Details')}}"> <i data-feather="eye"></i></a>
                                            @endcan
                                            @can('edit tenant')
                                                <a class="text-success customModal" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Edit')}}" href="#" data-size="lg"
                                                   data-url="{{ route('tenant.edit',$tenant->id) }}"
                                                   data-title="{{__('Edit Tenant')}}"> <i data-feather="edit"></i></a>
                                            @endcan
                                            @can('delete tenant')
                                                <a class=" text-danger confirm_dialog" data-bs-toggle="tooltip"
                                                   data-bs-original-title="{{__('Delete')}}" href="#"> <i
                                                        data-feather="trash-2"></i></a>
                                            @endcan
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
