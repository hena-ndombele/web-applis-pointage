<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Direction;
use App\Models\Departement;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceCount = Service::count();
        $directions = Direction::all();
        $departements = Departement::all();
        $services = Service::latest()->paginate(10);
    
        return view('services.index', compact('directions', 'departements', 'services', 'serviceCount'))
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
    public function store(StoreServiceRequest $request)
    {
        $request->validate(
            ['name'=>'required|unique:departements','direction_id'=>'required','departement_id']
        );
        Service::create([
            'name'=>$request->name,
            'direction_id'=>$request->direction_id,
            'departement_id'=>$request->departement_id
        ]);
        return redirect()->route('services.index')->with('success','Le service a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $request->validate(
            ['name'=>'required','direction_id'=>'required','departement_id']
        );
        $service->update([
            'name' =>$request->name, 
            'direction_id'=>$request->direction_id ,
            'departement_id'=>$request->departement_id 

        ]
        );
        return redirect()->route('services.index')->with('success','Le service a été modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','Le service a été supprimée avec succès');
    }
    public function getDepartementByService(StoreServiceRequest $request)
{
  $serviceId = $request->input('service_id');
  $service = Service::find($serviceId);
  $departement = $service->departement_id;
    return response()->json(['departement' => $departement]);
}
}