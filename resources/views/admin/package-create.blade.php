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
                <p class="font-weight-bold text-secondary small pb-1 mb-2">Package Thumbnail Image<span class="badge badge-warning">420x280 PX</span></p>
                <form method="post" action="{{route('admin_package_imagen_getFile_path')}}" enctype="multipart/form-data"
                        class="dropzone" id="dropzone2">
                    <input type="hidden" value="" name="id_blog_file">
                    @csrf
                </form>
            </div>
            <div class="col">
                <p class="font-weight-bold text-secondary small pb-1 mb-2 mt-4">Image Slider <span class="badge badge-warning">1900x1080 PX</span></p>
                <form method="post" action="{{route('admin_package_slider_getFile_path')}}" enctype="multipart/form-data"
                        class="dropzone" id="dropzone">
                    <input type="hidden" name="aux" id="imagenes_aux">
                    @csrf
                </form>
            </div>
            <div class="col">
                <p class="font-weight-bold text-secondary small pb-1 mb-2 mt-4">Package Map <span class="badge badge-warning">420x420 PX</span></p>
                <form method="post" action="{{route('admin_package_map_getFile_path')}}" enctype="multipart/form-data"
                        class="dropzone" id="dropzone3">
                        <input type="hidden" value="" name="id_file_map">
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-9">


    <form action="{{route('admin_package_store_path')}}" method="post">
        @csrf
    <div class="row">
        <div class="col-9">
            <div class="">
                <div class="">
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
                                <input type="text" name="codigo" class="form-control font-weight-bold {{ $errors->has('codigo') ? 'is-invalid' : '' }}" id="codigo" placeholder="" value="{{old('codigo')}}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('codigo') }}
                                </div>
                            </div>
                        </div>
{{--                        <div class="col-2">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="font-weight-bold text-secondary small" for="codigo_f">Code Fare</label>--}}
{{--                                <input type="text" name="codigo_f" class="form-control font-weight-bold {{ $errors->has('codigo_f') ? 'is-invalid' : '' }}" id="codigo_f" value="{{old('codigo_f')}}">--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $errors->first('codigo_f') }}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="titulo">Title Package</label>
                                <input type="text" name="titulo" class="form-control font-weight-bold {{ $errors->has('titulo') ? 'is-invalid' : '' }}" id="titulo" value="{{old('titulo')}}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('titulo') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="duracion">Duration</label>
                                <input type="number" name="duracion" class="form-control font-weight-bold {{ $errors->has('duracion') ? 'is-invalid' : '' }}" id="duracion" onkeyup="duration(this.value)">
                                <div class="invalid-feedback">
                                    {{ $errors->first('duracion') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="codigo_f">Code Travel</label>
                                <input type="text" name="codigo_f" class="form-control font-weight-bold {{ $errors->has('codigo_f') ? 'is-invalid' : '' }}" id="codigo_f" value="{{old('codigo_f')}}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('codigo_f') }}
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="highest">Highest Altitude</label>
                                <input type="text" name="highest" class="form-control font-weight-bold {{ $errors->has('highest') ? 'is-invalid' : '' }}" id="highest" value="{{old('highest')}}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('highest') }}
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="font-weight-bold text-secondary small" for="group_size">Group Size</label>
                                <input type="text" name="group_size" class="form-control font-weight-bold {{ $errors->has('group_size') ? 'is-invalid' : '' }}" id="group_size" value="{{old('group_size')}}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('group_size') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label for="basic-url" class="font-weight-bold text-secondary small">Your vanity URL</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://{{$host}}/paquetes/</span>
                                </div>
                                <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <textarea id="textarea-package" class="textarea-package" name="descripcion"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3" id="contenido">

                    </div>

                    <div class="row">
                        <div class="col-12 my-3">
                            <h4>Included</h4>
                            <hr>
                            <div class="form-group">
                                <textarea id="textarea-package" class="textarea-package" name="txta_included"></textarea>
                            </div>
                        </div>
                        <div class="col-12 my-3">
                            <h4>Not Included</h4>
                            <hr>
                            <div class="form-group">
                                <textarea id="textarea-package" class="textarea-package" name="txta_not_included"></textarea>
                            </div>
                        </div>
                        <div class="col-12" my-3>
                            <h4>Optionals</h4>
                            <hr>
                            <div class="form-group">
                                <textarea id="textarea-package" class="textarea-package" name="txta_optional"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col">
                            <h4>Price</h4>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="font-weight-bold text-danger small">Tours</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        {{--                                                        <label class="font-weight-bold text-success small" for="precio_tours">Price Tours</label>--}}
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" name="precio_tours" class="form-control font-weight-bold {{ $errors->has('precio_tours') ? 'is-invalid' : '' }}" id="precio_tours" placeholder="" value="0">
{{--                                        <input type="text" name="precio_tours" class="form-control font-weight-bold {{ $errors->has('precio_tours') ? 'is-invalid' : '' }}" id="precio_tours" placeholder="" value="{{old('precio_tours')}}">--}}
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            {{ $errors->first('precio_tours') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center font-weight-bold text-g-dark mb-2">
                                <div class="col">

                                </div>
                                <div class="col">
                                    Single
                                </div>
                                <div class="col">
                                    Double
                                </div>
                                {{--<div class="col">--}}
                                    {{--Matrimonial--}}
                                {{--</div>--}}
                                <div class="col">
                                    Triple
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_2_s" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_2_d" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="col">--}}
                                    {{--<div class="input-group input-group-sm">--}}
                                        {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text"><small>$</small></span>--}}
                                        {{--</div>--}}
                                        {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_2_m">--}}
                                        {{--<div class="input-group-append">--}}
                                            {{--<span class="input-group-text"><small>USD</small></span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_2_t" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_3_s" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_3_d" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="col">--}}
                                    {{--<div class="input-group input-group-sm">--}}
                                        {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text"><small>$</small></span>--}}
                                        {{--</div>--}}
                                        {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_3_m">--}}
                                        {{--<div class="input-group-append">--}}
                                            {{--<span class="input-group-text"><small>USD</small></span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_3_t" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_4_s" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_4_d" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="col">--}}
                                    {{--<div class="input-group input-group-sm">--}}
                                        {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text"><small>$</small></span>--}}
                                        {{--</div>--}}
                                        {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_4_m">--}}
                                        {{--<div class="input-group-append">--}}
                                            {{--<span class="input-group-text"><small>USD</small></span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_4_t" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                    <span data-feather="star"></span>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_5_s" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_5_d" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="col">--}}
                                    {{--<div class="input-group input-group-sm">--}}
                                        {{--<div class="input-group-prepend">--}}
                                            {{--<span class="input-group-text"><small>$</small></span>--}}
                                        {{--</div>--}}
                                        {{--<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="txt_5_m">--}}
                                        {{--<div class="input-group-append">--}}
                                            {{--<span class="input-group-text"><small>USD</small></span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>$</small></span>
                                        </div>
                                        <input type="text" class="form-control text-right" aria-label="Amount (to the nearest dollar)" name="txt_5_t" value="0">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><small>USD</small></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="col-auto my-4 py-1 text-center">
                <a href="#addSeo" class="btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Add SEO</a>
            </div>
            <div class="card bg-light">
                <div class="card-body">
                    <h6><span data-feather="activity"></span> Difficulty</h6>
                    <hr>
                    <div class="swiper-container swiper-right">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                @foreach($level as $levels)
                                    <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                        <input type="checkbox" id="level_{{$levels->id}}" name="level[]" value="{{$levels->id}}">
                                        <label for="level_{{$levels->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($levels->nombre))}}">{{ucwords(strtolower($levels->nombre))}}</label>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>


            <div class="card bg-light my-3">
                <div class="card-body">
                    <h6><span data-feather="folder"></span> Category</h6>
                    <hr>
                    <div class="swiper-container swiper-right">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                @foreach($category as $categoria)
                                    <span class="custom-checkbox d-block pr-3 text-ellipsis">
                                    <input type="checkbox" id="category_{{$categoria->id}}" name="category[]" value="{{$categoria->id}}" >
                                    <label for="category_{{$categoria->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($categoria->nombre))}}">{{ucwords(strtolower($categoria->nombre))}}</label>
                                </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-scrollbar"></div>
                    </div>
                </div>
            </div>

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

{{--            <div class="card bg-light my-3 w-100">--}}
{{--                <div class="card-body">--}}
{{--                    <h6><span data-feather="plus"></span> Included</h6>--}}
{{--                    <hr>--}}
{{--                    <div class="swiper-container swiper-right">--}}
{{--                        <div class="swiper-wrapper">--}}
{{--                            <div class="swiper-slide">--}}
{{--                                @foreach($incluye as $include)--}}
{{--                                    <span class="custom-checkbox d-block pr-3 text-ellipsis">--}}
{{--                                        <input type="checkbox" id="include_{{$include->id}}" name="include[]" value="{{$include->id}}" >--}}
{{--                                        <label for="include_{{$include->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($include->incluye))}}">{{ucwords(strtolower($include->incluye))}}</label>--}}
{{--                                    </span>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="swiper-scrollbar"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card bg-light my-3">--}}
{{--                <div class="card-body">--}}
{{--                    <h6><span data-feather="minus"></span> Not Included</h6>--}}
{{--                    <hr>--}}
{{--                    <div class="swiper-container swiper-right">--}}
{{--                        <div class="swiper-wrapper">--}}
{{--                            <div class="swiper-slide">--}}
{{--                                @foreach($noincluye as $noinclude)--}}
{{--                                    <span class="custom-checkbox d-block pr-3 text-ellipsis">--}}
{{--                                        <input type="checkbox" id="noinclude_{{$noinclude->id}}" name="noinclude[]" value="{{$noinclude->id}}" >--}}
{{--                                        <label for="noinclude_{{$noinclude->id}}" data-toggle="tooltip" data-placement="left" title="{{ucwords(strtolower($noinclude->noincluye))}}">{{ucwords(strtolower($noinclude->noincluye))}}</label>--}}
{{--                                    </span>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="swiper-scrollbar"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col text-center">
            {{--<a href="" class="btn btn-primary font-weight-bold">Update Package</a>--}}
            <input type="hidden" name="id_blog_file" id="imagen">
            <input type="hidden" name="id_blog_file2" id="imagenes">
            <input type="hidden" name="id_file_map" id="map">
            <input type="hidden" name="imagen_seo2" id="imagen_seo2">
            <input type="hidden" name="seo_atributos" id="seo_atributos">
            <button type="submit" class="btn btn-primary font-weight-bold">Create Package</button>
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
                                <form method="post" action="{{route('admin_seo_package_imagen_getFile_path')}}" enctype="multipart/form-data"
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
                    var dataString = $('#imagenes_aux').serialize()+'&'+$.param({ 'name_file': name });
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_package_slider_deleteFile_path') }}",
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
                    images_aux.push(response);
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
                    var dataString = $('#imagen').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_package_imagen_deleteFile_path') }}",
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
                    document.getElementById("imagen").value = response;
                }
                // success: function (file, response) {
                //     console.log(response);
                // },
                // error: function (file, response) {
                //     return false;
                // },

            });
            $("#dropzone3").dropzone({

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
                    var dataString = $('#map').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_package_map_deleteFile_path') }}",
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
                    document.getElementById("map").value = response;
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
                        url: "{{ route('admin_seo_package_imagen_deleteFile_path') }}",
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
    <script>
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


        $('select').on('change', function () {
            // var duration = $('#duration_slc').val();
            var $id_itinerary = this.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax( {
                type: "POST",
                url: "{{route('admin_package_duration_path')}}",
                data: {id_itinerary: $id_itinerary},
                success: function( response ) {
                    // console.log( $id );
                    $("#resumen_"+response.id).html(response.resumen);
                }
            } );
        });

        $("#contenido").load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
        });

        function duration($duration){
            if ($duration){
                var $duration1 = $duration;
                $("#contenido").load("/admin/package/load/"+49+"/"+$duration1+"");
            }
        }

        {{--$(document).ready(function() {--}}
        {{--$("#refrescar").bind("click", function() {--}}
        {{--$("#contenido").load("{{route('load_path', [49, 5])}}");--}}
        {{--});--}}
        {{--});--}}

    </script>
@endpush
