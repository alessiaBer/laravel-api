@extends('layouts.admin')

@section('content')
<div class="container bd-dark text-white">
    <div class="top top d-flex justify-content-between align-items-center pb-5">
        <h2>{{__('Projects')}}</h2>
        <a href="{{route('admin.projects.create')}}" class="text-decoration-none">
            <span>Add new project</span>
        </a>
    </div>
    </div>

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
                <td>{{$project->project_image}}</td>
                <td>{{$project->project_url}}</td>
                <td>{{$project->slug}}</td>
                <td>view|edit|delete</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection