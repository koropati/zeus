@extends('layouts.app')

@section('title-page')
    <title>
        Master Data User - {{ config('app.name') }}
    </title>
@endsection

@section('header-plugin')
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">User</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2>Data User</h2>
                            <button type="button" class="btn mb-1 btn-success" onClick="add()">
                                Create New
                                <span class="btn-icon-right">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.modal')
@endsection

@section('footer-plugin')
    <script src="{{ asset('assets/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script> --}}

    @include('user.js')
@endsection
