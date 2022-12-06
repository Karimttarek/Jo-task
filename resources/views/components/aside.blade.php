 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
     {{-- <img src="#" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
            <img src="#" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
            <a href="#" class="d-block">
                @if(isset(Auth::user()->name))
                    {{Auth::user()->name}}
                @endif
            </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact nav-child-indent nav-collapse-hide-child nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fab fa-accusoft nav-icon"></i>
              <p>
                File System
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('files')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Files</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('filesUpload')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Files</p>
                </a>
              </li>

            </ul>
          </li>
        <!-- Admin -->
        @if (Auth::check() && Auth::user()->is_admin == 1)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fab fa-accusoft nav-icon"></i>
              <p>
                Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.file')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Files</p>
                </a>
              </li>
              @endif

            </ul>
          </li>
          <!-- End Admin -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



