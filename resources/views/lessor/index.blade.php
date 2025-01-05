@extends('layouts.app')

@section('page-title')
    {{ __('Lessors') }}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb mb-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}"><h1>{{ __('Dashboard') }}</h1></a>
        </li>
        <li class="breadcrumb-item active">
            <a href="#">
                {{ __('Lessors') }}
            </a>
        </li>
    </ul>
@endsection

@section('card-action-btn')
    @if(Gate::check('manage lessor'))
        <a class="btn btn-primary btn-sm ml-20 customModal" href="#" data-size="lg"
           data-url="{{ route('lessor.create') }}"
           data-title="{{ __('Create Lessor') }}">
            <i class="ti-plus mr-5"></i> {{ __('Create Lessor') }}
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
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Nationality') }}</th>
                            <th>{{ __('Document Type') }}</th>
                            <th>{{ __('Document Number') }}</th>
                            <th>{{ __('City') }}</th>
                            <th>{{ __('Municipality') }}</th>
                            <th>{{ __('License Number') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lessors as $lessor)
                            <tr>
                                <td>{{ $lessor->id }}</td>
                                <td>{{ $lessor->name }}</td>
                                <td>{{ $lessor->nationality ?? '-' }}</td>
                                <td>{{ $lessor->document_type }}</td>
                                <td>{{ $lessor->document_number }}</td>
                                <td>{{ $lessor->city ?? '-' }}</td>
                                <td>{{ $lessor->municipality ?? '-' }}</td>
                                <td>{{ $lessor->license_number ?? '-' }}</td>
                                <td>
                                    <div class="cart-action">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['lessor.destroy', $lessor->id]]) !!}
                                        @can('show lessor')
                                            <a class="text-warning customModal" data-size="lg"
                                               data-bs-toggle="tooltip" data-bs-original-title="{{ __('Show') }}"
                                               href="#" data-url="{{ route('lessor.show', $lessor->id) }}"
                                               data-title="{{ __('Details') }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        @endcan
                                        @can('edit lessor')
                                            <a class="text-success customModal" data-bs-toggle="tooltip"
                                               data-bs-original-title="{{ __('Edit') }}" href="#" data-size="lg"
                                               data-url="{{ route('lessor.edit', $lessor->id) }}"
                                               data-title="{{ __('Edit Lessor') }}">
                                                <i data-feather="edit"></i>
                                            </a>
                                        @endcan
                                        @can('delete lessor')
                                            <a class="text-danger confirm_dialog" data-bs-toggle="tooltip"
                                               data-bs-original-title="{{ __('Delete') }}" href="#">
                                                <i data-feather="trash-2"></i>
                                            </a>
                                        @endcan
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
