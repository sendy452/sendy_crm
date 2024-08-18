<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[1];
?>

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ $page == "" ? "" : "collapsed"}}" href="{{url('/')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="list-lead" || $page=="ubah-lead" || $page=="deactivate-lead" ? "" : "collapsed"}}" data-bs-target="#lead-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Lead</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="lead-nav" class="nav-content collapse {{ $page =="list-lead" || $page=="ubah-lead" || $page=="deactivate-lead" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-lead')}}" class="{{ $page=="list-lead" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Lead</span>
            </a>
          </li>
          <li>
            <a href="{{url('ubah-lead')}}" class="{{ $page=="ubah-lead" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Lead</span>
            </a>
          </li>
        </ul>
      </li><!-- End Lead Nav -->


      <li class="nav-item">
        <a class="nav-link {{ $page =="list-service" || $page=="ubah-service" || $page=="deactivate-service" ? "" : "collapsed"}}" data-bs-target="#service-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-check"></i><span>Service</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="service-nav" class="nav-content collapse {{ $page =="list-service" || $page=="ubah-service" || $page=="deactivate-service" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-service')}}" class="{{ $page=="list-service" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Service</span>
            </a>
          </li>
          <li>
            <a href="{{url('ubah-service')}}" class="{{ $page=="ubah-service" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Service</span>
            </a>
          </li>
        </ul>
      </li><!-- End Service Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="list-project" || $page=="ubah-project" || $page=="deactivate-project" ? "" : "collapsed"}}" data-bs-target="#project-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Project</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="project-nav" class="nav-content collapse {{ $page =="list-project" || $page=="ubah-project" || $page=="deactivate-project" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-project')}}" class="{{ $page=="list-project" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Project</span>
            </a>
          </li>
          <li>
            <a href="{{url('ubah-project')}}" class="{{ $page=="ubah-project" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Project</span>
            </a>
          </li>
        </ul>
      </li><!-- End Project Nav -->

      <li class="nav-item">
        <a class="nav-link {{ $page =="list-customer" || $page=="ubah-customer" || $page=="deactivate-customer" ? "" : "collapsed"}}" data-bs-target="#customer-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="customer-nav" class="nav-content collapse {{ $page =="list-customer" || $page=="ubah-customer" || $page=="deactivate-customer" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-customer')}}" class="{{ $page=="list-customer" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Customer</span>
            </a>
          </li>
          <li>
            <a href="{{url('ubah-customer')}}" class="{{ $page=="ubah-customer" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Customer</span>
            </a>
          </li>
        </ul>
      </li><!-- End Customer Nav -->

      @if (auth()->user()->role_id < 3)          
      <li class="nav-heading">Lain-Lain</li>
      
      <li class="nav-item">
        <a class="nav-link {{ $page =="list-karyawan" || $page=="ubah-karyawan" || $page=="deactivate-karyawan" ? "" : "collapsed"}}" data-bs-target="#karyawan-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Master Karyawan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="karyawan-nav" class="nav-content collapse {{ $page =="list-karyawan" || $page=="ubah-karyawan" || $page=="deactivate-karyawan" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-karyawan')}}" class="{{ $page=="list-karyawan" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Data Karyawan</span>
            </a>
          </li>
          @if (auth()->user()->role_id == 1)
          <li>
            <a href="{{url('ubah-karyawan')}}" class="{{ $page=="ubah-karyawan" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Data Karyawan</span>
            </a>
          </li>
          @endif
        </ul>
      </li>
      <!-- End Karyawan Nav -->
      @endif

      @if (auth()->user()->role_id == 1)          
      <li class="nav-item">
        <a class="nav-link {{ $page =="ubah-role-user" || $page=="list-role" ? "" : "collapsed"}}" data-bs-target="#role-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-key"></i><span>Master Role</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="role-nav" class="nav-content collapse {{ $page =="ubah-role-user" || $page=="list-role" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('list-role')}}" class="{{ $page=="list-role" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>List Role</span>
            </a>
          </li>
          <li>
            <a href="{{url('ubah-role')}}" class="{{ $page=="ubah-role" ? "active" : ""}}">
              <i class="bi bi-circle"></i><span>Ubah Role</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Role Nav -->
      @endif

    </ul>

  </aside>