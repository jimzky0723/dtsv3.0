<?php $head = new \App\Http\Controllers\DivisionController(); ?>
@extends('layouts.app')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Documents</h2>
        <form class="form-inline form-accept">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Quick Search" autofocus>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                <div class="btn-group">
                    <a href="#document_form" class="btn btn-success" data-toggle="modal" data-link="{{ asset('addDivision') }}">
                        <i class="fa fa-plus"></i>  Add New
                        <span class="caret"></span>
                    </a>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        @if(count($division))
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th width="20%">Division ID</th>
                        <th width="15%">Description</th>
                        <th width="20%">Head</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($division as $div)
                        <tr>
                            <td>{{ $div->id }}</td>
                            <td><a class="title-info" data-route="{{ $div->description }}" data-link="{{ asset('/document/'.$div->id) }}" href="#document_info" data-toggle="modal">{{ $div->description }}</a></td>
                            <td><?php $head->getHead($div->head); ?></td>
                            <td><button>Delete</button>&nbsp;&nbsp;&nbsp;&nbsp;<button>Update</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $division->links() }}
        @else
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i> No documents found! </strong>
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

