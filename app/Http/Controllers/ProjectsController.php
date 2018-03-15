<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    private $company_id;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('auth')->except('show');

    }


    public function index()
    {
        //
        if(Auth::check()){
            $projects=Project::where('user_id',Auth::user()->id)->get();

            if($projects){
                return view('projects.index',['projects'=>$projects]);
            }
         
        }
       return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id=null)
    
    {
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
            return view('projects.create',['company_id'=>$company_id,'companies'=>$companies]);

         }
         return view('projects.create',['company_id'=>$company_id]);

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
  
            $request->validate([
                'project_name' => 'required|max:20',
                'description' => 'required|min:50',
                'days'=>'required|integer|min:0',
            ]);

            $project = Project::create([
                'name' => $request->input('project_name'),
                'description' => $request->input('description'),
                'days'=>$request->input('days'),
                'user_id' => Auth::user()->id,
                'company_id'=> $request->input('company_id')

                ,
            ]);

            if($project){
                return redirect()->route('projects.show', ['project'=> $project->id])
                ->with('success' , 'project created successfully');
            }
        }

            return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project=Project::find($project->id);
        return view('projects.show',['project' => $project]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        if(Auth::user()->id == $project->user_id){
            $project=Project::find($project->id);
            return view('projects.edit',['project' => $project]);
        }  else{
            return back()->withInput()->with('error' , 'you cannot edit this project');

        }

     

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    { 
        $request->validate([
            'project_name' => 'required|max:20',
            'description' => 'required|min:50',
        ]);
        $projectupdate=Project::where('id',$project->id)
        ->update([
            'name'=>$request->input('project_name'),
            'description'=>$request->input('description')
        ]);
            if ($projectupdate){
                return redirect()->route('projects.show',['project'=>$project->id])
                ->with('success','project updated successfuly');
            }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (Auth::check() && Auth::user()->id == $project->user_id){
            $findProject = Project::find( $project->id);
            if($findProject->delete()){
                
                //redirect
                return redirect()->route('projects.index')
                ->with('success' , 'project deleted successfully');
            }
            return back()->withInput()->with('errors' , 'project could not be deleted');
        }
        else{
            return back()->withInput()->with('errors' , 'you are not authorized to delete this project');

        }
       

    }
}
