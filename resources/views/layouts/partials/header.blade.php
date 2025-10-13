<div class="page-header">
    <div class="row m-0">
      <div class="header-wrapper">
        <div class="left-header col-lg-6 horizontal-wrapper ps-0">
          <div class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
              <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
            </svg>
          </div>
          <div class="toggle-sidebar sidebar-icon icon-box-sidebar">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-text-indent-left text-muted" viewBox="0 0 16 16">
              <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
            </svg>
          </div>
        </div>
        <div class="nav-right col-lg-6 right-header p-0">
          <ul class="nav-menus">
            <li class="serchinput">
              <div class="serchbox"><i data-feather="search"></i></div>
              <div class="form-group search-form">
                <input type="text" placeholder="Search here...">
              </div>
            </li>
            <li class="drkthm">
              <div class="mode"><i class="fas fa-moon"></i></div>
            </li>
            <li class="maximize"><a href="#!" onclick="javascript:toggleFullScreen()">
              <i data-feather="maximize-2"></i></a>
            </li>
            <li class="profile-nav onhover-dropdown dropdown">
              <div class="account-user">
                <img alt="" src="{{ Auth::user()->image_path ? asset('storage/' . Auth::user()->image_path) : asset('assets/images/user/no-image.jpg') }}">
              </div>
              <ul class="profile-dropdown show-div dropdown-menu">
                <li>
                  <div class="main-header-profile header-img">
                    <div class="main-img-user">
                      <img alt="" src="{{ Auth::user()->image_path ? asset('storage/' . Auth::user()->image_path) : asset('assets/images/user/no-image.jpg') }}">
                    </div>
                    <h6>{{Auth::user()->name}}</h6>
                  </div>
                </li>
                <li><a href="{{route('profile.edit')}}"><i data-feather="user"></i><span>Profile</span></a></li>
                <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-in"> </i><span>Log Out</span></a></li>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
</div>
