@extends('layouts.admin')

@section('content')
<h2 class="py-4">{{__('Technologies')}}</h2>
@if (session('message'))
<div class="alert alert-success w-50" role="alert">
    <strong>{{session('message')}}</strong>
</div>
@endif
<div class="container text-white py-5 d-flex justify-content-between">
    <div class="left w-50 pe-5">
        <h4>Add new technology</h4>
        <form action="{{route('admin.technologies.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Technology name</label>
                <input type="text" class="form-control" placeholder="Type the technology name.." aria-label="Username"
                    aria-describedby="basic-addon1" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="name">Technology image url</label>
                <input type="text" class="form-control" placeholder="Type the technology image url.." aria-label="Username"
                    aria-describedby="basic-addon1" name="tech_img_url" id="tech_img_url">
            </div>
            <button type="submit" class="btn btn-light">Store</button>
        </form>

    </div>
    <div class="right w-50">
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($technologies as $technology)
                    <tr>
                        <td scope="row">{{$technology->id}}</td>
                        <td scope="row">
                            <img height="100px" src="{{$technology->tech_img_url}}" alt="{{$technology->name}}">
                        </td>
                        <td>{{$technology->name}}</td>
                        <td>
                            <a href="{{route('admin.technologies.show', $technology)}}"
                                class="btn btn-primary text-decoration-none actions">
                                <span>View</span>
                            </a>
                            <a href="{{route('admin.technologies.edit', $technology)}}"
                                class="btn btn-warning text-decoration-none actions">
                                <span>Edit</span>
                            </a>
                            <button type="button" class="btn btn-danger actions" data-bs-toggle="modal"
                                data-bs-target="#modal{{$technology->slug}}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{$technology->slug}}" tabindex="-1"
                                aria-labelledby="modalTitle-{{$technology->slug}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header border-0">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hey bro!</h1>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are u sure u want to delete
                                            <strong>{{$technology->name}}</strong> technology?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="post"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Modal -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection