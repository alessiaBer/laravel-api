@extends('layouts.admin')

@section('content')
<h2 class="py-4">{{__('Typologies')}}</h2>
@if (session('message'))
<div class="alert alert-success w-50" role="alert">
    <strong>{{session('message')}}</strong>
</div>
@endif
<form action="{{route('admin.types.store')}}" method="post" class="w-50">
    @csrf
    <label for="name">Add new type</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Type the typology name" aria-label="Username"
            aria-describedby="basic-addon1" name="name" id="name">
        <span class="input-group-text" id="basic-addon1"><button class="border-0 bg-transparent"
                type="submit">+</button></span>
    </div>
</form>
<div class="container text-white py-5 d-flex justify-content-between">
    <div class="left w-50">

        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Projects</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($types as $type)
                    <tr>
                        <td scope="row">{{$type->id}}</td>
                        <td>{{$type->name}}</td>
                        <td>{{$type->projects->count()}}</td>
                        <td>
                            <a href="{{route('admin.types.show', $type)}}"
                                class="btn btn-primary text-decoration-none actions">
                                <span>View</span>
                            </a>
                            <a href="{{route('admin.types.edit', $type)}}"
                                class="btn btn-warning text-decoration-none actions">
                                <span>Edit</span>
                            </a>
                            <button type="button" class="btn btn-danger actions" data-bs-toggle="modal"
                                data-bs-target="#modal{{$type->slug}}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal{{$type->slug}}" tabindex="-1"
                                aria-labelledby="modalTitle-{{$type->slug}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-dark">
                                        <div class="modal-header border-0">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hey bro!</h1>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are u sure u want to delete
                                            <strong>{{$type->name}}</strong> type?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="{{route('admin.types.destroy', $type->slug)}}" method="post"
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
    <div class="right w-50 ps-5">
        @if($single_type)
        <div class="top_related d-flex justify-content-between">
            <h4>{{$single_type->name}}</h4>
            <a href="{{route('admin.types.index')}}" class="btn btn-outline-light rounded-circle">X</a>    
        </div>
        
    
        <span>Related projects:</span> 
        
        <ul class="list-unstyled">
            <li></li>
            @forelse($related_projects as $related_project) 
                <li>
                    <a href="{{route('admin.projects.show', $related_project)}}">{{$related_project->title}}</a>
                </li>
            @empty
                <li>There are no related projects!</li>
            @endforelse
        </ul>
        @else 
        <span class="d-block pt-5 text-secondary">
            Hey Bro!<br>
            ..Select a typology to see the related projects..
        </span>
        @endif
    </div>
</div>
@endsection