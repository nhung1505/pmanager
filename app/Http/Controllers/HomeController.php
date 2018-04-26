<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Project;
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
     * @return \Illuminate\Http\Response
     */


        public function index(Request $request)
    {
        $companies = Company::orderBy('id', 'desc')->paginate(8);
        $projects = Project::orderBy('id', 'desc')->paginate(8);
        return view('home', compact('companies', 'projects'));


    }

}
