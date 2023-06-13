<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Controllers\Controller;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderBy('name')->get();
        $single_type = null;
        $edit_type = null;
        return view('admin.types.index', compact('types', 'single_type', 'edit_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {

        $val_data = $request->validated();
        $slug = Type::generateSlug($val_data['name']);
        $val_data['slug'] = $slug;

        Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'Type created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $single_type = $type;
        $edit_type = null;
        $types = Type::orderBy('name')->get();
        $related_projects = $type->projects;
        //dd($related_projects);
        return view('admin.types.index', compact('types', 'single_type', 'related_projects', 'edit_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $edit_type = $type;
        $single_type = null;
        $types = Type::orderBy('name')->get();
        return view('admin.types.index', compact('types', 'edit_type', 'single_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeRequest  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $val_data = $request->validated();
        $slug = Type::generateSlug($val_data['name']);
        $val_data['slug'] = $slug;

        $type->update($val_data);

        return to_route('admin.types.index')->with('message', 'Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('message', 'Type deleted successfully!');
    }
}
