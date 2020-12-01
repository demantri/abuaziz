<?php 
    $con=new konfig();
    $no_user = $this->session->userdata('no_user');
    $user = $con->dataProfile($no_user);
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php  $this->load->view('template/header'); ?>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Start Left menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img style=" margin-top :15px; width:120px; height: 120px; " class="main-logo" src="<?=base_url();?>assets/img/logo/logo3.png" alt="" /></a>
                <div style="color: black; font-size: 18px;">
                <b>
                
                </b>
            
                </div>
                <!-- <a href="index.html"><img class="main-logo" src="<?=base_url();?>assets/img/logo/logo.png" alt="" /></a> -->
                <strong><a href="index.html"><img src="<?=base_url();?>assets/img/logo/logosn.png" alt="" /></a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <?php  $this->load->view('template/menu'); ?>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="<?=base_url();?>assets/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                    <i class="educate-icon educate-nav"></i>
                                                </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <img src="<?=base_url();?>assets/img/logo/pic.jpg" alt="" />
                                                            <span class="admin-name"><?php echo $this->session->userdata('jabatan');?></span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="#" id="btn-logout"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <?php  $this->load->view('template/menu'); ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list single-page-breadcome">
                                <div class="row">
                                    <?php  $this->load->view('template/breadcrumb'); ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    
                    <?php  $this->load->view($main_view); ?>

                </div>
            </div>
        </div>
        <!-- Static Table End -->
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <?php  $this->load->view('template/footer'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php  $this->load->view('template/script'); ?>
    
    
    <script>
        // $('#harga_barang').number( true, 2,',', '.' );
        $('#btn-logout').click(function() {
            Swal.fire({
              title: 'Apakah Anda Yakin?',
              type: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Keluar',
              cancelButtonText: 'Batal',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                Swal.fire(
                  'Anda Telah Keluar!',
                  'success'
                )
                setTimeout(function(){ window.location.href = "<?php echo site_url('auth/logout'); ?>"; },3000);
              }
            });
        });

        $('select').select2({
            theme: 'bootstrap4',
        });
    </script>
</body>

</html>