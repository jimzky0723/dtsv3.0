<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-hover table-striped">
                    <tr>
                        <td class="text-right col-lg-5">Subject :</td>
                        <td class="col-lg-7">{{ $feedback->subject }}</td>
                    </tr>
                    <tr>
                        <td class="text-right col-lg-5">Tel No. :</td>
                        <td class="col-lg-7">{{ $feedback->telno }}</td>
                    </tr>
                    <tr>
                        <td class="text-right col-lg-5">Message :</td>
                        <td class="col-lg-7">{!! nl2br($feedback->message) !!}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>