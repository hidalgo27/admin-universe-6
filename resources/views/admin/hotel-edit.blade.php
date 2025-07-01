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
                                <li class="breadcrumb-item active" aria-current="page">Edit Hotel</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if (session('status'))
        <div class="toast bg-primary fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Hotel</strong>
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
    @foreach($hotel as $hotels)

        <div class="row">
            <div class="col-3">
                <div class="row">
                    <div class="col-12">
                        @if (empty($hotels->imagen))
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Package Thumbnail Image <span class="badge badge-warning">420x280 PX</span></p>
                            <form method="post" action="{{route('admin_hotel_image_store_path')}}" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone_hotel">
                                <input type="hidden" value="{{$hotels->id}}" name="id_hotel_file">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <div class="col-12 mb-4">
                        @if ($hotels->imagen)
                            <p class="font-weight-bold text-secondary small pb-1 mb-2">Package Thumbnail Image <span class="badge badge-warning">420x280 PX</span></p>
                            <img src="{{$hotels->imagen}}" alt="" class="img-thumbnail w-100 mb-2">
                            <form action="{{route('admin_hotel_image_delete_form_path')}}" method="post" class="text-center">
                                {{--@method('DELETE')--}}
                                @csrf
                                <input type="hidden" name="id_hotel" value="{{$hotels->id}}">
                                <input type="hidden" name="filename" value="{{$hotels->imagen}}">
                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                    @if ($hotels->imagenes->count() > 0)
                        <div class="col-12 ">
                            <div class="row">
                                <div class="col">
                                    <p class="font-weight-bold text-secondary small pb-1 mb-2">Hotel Image Gallery <span class="badge badge-warning">Recomendado: 1900x1080 PX</span></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="bd-example">
                                        <div id="hotelGalleryCarousel" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach($hotels->imagenes as $index => $imagen)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ $imagen->imagen }}" alt="Imagen del hotel" class="img-thumbnail w-100 mb-2">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <form action="{{ route('admin_hotel_gallery_delete_path') }}" method="POST" class="text-center">
                                                                @csrf
                                                                <input type="hidden" name="imagen_id" value="{{ $imagen->id }}">
                                                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <a class="carousel-control-prev" href="#hotelGalleryCarousel" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#hotelGalleryCarousel" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
{{--                    <form method="post" action="{{ route('admin_hotel_gallery_upload_path') }}" enctype="multipart/form-data" class="dropzone" id="dropzone_gallery">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="idhotel" value="{{ $hotels->id }}">--}}
{{--                    </form>--}}

                    <form method="post" action="{{route('admin_image_hotels_slider_store_path')}}" enctype="multipart/form-data"
                          class="dropzone" id="dropzone_hotels">
                        <input type="hidden" value="{{$hotel->id}}" name="id_hotels_file">
                        @csrf
                    </form>


                </div>
            </div>
            <div class="col">
                <form action="{{route('admin_hotel_update_path', $hotels->id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-secondary small" for="txt_destination">Name Hotel</label>
                                        <input type="text" name="txt_hotel" class="form-control font-weight-bold" id="txt_destination" placeholder="" value="{{$hotels->nombre}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-secondary small" for="txt_country">Address</label>
                                        <input type="text" name="txt_address" class="form-control font-weight-bold" id="txt_country" value="{{$hotels->direccion}}">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-secondary small" for="slc_category">Category</label>
                                        <select class="form-control font-weight-bold text-muted" name="slc_category" id="slc_category">
                                            <option value="0" @if($hotels->estrellas == "0") selected @endif>Select Category</option>
                                            <option value="2" @if($hotels->estrellas == "2") selected @endif>2 stars</option>
                                            <option value="3" @if($hotels->estrellas == "3") selected @endif>3 stars</option>
                                            <option value="4" @if($hotels->estrellas == "4") selected @endif>4 stars</option>
                                            <option value="5" @if($hotels->estrellas == "5") selected @endif>5 stars</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="basic-url" class="font-weight-bold text-secondary small">Your vanity URL</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">https://</span>
                                        </div>
                                        <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3" value="{{$hotels->url}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    @php $stringArray = explode(',', $hotels->servicios); @endphp
                                    <label class="font-weight-bold text-secondary small" for="slc_services">Services</label>
                                    <select class="selectpicker w-100" data-live-search="true" id="slc_services" name="slc_services[]" multiple data-style="btn-outline-secondary" title="Select Services" data-actions-box="true">
                                        <option @if (in_array('Restaurant', $stringArray)) selected @endif data-tokens="Restaurant">Restaurant</option>
                                        <option @if (in_array('Internet', $stringArray)) selected @endif data-tokens="Internet">Internet</option>
                                        <option @if (in_array('Laundry Service', $stringArray)) selected @endif data-tokens="Laundry Service">Laundry Service</option>
                                        <option @if (in_array('Room Service', $stringArray)) selected @endif data-tokens="Room Service">Room Service</option>
                                        <option @if (in_array('Bar', $stringArray)) selected @endif data-tokens="Bar">Bar</option>
                                        <option @if (in_array('Spa', $stringArray)) selected @endif data-tokens="Spa">Spa</option>
                                    </select>
{{--                                    @foreach ($services as $user)--}}
{{--                                        {{$user}}--}}
{{--                                    @endforeach--}}
{{--                                    @if (in_array('Laundry Service', $services[1]))--}}
{{--                                        {{'laundry'}}--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label class="font-weight-bold text-secondary small" for="txt_Expedia">Calification Expedia</label>
                                    <input type="text" name="txt_Expedia" class="form-control font-weight-bold" id="txt_Expedia" placeholder="" value="{{$hotels->expedia}}">
                                </div>
                                <div class="col-6">
                                    <label class="font-weight-bold text-secondary small" for="txt_Tripadvisor">Calification Tripadvisor</label>
                                    <input type="text" name="txt_Tripadvisor" class="form-control font-weight-bold" id="txt_Tripadvisor" placeholder="" value="{{$hotels->tripadvisor}}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <h3 class="font-weight-bold text-secondary small">Description</h3>
                                    <div class="form-group">
                                        <textarea class="textarea-package" name="txta_short">{!! $hotels->descripcion !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card-body">
                                <h6><span data-feather="map-pin"></span> Destinations</h6>
                                <hr>
{{--                                <div class="swiper-container swiper-right">--}}
{{--                                    <div class="swiper-wrapper">--}}
{{--                                        <div class="swiper-slide">--}}
                                            @foreach($destinations as $destino)
                                                @forelse  ($hotel_destino->where('iddestinos', $destino->id) as $hotel_destinos)
                                                    <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="destino_{{$destino->id}}" name="destino[]" value="{{$destino->id}}" checked>
                                                <label for="destino_{{$destino->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($destino->nombre))}}">{{ucwords(strtolower($destino->nombre))}}</label>
                                            </span>
                                                @empty
                                                    <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="destino_{{$destino->id}}" name="destino[]" value="{{$destino->id}}" >
                                                <label for="destino_{{$destino->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($destino->nombre))}}">{{ucwords(strtolower($destino->nombre))}}</label>
                                            </span>
                                                @endforelse
                                            @endforeach
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="swiper-scrollbar"></div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row my-5">
                        <div class="col text-center">
                            {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                            <button type="submit" class="btn btn-primary font-weight-bold">Update Hotel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    @endforeach
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.toast').toast('show');
        });


        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {
            $("#dropzone").dropzone({

                maxFilesize: 12,
                maxFiles: 3,
                // renameFile: function(file) {
                //     var dt = new Date();
                //     var time = dt.getTime();
                //     return time+file.name;
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    // alert(response);
                    var name = file.name;
                    // alert(name);
                    var dataString = $('#dropzone').serialize()+'&'+$.param({ 'name_file': name });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_image_slider_delete_path') }}",
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

            $("#dropzone2").dropzone({

                maxFilesize: 12,
                maxFiles: 1,
                // renameFile: function(file) {
                //     var dt = new Date();
                //     var time = dt.getTime();
                //     return time+file.name;
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    var name = file.name;
                    // alert(name);
                    var dataString = $('#dropzone2').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_image_delete_path') }}",
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
    <script>
        $("#dropzone_hotels").dropzone({
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file){
                var dataString = $('#dropzone_hotels').serialize() + '&' + $.param({ 'name_file': file.name });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('admin_hotels_imagen_deleteFile_path') }}",
                    data: dataString,
                    success: function (data) {
                        console.log("File successfully removed.");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            }
        });


        $("#dropzone_gallery").dropzone({
            maxFilesize: 12,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
            addRemoveLinks: true,
            timeout: 50000,
            success: function (file, response) {
                console.log("Imagen subida:", response);
            },
            error: function (file, response) {
                console.error("Error al subir imagen:", response);
            }
        });



        tinymce.init({
            selector: 'textarea.textarea-package',
            height: 250,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });
        // $('.selectpicker').selectpicker();
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        var swiper = new Swiper('.swiper-container', {
            direction: 'vertical',
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            mousewheel: true,
        });


        $("#contenido").load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
        });



    </script>
@endpush
