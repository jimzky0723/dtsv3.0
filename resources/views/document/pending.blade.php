<?php
    use App\Http\Controllers\DocumentController as Doc;
    use App\User;
?>
@extends('layouts.app')
@section('content')
    <div class="col-md-12 wrapper">
        <div class="alert alert-jim">
            @if (session('status'))
                <?php
                $status = session('status');
                ?>
                @if(isset($status['success']))
                    <div class="alert alert-success">
                        <ul>
                            @foreach ($status['success'] as $success)
                                <li>{!! $success !!}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(isset($status['errors']))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($status['errors'] as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif
            <h2 class="page-header">Pending Documents</h2>
            <form id="accept_form" method="post">
                {{ csrf_field() }}
                @if(count($pending))
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th width="30%">Route No / Barcode</th>
                        <th width="30%">Document Type</th>
                        <th>From</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 ;?>
                    @foreach($pending as $doc)
                        <tr>
                            <td><strong>{{ $i++ }}</strong></td>
                            <td>
                                <a class="title-info" data-route="{{ $doc->route_no }}" data-link="{{ asset('/document/info/'.$doc->route_no.'/'.$doc->doc_type) }}" href="#document_info" data-toggle="modal">
                                {{ $doc->route_no }}
                                </a>
                            </td>
                            <td>{{ Doc::docTypeName($doc->doc_type) }}</td>
                            <?php
                                $user = User::find($doc->delivered_by);
                            ?>
                            <td>{{ $user->fname.' '.$user->lname }}</td>
                            <td>
                                {{ Doc::timeDiff($doc->date_in) }}
                            </td>
                            <td>
                                <a href="#remove_pending" data-link="{{ asset('document/removepending/'.$doc->id) }}" data-id="{{ $doc->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Done</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $pending->links() }}
                @else
                <div class="alert alert-info">
                    <i class="fa fa-info"></i> No pending document!
                </div>
                @endif
                <div class="clearfix"></div><br>
            </form>
            <hr />
            <div class="accepted-list">

            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection