<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::asset('node_modules/admin-lte/dist/img/avatar5.png') }}" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                @isset($auth_user)
                    <p> {{ $auth_user->email }} </p>
                @endisset
                <!-- p>user</p -->
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            
            <li class="header">ACTIVITIES</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{ set_active(['meeting']) }}"><a href="#"><i class="fa fa-edit"></i> <span>MEETING</span></a></li>
            <li class="{{ set_active(['tw']) }}"><a href="#"><i class="fa fa-edit"></i> <span>3W</span></a></li>
            <li class="header">ACTIVITIES</li>
            <li class="treeview {{ set_active(['config', 'config/*']) }}">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Configuration</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ set_active(['config/user', 'config/user/*']) }}"><a href="{{ url('/config/user') }}"><i class="fa fa-circle-o"></i> User</a></li>
                    <li class="{{ set_active(['config/department', 'config/department/*']) }}"><a href="{{ url('/config/department') }}"><i class="fa fa-circle-o"></i> Department</a></li>
                    <li class="{{ set_active(['config/location', 'config/location/*']) }}"><a href="{{ url('/config/location') }}"><i class="fa fa-circle-o"></i> Location</a></li>
                    <li class="{{ set_active(['config/meeting_type', 'config/meeting_type/*']) }}"><a href="{{ url('/config/meeting_type') }}"><i class="fa fa-circle-o"></i> Meeting Type</a></li>
                    <li class="{{ set_active(['config/meeting_group', 'config/meeting_group/*']) }}"><a href="{{ url('/config/meeting_group') }}"><i class="fa fa-circle-o"></i> Meeting Group</a></li>
                </ul>
            </li>
            
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    
</aside>