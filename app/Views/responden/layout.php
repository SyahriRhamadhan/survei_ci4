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
    <link rel="stylesheet" href="<?= base_url('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') ?>">
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
                    <div class="navbar-brand d-flex justify-content-center align-items-center">
                        <!-- Logo icon -->
                        <a href="/">
                            <img src="<?= base_url('assets/images/sidebar-logo.png') ?>" alt="Logo" class="img-fluid" style="height: 70px;  width: 80px;">
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
                        <h3 class="fw-bolder text-dark">

                            SURVEI UMRAH
                        </h3>
                    </ul>

                    <ul class="navbar-nav float-end">
                        <!-- Sebelumnya terdapat content search  kemudian di hapus -->


                        <!-- User profile and search -->
                        <li class="nav-item dropdown">

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




                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Menu Utama </span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/responden/dashboard"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu ">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/responden/layanan"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu ">Survei Layanan</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/responden/upps"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu ">Survei UPPS</span></a></li>






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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/popper.js/dist/umd/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="<?= base_url('dist/js/app-style-switcher.js') ?>"></script>
    <script src="<?= base_url('dist/js/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') ?>"></script>
    <script src="<?= base_url('dist/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('assets/extra-libs/sparkline/sparkline.js') ?>"></script>
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

    <!--This page plugins -->
    <script src="<?= base_url('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('dist/js/pages/datatable/datatable-basic.init.js') ?>"></script>
    <script>
        document.getElementById('kategori_responden').addEventListener('change', function() {
            var category = this.value;
            document.getElementById('mahasiswaFields').style.display = category === 'mahasiswa' ? 'block' : 'none';
            document.getElementById('dosenFields').style.display = category === 'dosen' ? 'block' : 'none';
            document.getElementById('tendikFields').style.display = category === 'tendik' ? 'block' : 'none';
        });

        function filterJenisLayanan() {
            const unitLayanan = document.getElementById('unit_layanan').value;
            const jenisLayananSelect = document.getElementById('jenis_layanan_yang_diterima');
            const jenisOptions = document.querySelectorAll('.jenis-option');

            jenisLayananSelect.value = '';
            jenisOptions.forEach(option => {
                option.style.display = option.getAttribute('data-unit') === unitLayanan ? 'block' : 'none';
            });
        }

        function goToDetail() {
            const unitLayanan = document.getElementById('unit_layanan').value;
            const jenisLayananYangDiterima = document.getElementById('jenis_layanan_yang_diterima').value;

            if (unitLayanan && jenisLayananYangDiterima) {
                const url = `<?= base_url('responden/survei/detail') ?>/${jenisLayananYangDiterima}`;
                window.location.href = url;
            } else {
                alert("Silakan pilih Unit Layanan dan Jenis Layanan yang Diterima terlebih dahulu.");
            }
        }
        $(function() {
            <?php if (session()->has('berhasil')): ?>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "success",
                    title: "<?= $_SESSION['berhasil'] ?>"
                });
            <?php endif; ?>
        });

        // Menggunakan event delegation untuk tombol-hapus
        $(document).on('click', '.tombol-hapus', function(e) {
            e.preventDefault(); // Mencegah pengalihan default href
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Data akan dihapus?",
                text: "Proses tidak bisa dikembalikan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#5F76E8",
                cancelButtonColor: "#FF4F70",
                confirmButtonText: "Yaa, Hapus Itu!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = getLink;
                }
            });
        });
    </script>
</body>

</html>