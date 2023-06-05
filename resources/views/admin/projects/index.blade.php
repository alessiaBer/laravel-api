@extends('layouts.admin')

@section('content')
<div class="container bd-dark text-white py-5">
    <div class="top top d-flex justify-content-between align-items-center pb-5">
        <h2>{{__('Projects')}}</h2>
        <a href="{{route('admin.projects.create')}}" class="text-decoration-none">
            <span>Add new project</span>
        </a>
    </div>

    @if (session('message'))
    <div class="alert alert-success" role="alert">
        <strong>{{session('message')}}</strong>
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Url</th>
                <th scope="col">Slug</th>
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
                <td>{{$project->project_url}}</td>
                <td>{{$project->slug}}</td>
                <td>
                    <a href="{{route('admin.projects.show', $project->id)}}"
                        class="btn btn-primary text-decoration-none">
                        <span>View</span>
                    </a>
                    <a href="{{route('admin.projects.edit', $project->id)}}"
                        class="btn btn-warning text-decoration-none">
                        <span>Edit</span>
                    </a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modal{{$project->id}}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal{{$project->id}}" tabindex="-1"
                        aria-labelledby="modalTitle-{{$project->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are u sure u want to delete
                                    <strong>{{$project->title}}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('admin.projects.destroy', $project->id)}}" method="post"
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