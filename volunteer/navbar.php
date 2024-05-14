<!-- <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
 
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

</style> -->
<nav class="main-header navbar navbar-expand  navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars mt-2"></i></a>
        </li>
        <a href="index" class="brand-link">
            <img src="../images/logo2.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">

        </a>


    </ul>




    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-3">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="#" class="d-block">Volunteer</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="v_profile" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p> My Profile

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="edit_v_profile" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i>
                        <p> Edit Profile

                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="manage_users" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p> My Area Users

                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Uncollected Donations
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="manage_food_donation" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Food Donations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="manage_book_donation" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Donations</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Collected Donations
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="total_food_donations" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Food Donations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="total_book_donations" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Donations</p>
                            </a>
                        </li>

                    </ul>
                </li>




                <li class="nav-item">
                    <a href="manage_book_applications" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p> Book Applications

                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="v_changePassword" class="nav-link">
                        <i class="nav-icon fa fa-lock"></i>
                        <p> Change Password

                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="../logout" class="nav-link">
                        <button class="bg-danger" style="padding: 4px 18px;border-radius: 10px;">
                            <i class="nav-icon fas fa-sign-out-alt" style="margin-right: 5px;"></i>Logout
                        </button>
                    </a>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>