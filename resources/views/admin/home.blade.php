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
    @if (session('status'))
        <div class="toast bg-primary fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Package</strong>
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

    @if (session('delete'))
        <div class="toast bg-danger fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Package</strong>
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
    @if (session('delete2'))
        <div class="alert alert-success m-2" role="alert">
            {{session('delete2')}}
        </div>
    @endif
    <div class="">
        <div class="table-wrapper m-0 p-0">
            <div class="table-title m-0">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Packages</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('admin_package_create_path')}}" class="btn btn-success"><span data-feather="plus-circle"></span> Add New Package</a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><span data-feather="trash"></span> Delete</a>
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
                    <th class="text-center"></th>
                    <th class="text-center">Discount</th>
                    <th>Duration</th>
                    <th>Name</th>
                    {{--<th>Address</th>--}}
                    <th class="text-center">Packages on homepage?</th>
                    <th class="text-center">Offers on homepage?</th>
                    <th class="text-center">SEO</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paquete->sortBy('duracion') as $paquetes)
                    @if ($paquetes->estado == 0)
                        @php $estado_paquete = ""; @endphp
                    @else
                        @php $estado_paquete = "checked"; @endphp
                    @endif

                    @if ($paquetes->offers_home == 0)
                        @php $offers_home_ckeck = ""; @endphp
                    @else
                        @php $offers_home_ckeck = "checked"; @endphp
                    @endif

                    @if ($paquetes->is_p_t == 0)
                        @php $is_p_t = ""; @endphp
                    @else
                        @php $is_p_t = "checked"; @endphp
                    @endif

                    @if ($paquetes->is_tours == 0)
                        @php $is_tours = ""; @endphp
                    @else
                        @php $is_tours = "checked"; @endphp
                    @endif
                    <tr>
{{--                        <td>--}}
{{--                            <span class="custom-checkbox">--}}
{{--                                <input type="checkbox" id="checkbox1" name="options[]" value="1" >--}}
{{--                                <label for="checkbox1"></label>--}}
{{--                            </span>--}}
{{--                        </td>--}}
                        <td class="text-center">
                            <form id="form_is_package_{{$paquetes->id}}">
                                <input type="checkbox" {{$is_p_t}} value="{{$paquetes->id}}" name="txt_is_package" data-toggle="toggle" data-size="xs" onchange="is_package({{$paquetes->id}})" data-on="Package" data-off="Tours" data-onstyle="success" data-offstyle="g-yellow">
                            </form>
                        </td>
                        <td class="text-center">
                            @if($paquetes->descuento)
                                @switch($paquetes->descuento)
                                    @case(10)
                                    @php $color_d = 'btn-info' @endphp
                                    @break

                                    @case(15)
                                    @php $color_d = 'btn-g-yellow' @endphp
                                    @break

                                    @case(20)
                                    @php $color_d = 'btn-success' @endphp
                                    @break

                                    @case(25)
                                    @php $color_d = 'btn-danger' @endphp
                                    @break

                                    @default
                                    @php $color_d = 'btn-text' @endphp
                                @endswitch
                                <button type="button" class="btn font-weight-bold btn-xs {{$color_d}}" data-toggle="modal" data-target="#desc_{{$paquetes->id}}">
                                    {{$paquetes->descuento}}%
                                </button>
                            @else
                                <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#desc_{{$paquetes->id}}">
                                    0%
                                </button>
                            @endif
                            {{--                            <form id="form_is_tours_{{$paquetes->id}}">--}}
                            {{--                                <input type="checkbox" {{$is_tours}} value="{{$paquetes->id}}" name="txt_is_tour" data-toggle="toggle" data-size="xs" onchange="is_tours({{$paquetes->id}})">--}}
                            {{--                            </form>--}}
                        </td>
                        <td><span class="font-weight-bold">{{$paquetes->duracion}} day</span></td>
                        <td><a href="{{route('admin_package_edit_path', $paquetes->id)}}">{{$paquetes->titulo}}</a></td>
                        <td class="text-center">
                            <form id="form_estado_{{$paquetes->id}}">
                                <input type="checkbox" {{$estado_paquete}} value="{{$paquetes->id}}" name="txt_estado" data-toggle="toggle" data-size="xs" onchange="estado_home({{$paquetes->id}})" data-on="yes" data-off="no" data-onstyle="success" data-offstyle="danger">
                            </form>
                        </td>
                        <td class="text-center">
                            <form id="form_offer_{{$paquetes->id}}">
                                <input type="checkbox" {{$offers_home_ckeck}} value="{{$paquetes->id}}" name="txt_offer" data-toggle="toggle" data-size="xs" onchange="offer_home({{$paquetes->id}})" data-on="yes" data-off="no" data-onstyle="success" data-offstyle="danger">
                            </form>
                        </td>

                        <td class="text-center">
                            @foreach($seo->where('id_t', $paquetes->id) as $id_t)
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
                        {{--<td>(171) 555-2222</td>--}}
                        <td class="text-center">
                            <a href="{{route('admin_package_edit_path', $paquetes->id)}}" class="edit"><span data-feather="edit-3"></span></a>
                            <a href="#delete_package_{{$paquetes->id}}" class="delete" data-toggle="modal"><span data-feather="trash"></span></a>
                            <a href="{{route('admin_inquire_index_path', $paquetes->id)}}"><span data-feather="code"></span></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="desc_{{$paquetes->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$paquetes->titulo}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('descuento_path', [$paquetes->id])}}" method="post">
                                <div class="modal-body">

                                    @switch($paquetes->descuento)
                                        @case(10)
                                        @php $d_check = 'checked' @endphp
                                        @break

                                        @case(15)
                                        @php $d_check = 'checked' @endphp
                                        @break

                                        @case(20)
                                        @php $d_check = 'checked' @endphp
                                        @break

                                        @case(25)
                                        @php $d_check = 'checked' @endphp
                                        @break

                                        @default
                                        @php $d_check = '' @endphp
                                    @endswitch

                                        @csrf
                                        <div class="form-check">
                                            <input class="form-check-input" type="hidden" name="id_paquete" value="{{$paquetes->id}}">
                                            <input class="form-check-input" type="radio" name="descuento_rdo" id="de_10_{{$paquetes->id}}" value="10" @if ($paquetes->descuento == 10 )checked @endif>
                                            <label class="form-check-label text-info font-weight-bold" for="de_10_{{$paquetes->id}}">
                                                10%
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="descuento_rdo" id="de_15_{{$paquetes->id}}" value="15" @if ($paquetes->descuento == 15) checked @endif>
                                            <label class="form-check-label text-g-yellow font-weight-bold" for="de_15_{{$paquetes->id}}">
                                                15%
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="descuento_rdo" id="de_20_{{$paquetes->id}}" value="20" @if ($paquetes->descuento == 20) checked @endif>
                                            <label class="form-check-label text-success font-weight-bold" for="de_20_{{$paquetes->id}}">
                                                20%
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="descuento_rdo" id="de_25_{{$paquetes->id}}" value="25" @if ($paquetes->descuento == 25) checked @endif>
                                            <label class="form-check-label text-danger font-weight-bold" for="de_25_{{$paquetes->id}}">
                                                25%
                                            </label>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="delete_package_{{$paquetes->id}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('admin_package_delete_path', $paquetes->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete Hotel</h4>
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
                @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                <div class="col-auto">
                    {{ $paquete->links() }}
                </div>

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
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" required>
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
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Employee</h4>
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
@endsection
@push('scripts')
    <script type="text/javascript">

        function estado_home($id_estado) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var dataString = $('#form_estado_'+$id_estado).serialize()+'&'+$.param({ 'id_estado': $id_estado });
            // alert('Datos serializados: '+dataString);
            $.ajax({
                type: "POST",
                url: '{{route('estado_home_path')}}',
                data: dataString,
                success: function(data) {
                    // document.getElementById('precio_persona').innerHTML = data;
                }
            });
        }

        function offer_home($id_paquete) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var dataString = $('#form_offer_'+$id_paquete).serialize()+'&'+$.param({ 'id_paquete': $id_paquete });
            // alert('Datos serializados: '+dataString);
            $.ajax({
                type: "POST",
                url: '{{route('offer_home_path')}}',
                data: dataString,
                success: function(data) {
                    // document.getElementById('precio_persona').innerHTML = data;
                }
            });
        }

        function is_package($id_is_package) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var dataString = $('#form_is_package_'+$id_is_package).serialize()+'&'+$.param({ 'id_is_package': $id_is_package });
            // alert('Datos serializados: '+dataString);
            $.ajax({
                type: "POST",
                url: '{{route('is_package_path')}}',
                data: dataString,
                success: function(data) {
                    // document.getElementById('precio_persona').innerHTML = data;
                }
            });
        }

        function is_tours($id_is_tours) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var dataString = $('#form_is_tours_'+$id_is_tours).serialize()+'&'+$.param({ 'id_is_tours': $id_is_tours });
            // alert('Datos serializados: '+dataString);
            $.ajax({
                type: "POST",
                url: '{{route('is_tours_path')}}',
                data: dataString,
                success: function(data) {
                    // document.getElementById('precio_persona').innerHTML = data;
                }
            });
        }

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
        });
        $(document).ready(function(){
            $('.toast').toast('show');
        });
    </script>
@endpush
