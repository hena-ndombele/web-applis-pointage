<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Http\Requests\StoreDirectionRequest;
use App\Http\Requests\UpdateDirectionRequest;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directions = Direction::latest()->paginate(10);
        return view('directions.index', compact('directions'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
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
    public function store(StoreDirectionRequest $request)
    {
        $request->validate(
            ['name'=>'required|unique:directions']
        );
        Direction::create([
            'name'=>$request->name
        ]);
        return redirect()->route('directions.index')->with('success','La direction a été ajoutée avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direction $direction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDirectionRequest $request, Direction $direction)
    {
        $request->validate(
            ["name"=>"required"
            ]
        );
        $direction->update([
            'name' =>$request->name,       

        ]
        );  
        return redirect()->route('directions.index')->with('success','La direction a été modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direction $direction)
    {
        $direction->delete();
        return redirect()->route('directions.index')->with('success','La direction a été supprimée avec succès');
    }
}
