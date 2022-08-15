@extends('layouts.error')

@section('title-page')
    <title>
        404 Not Found - {{ config('app.name') }}
    </title>
@endsection

@section('content')
    <h1 class="error-text text-primary">404</h1>
    <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Not Found</h4>
    <p>Your Request resulted in an Not Found.</p>
    <form class="mt-5 mb-5">

        <div class="text-center mb-4 mt-4"><a href="{{ route('dashboard') }}" class="btn btn-primary">Go
                to Homepage</a>
        </div>
    </form>
@endsection