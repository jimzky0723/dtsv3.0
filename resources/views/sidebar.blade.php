<div class="col-md-3 wrapper">
    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">PENDING DOCUMENTS</h3>                
        </div> 
        <div class="panel-body"> 
            @for($i=0; $i < 5; $i++)
            <table class="table table-hover">
                <thead>
                    <tr><th>General Documents</th></tr>
                </thead>
                <tbody>
                    <tr><td>Route #: D12345678</td></tr>
                    <tr><td>From: Queeny Anora</td></tr>
                    <tr><td>
                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-bookmark"></i> Details</a>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Done</a>
                        </td></tr>
                </tbody>
            </table>
            @endfor
        </div>
    </div>
</div>