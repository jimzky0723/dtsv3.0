<?php
    use App\Http\Controllers\DocumentController as Doc;
    use App\User as User;
    use App\Section;
?>
@if(count($document))
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th width="25%">Received By</th>
            <th width="25%">Date In</th>
            <th width="25%">Duration</th>
            <th width="25%">Remarks</th>
        </tr>
    </thead>
    <tbody>
    @foreach($document as $doc)
        <tr>
            <td>
                <?php $user = User::find($doc->received_by); ?>
                {{ $user->fname.' '.$user->lname }}
                <br>
                <em>({{ Section::find($user->section)->description }})</em>
            </td>
            <td>{{ date('M d, Y', strtotime($doc->date_in)) }}<br>{{ date('h:i A', strtotime($doc->date_in)) }}</td>
            <td>
                <?php $check = Doc::checkLastRecord($doc->route_no); ?>
                @if($doc->id==$check && $doc->status==1)
                    Cycle End
                @else
                    <?php
                        $next = Doc::getNextRecord($doc->route_no,$doc->id);
                        if(count($next)):
                            foreach($next as $tmp){
                                if($tmp['route_no']!=$doc->route_no){
                                    echo Doc::timeDiff($doc->date_in);
                                }else{
                                    echo Doc::timeDiff($doc->date_in,$tmp['date_in']);
                                }
                            }
                        else:
                            echo Doc::timeDiff($doc->date_in);
                        endif;
                    ?>
                @endif
            </td>
            <td>{{ nl2br($doc->action) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-danger">
        <i class="fa fa-times"></i> No tracking history!
    </div>
@endif