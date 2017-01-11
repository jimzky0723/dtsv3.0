<div class="modal-body">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="alert alert-default">
                    <strong>Subject : {{ $feedback->subject }}</strong><br />
                    <strong>Tel no. {{ $feedback->telno }}</strong> <br />
                    {{ $feedback->message }}
                </div>
            </div>
        </div>
    </div>
</div>