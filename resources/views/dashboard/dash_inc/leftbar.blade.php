<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="{{ (\Request::route()->getName() == 'dashboard-analytics') ? 'active' : '' }}">
                <a href="{{route('dashboard-analytics','2019')}}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="{{ (\Request::route()->getName() == 'idea.all'||\Request::route()->getName() == 'idea.view'||\Request::route()->getName() == 'idea.search') ? 'active pcoded-trigger' : '' }}">
                <a href="{{route('idea.all')}}">
                    <span class="pcoded-micon"><i class="far fa-lightbulb"></i></span>
                    <span class="pcoded-mtext">Ideas</span>
                </a>
            </li> 

            <li class="{{ (\Request::route()->getName() == 'topVoter') ? 'active pcoded-trigger' : '' }}">
                <a href="{{route('topVoter')}}">
                    <span class="pcoded-micon"><i class="fas fa-thumbs-up"></i></span>
                    <span class="pcoded-mtext">Top Voters</span>
                </a>
            </li>

            <li class="{{ (\Request::route()->getName() == 'topIdeaSubmitters') ? 'active pcoded-trigger' : '' }}">
                <a href="{{route('topIdeaSubmitters')}}">
                    <span class="pcoded-micon"><i class="fas fa-swatchbook"></i></span>
                    <span class="pcoded-mtext">Top Idea Submitters</span>
                </a>
            </li>
   
                   <li class="pcoded-hasmenu {{ (\Request::route()->getName() == 'users.add'||\Request::route()->getName() == 'users.edit'||\Request::route()->getName() == 'users.all'||\Request::route()->getName() == 'users.search') ? 'active pcoded-trigger' : '' }} " >
                <a href="javascript:void(0)">
                <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                <span class="pcoded-mtext">Users</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ (\Request::route()->getName() == 'users.add') ? 'active' : '' }}">
                        <a href="{{route('users.add')}}">
                        <span class="pcoded-mtext">Add User</span>
                        </a>
                    </li>
                    <li class=" {{ (\Request::route()->getName() == 'users.search'||\Request::route()->getName() == 'users.all') ? 'active' : '' }}">
                        <a href="{{route('users.all')}}">
                        <span class="pcoded-mtext">All Users</span>
                        </a>
                    </li>

                </ul>
            </li>

 

          <li class="pcoded-hasmenu {{ (\Request::route()->getName() == 'roles.add'||\Request::route()->getName() == 'roles.edit'||\Request::route()->getName() == 'roles.all'||\Request::route()->getName() ==
          'roles.search') ? 'active pcoded-trigger' : '' }} " >
                <a href="javascript:void(0)">
                <span class="pcoded-micon"><i class="fas fa-ruler-combined"></i></span>
                <span class="pcoded-mtext">Roles</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ (\Request::route()->getName() == 'roles.add') ? 'active' : '' }}">
                        <a href="{{route('roles.add')}}">
                        <span class="pcoded-mtext">Add Role</span>
                        </a>
                    </li>
                    <li class=" {{ (\Request::route()->getName() == 'roles.search'||\Request::route()->getName() == 'roles.all') ? 'active' : '' }}">
                        <a href="{{route('roles.all')}}">
                        <span class="pcoded-mtext">All Roles</span>
                        </a>
                    </li>

                </ul>
            </li>


           
        </ul>
    </div>
</nav>