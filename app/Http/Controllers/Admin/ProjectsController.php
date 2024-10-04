<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectsRequest;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Functions\Helper;
use SebastianBergmann\CodeCoverage\Report\Xml\Project as XmlProject;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allProjs = Project::all();

        if($request->has('search') && $request->search !== ''){
            $search = $request->search;
            $projects = Project::where('title', 'LIKE', "%{$search}%")->orderBy('id')->paginate(10);
        } else {
            $projects = Project::orderBy('id', 'desc')->paginate(10);
        }



        return view('admin.projects.index', compact('projects', 'allProjs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectsRequest $request)
    {
        $data = $request->all();

        if (array_key_exists('img_path', $data)) {
            $image_path = Storage::put('uploads', $data['img_path']);
            $original_img_path = $request->file('img_path')->getClientOriginalName();
        }


        $data['img_path'] = $image_path;
        $data['img_original_name'] = $original_img_path;
        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        $new_project = Project::create($data);

        if(array_key_exists('technologies', $data)){
            $new_project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project)->with('created', 'Il Nuovo Progetto è stato creato correttamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectsRequest $request, Project $project)
    {
        $data = $request->all();

        if($data['title'] !== $project->title){
            $data['slug'] = Helper::generateSlug($data['title'], Project::class);
        }

        $project->update($data);

        if(array_key_exists('technologies', $data)){
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project)->with('edited', 'Il Progetto è stato modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted', 'Il Progetto "' . $project->title . '" è stato spostato nel cestino');
    }

    public function deleteMultiple(Request $request){

        //Ritrasformo il Json Javascript con l'array di Id selezionati in un array Php
        $projectIds = json_decode($request->input('selected_projects'));

        if ($projectIds) {
            Project::whereIn('id', $projectIds)->delete();
            return redirect()->route('admin.projects.index')->with('success', 'Progetti eliminati con successo.');
        }

        return redirect()->route('admin.projects.index')->with('error', 'Nessun progetto selezionato.');
    }

    public function trash(){
        $projects = Project::onlyTrashed()->orderBy('id', 'desc')->get();

        return view('admin.projects.trash', compact('projects'));
    }

    public function restore($id){
        $project = Project::withTrashed()->find($id);
        $project->restore();

        return redirect()->route('admin.projects.index')->with('restored', 'Il Progetto "' . $project->title . '" è stato ripristinato correttamente');
    }

    public function delete($id){
        $project = Project::withTrashed()->find($id);

        if ($project->img_path) {
            Storage::delete($project->img_path);
        }

        $project->forceDelete();

        return redirect()->route('admin.projects.index')->with('deleted', 'Il Progetto "' . $project->title . '" è stato eliminato definitivamente');
    }
}
