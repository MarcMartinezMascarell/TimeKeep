@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])
          </span>
          <span class="app-brand-text demo menu-text fw-bolder">{{config('variables.templateName')}}</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="bx bx-menu bx-sm"></i>
        </a>
      </div>
      @endif

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">

          <!-- Style Switcher -->
          <li class="nav-item">
            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
              <i class='bx bx-sm'></i>
            </a>
          </li>
          <!--/ Style Switcher -->

          @auth
          <!-- Notification -->
          <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class="bx bx-bell bx-sm"></i>
              <span id="badge-notifications" class="badge bg-{{Auth::user()->notifications->where('read_at', '=', null)->count() > 0 ? 'danger' : 'primary'}} rounded-pill badge-notifications">{{Auth::user()->notifications->where('read_at', '=', null)->count()}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
              <li class="dropdown-menu-header border-bottom">
                <div class="dropdown-header d-flex align-items-center py-3">
                  <h5 class="text-body mb-0 me-auto">Notification</h5>
                  <a id="read-all-notifications" href="{{route('notifications.read-all')}}" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
                </div>
              </li>
              <li class="dropdown-notifications-list scrollable-container">
                <ul class="list-group list-group-flush">
                  @forelse (Auth::user()->notifications->where('read_at', null) as $notification)
                  <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar">
                          <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="img-fluid w-px-40 h-auto rounded-circle">
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <a href="{{isset($notification->data['route']) ? route($notification->data['route']) : '#'}}">
                          <h6 class="mb-1">{{$notification->data['title']}}</h6>
                          <p class="mb-0">{{$notification->data['message']}}</p>
                        </a>
                        <small class="text-muted">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans(now())}}</small>
                      </div>
                      <div class="flex-shrink-0 dropdown-notifications-actions">
                        <a data-id="{{$notification->id}}" href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                        <a data-id="{{$notification->id}}" href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                      </div>
                    </div>
                  </li>
                  @empty
                  <li class="dropdown-menu-footer border-top">
                    <p class="dropdown-item d-flex justify-content-center align-items-center text-muted p-2 mb-0 h-px-40">
                      {{__("Todavía no tienes notificaciones...")}}
                    </p>
                  </li>
                  @endforelse

                </ul>
              </li>
              {{-- <li class="dropdown-menu-footer border-top">
                <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40">
                  View all notifications
                </a>
              </li> --}}
            </ul>
          </li>
          @endauth
          <!--/ Notification -->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}" alt style="object-fit:cover;" class="img-fluid w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-semibold d-block">
                        @if (Auth::check())
                        {{ Auth::user()->name }}
                        @else
                        John Doe
                        @endif
                      </span>
                      <small class="text-muted">@isset(Auth::user()->company[0]) {{Auth::user()->company[0]->name}} @endisset</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                  <i class="bx bx-cog me-2"></i>
                  <span class="align-middle">Settings</span>
                </a>
              </li>
              @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
              <li>
                <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                  <i class='bx bx-key me-2'></i>
                  <span class="align-middle">API Tokens</span>
                </a>
              </li>
              @endif
              <li>
                <a class="dropdown-item" href="javascript:void(0);">
                  <i class="bx bx-credit-card me-2"></i>
                  <span class="align-middle">Billing</span>
                </a>
              </li>
              {{-- @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <h6 class="dropdown-header">Manage Team</h6>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
                  <i class='bx bx-cog me-2'></i>
                  <span class="align-middle">Team Settings</span>
                </a>
              </li>
              @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
              <li>
                <a class="dropdown-item" href="{{ route('teams.create') }}">
                  <i class='bx bx-user me-2'></i>
                  <span class="align-middle">Create New Team</span>
                </a>
              </li>
              @endcan
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <lI>
                <h6 class="dropdown-header">Switch Teams</h6>
              </lI>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              @if (Auth::user())
              @foreach (Auth::user()->allTeams() as $team)
              {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream.

              <x-jet-switchable-team :team="$team" />
              @endforeach
              @endif
              @endif
              <li>
                <div class="dropdown-divider"></div>
              </li>
              @if (Auth::check())
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class='bx bx-power-off me-2'></i>
                  <span class="align-middle">Logout</span>
                </a>
              </li>
              <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
              </form>
              @else
              <li>
                <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
                  <i class='bx bx-log-in me-2'></i>
                  <span class="align-middle">Login</span>
                </a>
              </li>
              @endif --}}
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->


  <script>
    //Ajax call on read all notification
    let badge = document.getElementById('badge-notifications');
    document.getElementById('read-all-notifications').addEventListener('click', function(e) {
      e.preventDefault();
      console.log('click');
      $.ajax({
        url: "{{ route('notifications.read-all') }}",
        type: "GET",
        success: function(data) {
          if (data.status == 'success') {
            badge.html(0);
            badge.removeClass('bg-danger').addClass('bg-primary');
          }
        }
      });
    });
    //Ajax call on read single notification
    let notifications = document.querySelector('.dropdown-notifications-read');
    if(notifications) {
      notifications.addEventListener('click', function(e) {
      e.preventDefault();
      console.log(badge);
      let id = e.target.parentElement.getAttribute('data-id');
      $.ajax({
        url: "{{ route('notifications.read', ['id' => ':id']) }}".replace(':id', id),
        type: "GET",
        success: function(data) {
          console.log(data);
          if (data.status == 'success') {
            let currentValue = parseInt(badge.innerHTML);
            badge.innerHTML = currentValue - 1;
            if (currentValue <= 1) {
              $('#badge-notifications').removeClass('bg-danger').addClass('bg-primary');
            }
          }
        }
      });
    });
    }
  </script>
