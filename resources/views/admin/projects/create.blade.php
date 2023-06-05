@extends('layouts.admin')

@section('content')
<section>
    <div class="container create_container py-5">
        @include('partials.validation_error')
        <form class="row g-3" action="{{route('admin.projects.store')}}" method="post">
            @csrf

            <div class="col-12">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Type your project title here...">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" rows="5" placeholder="Type your project description here...">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="project_image" class="form-label">Project image</label>
                <input type="text" class="form-control @error('project_image') is-invalid @enderror" id="project_image" name="project_image" placeholder="Image URL" value="{{ old('project_image') }}">
                @error('project_image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="project_url" class="form-label">Project url</label>
                <input type="text" class="form-control @error('project_url') is-invalid @enderror" id="project_url" name="project_url" placeholder="http://project.dev" value="{{ old('project_url') }}">
                @error('project_url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 mx-auto text-center pt-3">
                <button type="submit" class="btn btn-light text-dark px-4">Sign in</button>
            </div>
        </form>
    </div>
</section>

@endsection