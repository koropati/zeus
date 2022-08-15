@extends('layouts.error')

@section('title-page')
    <title>
        500 Server error - {{ config('app.name') }}
    </title>
@endsection

@section('content')
    <h1 class="error-text text-primary">500</h1>
    <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Server Error</h4>
    <p>Your Request resulted in an Server Error.</p>
    <form class="mt-5 mb-5">

        <div class="text-center mb-4 mt-4"><a href="{{ route('dashboard') }}" class="btn btn-primary">Go
                to Homepage</a>
        </div>
    </form>
@endsection