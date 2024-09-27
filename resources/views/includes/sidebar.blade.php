<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
       <li class="nav-item {{ request()->is('dashboard') ? 'active' : ''}}">
          <a class="nav-link" href="{{url('/dashboard')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
          </a>
       </li>
       <li class="nav-item {{ request()->is('property') ? 'active' : ''}}">
         <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
         <i class="icon-bar-graph menu-icon"></i>
         <span class="menu-title">Property</span>
         <i class="menu-arrow"></i>
         </a>
         <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="{{url('property/create')}}">Add Property</a></li>
               <li class="nav-item"> <a class="nav-link" href="{{url('property')}}">Manage Properties</a></li>
               
            </ul>
         </div>
      </li>
       <li class="nav-item {{ request()->is('users') ? 'active' : ''}}">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">Users</span>
          <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
             <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{url('users')}}">Manage Users</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('roles')}}">Roles</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{url('permissions')}}">Permissions</a></li>
             </ul>
          </div>
       </li>
       
    </ul>
 </nav>