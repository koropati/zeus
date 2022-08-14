@extends('layouts.error')

@section('title-page')
    <title>
        401 Unauthorized - {{ config('app.name') }}
    </title>
@endsection

@section('body-page')
    <h5>
        Before proceeding, please check your email for a verification link. If you did not
        receive the email.
    </h5>
@endsection

@section('footer-page')
<form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
    @csrf
    <div class="text-center">
        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
            Click here to request another
        </button>
    </div>
</form>
@endsection
