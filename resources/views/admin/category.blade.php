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
                                <li class="breadcrumb-item active" aria-current="page">All Category</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        {{--<div class="btn-toolbar mb-2 mb-md-0">--}}
        {{--<div class="btn-group mr-2">--}}
        {{--<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
        {{--<button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
        {{--</div>--}}
        {{--<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">--}}
        {{--<span data-feather="calendar"></span>--}}
        {{--This week--}}
        {{--</button>--}}
        {{--</div>--}}
    </div>

    {{--<h2>Section title</h2>--}}
    {{--@if(Auth::user()->hasRole('admin'))--}}
    {{--<div>Acceso como administrador</div>--}}
    {{--@else--}}
    {{--<div>Acceso usuario</div>--}}
    {{--@endif--}}
    {{--You are logged in!--}}
    {{--<div class="row">--}}
    {{--<div class="col">--}}
    {{--sd--}}
    {{--</div>--}}
    {{--</div>--}}
    @if (session('status'))
        <div class="toast bg-primary fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Category</strong>
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
    @if (session('delete2'))
        <div class="alert alert-success m-2" role="alert">
            {{session('delete2')}}
        </div>
    @endif
    @if (session('delete'))
        <div class="toast bg-danger fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Category</strong>
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


    <div class="">
        <div class="table-wrapper m-0 p-0">
            <div class="table-title m-0">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Category</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addCategory" class="btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Add New Category</a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><span data-feather="trash"></span> Delete</a>
                    </div>
                </div>
            </div>

            <!-- add Modal HTML -->
            <div id="addCategory" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="row">
                            <div class="col-5 modal-body">
                                <div class="col">
                                    <p class="font-weight-bold text-secondary small pb-1 mb-2">Category Thumbnail Image <span class="badge badge-warning">350x250 PX</span></p>
                                    <form method="post" action="{{route('admin_category_imagen_getFile_path')}}" enctype="multipart/form-data"
                                    class="dropzone" id="dropzone_category_2">
                                        <input type="hidden" value="" name="id_blog_file">
                                        @csrf
                                    </form>
                                </div>
                                <div class="col">
                                    <p class="font-weight-bold text-secondary small pb-1 mb-2 mt-4">Banner Category Image <span class="badge badge-warning">1900x1080 PX</span></p>
                                    <form method="post" action="{{route('admin_category_slider_getFile_path')}}" enctype="multipart/form-data"
                                    class="dropzone" id="dropzone_category">
                                        <input type="hidden" value="" name="id_blog_file2">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <div class="col-7">
                                <form action="{{route('admin_category_store_path')}}" method="post">
                                    @csrf
                                    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <input type="text" class="form-control" name="txt_category" required>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center my-auto">
                                                <a href="#addSeo" class="btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Add SEO</a>
                                            </div>
                                        </div>  
                                        <label for="basic-url" class="font-weight-bold text-secondary small">Your vanity URL</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon3">https://{{$host}}/categoria/</span>
                                            </div>
                                            <input type="text" class="form-control" name="url" id="basic-url" aria-describedby="basic-addon3">
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="txta_descripcion" class="form-control"></textarea>
                                        </div>
                                        <div class="m-5 text-center">
                                            <input type="hidden" name="id_blog_file" id="imagen">
                                            <input type="hidden" name="id_blog_file2" id="imagenes">
                                            <input type="hidden" name="imagen_seo2" id="imagen_seo2">
                                            <input type="hidden" name="seo_atributos" id="seo_atributos">
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                            <input type="submit" class="btn btn-success" value="Add">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover small table-sm font-weight-bold text-secondary">
                <thead>
                <tr>
{{--                    <th>--}}
{{--							<span class="custom-checkbox">--}}
{{--								<input type="checkbox" id="selectAll">--}}
{{--								<label for="selectAll"></label>--}}
{{--							</span>--}}
{{--                    </th>--}}
                    <th>Category</th>
                    {{--<th>Address</th>--}}
                    <th class="text-right">SEO</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($category as $category1)

                        <tr>
{{--                            <td>--}}
{{--                            <span class="custom-checkbox">--}}
{{--                                <input type="checkbox" id="checkbox1" name="options[]" value="1" >--}}
{{--                                <label for="checkbox1"></label>--}}
{{--                            </span>--}}
{{--                            </td>--}}
                            <td><a href="{{route('admin_category_edit_path', $category1->id)}}">{{$category1->nombre}}</a></td>
                            {{--<td>{{$category1->estado}}</td>--}}
                            {{--<td>(171) 555-2222</td>--}}
                            <td class="text-right">
                                @foreach($seo->where('id_t', $category1->id) as $id_t)
                                    @if($id_t!=null)
                                        <a href="#delete_seo_{{$id_t->id}}" class="delete" data-toggle="modal"><span data-feather="trash"></span></a>
                                        <div id="delete_seo_{{$id_t->id}}" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('admin_seo_delete_path', $id_t->id)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete post</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete these Records?</p>
                                                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                            <input type="submit" class="btn btn-danger" value="Delete">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-right">
                                <a href="{{route('admin_category_edit_path', $category1->id)}}" class="edit"><span data-feather="edit"></span></a>
                                <a href="#delete_category_{{$category1->id}}" class="delete" data-toggle="modal"><span data-feather="trash"></span></a>
                            </td>
                        </tr>
                        <!-- Delete Modal HTML -->
                        <div id="delete_category_{{$category1->id}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{route('admin_category_delete_path', $category1->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Included</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete these Records?</p>
                                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal HTML -->
                        <div id="edit_category_{{$category1->id}}" class="modal fade">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{route('admin_category_update_path', $category1->id)}}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Category</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <input type="text" class="form-control" name="txt_category" required value="{{$category1->nombre}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="txta_descripcion" rows="6" class="form-control">{{$category1->descripcion}}</textarea>
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


                @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                <div class="col-auto">
                    {{ $category->links() }}
                </div>
            </div>
{{--            <div class="clearfix">--}}
{{--                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>--}}
{{--                <ul class="pagination">--}}
{{--                    <li class="page-item disabled"><a href="#">Previous</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">1</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">2</a></li>--}}
{{--                    <li class="page-item active"><a href="#" class="page-link">3</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">4</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">5</a></li>--}}
{{--                    <li class="page-item"><a href="#" class="page-link">Next</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
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
                                    <form method="post" action="{{route('admin_seo_category_imagen_getFile_path')}}" enctype="multipart/form-data"
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
    <script type="text/javascript">
        $(document).ready(function(){
            // Activate tooltip
            // $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function(){
                if(this.checked){
                    checkbox.each(function(){
                        this.checked = true;
                    });
                } else{
                    checkbox.each(function(){
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function(){
                if(!this.checked){
                    $("#selectAll").prop("checked", false);
                }
            });
            Dropzone.autoDiscover = false;
        });
        $(document).ready(function(){
            $('.toast').toast('show');
        });
        
    </script>
    <script>
        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {
            $("#dropzone_category").dropzone({

                maxFilesize: 12,
                maxFiles: 1,
                // renameFile: function(file) {
                //     var dt = new Date();
                //     var time = dt.getTime();
                //     return time+file.name;
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    var name = file.upload.filename;
                    var dataString = $('#imagenes').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_category_slider_deleteFile_path') }}",
                        data: dataString,
                        success: function (data) {
                            console.log("File has been successfully removed!!");
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    document.getElementById("imagenes").value = null;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                success: function(file, response){
                    document.getElementById("imagenes").value = response;
                }
                // success: function (file, response) {
                //     console.log(response);
                // },
                // error: function (file, response) {
                //     return false;
                // },

            });
            $("#dropzone_category_2").dropzone({
                maxFilesize: 12,
                maxFiles: 1,
                // renameFile: function(file) {
                //     var dt = new Date();
                //     var time = dt.getTime();
                //     return time+file.name;
                // },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file){
                    var name = file.upload.filename;
                    var dataString = $('#imagen').serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin_category_imagen_deleteFile_path') }}",
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
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
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
                        url: "{{ route('admin_seo_category_imagen_deleteFile_path') }}",
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
@endpush
