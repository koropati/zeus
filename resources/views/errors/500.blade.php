@extends('layouts.error')

@section('title-page')
    <title>
        500 Server Error - {{ config('app.name') }}
    </title>
@endsection

@section('body-page')
    <h1>
        500
    </h1>
    <div class="h6 mt-4">
        In most cases, this error results from a problem with the code or program you are calling rather than with the web server itself.
    </div>
    <div>
        Calm down you can move to the previous page
    </div>
@endsection

@section('footer-page')
    <div class="d-flex justify-content-between">
        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Back</a>
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Home</a>
    </div>
@endsection