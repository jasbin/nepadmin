@extends('layouts.master')
@section('content')
    <h3>All Category Items</h3>

    <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#create">
            Add New Image
    </button>



    <table id="myTable" class="table table-bordered table-striped text-center" >
            <thead>
                <tr>
                    <th>Category Item</th>
                    <th>Preview</th>
                    <th style="width: 20%;">Modify</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoryitems as $item)
                    <tr>
                            <td>{{$item->cover_image}}</td>
                            <td><img style="width:20%;" src="{{asset('storage/cover_image/original/'.$item->cover_image)}}" alt="image"></td>
                            <td>
                            <button class="btn btn-primary mb-2 mt-2" data-myid='{{$item->id}}' data-toggle="modal" data-target="#edit">
                                            Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-myid='{{$item->id}}' data-target="#delete">Delete</button>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$categoryitems->links()}}



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
                <form action="{{route('gallery.image.store')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <input type="hidden" name='id' value="{{$id}}">
                            @include('gallery.view.form')
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
                    <h5 class="modal-title" id="edititem">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{--updates image --}}
                <form action="{{route('gallery.image.update')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <input type="hidden" name='id' id='categoryitem_id' value="">
                        @include('gallery.view.form')
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

                    <form action="{{route('gallery.image.delete')}}" method="GET">
                            <div class="modal-body">
                            <input type="hidden" name='id' id='categoryitem_id' value="">
                            <p>Are you sure you want to delete this image?</p>
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
    <script src="{{asset('js/gallery/images/scripts.js')}}"></script>
@endsection