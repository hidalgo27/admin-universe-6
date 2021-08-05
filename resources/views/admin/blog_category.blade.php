@extends('layouts.admin.app')
@section('sidebar')
    @parent
    @include('layouts.admin.sidebar')
@endsection
@section('content')
<div class="">
    <div class="table-wrapper m-0 p-0">
        <div class="table-title m-0">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>Blog categories</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="#addCategoryBlog" class="btn btn-success" data-toggle="modal"><span data-feather="plus-circle"></span> Add New Category</a>
                </div>
            </div>
        </div>
        <div id="addCategoryBlog" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{route('admin_blog_category_store_path')}}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="txt_category" required>
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
        @if (session('status'))
            <div class="alert alert-success m-2" role="alert">
                Category created successfully
            </div>
        @endif
        @if (session('status2'))
            <div class="alert alert-success m-2" role="alert">
                Category updated successfully
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-success m-2" role="alert">
                Category successfully removed
            </div>
        @endif
        <table class="table table-striped table-hover small table-sm font-weight-bold text-secondary">
            <thead>
                <tr>
                    <th>Title</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td><a href="#editCategoryBlog_{{$category->id}}" data-toggle="modal">{{$category->nombre}}</a></td>
                        <td class="text-right">
                            <a href="#editCategoryBlog_{{$category->id}}" class="edit" data-toggle="modal"><span data-feather="edit"></span></a>
                            <a href="#delete_blog_{{$category->id}}" class="delete" data-toggle="modal"><span data-feather="trash"></span></a>
                        </td>
                    </tr>
                    <div id="editCategoryBlog_{{$category->id}}" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{route('admin_blog_category_update_path',$category->id)}}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                        <input type="text" class="form-control" name="txt_category" value="{{$category->nombre}}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                        <input type="submit" class="btn btn-success" value="Update">
                                    </div>
            
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal HTML -->
                    <div id="delete_blog_{{$category->id}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('admin_blog_category_delete_path', $category->id)}}" method="post">
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

                @endforeach
            </tbody>
        </table>
        <div class="row justify-content-center">
            <div class="col-auto">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
