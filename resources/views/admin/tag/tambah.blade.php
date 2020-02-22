@extends('layouts.backend.master')

@section('title', 'Tag')

@push('css')
    <!-- Sweet Alert Css -->
    <link href="{{asset('backend/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        TAMBAH TAG BARU
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.tag.store')}}" method="POST">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="tag" class="form-control" name="name">
                                <label class="form-label">Nama Tag</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SIMPAN</button>
                        <a href="{{route('admin.tag.index')}}" type="button" class="btn btn-danger m-t-15 waves-effect">KEMBALI</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

</div>
@endsection

@push('js')

@endpush
