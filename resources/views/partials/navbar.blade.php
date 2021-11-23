<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/admin/dashboard" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
               <form action="/admin/logout" enctype="multipart/form-data" method="post">
                   @csrf
                   <button class="dropdown-item">
                       <i class="far fa-sign-out mr-2"></i> Logout
                   </button>
               </form>
                <div class="dropdown-divider"></div>

            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
