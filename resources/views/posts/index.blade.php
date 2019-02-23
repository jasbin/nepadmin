@extends('layouts.master')
@section('content')
    <h3>All Posts</h3>
    <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#create">
            Add New Post
    </button>
    <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Modify</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->body}}</td>
                            <td>
                            <button type="button" class="btn btn-primary mb-2 mt-2" data-myid={{$post->id}} data-mytitle='{{$post->title}}' data-mybody='{{$post->body}}' data-toggle="modal" data-target="#edit">
                                            Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-myid={{$post->id}} data-target="#delete">Delete</button>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <!-- Button trigger modal -->


     <!-- Create Modal -->
     <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create new post" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create">Add Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('posts.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            @include('posts.form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
            </div>
            </div>
        </div>
        <!-- Edit Modal -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="create new post" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{route('posts.update')}}" method="POST">
                            {{ csrf_field() }}

                            <div class="modal-body">
                            <input type="hidden" name='post_id' id='post_id' value="">
                                @include('posts.form')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>

                    </form>
                </div>
                </div>
                </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete post" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{route('posts.delete')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                            <input type="hidden" name='id' id='post_id' value="">
                            <p>Are you sure you want to delete this post?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>

                    </form>
                </div>
                </div>
                </div>
        </div>

@endsection
