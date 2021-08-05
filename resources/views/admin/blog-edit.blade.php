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
                                <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if (session('status'))
        <div class="alert alert-success m-2" role="alert">
            {{session('status')}}
        </div>
    @endif
    <div class="row">
        <div class="col-3">
            <div class="row">
                <div class="col-12 text-center">
                    @if ($post->imagen_miniatura)
                        <p class="font-weight-bold text-secondary small pb-1 mb-2">Post Miniature Image <span class="badge badge-warning">800x900 PX</span></p>
                        <img src="{{$post->imagen_miniatura}}" alt="" class="img-thumbnail w-100 mb-2">
                        <form action="{{route('admin_blog_image_form_delete_path')}}" method="post">
                            @csrf
                            <input type="hidden" name="id_blog" value="{{$post->id}}">
                            <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    @if ($post->imagen_miniatura ==NULL)
                        <p class="font-weight-bold text-secondary small pb-1 mb-2">Post Miniature Image <span class="badge badge-warning">250x100 PX</span></p>
                        <form method="post" action="{{route('admin_blog_image_store_path')}}" enctype="multipart/form-data"
                              class="dropzone" id="dropzone_imagen">
                            <input type="hidden" value="{{$post->id}}" name="id_blog_file">
                            @csrf
                        </form>
                    @endif
                </div>
                @if ($post->imagenes->count() > 0)
                <div class="col-12 mb-4">
                    <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Post Images</p>
                    <div class="row">
                        <div class="col">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner text-center">
                                    @php $imagen_slider = 0; @endphp
                                    @foreach($post->imagenes as $imagen)
                                        @if ($imagen_slider == 0)
                                            @php $item_carousel = "active";  @endphp
                                        @else
                                            @php $item_carousel = "";  @endphp
                                        @endif
                                        <div class="carousel-item {{$item_carousel}}">
                                            <img src="{{$imagen->nombre}}" alt="" class="img-thumbnail w-100 mb-2">
                                            <form action="{{route('admin_blog_slider_form_delete_path')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id_blog" value="{{$post->id}}">
                                                <input type="hidden" name="id_blog_imagen" value="{{$imagen->id}}">
                                                <input type="hidden" name="filename" value="{{$imagen->nombre}}">
                                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                            @php $imagen_slider++; @endphp
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
                <div class="col-12">
                    <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Post Images <span class="badge badge-warning">1900x1080 PX</span></p>
                    <form method="post" action="{{route('admin_blog_slider_store_path')}}" enctype="multipart/form-data"
                          class="dropzone" id="dropzone_blog">
                        <input type="hidden" value="{{$post->id}}" name="id_blog_file">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <form action="{{route('admin_blog_update_path', $post->id)}}"  method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-bold text-secondary small" for="txt_destination">Título</label>
                                    <input type="text" name="txt_titulo" class="form-control font-weight-bold" id="txt_destination" placeholder="" value="{{$post->titulo}}">
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-group">
                                    <label class="font-weight-bold text-secondary small" for="slc_category">Select Category</label>
                                    <select class="form-control font-weight-bold text-muted" name="slc_category" id="slc_category">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->nombre}}" @if(($categoria->id) == ($post->categoria->id)) selected @endif>{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
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
                                <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3" value="{{$post->url}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <h3 class="font-weight-bold text-secondary small">Description</h3>
                                <div class="form-group">
                                    <textarea class="textarea-package" name="txta_short">{!! $post->detalle !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row mb-3">
                    <div class="col text-center">
                        {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                        <button type="submit" class="btn btn-primary font-weight-bold">Update Post</button>
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
            $("#dropzone_imagen").dropzone({

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
                    var dataString = $('#dropzone_imagen').serialize();
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