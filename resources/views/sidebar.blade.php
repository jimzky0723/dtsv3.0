<?php
    use App\Http\Controllers\DocumentController as Doc;
    use App\User;
    $pending = Doc::pendingDocuments();
?>
<div class="col-md-3 wrapper">
    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">PENDING DOCUMENTS</h3>                
        </div> 
        <div class="panel-body"> 
            @foreach($pending as $pend)
            <table class="table table-hover table-{{ $pend->id }}">
                <thead>
                    <tr><th>{{ Doc::getDocType($pend->route_no) }}</th></tr>
                </thead>
                <tbody>
                    <tr><td>Route #: {{ $pend->route_no }}</td></tr>
                    <?php $user = User::find($pend->delivered_by); ?>
                    <tr><td>From: {{ $user->fname.' '.$user->lname }}</td></tr>
                    <tr><td>Duration: {{ Doc::timeDiff($pend->date_in) }}</td></tr>
                    <input type="hidden" data-div="div-{{ $pend->id }}" class="duration" value="{{ $pend->date_in }}">
                    <tr><td>
                            <a href="#document_info_pending" data-route="{{ $pend->route_no }}" data-link="{{ asset('document/info/'.$pend->route_no) }}" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-bookmark"></i> Details</a>
                            <a href="#remove_pending" data-link="{{ asset('document/removepending/'.$pend->id) }}" data-id="{{ $pend->id }}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Done</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            @endforeach

            @if(!count($pending))
                <div class="alert alert-success text-center">
                    <h4><strong>Congrats!</strong><br>You don't have pending documents.</h4>

                </div>

            @endif
        </div>
    </div>
</div>
