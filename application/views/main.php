<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sipekeba | Halaman Administrator</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/skin-yellow.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
    <script>
        var base_url = "<?= base_url() ?>";
    </script>

    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="javascript:;" class="logo">
                <span class="logo-mini"><b>SPKB</b></span>
                <span class="logo-lg"><b>SIPEKEBA</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url() ?>assets/img/logo.png" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?= $this->session->real_name ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?= base_url() ?>assets/img/logo.png" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $this->session->real_name ?>
                                        <small>Administrator</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-info">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout" class="btn btn-danger">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url() ?>assets/img/logo.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?= $this->session->real_name ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li onclick="render_page('dashboard')"><a href="javascript:;"><i class="fa fa-home text-aqua"></i> <span>DASHBOARD</span></a></li>
                    <li onclick="render_page('data_layanan')"><a href="javascript:;"><i class="fa fa-pencil-square-o text-lime"></i> <span>DATA LAYANAN</span></a></li>
                    <li onclick="render_page('data_admin')"><a href="javascript:;"><i class="fa fa-user-plus text-yellow"></i> <span>DATA ADMIN</span></a></li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper" id="main-container"></div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> <?php echo APP_VERSION ?>
            </div>
            <strong>Copyright © <?= date('Y') ?> <a href="/">SIPEKEBA</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url() ?>assets/js/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>assets/js/fastclick.js"></script>
    <script src="<?= base_url() ?>assets/js/adminlte.js"></script>
    <script src="<?= base_url() ?>assets/js/main.js"></script>
    <script>
        render_page('dashboard');
    </script>
</body>

</html>