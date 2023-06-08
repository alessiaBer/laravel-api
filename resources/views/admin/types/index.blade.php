@extends('layouts.admin')

@section('content')
<div class="container text-white py-5 d-flex justify-content-between">
    <div class="left w-50 pe-5">
        <h2 class="pb-4">{{__('Typologies')}}</h2>
        @if (session('message'))
        <div class="alert alert-success" role="alert">
            <strong>{{session('message')}}</strong>
        </div>
        @endif
        <form action="{{route('admin.types.store')}}" method="post">
            @csrf
            <label for="name">Add new type</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Type the typology name" aria-label="Username"
                    aria-describedby="basic-addon1" name="name" id="name">
                <span class="input-group-text" id="basic-addon1"><button class="border-0 bg-transparent"
                        type="submit">+</button></span>
            </div>
        </form>
    </div>

    <div class="table-responsive w-50">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($types as $type)
                <tr>
                    <td scope="row">{{$type->id}}</td>
                    <td>{{$type->name}}</td>
                    <td>view | delete </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection