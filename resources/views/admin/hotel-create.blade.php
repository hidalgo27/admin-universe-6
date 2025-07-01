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
                                <li class="breadcrumb-item"><a href="{{route('admin_hotel_index_path')}}">All Hotel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create New Hotel</li>
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
                <p class="font-weight-bold text-secondary small pb-1 mb-2">Package Thumbnail Image<span class="badge badge-warning">420x280 PX</span></p>
                <form method="post" action="{{route('admin_hotel_imagen_getFile_path')}}" enctype="multipart/form-data"
                        class="dropzone" id="dropzone_hotel">
                    <input type="hidden" value="" name="id_blog_file">
                    @csrf
                </form>
            </div>
            <div class="col pt-4">

                <p class="font-weight-bold text-secondary small pb-1 mb-2 mt-4">Hotel Gallery Images <span class="badge badge-warning">1900x1080 PX</span></p>
                <form method="post" action="{{ route('admin_hotel_slider_getFile_path') }}" enctype="multipart/form-data"
                      class="dropzone" id="dropzone_hotel_gallery">
                    <input type="hidden" name="aux" id="imagenes_aux">
                    @csrf
                </form>

            </div>


        </div>
        <div class="col-9">
            <form action="{{route('admin_hotel_store_path')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-bold text-secondary small" for="txt_destination">Name Hotel</label>
                                    <input type="text" name="txt_hotel" class="form-control font-weight-bold" id="txt_destination" placeholder="" value="{{old('txt_destination')}}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="font-weight-bold text-secondary small" for="txt_country">Address</label>
                                    <input type="text" name="txt_address" class="form-control font-weight-bold" id="txt_country" alue="{{old('txt_country')}}">
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-group">
                                    <label class="font-weight-bold text-secondary small" for="slc_category">Category</label>
                                    <select class="form-control font-weight-bold text-muted" name="slc_category" id="slc_category">
                                        <option value="0">Select Category</option>
                                        <option value="2">2 stars</option>
                                        <option value="3">3 stars</option>
                                        <option value="4">4 stars</option>
                                        <option value="5">5 stars</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="basic-url" class="font-weight-bold text-secondary small">Your vanity URL</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3" placeholder="https://">
                                </div>
                            </div>
                            <div class="col">
                                <label class="font-weight-bold text-secondary small" for="slc_services">Services</label>
                                <select class="selectpicker w-100" data-live-search="true" id="slc_services" name="slc_services[]" multiple data-style="btn-outline-secondary" title="Select Services" data-actions-box="true">
                                    <option data-tokens="Restaurant">Restaurant</option>
                                    <option data-tokens="Internet">Internet</option>
                                    <option data-tokens="Laundry Service">Laundry Service</option>
                                    <option data-tokens="Room Service">Room Service</option>
                                    <option data-tokens="Bar">Bar</option>
                                    <option data-tokens="Spa">Spa</option>
                                </select>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-6">
                                <label class="font-weight-bold text-secondary small" for="txt_Expedia">Calification Expedia</label>
                                <input type="text" name="txt_Expedia" class="form-control font-weight-bold" id="txt_Expedia" placeholder="" value="{{old('txt_Expedia')}}">
                            </div>
                            <div class="col-6">
                                <label class="font-weight-bold text-secondary small" for="txt_Tripadvisor">Calification Tripadvisor</label>
                                <input type="text" name="txt_Tripadvisor" class="form-control font-weight-bold" id="txt_Tripadvisor" placeholder="" value="{{old('txt_Tripadvisor')}}">
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
                    <div class="col-4">
                        <div class="card bg-light my-3">
                            <div class="card-body">
                                <h6><span data-feather="map-pin"></span> Destinations</h6>
                                <hr>
                                <div class="swiper-container swiper-right">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            @foreach($destinations as $destino)
                                                <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                                <input type="checkbox" id="destino_{{$destino->id}}" name="destino[]" value="{{$destino->id}}" >
                                                <label for="destino_{{$destino->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($destino->nombre))}}">{{ucwords(strtolower($destino->nombre))}}</label>
                                            </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="swiper-scrollbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row mb-3">
                    <div class="col text-center">
                        {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
                        <input type="hidden" name="id_blog_file" id="imagen">
                        <input type="hidden" name="hotel_slider_images" id="imagenes">
                        <input type="hidden" name="hotel_slider_aux" id="imagenes_aux">
                        <button type="submit" class="btn btn-primary font-weight-bold">Create Hotel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=4im5y0hsu2i10v7je2aecag5d41lh7hc0oh1mpj0lgv8pmgj "></script>
    <script>
        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {
            $("#dropzone_hotel").dropzone({

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
                    alert(name);
                    var dataString = $('#imagen').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_hotel_imagen_deleteFile_path') }}",
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
        });

        Dropzone.autoDiscover = false;
        jQuery(document).ready(function () {
            const images = [];
            const images_aux = [];
            var dataT = "";
            var aux2 = "";

            $("#dropzone_hotel_gallery").dropzone({
                maxFilesize: 12,
                maxFiles: 10,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    dataT = time;
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.webp,.avif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function (file) {
                    var name = file.name;
                    var dataString = $('#imagenes_aux').serialize() + '&' + $.param({ 'name_file': name });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_hotel_slider_deleteFile_path') }}", // asegúrate de tener esta ruta
                        data: dataString,
                        success: function (data) {
                            aux2 = data;
                            var index_name_aux = images_aux.indexOf(aux2);
                            images_aux.splice(index_name_aux, 1);
                            images.splice(index_name_aux, 1);
                            document.getElementById("imagenes").value = images;
                            document.getElementById("imagenes_aux").value = images_aux;
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null
                        ? fileRef.parentNode.removeChild(file.previewElement)
                        : void 0;
                },
                success: function (file, response) {
                    images_aux.push(response + " " + dataT);
                    var img = response.split(" ");
                    images.push(img[0]);
                    document.getElementById("imagenes").value = images;
                    document.getElementById("imagenes_aux").value = images_aux;
                }
            });
        });



    </script>
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
        var swiper = new Swiper('.swiper-container', {
            direction: 'vertical',
            slidesPerView: 'auto',
            freeMode: true,
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            mousewheel: true,
        });
        $('.selectpicker').selectpicker();
    </script>
@endpush
