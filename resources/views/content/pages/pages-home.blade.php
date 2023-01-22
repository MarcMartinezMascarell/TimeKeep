@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
<h4>Home Page</h4>

@if(auth()->user()->hasCompanyInvitation)
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm">
          <div class="card-body">
            <h5 class="card-title text-primary">You have an invitation to join ! 🎉</h5>
            <p class="mb-4">You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in your profile.</p>

            <div class="row justify-space-between align-items-center">
              <div class="col">
                <a href="/accept-company-invitation?token={{auth()->user()->hasCompanyInvitation->invitation_token}}&email={{auth()->user()->hasCompanyInvitation->email}}&company={{auth()->user()->hasCompanyInvitation->company_id}}&role={{auth()->user()->hasCompanyInvitation->role}}" class="btn btn-sm btn-label-success">Accept invitation</a>
                <a href="javascript:;" class="btn btn-sm btn-label-danger">Deny invitation</a>
              </div>
              <div class="col">
                <p class="card-text text-end small text-muted">Last updated 3 mins ago</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif


@endsection
