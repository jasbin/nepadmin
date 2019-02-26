@extends('layouts.master')
@section('content')
    <h3>All Category</h3>
    <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#create">
            Add New Category
    </button>
    <table id="myTable" class="table table-bordered table-striped" >
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Modify</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                            <td>{{$category->title}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                            <button type="button" class="btn btn-primary mb-2 mt-2" data-myid='{{$category->id}}' data-route='{{ URL::to('admin/gallery/getByID') }}' data-toggle="modal" data-target="#edit">
                                            Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-myid='{{$category->id}}' data-target="#delete">Delete</button>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



    <!-- Button trigger modal -->


     <!-- Create Modal -->
     <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create new category" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            @include('gallery.form')
                            <div class="form-group">
                                Select images: <input type="file" name="cover_image[]" multiple>
                            </div>
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
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit new category" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Edit Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{route('gallery.update')}}" method="POST">
                            {{ csrf_field() }}

                            <div class="modal-body">
                            <input type="hidden" name='id' id='category_id' value="">
                                @include('gallery.form')
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
        <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete category" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{route('gallery.delete')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                            <input type="hidden" name='id' id='category_id' value="">
                            <p>Are you sure you want to delete this category?</p>
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

@section('script')
    <script src="{{asset('js/gallery/scripts.js')}}"></script>
@endsection