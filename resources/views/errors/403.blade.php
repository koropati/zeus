@extends('layouts.error')

@section('title-page')
    <title>
        403 Forbidden - {{ config('app.name') }}
    </title>
@endsection

@section('body-page')
    <h1>
        403
    </h1>
    <div class="h6 mt-4">
        Request does not specify the file name, or the directory or the file does not have the permission that allows the pages to be viewed from the web
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