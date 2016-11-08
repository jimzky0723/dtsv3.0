@extends('layouts.app')

@section('content')
<h3 class="page-header">Accepted
    <small>Documents</small>
</h3>
<img src="{{ asset('resources/img/chart.PNG') }} " class="img-responsive">
<h3 class="page-header">Delivered
    <small>Documents</small>
</h3>
<img src="{{ asset('resources/img/chart.PNG') }} " class="img-responsive">
<h3 class="page-header">Document
    <small>Types</small>
</h3>
<img src="{{ asset('resources/img/chart2.PNG') }} " class="img-responsive">
@endsection

@include('sidebar')
