@extends('layouts.error')

@section('title-page')
    <title>
        400 Bad Request - {{ config('app.name') }}
    </title>
@endsection

@section('content')
    <h1 class="error-text text-primary">400</h1>
    <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Bad Request</h4>
    <p>Your Request resulted in an Bad Request.</p>
    <form class="mt-5 mb-5">

        <div class="text-center mb-4 mt-4"><a href="{{ route('dashboard') }}" class="btn btn-primary">Go
                to Homepage</a>
        </div>
    </form>
@endsection