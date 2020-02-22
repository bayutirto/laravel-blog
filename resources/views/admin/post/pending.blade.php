@extends('layouts.backend.master')

@section('title', 'Post')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row clearfix block-header">
            <a href="{{ route('admin.post.create')}}" type="button" class="btn bg-blue waves-effect">
                    <i class="material-icons">add</i>
                    <span>TAMBAH DATA</span>
            </a>
        </div>
    </div>

    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        SEMUA POST
                        <span class="badge bg-blue">{{ $posts->count() }}</span>
                    </h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Author</th>
                                    <th>Viewed</th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Author</th>
                                    <th>Viewed</th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Opsi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($posts as $key=>$post)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ str_limit($post->title, '10') }}</td>
                                    <td>{{ $post->user->name}}</td>
                                    <td>{{ $post->view_count }}</td>
                                    <td>
                                        @if($post->is_approved == true)
                                            <span class="badge bg-blue">Approved</span>
                                        @else
                                            <span class="badge bg-pink">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($post->status == true)
                                            <span class="badge bg-blue">Published</span>
                                        @else
                                            <span class="badge bg-pink">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->created_at}}</td>
                                    <td class="text-center">
                                            @if($post->is_approved == false)
                                            <button type="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                                                <i class="material-icons">remove</i>
                                                <span></span>
                                            </button>
                                            <form method="POST" action="{{route('admin.post.approve', $post->id)}}" id="approval-form" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            @else
                                                <button type="button" class="btn btn-success waves-effect" disabled>
                                                    <i class="material-icons">done</i>
                                                    <span></span>
                                                </button>
                                            @endif
                                        <a href="{{route('admin.post.show',$post->id)}}"  class="btn btn-warning waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('admin.post.edit',$post->id)}}"  class="btn btn-primary waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger waves-effect" onclick="deletePost({{$post->id}})">
                                                <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{$post->id}}" action="{{route('admin.post.destroy',$post->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->


@endsection

@push('js')
    <script src="{{asset('backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/js/pages/tables/jquery-datatable.js')}}"></script>
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
