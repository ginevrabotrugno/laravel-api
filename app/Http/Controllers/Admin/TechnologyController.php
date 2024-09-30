<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnologyRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Functions\Helper;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechnologyRequest $request)
    {
        $exists = Technology::where('name', $request->name)->first();

        if(!$exists){

            $data = $request->all();
            $data['slug'] = Helper::generateSlug($data['name'], Technology::class);
            $technology = Technology::create($data);

            return redirect()->route('admin.technologies.index')->with('success', 'Il nuovo Tipo è stato creato correttamente!');

        } else {
            return redirect()->route('admin.technologies.index')->with('error', 'Errore: Il Tipo inserito è già presente!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnologyRequest $request, Technology $technology)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['name'], Technology::class);
        $technology->update($data);
        return redirect()->route('admin.technologies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('deleted', 'Il Tipo è stato eliminato correttamente');
    }
}
