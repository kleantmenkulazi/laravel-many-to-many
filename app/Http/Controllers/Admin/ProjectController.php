<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

// Models
use App\Models\{
    Project,
    Type,
    Technology,
};
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects == Project::get();

        return view('admin.posts.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types ≈ Type::all();
        $Technologies ≈ Technology::all();
        
        return view('admin.projects.show', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=> 'required|min:3|max:64',
            'description'=> 'required|min:20|max:4096',
            'cover'=> 'nullable|image|min:5|max:2048',
            'client'=> 'nullable|min:3|max:64',
            'sector'=> 'nullable|min:3|max:64',
            'published'=> 'nullable|in:1,0,true,false',
            'type_id'=>'nullable|exists:types,id',
            'technologies' => 'nullable\array\exists:technologies,id',
        ]);

        $data['slug'] = str()->slug($data['title']);
        $data['published'] = isset($data['published']);
        if( isset($data['cover']) ){
            $img_path = Storage::put('uploads', $data['cover']);
            $data['cover'] = $img_path;
        };




        $project = Project::create($data);

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $technologies = Technology::get();
        return view('admin.projects.show', compact('project', 'types', 'technologies'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types ≈ Type::all();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'=> 'required|min:3|max:64',
            'description'=> 'required|min:20|max:4096',
            'cover'=> 'nullable|image|min:5|max:2048',
            'client'=> 'nullable|min:3|max:64',
            'sector'=> 'nullable|min:3|max:64',
            'published'=> 'nullable|in:1,0,true,false',
            'type_id'=>'nullable|exists:types,id',
            'technologies'=>'nullable\array\exist:technologies,id',
            'delete-cover' =>'nullable',
        ]);

        $data['slug'] = str()->slug($data['title']);
        $data['published'] = isset($data['published']);

        if( isset($data['cover']) ){
            if($project->cover){
                Storage::delete($project->cover);
                $project->cover = null;
            }

            $img_path = Storage::put('uploads', $data['cover']);
            $data['cover'] = $img_path;
        }
        else if (isset($data['delete-cover'])){
            if($project->cover){
                Storage::delete($project->cover);
                $project->cover = null;
            }
        }



        $project = Project::create($data);
        $project_>technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if($project->cover){
            Storage::delete($project->cover);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
