@extends('layouts.app')

@section('content')

    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">System Users</h2>
        <form class="form-inline form-accept">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Quick Search" autofocus>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
                <div class="btn-group">
                    <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-link="{{ asset('user/new') }}" href="#new">
                        <i class="fa fa-plus"></i>  Add New
                    </a>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>
        @if(count($users))
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th width="8%"></th>
                        <th width="20%">User ID</th>
                        <th width="15%">Name </th>
                        <th width="20%">User email</th>
                        <th width="20%">Designation</th>
                        <th width="20%">Division</th>
                        <th width="20%">Section</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                           <td>Edit</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->fname ." ". $user->mname." ".$user->lname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->designation }}</td>
                            <td>{{ $user->division }}</td>
                            <td>{{ $user->section }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        @else
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i>No users found.</strong>
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

