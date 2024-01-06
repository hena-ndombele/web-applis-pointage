<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $serviceCount = \App\Models\Service::count();
        $DepartementCount = \App\Models\Departement::count();
        $DirectionCount = \App\Models\Direction::count();
        $AgentCount = \App\Models\Agent::count();

        return view('home',compact('serviceCount','DepartementCount','DirectionCount','AgentCount'));
    }
}
