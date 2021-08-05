@extends('layouts.admin.app')
@section('sidebar')
    @parent
    @include('layouts.admin.sidebar')
@endsection
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb small font-weight-bold p-0 m-0 bg-white">
                                <li class="breadcrumb-item"><a href="#">1. Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin_blog_index_path')}}">All Posts</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create New Post</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if (session('status2'))
        <div class="alert alert-success m-2" role="alert">
            {{session('status2')}}
        </div>
    @endif
    <div id="addCategoryBlog" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('admin_blog_category_store_path')}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="txt_category" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-9">
            <form action="{{route('admin_blog_store_path')}}"  method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-auto">
                                <div class="form-group">
                                    <label class="font-weight-bold text-secondary small" for="slc_category">Select Category</label>
                                    <select class="form-control font-weight-bold text-muted" name="slc_category" id="slc_category">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->nombre}}">{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto m-auto">
                                <a href="#addCategoryBlog" class="delete btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Create a New Category</a>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-bold text-secondary small" for="txt_destination">Título</label>
                                    <input type="text" name="txt_titulo" class="form-control font-weight-bold" id="txt_destination" placeholder="" value="{{old('txt_destination')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="basic-url" class="font-weight-bold text-secondary small">URL</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3">https://</span>
                                    </div>
                                    <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h3 class="font-weight-bold text-secondary small">Description</h3>
                                <div class="form-group">
                                    <textarea class="textarea-package" name="txta_short"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row mb-3">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary font-weight-bold">Create Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {

            $("#dropzone_blog").dropzone({

                maxFilesize: 12,
                maxFiles: 3,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    var name = file.name;
                    var dataString = $('#dropzone_blog').serialize()+'&'+$.param({ 'name_file': name });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_blog_slider_delete_path') }}",
                        data: dataString,
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                // success: function (file, response) {
                //     console.log(response);
                // },
                // error: function (file, response) {
                //     return false;
                // },

            });
            
            $("#dropzone_imagen_blog").dropzone({
                maxFilesize: 12,
                maxFiles: 1,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    // var name = file.name;
                    var dataString = $('#dropzone_imagen_blog').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_blog_image_delete_path') }}",
                        data: dataString,
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                // success: function (file, response) {
                //     console.log(response);
                // },
                // error: function (file, response) {
                //     return false;
                // },

            });
            
                     
        });
    </script>

    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=4im5y0hsu2i10v7je2aecag5d41lh7hc0oh1mpj0lgv8pmgj "></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.textarea-package',
            height: 250,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });
        $(document).ready(function(){
            $('.toast').toast('show');
        });
    </script>
@endpush
