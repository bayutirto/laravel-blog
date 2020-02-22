@extends('layouts.backend.master')

@section('title', 'Post')

@push('css')
    <!-- Sweet Alert Css -->
    <link href="{{asset('backend/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
     <!-- Multi Select Css -->
     <link href="{{asset('backend/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">

@endpush

@section('content')
<div class="container-fluid">

    <ol class="breadcrumb breadcrumb-bg-blue">
        <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Post</a></li>
        <li class="active"><i class="material-icons">create</i> Tambah</li>
    </ol>

    <!-- Vertical Layout -->
    <form action="{{route('admin.post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TAMBAH POST BARU
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="title" class="form-control" name="title">
                                <label class="form-label">Judul</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Featured Image</label>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="publish" class="filled-in chk-col-light-blue" name="status" value="1">
                            <label for="publish">Publish</label>
                        </div>
                        <a href="{{route('admin.post.index')}}" type="button" class="btn btn-danger m-t-15 waves-effect"><i class="material-icons">arrow_back</i>
                            <span>Kembali</span></a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="material-icons">send</i>
                            <span>Simpan</span></a></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TAMBAH KATEGORI DAN TAG
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : ''}}">
                                <p>
                                    <b>Pilih Kategori</b>
                                </p>
                                <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error' : ''}}">
                                <p>
                                    <b>Pilih Tag</b>
                                </p>
                                <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                    @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TinyMCE -->
        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BODY
                            </h2>
                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="body">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# TinyMCE -->
    </form>
    <!-- #END# Vertical Layout -->

</div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <!-- Multi Select Plugin Js -->
    <script src="{{asset('backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script>
    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <!-- TinyMCE -->
    <script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
    <script>
        $(function () {

            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
        });
    </script>


@endpush
