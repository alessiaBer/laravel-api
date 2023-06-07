@extends('layouts.admin')

@section('content')
<section>
<div class="container py-5">
    <h3 class="pb-4">Title: {{$project->title}}</h3>
    <div class="content_container d-flex">
        <div class="project_img_container">
            <img src="{{$project->project_image}}" alt="{{$project->title}}" height="300">
        </div>
        <div class="project_info ps-4">
            @if($project->type)
                <p><strong>Type: </strong>{{$project->type->name}}</p>
            @endif
            <p><strong>Description:</strong><br>{{$project->description}}</p>
            <span class="d-block"><strong>Link: </strong>
                <ul>
                    <li>{{$project->project_live_url}}</li>
                    <li>{{$project->project_source_code}}</li>
                </ul>
            </span>
        </div>
    </div>
</div>
</section>
@endsection