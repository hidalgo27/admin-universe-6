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
                    <h2>Manage <b>Blog</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="{{route('admin_blog_create_path')}}" class="btn btn-success"><span data-feather="plus-circle"></span> Add New post</a>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success m-2" role="alert">
                {{session('status')}}
            </div>
        @endif
        @if (session('delete'))
            <div class="alert alert-success m-2" role="alert">
                {{session('delete')}}
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
                @foreach($posts as $post)
                    <tr>
                        <td><a href="{{route('admin_blog_edit_path', $post->id)}}">{{$post->titulo}}</a></td>
                        <td class="text-right">
                            <a href="{{route('admin_blog_edit_path', $post->id)}}" class="edit"><span data-feather="edit"></span></a>
                            <a href="#delete_blog_{{$post->id}}" class="delete" data-toggle="modal"><span data-feather="trash"></span></a>
                        </td>
                    </tr>
                    <!-- Delete Modal HTML -->
                    <div id="delete_blog_{{$post->id}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('admin_blog_delete_path', $post->id)}}" method="post">
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
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
