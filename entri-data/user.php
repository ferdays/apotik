<?php
session_start();
include("../system/koneksi.php");
if(!isset($_SESSION['id_user'])){
    header("Location: ../auth/login.php");
}
include("../system/function.php");
$id_user = $_SESSION['id_user'];
$get = mysql_query("SELECT * FROM users WHERE id_user=$id_user");
$get2 = mysql_fetch_array($get);
$jabatan = $get2['role'];
$getmt = mysql_fetch_array(mysql_query("SELECT * FROM pengaturanweb"));
if ($jabatan!="admin") {
    if ($getmt['status']=="mt") {
        header("Location: ../maintenance.php");
    }
}
if ($jabatan!="admin") {
    header("Location: ../");
}
else {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Apotik</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/font.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <nav class="navbar navbar-default navbar-atas navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">APO<span style='color:#F77B6F;'>TIK</span></a>
        </div>
    
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="disabled"><a href="#"></a></li>
                <li class="disabled"><a href="#"></a></li>
                <li class=""><a href="../">Dashboard</a></li>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entri Data <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <?php if ($jabatan=="kasir") {
                        ?>
                        <li><a href="#"><i class='fa fa-plus'></i> Pembelian Obat</a></li>
                        <li><a href="#"><i class='fa fa-plus'></i> Penjualan Obat</a></li>
                        <?php }  else {?>
                        <li><a href="user.php"><i class='fa fa-plus'></i> Tambah User</a></li>
                        <li><a href="supplier.php"><i class='fa fa-plus'></i> Tambah Pemasok</a></li>
                        <li><a href="dokter.php"><i class='fa fa-plus'></i> Tambah Dokter</a></li>
                        <?php } ?>
                        </ul>
                </li>
                <?php } ?>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lihat Data <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <?php if ($jabatan=="admin") {
                        ?>
                        <li><a href="../lihat-data/user.php"><i class='fa fa-folder-open-o'></i> Data User</a></li>
                        <li><a href="../lihat-data/pemasok.php"><i class='fa fa-folder-open-o'></i> Data Pemasok</a></li>
                        <li><a href="../lihat-data/dokter.php"><i class='fa fa-folder-open-o'></i> Data Dokter</a></li>
                        <?php } else { } if ($jabatan=="gudang") {
                        ?>
                        <li><a href="../lihat-data/obat.php"><i class='fa fa-folder-open-o'></i> Data Obat</a></li>
                        <li><a href="../lihat-data/pemasok.php"><i class='fa fa-folder-open-o'></i> Data Pemasok</a></li>
                        <li><a href="../lihat-data/pembelian-obat.php"><i class='fa fa-folder-open-o'></i> Data Pembelian Obat</a></li>
                        <?php } elseif ($jabatan=="kasir") { ?>
                        <li><a href="../lihat-data/obat.php"><i class='fa fa-folder-open-o'></i> Data Obat</a></li>
                        <li><a href="../lihat-data/penjualan-obat.php"><i class='fa fa-folder-open-o'></i> Data Penjualan Obat</a></li>
                        <?php } else { ?>
                        <li><a href="../lihat-data/obat.php"><i class='fa fa-folder-open-o'></i> Data Obat</a></li>
                        <li><a href="../lihat-data/pembelian-obat.php"><i class='fa fa-folder-open-o'></i> Data Pembelian Obat</a></li>
                        <li><a href="../lihat-data/penjualan-obat.php"><i class='fa fa-folder-open-o'></i> Data Penjualan Obat</a></li>
                        <?php } ?>
                        </ul>
                </li>
                <?php } if ($jabatan=="kasir" || $jabatan=="pimpinan") {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#"><i class='fa fa-clock-o'></i> Pembelian Obat Bulanan</a></li>
                        <li><a href="#"><i class='fa fa-print'></i> Rekap Pembelian Obat</a></li>
                        <li><a href="#"><i class='fa fa-clock-o'></i> Penjualan Obat Bulanan</a></li>
                        <li><a href="#"><i class='fa fa-print'></i> Rekap Penjualan Obat</a></li>
                        </ul>
                </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style='text-transform:capitalize;'><?php echo $get2['nama']; ?> <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="../system/logout.php"><i class='fa fa-sign-out'></i> Logout</a></li>
                    </ul>
                </li>
                <li><a href="#"></a></li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid" id="atas">
        <div class="row">
            <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i>  Home</a></li>
                    <li><a href="../#manajemenuser">Manajemen User</a></li>
                    <li class="active">Tambah User</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-statistik-big" style="height:130px;background:#57C8F2;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'>Manajemen User</h1>
                    <p style='color:#FFF;font-weight:300;'>Tambah User</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 fade-in">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-user-plus'></i> Tambah User</p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <form action="../system/sign-up.php" method="POST" role="form">

                        <?php
                        if(!empty($_GET['info'])) {
                               if($_GET['info'] == '1')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-success">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Sukses!</strong> Anda sukses membuat user baru
                                </div>
                                <?php }
                                elseif($_GET['info'] == '2')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Silahkan ulangi password dengan benar
                                </div>
                                <?php }
                                elseif($_GET['info'] == '3')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Anda belum mengulangi password
                                </div>
                                <?php }
                                elseif($_GET['info'] == '4')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Anda belum mengisi password
                                </div>
                                <?php }
                                elseif($_GET['info'] == '5')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Username yang anda masukkan telah digunakan oleh user lain
                                </div>
                                <?php }
                                elseif($_GET['info'] == '6')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Anda belum mengisi username
                                </div>
                                <?php }
                                elseif($_GET['info'] == '7')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Email telah digunakan
                                </div>
                                <?php }
                                elseif($_GET['info'] == '8')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Anda belum mengisi email
                                </div>
                                <?php }
                                elseif($_GET['info'] == '9')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Anda belum mengisi nama
                                </div>
                                <?php }
                            }
                        ?>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="pass" class="form-control" id="" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password">Ulangi Password</label>
                            <input type="password" name="ulangi_pass" class="form-control" id="" placeholder="Ulangi Password">
                        </div>
                        <div class="form-group">
                            <label for="username">Hak Akses</label>
                            <select class="form-control" name="role" id="select" required>
                              <option selected="selected" disabled>Pilih Hak Akses</option>
                              <option value="admin">Admin</option>
                              <option value="kasir">Kasir</option>
                              <option value="gudang">Gudang</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 fade-in">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-user'></i> Lainnya pada menu <strong> Manajemen User </strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <a href="supplier.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#3498DB;">
                                <h1 class='fa fa-user-plus' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Tambah Pemasok</p>
                        </div></a>
                        <a href="dokter.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#306C94;">
                                <h1 class='fa fa-user-md' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Tambah Dokter</p>
                        </div></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-center">&copy; Copyright 2016 <a href="http://ferdays.tk/" style="color:#EEE;" target="_blank">Ferdays.tk</a> <a href="#atas" style='float:right;color:#FFF;'><i class="fa fa-angle-up"></i></a></p>
    </footer>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Custom -->
    <script type="text/javascript">
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
    </script>
    <script type="text/javascript">
    jQuery(function ($) {
        $('.panel-heading span.clickable').on("click", function (e) {
            if ($(this).hasClass('panel-collapsed')) {
                // expand the panel
                $(this).parents('.panel').find('.panel-body').slideDown();
                $(this).removeClass('panel-collapsed');
                $(this).find('i').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
            }
            else {
                // collapse the panel
                $(this).parents('.panel').find('.panel-body').slideUp();
                $(this).addClass('panel-collapsed');
                $(this).find('i').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
            }
        });
    });
    </script>
</body>
</html>
<?php } ?>