@extends('layouts.master')
@section('content')
    <h3>All Services</h3>
    <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#create">
            Add New Service
    </button>
    <form action="{{route('services.index')}}" method="GET">
        @include('inc.search')
    </form>

    @include('inc.checkbox_services')

    <table id="myTable" class="table table-bordered table-striped text-center" >
            <thead>
                <tr>
                    <th style="width: 20%;">Title</th>
                    <th style="width: 60%;">Body</th>
                    <th style="width: 20%;">Modify</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                            <td class="title">{{$service->title}}</td>
                            <td class="body">{{str_limit($service->body,50,"...")}}</td>
                            <td class="modify">
                            <button type="button" class="btn btn-primary mb-2 mt-2" data-myid='{{$service->id}}' data-mytitle='{{$service->title}}' data-route='{{ URL::to('admin/services/getByID') }}' data-toggle="modal" data-target="#edit">
                                            Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-myid='{{$service->id}}' data-target="#delete">Delete</button>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$services->links()}}

    <!-- Button trigger modal -->


     <!-- Create Modal -->
     <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create new post" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('services.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            @include('services.form')
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
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit new service" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit">Edit Service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{route('services.update')}}" method="POST">
                            {{ csrf_field() }}

                            <div class="modal-body">
                            <input type="hidden" name='id' id='service_id' value="">
                                @include('services.form')
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

                    <form action="{{route('services.delete')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">
                            <input type="hidden" name='id' id='service_id' value="">
                            <p>Are you sure you want to delete this service?</p>
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
    <script src="{{asset('js/service/scripts.js')}}"></script>
@endsection