<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Project;
use App\Models\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $projects = Project::where('user_id', Auth::user()->id)->get();
            return view('projects.index', ['projects' => $projects]);
        }
        return view('auth.login');

    }

    public function adduser(Request $request){
        //add user to projects

        //take a project, add a user to it
        $project = Project::find($request->input('project_id'));
        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first(); //single record
            //check if user is already added to the project
            $projectUser = ProjectUser::where('user_id', $user->id)
                ->where('project_id', $project->id)->first();

            if($user && $project){
                $project->users()->toggle($user->id);
                return redirect()->route('projects.show', ['project'=>$project->id])->with('success',  $request->input('email').'was added project successfully');

            }
        }
        return redirect()->route('projects.show', ['project'=>$project->id])->with('errors',  'Error adding user to project');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
        if (!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create', ['company_id' => $company_id, 'companies' => $companies]);
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
            $projects = Project::all();
            $project = new Project();
            $project -> name = $request->input('name');
            $project -> description = $request->input('description');
            $project -> company_id = $request->input('company_id');
            $project->project_image = $request->file('project_image')->store('project_image/', 'public');
            $project->user_id = Auth::user()->id;
            $project->save();
            if($project){
                return redirect()->route('projects.show', ['project'=>$project->id])
                    ->with('success', 'Project create successfully');
            }
        }
        return back()->withInput()->with('errors', 'Error creating new project ');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
//        $project= Project::where('id', $project->id)->first();

        $project = Project::find($project->id);
        $comments = $project->comments;
        return view('projects.show', ['project' => $project, 'comments' =>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Project $project)
    {
        //save data
        $projectUpdate = Project::where('id', $project -> id)->update([
            'name' => $request -> input('name'),
            'description' => $request ->input('description')
        ]);
        if($projectUpdate){
            return redirect()->route('projects.show', ['project' => $project->id])
                ->with('success', 'project update successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $findProject = Project::find($project->id);
        if($findProject->delete()){
            return redirect()->route('projects.index')
                ->with('success', 'Project deleted successfully');
        }
        return back()->withInput()->with('errors', 'Project could not be delete ');
    }
}
