<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
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
    public function store(TypeRequest $request)
    {
        $exists = Type::where('name', $request->name)->first();

        if(!$exists){

            $data = $request->all();
            $data['slug'] = Helper::generateSlug($data['name'], Type::class);
            $type = Type::create($data);

            return redirect()->route('admin.types.index')->with('success', 'Il nuovo Tipo è stato creato correttamente!');

        } else {
            return redirect()->route('admin.types.index')->with('error', 'Errore: Il Tipo inserito è già presente!');
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
    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['name'], Type::class);
        $type->update($data);
        return redirect()->route('admin.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('deleted', 'Il Tipo è stato eliminato correttamente');
    }

    public function typeProjects(){
        $types = Type::all();

        return view('admin.types.typeProjects', compact('types'));
    }

    public function projectsPerType(Type $type){
        return view('admin.types.projectsPerType', compact('type'));
    }
}
