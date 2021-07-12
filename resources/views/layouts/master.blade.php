<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">


</head>
 <div id="user_auth" data-user="{{auth()->check()}} "></div>
<body class="hold-transition sidebar-mini" >

<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block p-lg-2">
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <!-- SEARCH FORM -->
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" @click="searchit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </li>
        </ul>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{asset('assets/img/logo2.png')}}" alt="Project Vue Logo"  class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Project Vue</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="image">
                    <img  src="./assets/img/profile/{{auth()->user()->photo}}" class="img-circle elevation-2" id="myImage" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">@if(auth()->check()){{auth()->user()->name}} @endif</a>
                </div>

            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/dashboard"  class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt blue"></i>
                            <p>
                               Dashboard
                         </p>
                        </router-link>
                    </li>
                    @canany(['isAdmin','isAuthor'])
                    <li class="nav-item ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tasks green"></i>
                            <p>
                                Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">

                                <router-link to="/users"  class="nav-link ">
                                    <i class="fas fa-users orange nav-icon"></i>
                                    <p>Users</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-circle nav-icon"></i>
                                    <p>Inactive Page</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcanany
                    @canany(['isAdmin'])
                    <li class="nav-item">
                        <router-link to="/developer"  class="nav-link ">
                            <i class="nav-icon fas fa-cogs blue"></i>
                            <p>
                                Developer
                            </p>
                        </router-link>
                    </li>
                    @endcanany
                    <li class="nav-item">
                        <router-link to="/profile"  class="nav-link ">
                            <i class="nav-icon fas fa-user orange"></i>
                            <p>
                                Profile
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                            <i class="nav-icon fas fa-power-off red"></i>
                            <p>



                                Logout
                            </p>
                            <form id="logout-form"  action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>

    </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

            <div class="container-fluid">
                <!-- route outlet -->
                <!-- component matched by the route will render here -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
@auth
    <script>window.user=@json(auth()->user())</script>
@endauth
<!-- REQUIRED SCRIPTS -->
<script src="{{asset('js/app.js')}}"></script>

<script>
    {{--var user = $('#user_auth').attr('data-user');--}}
    {{--if (user== ' '){--}}
    {{--    window.location.href = "{{route('login')}}"--}}

    {{--}--}}
    Fire.$on('changePhoto',(img)=>{
        document.getElementById("myImage").src = `{{asset('assets/img/profile/')}}/${img}`;

    });

</script>

</body>
</html>
