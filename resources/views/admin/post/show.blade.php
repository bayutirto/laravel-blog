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
    </ol>

    <div class="container-fluid">
        <div class="row clearfix block-header">
            <a href="{{ route('admin.post.index')}}" type="button" class="btn bg-red waves-effect">
                <i class="material-icons">arrow_back</i>
                <span>Kembali</span>
            </a>
            @if($post->is_approved == false)
                <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $post->id }})">
                    <i class="material-icons">remove</i>
                    <span>Approve</span>
                </button>
                <form method="POST" action="{{route('admin.post.approve', $post->id)}}" id="approval-form">
                    @csrf
                    @method('PUT')
                </form>
            @else
                <button type="button" class="btn btn-success waves-effect pull-right" disabled>
                    <i class="material-icons">done</i>
                    <span>Approved</span>
                </button>
            @endif
        </div>
    </div>

    <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{$post->title}}
                        <small>Posted by <strong><a href="">{{ $post->user->name}}</a></strong> on {{$post->created_at->toFormattedDateString()}}</small>
                        </h2>
                    </div>
                    <div class="body">
                        {!! $post->body!!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            Kategori
                        </h2>
                    </div>
                    <div class="body">
                        @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{$category->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-red">
                        <h2>
                            Tag
                        </h2>
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $tag)
                            <span class="label bg-red">{{$tag->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Featured Image
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image)}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    <!-- #END# Vertical Layout -->

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.7/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function approvePost(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                cancelButton: 'btn btn-danger',
                confirmButton: 'btn btn-success'
            },
            buttonsStyling: true,
            })

            swalWithBootstrapButtons.fire({
            title: 'Apakah anda yakin?',
            text: "Anda ingin menyetujui post ini!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('approval-form').submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Dibatalkan',
                'Post ini masih pending',
                'info'
                )
            }
        })
    }
</script>
@endpush
