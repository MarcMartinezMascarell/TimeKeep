@extends('layouts/layoutMaster')

@section('title', 'User Management')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/spinkit/spinkit.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/spinkit/spinkit.cs')}}s" />
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/block-ui/block-ui.css')}}" /> --}}
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/pdfmake/pdfmake.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.print.js')}}"></script>
<script src="{{asset('assets/vendor/libs/jszip/jszip.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-buttons/buttons.html5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/block-ui/block-ui.js')}}"><script>
@endsection

@section('page-script')
<script src="{{asset('js/laravel-user-management.js')}}"></script>
@endsection

@section('content')

<div id="content" class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Users</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">{{$company->users->count()}} / {{$company->max_users}}</h3>
              <small class="text-success">{{($company->users->count() / $company->max_users)*100}}%</small>
            </div>
          </div>
          <span class="badge bg-label-primary rounded p-2">
            <i class="fa-solid fa-users fa-2x"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Admins</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">1</h3>
            </div>
          </div>
          <span class="badge bg-label-success rounded p-2">
            <i class="fa-solid fa-user-tie fa-2x"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Managers</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2">2</h3>
            </div>
          </div>
          <span class="badge bg-label-info rounded p-2">
            <i class="fa-solid fa-user-gear fa-2x"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Verification Pending</span>
            <div class="d-flex align-items-end mt-2">
              <h3 class="mb-0 me-2"></h3>
              <small class="text-danger">(+6%)</small>
            </div>
            <small>Recent analytics</small>
          </div>
          <span class="badge bg-label-warning rounded p-2">
            <i class="bx bx-user-voice bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@if (Auth::user()->company[0]->invitations->count())
<div class="row g-4 mb-4 invitations-container">
  <div class="col-sm-12 col-xl-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left w-75">
            <span class="mb-2">Pending invitations</span>
            {{-- <div class="d-flex align-items-end mt-2"> --}}
              @foreach (Auth::user()->company[0]->invitations as $invitation)
              <div class="invitation-item w-100 row justify-content-between">
                <div class="col">
                  <small>{{$invitation->name}} {{$invitation->surname}}</small>
                </div>
                <div class="col">
                  <small>{{$invitation->email}}</small>
                </div>
                <div class="col">
                  <small>{{$invitation->job}}</small>
                </div>
                <div class="col">
                  <small>{{Carbon\Carbon::parse($invitation->created_at)->diffForHumans()}}</small>
                </div>
              </div>
              @endforeach
            {{-- </div> --}}
          </div>
          <span class="badge bg-label-warning rounded p-2">
            <i class="bx bx-time-five bx-sm"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
<!-- Users List Table -->
<div class="card users-container">
  <div class="card-header">
    <h5 class="card-title mb-0">Search Filter</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table id="company_users" class="datatables-users table border-top">
      <thead>
        <tr>
          <th></th>
          <th>Id</th>
          <th>User</th>
          <th>Email</th>
          <th>Job</th>
          <th>Rol</th>
          <th>Created at</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Invite new User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-user pt-0" id="addNewUserForm" action="{{route('send.invitation')}}">
        <input type="hidden" name="company_id" value="{{auth()->user()->company[0]->id}}">
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Name</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John" name="name" aria-label="John" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Last Name</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="Doe" name="surname" aria-label="Doe" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-job">Job</label>
          <input type="text" id="add-user-job" name="job" class="form-control" placeholder="Web Developer" aria-label="jdoe1" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="user-role">User Role</label>
          <select id="user-role" class="form-select" name="role">
            <option value="company_worker">Worker</option>
            <option value="company_manager">Manager</option>
            <option value="company_admin">Admin</option>
          </select>
        </div>
        <div class="mb-4">
          <label class="form-label" for="user-plan">Select Plan</label>
          <select id="user-plan" class="form-select">
            <option value="basic">Basic</option>
            <option value="enterprise">Enterprise</option>
            <option value="company">Company</option>
            <option value="team">Team</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Send invitation</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>
@endsection
