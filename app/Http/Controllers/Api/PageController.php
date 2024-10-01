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

        if($projects){
            $success = true;
            foreach($projects as $project){
                if (!$project->img_path) {
                    $project->img_path = asset('img/placeholder.jpg');
                    $project->img_original_name = 'no image';
                }
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'projects'));
    }

    public function types(){
        $types = Type::orderby('id')->get();

        if($types){
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'types'));
    }

    public function technologies(){
        $technologies = Technology::orderBy('id')->get();

        return response()->json($technologies);
    }

    public function project($slug){
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        if($project){
            $success = true;
            if (!$project->img_path) {
                $project->img_path = asset('img/placeholder.jpg');
                $project->img_original_name = 'no image';
            }
        } else {
            $success = false;
        }


        return response()->json(compact('success', 'project'));
    }

    public function projectsPerType($slug){
        $type = Type::where('slug', $slug)->with('projects')->first();

        if($type){
            $success = true;

            foreach($type->projects as $project){
                $project->technologies;
            }
        } else {
            $success = false;
        }


        return response()->json(compact('success', 'type'));
    }

    public function projectsPerTechnology($slug){
        $technology = Technology::where('slug', $slug)->with('projects')->first();

        if($technology){
            $success = true;
            foreach($technology->projects as $project){
                $project->technologies;

                if (!$project->img_path) {
                    $project->img_path = asset('img/placeholder.jpg');
                    $project->img_original_name = 'no image';
                }
            }
        } else {
            $success = true;
        }


        return response()->json(compact('success', 'technology'));
    }

}


