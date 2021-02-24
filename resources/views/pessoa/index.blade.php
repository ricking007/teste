@extends('themes.default.template')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Pessoas</h2>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item">
                <a href="dashboard">Home</a>
            </li> --}}
                <li class="breadcrumb-item">
                    <a>Pessoas</a>
                </li>
            </ol>
        </div>
        {{-- <div class="col-lg-2"></div> --}}
    </div>
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Pessoas cadastradas</h5>
                    </div>
                    <div class="ibox-content">
                        <div id="grid"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
