@extends('layouts.backend.master')

@section('title', 'Kategori')

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
                        TAMBAH KATEGORI BARU
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="tag" class="form-control" name="name">
                                <label class="form-label">Nama Kategori</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="tag" class="form-control" name="caption">
                                <label class="form-label">Caption</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SIMPAN</button>
                        <a href="{{route('admin.category.index')}}" type="button" class="btn btn-danger m-t-15 waves-effect">KEMBALI</a>
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
