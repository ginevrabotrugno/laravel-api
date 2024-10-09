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
        $data = Project::orderBy('id', 'desc')->with('type', 'technologies')->paginate(8);

        if($data){
            $success = true;
            foreach($data as $project){
                if (!$project->img_path) {
                    $project->img_path = asset('img/placeholder.jpg');
                    $project->img_original_name = 'no image';
                }
            }
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'data'));
    }

    public function types(){
        $data = Type::orderby('id')->get();

        if($data){
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'data'));
    }

    public function technologies(){
        $data = Technology::orderBy('id')->get();

        if($data){
            $success = true;
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'data'));
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

    public function search(Request $request){
        $success = true;

        if($request->has('search') && $request->search !== ''){
            $search = $request->input('search');
            $data = Project::where('title', 'LIKE', "%{$search}%")->with('type', 'technologies')->orderBy('id', 'desc')->paginate(8);
        } else {
            $data = Project::orderBy('id', 'desc')->with('type', 'technologies')->paginate(8);
        }

        return response()->json(compact('success', 'data'));
    }

}


