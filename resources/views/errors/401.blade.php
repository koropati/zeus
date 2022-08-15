@extends('layouts.error')

@section('title-page')
    <title>
        401 Unauthorized - {{ config('app.name') }}
    </title>
@endsection

@section('content')
    <h1 class="error-text text-primary">401</h1>
    <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Unauthorized</h4>
    <p>Your Request resulted in an Unauthorized.</p>
    <form class="mt-5 mb-5">

        <div class="text-center mb-4 mt-4"><a href="{{ route('dashboard') }}" class="btn btn-primary">Go
                to Homepage</a>
        </div>
    </form>
@endsection