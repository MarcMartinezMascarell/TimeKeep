@extends('layouts/layoutMaster')

@php
$breadcrumbs = [['link' => 'home', 'name' => 'Home'], ['link' => 'javascript:void(0)', 'name' => 'User'], ['name' => 'Profile']];
@endphp

@section('title', 'User Profile - Profile')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
@endsection

<!-- Page -->
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-profile.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">User Profile /</span> Profile
</h4>


<!-- Header -->
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
        <div class="flex-shrink-0 mt-n1 mx-sm-0 mx-auto avatar-online">
          <img src="{{ $user ? $user->profile_photo_url : asset('assets/img/avatars/1.png') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
        </div>
        <div class="flex-grow-1 mt-3 mt-sm-5">
          <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
            <div class="user-profile-info">
              <div class="d-flex mb-4 gap-2">
                <h4 class="mb-0">{{ $user->name }}</h4>
                @if(count($sessions) > 0)
                <span class="badge rounded-pill bg-label-success ">Connected</span>
                @else
                <span class="badge rounded-pill bg-label-danger ">Disconnected</span>
                @endif
              </div>
              <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                <li class="list-inline-item fw-semibold">
                  <i class='bx bx-pen'></i> UX Designer
                </li>
                <li class="list-inline-item fw-semibold">
                  <i class='bx bx-map'></i> Vatican City
                </li>
                <li class="list-inline-item fw-semibold d-flex align-items-center gap-1">
                  <i class='bx bx-calendar-alt'></i> Joined {{ $user->created_at->format('d/m/Y') }}
                </li>
              </ul>
            </div>
            @if($user->id == auth()->user()->id)
            <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
              <i class='bx bx-message-square-edit'></i> Edit Profile
            </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Header -->

<!-- Navbar pills -->
<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-sm-row mb-4">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class='bx bx-user'></i> Profile</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-teams')}}"><i class='bx bx-group'></i> Teams</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-projects')}}"><i class='bx bx-grid-alt'></i> Projects</a></li>
      <li class="nav-item"><a class="nav-link" href="{{url('pages/profile-connections')}}"><i class='bx bx-link-alt'></i> Connections</a></li>
    </ul>
  </div>
</div>
<!--/ Navbar pills -->

<!-- User Profile Content -->
<div class="row">
  <div class="col-xl-4 col-lg-5 col-md-5">
    <!-- About User -->
    <div class="card mb-4">
      <div class="card-body">
        <small class="text-muted text-uppercase">About</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Full Name:</span> <span>{{ $user->name }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span class="fw-semibold mx-2">Role:</span> <span>{{ $user->getRoleNames()[0] }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-desktop"></i><span class="fw-semibold mx-2">Last connection:</span> <span>{{ (isset($user->last_login_at)) ? Carbon\Carbon::parse($user->last_login_at)->diffForHumans(now()) : '' }}</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-detail"></i><span class="fw-semibold mx-2">Languages:</span> <span>English</span></li>
        </ul>
        <small class="text-muted text-uppercase">Contacts</small>
        <ul class="list-unstyled mb-4 mt-3">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-semibold mx-2">Contact:</span> <span>(123) 456-7890</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-chat"></i><span class="fw-semibold mx-2">Skype:</span> <span>john.doe</span></li>
          <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-semibold mx-2">Email:</span> <span>john.doe@example.com</span></li>
        </ul>
        <small class="text-muted text-uppercase">Teams</small>
        <ul class="list-unstyled mt-3 mb-0">
          <li class="d-flex align-items-center mb-3"><i class="bx bxl-github text-primary me-2"></i>
            <div class="d-flex flex-wrap"><span class="fw-semibold me-2">Backend Developer</span><span>(126 Members)</span></div>
          </li>
          <li class="d-flex align-items-center"><i class="bx bxl-react text-info me-2"></i>
            <div class="d-flex flex-wrap"><span class="fw-semibold me-2">React Developer</span><span>(98 Members)</span></div>
          </li>
        </ul>
      </div>
    </div>
    <!--/ About User -->
    <!-- Profile Overview -->
    <div class="card mb-4">
      <div class="card-body">
        <small class="text-muted text-uppercase">Overview</small>
        <ul class="list-unstyled mt-3 mb-0">
          <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-semibold mx-2">Task Compiled:</span> <span>13.5k</span></li>
          <li class="d-flex align-items-center mb-3"><i class='bx bx-customize'></i><span class="fw-semibold mx-2">Projects Compiled:</span> <span>146</span></li>
          <li class="d-flex align-items-center"><i class="bx bx-user"></i><span class="fw-semibold mx-2">Connections:</span> <span>897</span></li>
        </ul>
      </div>
    </div>
    <!--/ Profile Overview -->
  </div>
  <div class="col-xl-8 col-lg-7 col-md-7">
    <!-- Activity Timeline -->
    <div class="card text-center mb-4">
      <div class="card-header">
        <ul class="nav nav-pills card-header-pills" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#navs-pills-notifications" role="tab">Notifications</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#navs-pills-within-card-link" role="tab">Link</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link disabled" data-bs-toggle="tab" data-bs-target="javascript:void(0)" role="tab">Disabled</button>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-pills-notifications" role="tabpanel">
          <div class="list-group">
              @if(count($user->notifications) > 0)
              @foreach($user->notifications as $notification)
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                <div class="li-wrapper d-flex justify-content-start align-items-center">
                  <div class="avatar avatar-sm me-3">
                    <span class="avatar-initial rounded-circle bg-label-success">M</span>
                  </div>
                  <div class="list-content text-left">
                    <h6 class="mb-1 text-left">{{ $notification->data['title'] }}</h6>
                    <small class="text-muted">{{ $notification->data['message'] }}</small>
                  </div>
                </div>
                <small>{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans(now()) }}</small>
              </a>
              @endforeach
              @else
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                <div class="li-wrapper d-flex justify-content-start align-items-center">
                  <div class="list-content text-left">
                    <h6 class="mb-1 text-left">No notifications...</h6>
                  </div>
                </div>
              </a>
              @endif
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-within-card-link" role="tabpanel">
            <h4 class="card-title">Special link title</h4>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="javascript:void(0)" class="btn btn-secondary">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
    <!--/ Activity Timeline -->
    <div class="row">
      <!-- Connections -->
      <div class="col-lg-12 col-xl-6">
        <div class="card card-action mb-4">
          <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Connections</h5>
            <div class="card-action-element">
              <div class="dropdown">
                <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="javascript:void(0);">Share connections</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mb-0">
              <li class="mb-3">
                <div class="d-flex align-items-start">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">Cecilia Payne</h6>
                      <small class="text-muted">45 Connections</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <button class="btn btn-label-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="d-flex align-items-start">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">Curtis Fletcher</h6>
                      <small class="text-muted">1.32k Connections</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <button class="btn btn-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="d-flex align-items-start">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">Alice Stone</h6>
                      <small class="text-muted">125 Connections</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <button class="btn btn-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="d-flex align-items-start">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">Darrell Barnes</h6>
                      <small class="text-muted">456 Connections</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <button class="btn btn-label-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                  </div>
                </div>
              <li class="mb-3">
                <div class="d-flex align-items-start">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/avatars/12.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">Eugenia Moore</h6>
                      <small class="text-muted">1.2k Connections</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <button class="btn btn-label-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                  </div>
                </div>
              </li>
              <li class="text-center">
                <a href="javascript:;">View all connections</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Connections -->
      <!-- Teams -->
      <div class="col-lg-12 col-xl-6">
        <div class="card card-action mb-4">
          <div class="card-header align-items-center">
            <h5 class="card-action-title mb-0">Teams</h5>
            <div class="card-action-element">
              <div class="dropdown">
                <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="javascript:void(0);">Share teams</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mb-0">
              <li class="mb-3">
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/icons/brands/react-label.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">React Developers</h6>
                      <small class="text-muted">72 Members</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/icons/brands/support-label.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">Support Team</h6>
                      <small class="text-muted">122 Members</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <a href="javascript:;"><span class="badge bg-label-primary">Support</span></a>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/icons/brands/figma-label.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">UI Designers</h6>
                      <small class="text-muted">7 Members</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <a href="javascript:;"><span class="badge bg-label-info">Designer</span></a>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/icons/brands/vue-label.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-2">
                      <h6 class="mb-0">Vue.js Developers</h6>
                      <small class="text-muted">289 Members</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                  </div>
                </div>
              </li>
              <li class="mb-3">
                <div class="d-flex align-items-center">
                  <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                      <img src="{{asset('assets/img/icons/brands/twitter-label.png')}}" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div class="me-w">
                      <h6 class="mb-0">Digital Marketing</h6>
                      <small class="text-muted">24 Members</small>
                    </div>
                  </div>
                  <div class="ms-auto">
                    <a href="javascript:;"><span class="badge bg-label-secondary">Marketing</span></a>
                  </div>
                </div>
              </li>
              <li class="text-center">
                <a href="javascript:;">View all teams</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Teams -->
    </div>
    <!-- Projects table -->
    {{-- <div class="card mb-4">
      <div class="card-datatable table-responsive">
        <table class="datatables-projects border-top table">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th>Name</th>
              <th>Leader</th>
              <th>Team</th>
              <th class="w-px-200">Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div> --}}
    <!--/ Projects table -->
  </div>
</div>
<!--/ User Profile Content -->





@endsection



