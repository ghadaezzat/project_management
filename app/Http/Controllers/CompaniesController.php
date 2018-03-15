<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
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
            $companies=Company::where('user_id',Auth::user()->id)->get();

            if($companies){
                return view('companies.index',['companies'=>$companies]);
            }
         
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
  
            $request->validate([
                'company_name' => 'required|max:20',
                'description' => 'required|min:50',
            ]);

            $company = Company::create([
                'name' => $request->input('company_name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);

            if($company){
                return redirect()->route('companies.show', ['company'=> $company->id])
                ->with('success' , 'Company created successfully');
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
    public function show(Company $company)
    {
        $company=Company::find($company->id);
        return view('companies.show',['company' => $company]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if(Auth::user()->id == $company->user_id){
            $company=Company::find($company->id);
            return view('companies.edit',['company' => $company]);
        }  else{
            return back()->withInput()->with('error' , 'you cannot edit this company');

        }

     

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    { 
        $request->validate([
            'company_name' => 'required|max:20',
            'description' => 'required|min:50',
        ]);
        $companyupdate=company::where('id',$company->id)
        ->update([
            'name'=>$request->input('company_name'),
            'description'=>$request->input('description')
        ]);
            if ($companyupdate){
                return redirect()->route('companies.show',['company'=>$company->id])
                ->with('success','company updated successfuly');
            }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if (Auth::check() && Auth::user()->id == $company->user_id){
            $findCompany = Company::find( $company->id);
            if($findCompany->delete()){
                
                //redirect
                return redirect()->route('companies.index')
                ->with('success' , 'Company deleted successfully');
            }
            return back()->withInput()->with('errors' , 'Company could not be deleted');
        }
        else{
            return back()->withInput()->with('errors' , 'you cannot delete this company');

        }
       

    }
}
