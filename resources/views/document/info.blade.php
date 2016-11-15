<?php
    use App\User;
    use App\Http\Controllers\DocumentController as Doc;

    $user = User::find($document->prepared_by);

    $filter = Doc::isIncluded($document->doc_type);
?>
<table class="table table-hover table-striped">

    <tr>
        <td class="text-right col-lg-5">Document Type :</td>
        <td class="col-lg-7">{{ Doc::docTypeName($document->doc_type) }}</td>
    </tr>
    <tr>
        <td class="text-right">Prepared By :</td>
        <td>{{ $user->fname.' '.$user->mname.' '.$user->lname }}</td>
    </tr>
    <tr>
        <td class="text-right">Prepared Date :</td>
        <td>{{ date('M d, Y h:i:s A',strtotime($document->prepared_date)) }}</td>
    </tr>
    <tr class="{{ $filter[1] }}">
        <td class="text-right">Amount :</td>
        <td>{{ number_format($document->amount) }}</td>
    </tr>
    <tr class="{{ $filter[2] }}">
        <td class="text-right">PR # :</td>
        <td>{{ $document->pr_no }}</td>
    </tr>
    <tr class="{{ $filter[3] }}">
        <td class="text-right">PO # :</td>
        <td>{{ $document->po_no }}</td>
    </tr>
    <tr class="{{ $filter[4] }}">
        <td class="text-right">Purpose:</td>
        <td>{{ $document->purpose }}</td>
    </tr>
    <tr class="{{ $filter[5] }}">
        <td class="text-right">Source of Fund / Charge To :</td>
        <td>{{ $document->source_fund }}</td>
    </tr>
    <tr class="{{ $filter[6] }}">
        <td class="text-right">Requested By :</td>
        <td>{{ $document->requested_by }}</td>
    </tr>
    <tr class="{{ $filter[7] }}">
        <td class="text-right">Route To :</td>
        <td>{{ $document->route_to }}</td>
    </tr>
    <tr class="{{ $filter[8] }}">
        <td class="text-right">Route From :</td>
        <td>{{ $document->route_from }}</td>
    </tr>
    <tr class="{{ $filter[9] }}">
        <td class="text-right">Supplier :</td>
        <td>{{ $document->supplier }}</td>
    </tr>
    <tr class="{{ $filter[10] }}">
        <td class="text-right">Date of Event :</td>
        <td>{{ $document->event_date }}</td>
    </tr>
    <tr class="{{ $filter[11] }}">
        <td class="text-right">Location of Event :</td>
        <td>{{ $document->event_location }}</td>
    </tr>
    <tr class="{{ $filter[12] }}">
        <td class="text-right">Participants :</td>
        <td>{{ $document->event_participant }}</td>
    </tr>
    <tr class="{{ $filter[13] }}">
        <?php
        if($filter[13]!='hide'):
            $applicant = User::find($document->cdo_applicant);
        ?>
        <td class="text-right">Applicant :</td>
        ?>
        <td>{{ $applicant->fname.' '.$applicant->mname.' '.$applicant->lname }}</td>
        @endif
    </tr>
    <tr class="{{ $filter[14] }}">
        <td class="text-right">Number of Days :</td>
        <td>{{ $document->cdo_day }}</td>
    </tr>
    <tr class="{{ $filter[15] }}">
        <td class="text-right">Date of Event :</td>
        <td>{{ $document->event_daterange }}</td>
    </tr>
    <tr class="{{ $filter[16] }}">
        <td class="text-right">Payee :</td>
        <td>{{ $document->payee }}</td>
    </tr>
    <tr class="{{ $filter[17] }}">
        <td class="text-right">Item/s :</td>
        <td>{{ $document->item }}</td>
    </tr>
    <tr class="{{ $filter[18] }}">
        <td class="text-right">DV Number :</td>
        <td>{{ $document->dv_no }}</td>
    </tr>

</table>