<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;

use App\Models\Company;
use App\Models\Company_invitation;

class CompanyController extends Controller
{
    public function index() {
      if(auth()->user()->hasAnyRole(['super-admin', 'company_admin'])) {
        $user = Auth::user();
        $company = Company::find($user->company[0]->id);
        $company->users;
        return view('company.users', compact('company'));
      } else {
        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
      }
    }

    public function create() {
        return view('company.create');
    }

    public function store(Request $request) {
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
        if($request->file('logo_url')) {
          $image = $request->file('logo_url');
          $filename = str_replace(' ', '', $request->name) . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/companies' . $filename);
          $request->logo_url->move(public_path('images/companies'), $filename);
          $company->logo_url = url('/companies') . '/images/' . $filename;
        }
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

    public function sendInvitation(Request $request) {
      if(Auth::user()->hasRole('company_admin')) {
        $user = Auth::user();
        $invitation = new Company_invitation;
        $invitation->email = $request->email;
        $invitation->name = $request->name;
        $invitation->surname = $request->surname;
        $invitation->job = $request->job;
        $invitation->company_id = $request->company_id;
        $invitation->role = $request->role;
        $invitation->invitation_token = Str::random(20);
        $invitation->save();
        Notification::route('mail', $request->email)->notify(new \App\Notifications\CompanyInvitation($invitation));
        $user->notify(new \App\Notifications\InvitationSent($invitation));
        return response(['status' => 'success']);
      }
    }

    public function acceptInvitation(Request $request) {
      $invitation = Company_invitation::where('invitation_token', $request->token)->first();
      if($invitation) {
        if($user = Auth::user()) {
          $user->company()->attach($invitation->company_id, ['role' => $invitation->role]);
          $user->assignRole($invitation->role);
          $invitation->delete();
          return redirect()->route('pages-home')->with('success', 'You have been added to the company.');
        }
        else {
          return view('auth.register', ['invitation' => $invitation]);
        }
      }
      else {
        return redirect()->route('pages-home')->with('error', 'Invitation not found.');
      }
    }

}
