@extends('layouts.app')

@section('content')
    <span id="url" data-link="{{ asset('/designation') }}"></span>
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Designations</h2>
        <form class="form-inline form-accept">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Quick Search" autofocus>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                <div class="btn-group">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-link="{{ asset('/designation/create') }}" href="#new">
                        <i class="fa fa-plus"></i>  Add New
                    </a>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        @if(count($designations))
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th width="8%"></th>
                        <th width="20%">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($designations as $d)
                        <tr>
                            <td>
                                <span class="col-md-1">
                                    <a href="#remove_designation" data-link="{{ asset('/remove/designation') }}" data-id="{{ $d->id }}">
                                        <i class="fa fa-trash" aria-hidden="true" style="color: #9f191f;" title="Delete"></i>
                                    </a>
                                </span>
                                <span class="col-md-1">
                                    <a href="#edit_designation" data-link="{{ asset('/edit/designation') }}" data-id="{{ $d->id }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #0000cc;" title="Edit"></i>
                                    </a>
                                </span>
                            </td>
                            <td>{{ $d->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $designations->links() }}
        @else
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i>Record is empty.</strong>
            </div>
        @endif
    </div>
@endsection
@section('plugin')
    <script src="{{ asset('resources/plugin/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('resources/plugin/daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('css')
    <link href="{{ asset('resources/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
@endsection
