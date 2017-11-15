<?php
    use App\Http\Controllers\DocumentController as Doc;
    use App\User as User;
    use App\Section;
    use App\Http\Controllers\ReleaseController as Rel;
?>

<?php if(count($document)): ?>
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
    <?php $data = array(); ?>
    <?php foreach($document as $doc): ?>
        <?php
            $user = User::find($doc->received_by);
            $data['received_by'][] = $user->fname.' '.$user->lname;
            $data['section'][] = Section::find($user->section)->description;
            $data['date'][] = $doc->date_in;
            $data['date_in'][] = date('M d, Y', strtotime($doc->date_in));
            $data['time_in'][] = date('h:i A', strtotime($doc->date_in));
            $data['remarks'][] = $doc->action;
            $data['status'][] = $doc->status;
        ?>
    <?php endforeach; ?>
    <?php for($i=0;$i<count($data['received_by']);$i++): ?>
    <tr>
        <td><?php echo e($data['received_by'][$i]); ?>

            <br>
            <em>(<?php echo e($data['section'][$i]); ?>)</em>
        </td>
        <td>
            <?php echo e($data['date_in'][$i]); ?>

            <br>
            <?php echo e($data['time_in'][$i]); ?>

        </td>
        <td>
            <?php
                $count = count($data['date']) - 1;
                $next = true;
                if($count>$i){
                    $date = $data['date'][$i+1];
                    $next = false;
                }else{
                    $date = date('Y-m-d H:i:s');
                }
            ?>
            <?php if($next && $data['status'][$i]==1): ?>
                Cycle End
            <?php else: ?>
                <?php echo e(Rel::duration($data['date'][$i],$date)); ?>

            <?php endif; ?>
        </td>
        <td><?php echo nl2br($data['remarks'][$i]); ?></td>
    </tr>
    <?php endfor; ?>
    </tbody>
</table>
<?php else: ?>
    <div class="alert alert-danger">
        <i class="fa fa-times"></i> No tracking history!
    </div>
<?php endif; ?>