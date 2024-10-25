<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/images/favicon.png') ?>">
    <title>Survei UMRAH</title>
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/extra-libs/c3/c3.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/libs/chartist/dist/chartist.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') ?>" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?= base_url('dist/css/style.min.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

    <!-- Preloader - style you can find in spinners.css -->

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->
   
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Topbar header - style you can find in pages.scss -->
 
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="/auth/login">
                            Logo Survei Umrah
                            <!-- <img src="../assets/images/freedashDark.svg" alt="" class="img-fluid"> -->
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <!-- Sebelumnya terdapat content notifikasi kemudian di hapus -->
                      
                    </ul>
             
                    <ul class="navbar-nav float-end">
                             <!-- Sebelumnya terdapat content search  kemudian di hapus -->
                      
                   
                        <!-- User profile and search -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="<?= base_url('assets/images/users/profile-pic.jpg') ?>" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ms-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark">Jason Doe</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i data-feather="power"
                                        class="svg-icon me-2 ms-1"></i>
                                    Logout</a>
                                <div class="dropdown-divider"></div>
                                
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
  
        <!-- End Topbar header -->
   
   
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
  
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/auth/login"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <!-- Contoh Sidebar Tidak Bersarang -->
                        <!-- <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Survei Responden</span></li> -->
                      

                        <!-- <li class="sidebar-item"> <a class="sidebar-link" href="ticket-list.html"
                                aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                                    class="hide-menu">Ticket List
                                </span></a>
                        </li> -->
                        <!-- ICON  -->
                        <!-- <i data-feather="file-text" class="feather-icon"></i> -->
                 
                      
                        <!-- Contoh Sidebar Bersarang -->
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Dashboard Admin </span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                    class="hide-menu">  Survei </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                
                                <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                                            class="hide-menu h6"> Tipe Setahun
                                        </span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                                            class="hide-menu h6"> Tipe Pengunjung
                                        </span></a>
                                </li>
                               
                            </ul>
                        </li>
                  
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                                    class="hide-menu"> User Manajemen </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                
                                <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                                            class="hide-menu h6"> Tambah Akun
                                        </span></a>
                                </li>
                                
                               
                            </ul>
                        </li>
                        

                        
                        <li class="list-divider"></li>
                       
                        
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= base_url('auth/logout') ?>"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a>
                        </li>
                                    
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
      
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
   
        <!-- Page wrapper  / MAIN CONTENT -->
   
        <div class="page-wrapper">
            
            
            <?= $this->renderSection('content') ?>
           
            
            <!-- footer -->
          
            <footer class="footer text-center text-muted">
                Copyright © SURVEI UMRAH 2024</a>.
            </footer>
        
        </div>
        <!-- End Page wrapper /MAIN CONTENT -->
     
    </div>

    <!-- End Wrapper -->

    <!-- End Wrapper -->

    <!-- All Jquery -->

    <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="<?= base_url('dist/js/app-style-switcher.js') ?>"></script>
    <script src="<?= base_url('dist/js/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') ?>"></script>
    <script src="<?= base_url('dist/js/sidebarmenu.js') ?>"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('dist/js/custom.min.js') ?>"></script>
    <!--This page JavaScript -->
    <script src="<?= base_url('assets/extra-libs/c3/d3.min.js') ?>"></script>
    <script src="<?= base_url('assets/extra-libs/c3/c3.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/chartist/dist/chartist.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') ?>"></script>
    <script src="<?= base_url('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') ?>"></script>
    <script src="<?= base_url('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <script src="<?= base_url('dist/js/pages/dashboards/dashboard1.min.js') ?>"></script>
</body>

</html>