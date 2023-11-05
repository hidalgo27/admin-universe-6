@extends('layouts.admin.app')
@section('sidebar')
    @parent
    @include('layouts.admin.sidebar')
@endsection
@section('content')
    @if (session('status'))
        <div class="toast bg-primary fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Country</strong>
                <small>
                    @php
                        date_default_timezone_set('America/Lima');
                        echo date ("l m Y");
                    @endphp
                </small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body font-weight-bold text-white">
                {{ session('status') }}
            </div>
        </div>
    @endif
    @if (session('statusseo'))
        <div class="alert alert-success m-2" role="alert">
            {{session('statusseo')}}
        </div>
    @endif
    @if (session('statusseo2'))
        <div class="alert alert-success m-2" role="alert">
            {{session('statusseo2')}}
        </div>
    @endif
    @if (session('delete'))
        <div class="toast bg-danger fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Country</strong>
                <small>
                    @php
                        date_default_timezone_set('America/Lima');
                        echo date ("l m Y");
                    @endphp
                </small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body font-weight-bold text-white">
                {{ session('delete') }}
            </div>
        </div>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb small font-weight-bold p-0 m-0 bg-white">
                                <li class="breadcrumb-item"><a href="#">1. Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Country Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
        @foreach($countries as $country)

            <div class="col-3">
                <div class="row">
                    <div class="col-12 text-center">
                        @if ($country->imagen)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Destinations Thumbnail Image <span class="badge badge-warning">800x900 PX</span></p>
                            <img src="{{$country->imagen}}" alt="" class="img-thumbnail w-100 mb-2">
                            <form action="{{route('admin_countries_image_form_delete_path')}}" method="post">
                                @csrf
                                <input type="hidden" name="id_pais" value="{{$country->id}}">
                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-4">
                        @if ($country->imagen ==NULL)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Destinations Thumbnail Image <span class="badge badge-warning">800x900 PX</span></p>
                            <form method="post" action="{{route('admin_image_countries_image_store_path')}}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone_imagen">
                                <input type="hidden" value="{{$country->id}}" name="id_countries_file">
                                @csrf
                            </form>
                        @endif
                    </div>
                    @if ($country->pais_imagen->count() > 0)
                        <div class="col-12 mb-4">
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Destinations Images</p>
                            <div class="row">
                                <div class="col">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner text-center">
                                            @php $imagen_slider = 0; @endphp
                                            @foreach($country->pais_imagen as $imagen)
                                                @if ($imagen_slider == 0)
                                                    @php $item_carousel = "active";  @endphp
                                                @else
                                                    @php $item_carousel = "";  @endphp
                                                @endif
                                                <div class="carousel-item {{$item_carousel}}">
                                                    <img src="{{$imagen->nombre}}" alt="" class="img-thumbnail w-100 mb-2">
                                                    <form action="{{route('admin_countries_slider_form_delete_path')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id_country" value="{{$country->id}}">
                                                        <input type="hidden" name="id_country_imagen" value="{{$imagen->id}}">
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
                        <p class="font-weight-bold text-secondary small pb-1 mb-2">Slider Destinations Images <span class="badge badge-warning">1900x1080 PX</span></p>
                        <form method="post" action="{{route('admin_image_countries_slider_store_path')}}" enctype="multipart/form-data"
                              class="dropzone" id="dropzone_countries">
                            <input type="hidden" value="{{$country->id}}" name="id_countries_file">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-9">
                <form action="{{route('admin_countries_update_path', $country->id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="txt_country">Destination</label>
                                <input type="text" name="txt_country" class="form-control font-weight-bold" id="txt_country" placeholder="" value="{{$country->nombre}}">
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
                                <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3" value="{{$country->url}}">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            @if ($seo!=NULL)
                                <a href="#editSeo" class="btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Edit SEO</a>
                            @endif
                            @if ($seo==NULL)
                                <a href="#addSeo" class="btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Add SEO</a>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Weather</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_weather">{{$country->clima}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Recommend</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_recommend">{{$country->recomendaciones}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Short</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_short">{{$country->resumen}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Extended</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_extended">{{$country->descripcion}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">History</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_history">{{$country->historia}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Geography</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_geography">{{$country->geografia}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">How to get?</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_get">{{$country->donde_ir}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Tourist Attractions</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_attractions">{{$country->atracciones}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Entertainment</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_entertainment">{{$country->entretenimiento}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Gastronomy</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_gastronomy">{{$country->gastronomia}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3 class="font-weight-bold text-secondary small">Festivals</h3>
                            <div class="form-group">
                                <textarea class="textarea-package" name="txta_festivals">{{$country->fiestas}}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col text-center">
                            {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                            <button type="submit" class="btn btn-primary font-weight-bold">Update destination</button>
                        </div>
                    </div>
                </form>
            </div>

        @endforeach
    </div>
    <div id="addSeo" class="modal fade">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{route('admin_seo_store_path')}}"  method="post">
                    @csrf
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
                                        <input type="text" class="form-control" name="txt_title"  maxlength="70" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>keywords</label><span class="small text-black-50"> (separated by commas)</span>
                                        <textarea type="text" class="form-control" name="txt_keywords"></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Description</label><span class="small text-black-50"> (no more than 160 characters)</span>
                                        <textarea type="text" class="form-control" name="txt_description" maxlength="160"></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>URL canonical</label>
                                        <input type="text" class="form-control" name="txt_url" >
                                    </div>
                                </div>
                                <input type="hidden" value="{{$country->id}}" name="text_idt">
                            </div>
                            <div class="col-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label><b>Schema</b> - JSON-LD</label>
                                        <textarea type="text" class="form-control" name="txt_schema" rows="18" placeholder="<script type='application/ld+json'>&#10;{&#10;'@context': 'https://schema.org',&#10;...&#10;}&#10;</script>"></textarea>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-success" value="Add">
                                    <input type="hidden" name="id_seo_file" id="imagen">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label><b>Open Graph</b> Type</label>
                                            <input type="text" class="form-control" name="txt_type" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label>Site name</label>
                                            <input type="text" class="form-control" name="txt_siteName" >
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Locale</label>
                                            <input type="text" class="form-control" name="txt_locale">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Image Width</label>
                                            <input type="number" class="form-control" name="txt_imageWidth">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Image Height</label>
                                            <input type="number" class="form-control" name="txt_imageHeight">
                                        </div>
                                    </div>
                                </div>
                </form>
                                <div class="row">
                                    <div class="col">
                                        <p class="font-weight-bold text-secondary small pb-1 mb-2">Image
                                        <form method="post" action="{{route('admin_seo_country_imagen_getFile_path')}}" enctype="multipart/form-data"
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

    @if ($seo!=NULL)
        <div id="editSeo" class="modal fade">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{route('admin_seo_update_path',$seo->id)}}"  method="post">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Edit SEO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Title</label><span class="small text-black-50"> (no more than 70 characters)</span>
                                            <input value="{{$seo->titulo}}" type="text" class="form-control" name="txt_title"  maxlength="70" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>keywords</label><span class="small text-black-50"> (separated by commas)</span>
                                            <textarea type="text" class="form-control" name="txt_keywords">{{$seo->keywords}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Description</label><span class="small text-black-50"> (no more than 160 characters)</span>
                                            <textarea type="text" class="form-control" name="txt_description" maxlength="160">{{$seo->descripcion}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>URL canonical</label>
                                            <input value="{{$seo->url}}" type="text" class="form-control" name="txt_url" >
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$country->id}}" name="text_idt">
                                </div>
                                <div class="col-4">
                                    <div class="col">
                                        <div class="form-group">
                                            <label><b>Schema</b> - JSON-LD</label>
                                            <textarea type="text" class="form-control" name="txt_schema" rows="18" placeholder="<script type='application/ld+json'>&#10;{&#10;'@context': 'https://schema.org',&#10;...&#10;}&#10;</script>">{{$seo->microdata}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                                        <input type="submit" class="btn btn-success" value="Update">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label><b>Open Graph</b> Type</label>
                                                <input value="{{$seo->og_tipo}}" type="text" class="form-control" name="txt_type" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <label>Site name</label>
                                                <input value="{{$seo->nombre_sitio}}" type="text" class="form-control" name="txt_siteName" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Locale</label>
                                                <input value="{{$seo->localizacion}}" type="text" class="form-control" name="txt_locale">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Image Width</label>
                                                <input value="{{$seo->imagen_width}}" type="number" class="form-control" name="txt_imageWidth">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Image Height</label>
                                                <input value="{{$seo->imagen_height}}" type="number" class="form-control" name="txt_imageHeight">
                                            </div>
                                        </div>
                                    </div>
                    </form>
                                    <div class="row">
                                        @if ($seo->imagen)
                                            <div class="col">
                                                <p class="font-weight-bold text-secondary small pb-1 mb-2">Image <span class="badge badge-warning">800x900 PX</span></p>
                                                <img src="{{$seo->imagen}}" alt="" class="img-thumbnail w-100 mb-2">
                                                <form action="{{route('admin_seo_country_image_form_delete_path')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_seo" value="{{$seo->id}}">
                                                    <button type="submit" class="btn btn-xs btn-danger">Eliminar Imagen</button>
                                                </form>
                                            </div>
                                        @endif
                                        @if ($seo->imagen==null)
                                            <div class="col">
                                                <p class="font-weight-bold text-secondary small pb-1 mb-2">Image
                                                <form method="post" action="{{route('admin_seo_country_image_store_path')}}" enctype="multipart/form-data"
                                                      class="dropzone" id="dropzone_imagen_seoEdit">
                                                    <input type="hidden" value="{{$seo->id}}" name="id_seo">
                                                    @csrf
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>


                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script>
        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {
            $("#dropzone_countries").dropzone({

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
                    var dataString = $('#dropzone_countries').serialize()+'&'+$.param({ 'name_file': name });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_countries_slider_delete_path') }}",
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
                        url: "{{ route('admin_countries_image_delete_path') }}",
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
            $("#dropzone_imagen_seo").dropzone({
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
                    var dataString = $('#imagen').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_seo_country_imagen_deleteFile_path') }}",
                        data:dataString,
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
            $("#dropzone_imagen_seoEdit").dropzone({

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
                    var dataString = $('#dropzone_imagen_seoEdit').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_seo_country_image_delete_path') }}",
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

                success: function(file, response){
                    console.log(response);
                }
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
