<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                @if( (isset($auth_user)) && ($auth_user->thumbnailphoto) )
                    <img src="data:image/jpeg;base64, {!! base64_encode( $auth_user->thumbnailphoto ) !!}" class="img-circle" alt="User Image"/>
                @else
                    <img src="{!! URL::asset('node_modules/admin-lte/dist/img/avatar5.png') !!}" class="img-circle" alt="User Image"/>
                @endif
            </div>
            <div class="pull-left info">
                @isset($auth_user)
                    <p> {{ $auth_user->mail }} </p>
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
            
            <!-- li class="header">ACTIVITIES</li -->
            <!-- Optionally, you can add icons to the links -->
            <!-- li class="{!! set_active(['home/']) !!}"><a href="{!! route('home.index') !!}"><i class="fa fa-edit"></i> <span>Home</span></a></li -->
            <li class="header">ACTIVITIES</li>
            <li class="treeview {!! set_active(['home', 'home/*']) !!}">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>3W</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! set_active(['home/tws/create', 'home/tws/create/*']) !!}"><a href="{!! route('tw.create') !!}"> <i class="fa fa-arrow-circle-o-right"></i> Create New</a></li>
                    <li class="{!! set_active(['home/tws/show-created-tws', 'home/tws/show-created-tws/*']) !!}"><a href="{!! route('tw.showCreatedTW') !!}"> <i class="fa fa-arrow-circle-o-right"></i> Assigned To Others</a></li>
                    <li class="{!! set_active(['home/tws/show-owne-tws', 'home/tws/show-owne-tws/*']) !!}"><a href="{!! route('tw.showOwneTW') !!}"> <i class="fa fa-arrow-circle-o-right"></i> Assigned To Me</a></li>
                </ul>
            </li>
            
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    
</aside>