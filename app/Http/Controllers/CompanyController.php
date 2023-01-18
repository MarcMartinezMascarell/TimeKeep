<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Company;

class CompanyController extends Controller
{
    public function index() {
      if(auth()->user()->hasRole('super-admin'))
        return view('company.index');
      else
        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
    }

    public function create() {
        return view('company.create');
    }

    public function store(Request $request) {
        // $company = Company::create([$request->all(), 'id_public' => Str::random(20)]);

        $company = new Company;
        $company->name = $request->name;
        $company->id_public = Str::random(20);
        $company->full_name = $request->full_name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->manager_type = $request->manager_type;
        $company->country = $request->country;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->zip = $request->zip;
        $company->cif = $request->cif;
        $company->save();
        Auth::user()->company()->attach($company->id, ['role' => 'owner']);


        return redirect()->route('company.index')
            ->with('success', 'Company created successfully.');
    }

    public function show(Company $company) {
        return view('company.show', compact('company'));
    }

    public function edit(Company $company) {
        return view('company.edit', compact('company'));
    }

    public function users() {
      if($user = Auth::user()) {
        $company = Company::find($user->company[0]->id);
        $company->users;
        return view('company.users', compact('company'));
      }
    }

    public function usersList() {
      if($user = Auth::user()) {
        $company = Company::find($user->company[0]->id);
        $company->users;
        return response(['data' => $company->users]);
      }
    }

}
