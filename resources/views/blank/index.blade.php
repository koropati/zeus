@extends('layouts.app')

@section('title-page')
    <title>
        {{ config('app.name') }} Blank Page
    </title>
@endsection

@section('header-plugin')

@endsection


@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">

</div>
@endsection

@section('footer-plugin')

@endsection