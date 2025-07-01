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
                <p class="font-weight-bold text-secondary small pb-1 mb-2">Package Thumbnail Image<span class="badge badge-warning">800x900 PX</span></p>
                <form method="post" action="{{route('admin_destinations_imagen_getFile_path')}}" enctype="multipart/form-data"
                    class="dropzone" id="dropzone_imagen">
                    <input type="hidden" value="" name="id_blog_file">
                    @csrf
                </form>
            </div>
            <div class="col">
                <p class="font-weight-bold text-secondary small pb-1 mb-2 mt-4">Image Slider <span class="badge badge-warning">1900x1080 PX</span></p>
                <form method="post" action="{{route('admin_destinations_slider_getFile_path')}}" enctype="multipart/form-data"
                    class="dropzone" id="dropzone_destinations">
                    <input type="hidden" name="aux" id="imagenes_aux">
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-9">
            <form action="{{route('admin_destinations_store_path')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-bold text-secondary small" for="txt_destination">Destination</label>
                            <input type="text" name="txt_destination" class="form-control font-weight-bold" id="txt_destination" placeholder="" value="{{old('txt_destination')}}">
                        </div>
                    </div>
{{--                    <div class="col">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="font-weight-bold text-secondary small" for="txt_region">Region</label>--}}
{{--                            <input type="text" name="txt_region" class="form-control font-weight-bold" id="txt_region" placeholder="" value="{{old('txt_region')}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="font-weight-bold text-secondary small" for="txt_country">Country</label>--}}
{{--                            <input type="text" name="txt_country" class="form-control font-weight-bold" id="txt_country" alue="{{old('txt_country')}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
                    <div class="col">
                        {{--                            <div class="form-group">--}}
                        {{--                                <label class="font-weight-bold text-secondary small" for="txt_country">Country</label>--}}
                        {{--                                <input type="text" name="txt_country" class="form-control font-weight-bold" id="txt_country" value="{{$destination->pais}}">--}}
                        {{--                            </div>--}}
                        <div class="form-group">
                            <label for="txt_country" class="font-weight-bold text-secondary small">Country</label>
                            <select class="form-control" name="txt_country" id="txt_country">
                                @foreach($country as $countries)
                                    <option value="{{$countries->id}}">{{$countries->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="basic-url" class="font-weight-bold text-secondary small">Your vanity URL</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">https://{{$host}}/destinos/</span>
                            </div>
                            <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <a href="#addSeo" class="btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Add SEO</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class="font-weight-bold text-secondary small" for="txt_titulo">Title</label>
                            <input type="text" name="txt_titulo" class="form-control font-weight-bold" id="txt_titulo" placeholder="" value="{{old('txt_titulo')}}">
                        </div>
                    </div>
                </div>

                <div class="">
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
                            <h3 class="font-weight-bold text-secondary small">Description</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_extended"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Intro</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_intro"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Best time to visit</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_best_time"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Top tours</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_top_tours"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Things to do</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_things"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Weather</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_weather"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Airports</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_airports"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Hotels</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_hotels"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Restaurants</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_restaurants"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Best way of payment</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_payment"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Festivities</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_festivities"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Other useful information</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_information"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Best places to visit</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_places"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-none">
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <h3 class="font-weight-bold text-secondary small">Short</h3>--}}
{{--                        <div class="form-group">--}}
{{--                            <textarea class="textarea-package" name="txta_short"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col">--}}
{{--                        <h3 class="font-weight-bold text-secondary small">Extended</h3>--}}
{{--                        <div class="form-group">--}}
{{--                            <textarea class="textarea-package" name="txta_extended"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">History</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_history"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">Geography</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_geography"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">How to get?</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_get"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">Tourist Attractions</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_attractions"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">Entertainment</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_entertainment"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">Gastronomy</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_gastronomy"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bold text-secondary small">Festivals</h3>
                        <div class="form-group">
                            <textarea class="textarea-package" name="txta_festivals"></textarea>
                        </div>
                    </div>
                </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col text-center">
                        {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                        <input type="hidden" name="id_blog_file" id="imagen">
                        <input type="hidden" name="id_blog_file2" id="imagenes">
                        <input type="hidden" name="imagen_seo2" id="imagen_seo2">
                        <input type="hidden" name="seo_atributos" id="seo_atributos">
                        <button type="submit" class="btn btn-primary font-weight-bold">Create Destination</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="addSeo" class="modal fade">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add SEO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="col">
                                <div class="form-group">
                                    <label>Title</label><span class="small text-black-50"> (no more than 70 characters)</span>
                                    <input type="text" class="form-control" name="txt_title" id="txt_title" maxlength="70" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>keywords</label><span class="small text-black-50"> (separated by commas)</span>
                                    <textarea type="text" class="form-control" name="txt_keywords" id="txt_keywords"></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Description</label><span class="small text-black-50"> (no more than 160 characters)</span>
                                    <textarea type="text" class="form-control" name="txt_description" id="txt_description" maxlength="160"></textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>URL canonical</label>
                                    <input type="text" class="form-control" name="txt_url" id="txt_url">
                                </div>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="col">
                                <div class="form-group">
                                    <label><b>Schema</b> - JSON-LD</label>
                                    <textarea type="text" class="form-control" name="txt_schema" id="txt_schema" rows="18" placeholder="<script type='application/ld+json'>&#10;{&#10;'@context': 'https://schema.org',&#10;...&#10;}&#10;</script>"></textarea>
                                </div>
                            </div>
                            <div class="col text-center">
                                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                                <input type="submit" id="send_clic" class="btn btn-success" data-dismiss="modal" value="Add">
                                <input type="hidden" name="id_seo_file" id="imagen_seo">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label><b>Open Graph</b> Type</label>
                                        <input type="text" class="form-control" name="txt_type" id="txt_type">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Site name</label>
                                        <input type="text" class="form-control" name="txt_siteName" id="txt_siteName">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Locale</label>
                                        <input type="text" class="form-control" name="txt_locale" id="txt_locale">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Image Width</label>
                                        <input type="number" class="form-control" name="txt_imageWidth" id="txt_imageWidth">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Image Height</label>
                                        <input type="number" class="form-control" name="txt_imageHeight" id="txt_imageHeight">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <p class="font-weight-bold text-secondary small pb-1 mb-2">Image
                                    <form method="post" action="{{route('admin_seo_destinations_imagen_getFile_path')}}" enctype="multipart/form-data"
                                            class="dropzone" id="dropzone_imagen_seo">
                                        <input type="hidden" value="" name="id_seo_file">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {
        const images=[];
        const images_aux=[];
        var dataT="";
        var aux2="";
        $("#dropzone_destinations").dropzone({

            maxFilesize: 12,
            maxFiles: 3,
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
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('admin_destinations_slider_deleteFile_path') }}",
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
            success: function(file, response){
                images_aux.push(response+" "+dataT);
                var img=response.split(" ");
                images.push(img[0]);
                document.getElementById("imagenes").value = images;
                document.getElementById("imagenes_aux").value = images_aux;
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
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file){
                // var name = file.name;
                var dataString = $('#imagen').serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('admin_destinations_imagen_deleteFile_path') }}",
                    data: dataString,
                    success: function (data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                document.getElementById("imagen").value = null;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response){
                document.getElementById("imagen").value = response;
            }
            // success: function (file, response) {
            //     console.log(response);
            // },
            // error: function (file, response) {
            //     return false;
            // },

        });
        $("#dropzone_imagen_seo").dropzone({
            maxFilesize: 12,
            maxFiles: 1,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file){
                // var name = file.name;
                var dataString = $('#imagen_seo').serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('admin_seo_destinations_imagen_deleteFile_path') }}",
                    data:dataString,
                    success: function (data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                document.getElementById("imagen_seo").value = null;
                document.getElementById("imagen_seo2").value = null;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response){
                document.getElementById("imagen_seo").value = response;
                document.getElementById("imagen_seo2").value = response;
            }
            // success: function (file, response) {
            //     console.log(response);
            // },
            // error: function (file, response) {
            //     return false;
            // },

        });
        $('#send_clic').click(function () {
            var array = [];
            array.push(document.getElementById("txt_title").value);
            array.push(document.getElementById("txt_description").value);
            array.push(document.getElementById("txt_url").value);
            array.push(document.getElementById("txt_type").value);
            array.push(document.getElementById("txt_keywords").value);
            array.push(document.getElementById("txt_schema").value);
            array.push(document.getElementById("txt_locale").value);
            array.push(document.getElementById("txt_siteName").value);
            array.push(document.getElementById("txt_imageWidth").value);
            array.push(document.getElementById("txt_imageHeight").value);
            document.getElementById("seo_atributos").value=array;
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
    </script>
@endpush
