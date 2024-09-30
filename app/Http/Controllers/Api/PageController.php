<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class PageController extends Controller
{
    public function index(){
        $projects = Project::orderBy('id')->with('type', 'technologies')->get();

        return response()->json($projects);
    }

    public function types(){
        $types = Type::orderby('id')->get();

        return response()->json($types);
    }

    public function technologies(){
        $technologies = Technology::orderBy('id')->get();

        return response()->json($technologies);
    }

    public function project($slug){
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        if (!$project->img_path) {
            $project->img_path = asset('img/placeholder.jpg');
            $project->img_original_name = 'no image';
        }

        return response()->json($project);
    }

    public function projectsPerType($slug){
        $type = Type::where('slug', $slug)->with('projects')->first();

        foreach($type->projects as $project){
            $project->technologies;
        };

        return response()->json($type);
    }

    public function projectsPerTechnology($slug){
        $technology = Technology::where('slug', $slug)->with('projects')->first();

        foreach($technology->projects as $project){
            $project->technologies;
        };

        return response()->json($technology);
    }

}


