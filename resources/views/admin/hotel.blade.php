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
                                <li class="breadcrumb-item active" aria-current="page">All hotels</li>
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
        <div class="toast bg-primary fixed-top" role="alert" aria-live="polite" aria-atomic="true" data-delay="3000" style="left: auto; top: 55px; right: 10px;">
            <div class="toast-header">
                <span data-feather="alert-circle" class="text-success mr-2"></span>
                <strong class="mr-auto">Hotels</strong>
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
                {{ session('delete') }}
            </div>
        </div>
    @endif


    <div class="">
        <div class="table-wrapper m-0 p-0">
            <div class="table-title m-0">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Hotel</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('admin_hotel_create_path')}}" class="btn btn-success"><span data-feather="plus-circle"></span> Add New Hotel</a>
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
                    {{--                    <th>Code</th>--}}
                    <th>Title</th>
                    {{--<th>Address</th>--}}
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hotel as $hotels)

                    <tr>
                        {{--                        <td>--}}
                        {{--                            <span class="custom-checkbox">--}}
                        {{--                                <input type="checkbox" id="checkbox1" name="options[]" value="1" >--}}
                        {{--                                <label for="checkbox1"></label>--}}
                        {{--                            </span>--}}
                        {{--                        </td>--}}
                        {{--                        <td>{{$hotels->codigo}} </td>--}}
                        <td><a href="{{route('admin_hotel_edit_path', $hotels->id)}}">{{$hotels->nombre}}</a></td>
                        {{--<td>(171) 555-2222</td>--}}
                        <td class="text-right">
                            <a href="{{route('admin_hotel_edit_path', $hotels->id)}}" class="edit"><span data-feather="edit"></span></a>
                            <a href="#delete_hotel_{{$hotels->id}}" class="delete" data-toggle="modal"><span data-feather="trash"></span></a>
                        </td>
                    </tr>
                    <!-- Delete Modal HTML -->
                    <div id="delete_hotel_{{$hotels->id}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('admin_hotel_delete_path', $hotels->id)}}" method="post">
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
                    {{ $hotel->links() }}
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
        });
        $(document).ready(function(){
            $('.toast').toast('show');
        });
    </script>
@endpush
