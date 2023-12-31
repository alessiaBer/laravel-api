@extends('layouts.admin')

@section('content')
<section>
    <div class="container create_container py-5">
        @include('partials.validation_error')
        <form class="row g-3" action="{{route('admin.projects.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="col-12">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" placeholder="Type your project title here...">
                @error('title')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                    <option value="">Select the project type</option>
                    @foreach($types as $type)
                    <option value="{{$type->id}}" {{ $type->id == old('type_id', '') ? 'selected' : ''}}>{{$type->name}}
                    </option>
                    @endforeach
                </select>
                @error('type_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class='form-group col-12'>
                <label class="form-label">Select technologies:</label>
                @foreach ($technologies as $technology)
                <div class="form-check @error('technologies') is-invalid @enderror">
                    <label class='form-check-label'>
                        <input name='technologies[]' type='checkbox' value='{{ $technology->id}}'
                            class='form-check-input' {{ in_array($technology->id, old('technologies', [])) ? 'checked' :
                        '' }}>
                        {{ $technology->name }}
                    </label>
                </div>
                @endforeach
                @error('technologies')
                <div class='invalid-feedback'>{{ $message}}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description"
                    name="description" rows="5"
                    placeholder="Type your project description here...">{{ old('description') }}</textarea>
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="project_image" class="form-label">Project image</label>
                <input type="file" class="form-control @error('project_image') is-invalid @enderror" id="project_image"
                    name="project_image" placeholder="Image path" value="{{ old('project_image') }}">
                @error('project_image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="second_img" class="form-label">Other Image</label>
                <input type="file" class="form-control @error('second_img') is-invalid @enderror" id="second_img"
                    name="second_img" placeholder="Image path" value="{{ old('second_img') }}">
                @error('second_img')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="project_live_url" class="form-label">Live url</label>
                <input type="text" class="form-control @error('project_live_url') is-invalid @enderror"
                    id="project_live_url" name="project_live_url" placeholder="http://project.dev"
                    value="{{ old('project_live_url') }}">
                @error('project_live_url')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12">
                <label for="project_source_code" class="form-label">Source Code</label>
                <input type="text" class="form-control @error('project_source_code') is-invalid @enderror"
                    id="project_source_code" name="project_source_code" placeholder="http://project.dev"
                    value="{{ old('project_source_code') }}">
                @error('project_source_code')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4 mx-auto text-center pt-3">
                <button type="submit" class="btn btn-light text-dark px-4">Store</button>
            </div>
        </form>
    </div>
</section>

@endsection