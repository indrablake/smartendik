<!DOCTYPE html>
<html>

<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Smarttendik</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Favicon -->
    <link rel="shortcut icon" href="https://simapedu.net/assets/logo.png" type="image/x-icon" />
    <link rel="apple-touch-icon" href="https://simapedu.net/assets/logo.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/css/theme-elements.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/css/theme-blog.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/vendor/rs-plugin/css/navigation.css">

    <!-- Demo CSS -->


    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/css/skins/skin-corporate-6.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontEnd/css/custom.css">

    <!-- Head Libs -->
    <script src="<?php echo base_url() ?>assets/frontEnd/vendor/modernizr/modernizr.min.js"></script>

    <style>
        .menu {
            color: white;
        }
    </style>

</head>

<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}">
    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="body">
        <header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 120, 'stickyHeaderContainerHeight': 70}" style="background-color:#00630E;margin-top:-5px">
            <div class="header-body" style="background-color:#00630E" style="margin-top:-5px">
                <div class="header-container container">
                    <div class="header-row">
                        <div class="header-column">
                            <div class="header-row">
                                <div class="header-logo">
                                    <a href="index.html">
                                        <img alt="Porto" height="80" data-sticky-height="60" src="http://pokjawaspai.org/media_library/images/fe7869ef2a5776317ca34db8838df23a.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="header-column justify-content-end">
                            <div class="header-row">
                                <div class="header-nav header-nav-links order-2 order-lg-1">
                                    <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                        <nav class="collapse">
                                            <ul class="nav nav-pills" id="mainNav">
                                                <li class="dropdown">
                                                    <a class="dropdown-item dropdown-toggle menu active" href="<?php echo base_url() ?>welcome/dashboard">
                                                        Home
                                                    </a>

                                                </li>
                                                <li class="dropdown">
                                                    <a class="dropdown-item dropdown-toggle menu" href="#">
                                                        Profile
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-submenu">
                                                            <a class="dropdown-item menu" href="home">Struktur </a>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item menu" href="<?php echo base_url() ?>welcome/pengurusSurat">Pengurus Surat</a></li>
                                                            </ul>
                                                        <li><a class="dropdown-item menu" href="<?php echo base_url() ?>welcome/visiMisi">Visi & Misi</a></li>
                                                        <li><a class="dropdown-item menu" href="<?php echo base_url() ?>welcome/adart">Anggaran Dasar & Anggaran Rumah Tangga</a></li>
                                                </li>
                                            </ul>
                                            </li>

                                            <li class="dropdown">
                                                <a class="dropdown-item menu" href="#">
                                                    Kontak
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a class=" btn btn-primary dropdown-item menu dropdown-toggle menu" href="<?php echo base_url() ?>welcome/auth">
                                                    Login
                                                </a>
                                                <!-- <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item menu" href="#">Guru</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item menu" href="#">Kepsek</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item menu" href="#">Pengawas</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item menu" href="#">Admin</a>
                                                    </li>
                                                </ul> -->
                                            </li>
                                            <li class="dropdown">
                                                <a class="dropdown-item menu" href="<?php echo base_url() ?>welcome/register">
                                                    Register
                                                </a>
                                            </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </div>
                                <div class="header-nav-features header-nav-features-light header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                    <div class="header-nav-feature header-nav-features-search d-inline-flex">
                                        <a href="#" class="header-nav-features-toggle" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
                                        <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed" id="headerTopSearchDropdown">
                                            <form role="search" action="page-search-results.html" method="get">
                                                <div class="simple-search input-group">
                                                    <input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
                                                    <span class="input-group-append">
                                                        <button class="btn" type="submit">
                                                            <i class="fa fa-search header-nav-top-icon"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>