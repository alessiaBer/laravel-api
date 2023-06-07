@extends('layouts.admin')

@section('content')
<div class="container text-white py-5">
    <div class="top top d-flex justify-content-between align-items-center pb-5">
        <h2>{{__('Projects')}}</h2>
        <a href="{{route('admin.projects.create')}}">
            <span>Add new project</span>
        </a>
    </div>

    @if (session('message'))
    <div class="alert alert-success" role="alert">
        <strong>{{session('message')}}</strong>
    </div>
    @endif
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Type</th>
                <th scope="col">Live Url</th>
                <th scope="col">Src Code</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <th scope="row">{{$project->id}}</th>
                <td>{{$project->title}}</td>
                <td>
                    <img src="{{$project->project_image}}" alt="{{$project->title}}" height="100">
                </td>
                <td>
                    @if($project->type)
                        {{$project->type->name}}
                    @else 
                        ---
                    @endif
                </td>
                <td>{{$project->project_live_url}}</td>
                <td>{{$project->project_source_code}}</td>
                <td>
                    <!-- metti route(..., $project invece di $project->id così l'url prende lo slug) e ricordarsi i parameters i web.php-->
                    <a href="{{route('admin.projects.show', $project)}}"
                        class="btn btn-primary text-decoration-none actions">
                        <span>View</span>
                    </a>
                    <a href="{{route('admin.projects.edit', $project)}}"
                        class="btn btn-warning text-decoration-none actions">
                        <span>Edit</span>
                    </a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger actions" data-bs-toggle="modal"
                        data-bs-target="#modal{{$project->slug}}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal{{$project->slug}}" tabindex="-1"
                        aria-labelledby="modalTitle-{{$project->slug}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark">
                                <div class="modal-header border-0">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hey bro!</h1>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are u sure u want to delete
                                    <strong>{{$project->title}}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('admin.projects.destroy', $project->slug)}}" method="post"
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


@endsection