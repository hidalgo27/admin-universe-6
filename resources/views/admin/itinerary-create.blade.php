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
                                <li class="breadcrumb-item active" aria-current="page">All Packages</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="col">
                <p class="font-weight-bold text-secondary small pb-1 mb-2 mt-4">Image Slider <span class="badge badge-warning">1900x1080 PX</span></p>
                <form method="post" action="{{route('admin_itinerary_slider_getFile_path')}}" enctype="multipart/form-data"
                    class="dropzone" id="dropzone">
                    <input type="hidden" name="aux" id="imagenes_aux">
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-9">
            <form action="{{route('admin_itinerary_store_path')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label class="font-weight-bold text-secondary small" for="codigo">Code</label>
                            <input type="text" name="codigo" class="form-control font-weight-bold" id="codigo" placeholder="" value="{{old('codigo')}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-bold text-secondary small" for="txt_title">Title Package</label>
                            <input type="text" name="txt_title" class="form-control font-weight-bold" id="txt_title">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">Short</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_short"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">Extended</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_extended"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col text-center">
                        {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                        <input type="hidden" name="id_blog_file2" id="imagenes">
                        <button type="submit" class="btn btn-primary font-weight-bold">Create itinerary</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
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
            toolbar: 'undo redo | formatselect | bold italic forecolor backcolor | image table | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });
    </script>
    <script>
        // Dropzone.autoDiscover = false;
        // jQuery(document).ready(function() {
        //     $("#dropzone").dropzone({
        //         url: "../../../../admin/package/upload_file",
        //         dictDefaultMessage: "Drop files here or<br>click to upload..."
        //     });
        // });
        {{--Dropzone.createThumbnailFromUrl(file, "{{asset('images/destinations/puno.jpg')}}", callback, crossOrigin);--}}
        const images=[];
                const images_aux=[];
                var dataT="";
                var aux2="";
        Dropzone.options.dropzone =
            {
                {{--init: function() {--}}
                    {{--thisDropzone = this;--}}
                    {{--// var name = file.upload.filename;--}}
                    {{--<!-- 4 -->--}}
                    {{--$.get("{{route('admin_itinerary_list_path')}}", function(data) {--}}

                        {{--<!-- 5 -->--}}
                        {{--$.each(data.images, function(key,value){--}}

                            {{--var mockFile = { name: value.original, size: value.size };--}}
                            {{--thisDropzone.emit("addedfile", mockFile);--}}
                            {{--thisDropzone.emit("thumbnail", mockFile, "http://new-goto.nu/images/itinerario/"+value.original);--}}
                            {{--thisDropzone.emit("complete", mockFile);--}}
                            {{--var existingFileCount = 1; // The number of files already uploaded--}}
                            {{--thisDropzone.options.maxFiles = thisDropzone.options.maxFiles - existingFileCount;--}}

                        {{--});--}}

                    {{--});--}}
                {{--},--}}

                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    dataT=time;
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                var name = file.name;
                var dataString = $('#imagenes_aux').serialize()+'&'+$.param({ 'name_file': name });
                // alert(name);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_itinerary_slider_deleteFile_path')}}",
                        data: dataString,
                        success: function (data) {
                            aux2=data;
                            var index_name_aux = images_aux.indexOf(aux2);
                            images_aux.splice(index_name_aux, 1);
                            images.splice(index_name_aux, 1);
                            document.getElementById("imagenes").value=images;
                            document.getElementById("imagenes_aux").value = images_aux;
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

                success: function (file, response) {
                    images_aux.push(response+" "+dataT);
                    var img=response.split(" ");
                    images.push(img[0]);
                    document.getElementById("imagenes").value = images;
                    document.getElementById("imagenes_aux").value = images_aux;
                },
                error: function (file, response) {
                    return false;
                },
            };
    </script>
@endpush
