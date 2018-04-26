<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $companies = Company::where('user_id', Auth::user()->id)->get();
            return view('companies.index', ['companies' => $companies]);
        }

        return view('auth.login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $companies = Company::all();
            $company = new Company();
            $company -> name = $request->input('name');
            $company -> description = $request->input('description');
            $company->company_image = $request->file('company_image')->store('company_image/', 'public');
            $company->user_id = Auth::user()->id;
            $company->save();
            if($company){
                return redirect()->route('companies.show', ['company'=>$company->id])
                    ->with('success', 'Company create successfully');
            }
        }
        return back()->withInput()->with('errors', 'Error creating new company ');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $companyUpdate = Company::where('id', $company->id)->first();
        $companyUpdate -> name = $request->input('name');
        $companyUpdate -> description = $request->input('description');
        if ($request->hasFile('company_image')) {
            Storage::disk('public')->delete('' . $companyUpdate->company_image);
            $companyUpdate->company_image = $request->file('company_image')->store('company_image/', 'public');
            }
        $companyUpdate->save();
        if($companyUpdate){
        return redirect()->route('companies.show', ['company' => $company->id])
                          ->with('success', 'company update successfully');
    }
        return back()->withInput();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $findCompany = Company::find($company->id);
        foreach ($findCompany->projects as $project){
            $project_id = $project->id;
            $project = Project::where('id', '=', $project_id)->update(['company_id'=>null]);
        }
        Storage::delete('public/'.$findCompany->company_image);
        if($findCompany->delete()){
            return redirect()->route('companies.index')
                ->with('success', 'Company deleted successfully');
        }
        return back()->withInput()->with('errors', 'Company could not be delete ');
    }
}
