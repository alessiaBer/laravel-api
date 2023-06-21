<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Auth::id());
        $projects = Auth::user()->projects()->orderByDesc('id')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::orderByDesc('id')->get();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();
        $slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $slug;
        $val_data['user_id'] = Auth::id();

        if($request->hasFile('project_image')) {
            $img_path = Storage::put('uploads', $request->project_image);
            $val_data['project_image'] = $img_path;
        }

        if($request->hasFile('second_img')) {
            $img_path = Storage::put('uploads', $request->second_img);
            $val_data['second_img'] = $img_path;
        }

        $new_project = Project::create($val_data);
        if($request->has('technologies')) {
            $new_project->technologies()->attach($request->technologies);
        }

        return to_route('admin.projects.index')->with('message', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        if (Auth::id() === $project->user_id) {
            return view('admin.projects.edit', compact('project', 'types', 'technologies'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();
        $slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $slug;

        if($request->hasFile('project_image')) {
            if($project->project_image) {
                Storage::delete($project->project_image);
            }
            $img_path = Storage::put('uploads', $request->project_image);
            $val_data['project_image'] = $img_path;
        }
        if($request->hasFile('second_img')) {
            if($project->second_img) {
                Storage::delete($project->second_img);
            }
            $img_path = Storage::put('uploads', $request->second_img);
            $val_data['second_img'] = $img_path;
        }

        $project->update($val_data);

        if($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }
        return to_route('admin.projects.index')->with('message', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);
        if($project->project_image) {
            Storage::delete($project->project_image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted successfully!');
    }
}
