@extends('layouts.app')

@section('content')

    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">System Users</h2>
        <form class="form-inline form-accept" action="{{ asset('/search/user') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Quick Search" autofocus>
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
        @if(count($users) > 0)
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th width="20%">Username</th>
                        <th width="15%">Name </th>
                        <th width="20%">User email</th>
                        <th width="20%">Designation</th>
                        <th width="20%">Division</th>
                        <th width="20%">Section</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <?php $section = \App\Section::where('id', $user->section)->pluck('description')->first(); ?>
                        <?php $division = \App\Division::where('id', $user->division)->pluck('description')->first(); ?>
                        <?php $designation = \App\Designation::where('id', $user->division)->pluck('description')->first(); ?>

                        <tr>
                            <td><a href="#user" data-id="{{ $user->id }}" data-link="{{ asset('user/edit') }}">{{ $user->username }}</a></td>
                            <td><a href="#user" data-id="{{ $user->id }}" data-link="{{ asset('user/edit') }}">{{ $user->fname ." ". $user->mname." ".$user->lname }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $designation }}</td>
                            <td>{{ $division }}</td>
                            <td>{{ $section }}</td>
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
@section('js')
    @@parent
    <script>
        (function($){
            $('.form-accept').submit(function(event){
                $(this).submit();
            });
        })($);
    </script>
@endsection


