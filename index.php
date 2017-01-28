<?php
session_start();
include("system/koneksi.php");
if(!isset($_SESSION['id_user'])){
    header("Location: auth/login.php");
}
include("system/function.php");
$id_user = $_SESSION['id_user'];
$get = mysql_query("SELECT * FROM users WHERE id_user=$id_user");
$get2 = mysql_fetch_array($get);
$jabatan = $get2['role'];
$getmt = mysql_fetch_array(mysql_query("SELECT * FROM pengaturanweb"));
if ($jabatan!="admin") {
    if ($getmt['status']=="mt") {
        header("Location: maintenance.php");
    }
}
error_reporting(0);
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
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/font.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
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
                <li class="active"><a href="#">Dashboard</a></li>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entri Data <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <?php if ($jabatan=="gudang") {
                        ?>
                        <li><a href="entri-data/beli-obat.php"><i class='fa fa-plus'></i> Pembelian Obat</a></li>
                        <?php } elseif ($jabatan=="kasir") {
                        ?>
                        <li><a href="entri-data/jual-obat.php"><i class='fa fa-plus'></i> Penjualan Obat</a></li>
                        <?php }   else {?>
                        <li><a href="entri-data/user.php"><i class='fa fa-plus'></i> Tambah User</a></li>
                        <li><a href="entri-data/supplier.php"><i class='fa fa-plus'></i> Tambah Pemasok</a></li>
                        <li><a href="entri-data/dokter.php"><i class='fa fa-plus'></i> Tambah Dokter</a></li>
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
                        <li><a href="lihat-data/user.php"><i class='fa fa-folder-open-o'></i> Data User</a></li>
                        <li><a href="lihat-data/pemasok.php"><i class='fa fa-folder-open-o'></i> Data Pemasok</a></li>
                        <li><a href="lihat-data/dokter.php"><i class='fa fa-folder-open-o'></i> Data Dokter</a></li>
                        <?php } else { } if ($jabatan=="gudang") {
                        ?>
                        <li><a href="lihat-data/obat.php"><i class='fa fa-folder-open-o'></i> Data Obat</a></li>
                        <li><a href="lihat-data/pemasok.php"><i class='fa fa-folder-open-o'></i> Data Pemasok</a></li>
                        <li><a href="lihat-data/pembelian-obat.php"><i class='fa fa-folder-open-o'></i> Data Pembelian Obat</a></li>
                        <?php } elseif ($jabatan=="kasir") { ?>
                        <li><a href="lihat-data/obat.php"><i class='fa fa-folder-open-o'></i> Data Obat</a></li>
                        <li><a href="lihat-data/penjualan-obat.php"><i class='fa fa-folder-open-o'></i> Data Penjualan Obat</a></li>
                        <?php } else { ?>
                        <li><a href="lihat-data/obat.php"><i class='fa fa-folder-open-o'></i> Data Obat</a></li>
                        <li><a href="lihat-data/pembelian-obat.php"><i class='fa fa-folder-open-o'></i> Data Pembelian Obat</a></li>
                        <li><a href="lihat-data/penjualan-obat.php"><i class='fa fa-folder-open-o'></i> Data Penjualan Obat</a></li>
                        <?php } ?>
                        </ul>
                </li>
                <?php } if ($jabatan=="kasir" || $jabatan=="pimpinan" || $jabatan=="gudang") {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <?php if($jabatan=="gudang") { ?>
                        <li><a href="javascript:void(0);"
                               onclick="window.open('print/print-data-obat.php','Print Preview','size=800,height=800,scrollbars=yes,resizeable=no')"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal"><i class='fa fa-clock-o'></i> Pembelian Obat Bulanan</a></li>
                        <li><a href="print/print-rekap-pembelian-obat.php" target="_blank"><i class='fa fa-print'></i> Rekap Pembelian Obat</a></li>
                        <?php } else if ($jabatan=="kasir") {
                        ?>
                        <li><a href="javascript:void(0);"
                               onclick="window.open('print/print-data-obat.php','Print Preview','size=800,height=800,scrollbars=yes,resizeable=no')"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class='fa fa-clock-o'></i> Penjualan Obat Bulanan</a></li>
                        <li><a href="print/print-rekap-penjualan-obat.php" target="_blank"><i class='fa fa-print'></i> Rekap Penjualan Obat</a></li>
                        <?php } else {?>
                        <li><a href="javascript:void(0);"
                               onclick="window.open('print/print-data-obat.php','Print Preview','size=800,height=800,scrollbars=yes,resizeable=no')"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class='fa fa-clock-o'></i> Penjualan Obat Bulanan</a></li>
                        <li><a href="print/print-rekap-penjualan-obat.php" target="_blank"><i class='fa fa-print'></i> Rekap Penjualan Obat</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal"><i class='fa fa-clock-o'></i> Pembelian Obat Bulanan</a></li>
                        <li><a href="print/print-rekap-pembelian-obat.php" target="_blank"><i class='fa fa-print'></i> Rekap Pembelian Obat</a></li>
                        <?php } ?>
                        </ul>
                </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style='text-transform:capitalize;'><?php echo $get2['nama']; ?> <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="system/logout.php"><i class='fa fa-sign-out'></i> Logout</a></li>
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
                    <li class="active">Dashboard</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <?php
        if(!empty($_GET['mt'])) {
            if($_GET['mt'] == '1')
            {
        ?>
        <div class="alert alert-dismissible alert-warning">
          <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
          <p>Mode <strong>Maintenance</strong> telah diaktifkan.</p>
        </div>
        <?php
        } elseif($_GET['mt'] == '2'){
        ?>
        <div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
          <p>Mode <strong>Maintenance</strong> telah dinonaktifkan.</p>
        </div>
        <?php
        }
        }
        if ($getmt['status']=='mt') {
        ?>
        <div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
          <p>Aplikasi sedang berada dalam mode <strong>Maintenance</strong>.</p>
        </div>
        <?php
        }
        if ($jabatan!="admin" && $jabatan!="pimpinan") {
        }
        else {
         ?>
        <div class="row">
            <div class="col-md-6 fade-in">
                <div class="panel-statistik-big" style='background:#99C262;'>
                    <div class="panel-judul-big" style='padding:120px;'>
                        <?php 
                        $hitungpemasukan = mysql_fetch_array(mysql_query("SELECT SUM(total) FROM penjualan"));
                        $pemasukan = $hitungpemasukan['SUM(total)'];
                        $pemasukan2 = number_format($pemasukan,2,",",".");
                        ?>
                        <h1 style='margin:0;font-size:60px;font-weight:100;color:white;'> Rp <?php echo $pemasukan2; ?></h1>
                    </div>
                    <h3 style='margin:15px;text-align:center;font-weight:300;color:#FFF;'>Total Pemasukan Apotik</h3>
                </div>
            </div>
            <div class="col-md-6 fade-in">
                <div class="panel-statistik-big" style='background:#AA4840;'>
                    <div class="panel-judul-big" style='padding:120px;background:#FF6C60;'>
                        <?php 
                        $hitungpengeluaran = mysql_fetch_array(mysql_query("SELECT SUM(total) FROM pembelian"));
                        $pengeluaran = $hitungpengeluaran['SUM(total)'];
                        $pengeluaran2 = number_format($pengeluaran,2,",",".");
                        ?>
                        <h1 style='margin:0;font-size:60px;font-weight:100;color:white;'> Rp <span><?php echo $pengeluaran2; ?></span></h1>
                    </div>
                    <h3 style='margin:15px;text-align:center;font-weight:300;color:#FFF;'>Total Pengeluaran Apotik</h3>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='width:29.5%;background:#99C262;'>
                        <h1 class="fa fa-credit-card" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <h1>
                            Rp.
                            <?php
                                $bulan = date('m');
                                $getdapatbulan = mysql_query("SELECT SUM(subtotal) FROM faktur_penjualan WHERE MONTH(tanggal)='$bulan'");
                                $dapatbulan = mysql_fetch_array($getdapatbulan);
                                echo number_format($dapatbulan['SUM(subtotal)'],2,",",".");
                            ?>
                        </h1>
                        <p>Total Pendapatan Bulan Ini</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='width:29.5%;background:#AA4840;'>
                        <h1 class="fa fa-credit-card-alt" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <h1>
                            Rp.
                            <?php
                                $bulan = date('m');
                                $getdapatbulan = mysql_query("SELECT SUM(subtotal) FROM faktur_pembelian WHERE MONTH(tanggal)='$bulan'");
                                $dapatbulan = mysql_fetch_array($getdapatbulan);
                                echo number_format($dapatbulan['SUM(subtotal)'],2,",",".");
                            ?>
                        </h1>
                        <p>Total Pengeluaran Bulan Ini</p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-3 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='background:#6CCAC9;'>
                        <h1 class="fa fa-users" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <h1 class="count">23</h1>
                        <p>Pembeli Obat</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='background:#57C8F2;'>
                        <h1 class="fa fa-archive" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <?php
                        $hitungobat = mysql_query("SELECT SUM(stok) FROM obat");
                        $dataobat=mysql_fetch_array($hitungobat);
                        ?>
                        <h1 class="count"><?php echo $dataobat['SUM(stok)']; ?></h1>
                        <p>Obat</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='background:#FF6C60;'>
                        <h1 class="fa fa-line-chart" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <?php 
                        $hitungpembelian = mysql_query("SELECT * FROM pembelian");
                        $numpembelian = mysql_num_rows($hitungpembelian);
                        ?>
                        <h1 class="count"><?php echo $numpembelian; ?></h1>
                        <p>Pembelian Obat</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='background:#A9D86E;'>
                        <h1 class="fa fa-line-chart" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <?php 
                        $hitungpenjualan = mysql_query("SELECT * FROM penjualan");
                        $numpenjualan = mysql_num_rows($hitungpenjualan);
                        ?>
                        <h1 class="count"><?php echo $numpenjualan; ?></h1>
                        <p>Penjualan Obat</p>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($jabatan!="admin" && $jabatan!="pimpinan") {

        } else {
        ?>
        <div class="row">
            <div class="col-lg-4 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='width:29.5%;background:#8175C7;'>
                        <h1 class="fa fa-user" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <h1 class="count">1</h1>
                        <p>Admin</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 fade-in">
                <div class="panel-statistik">
                       <div class="panel-judul" style='width:29.5%;background:#FCB322;'>
                        <h1 class="fa fa-spin fa-cog" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <h1 class="count">5</h1>
                        <p>Operator</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 fade-in">
                <div class="panel-statistik">
                    <div class="panel-judul" style='width:29.5%;background:#00A8B3;'>
                        <h1 class="fa fa-wrench" style="margin:0;"></h1>
                    </div>
                    <div class="panel-isi">
                        <h1 class="count">2</h1>
                        <p>Pegawai Gudang</p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-5">
                <div class="panel-statistik-big" style="height:130px;background:#57C8F2;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'>Obat Terlaris</h1>
                    <p style='color:#FFF;font-weight:300;'>
                        <strong><?php
                            $getlaris = mysql_query("SELECT id_obat, COUNT(id_obat) as jumlah FROM faktur_penjualan GROUP BY id_obat ORDER BY jumlah DESC");
                            $laris = mysql_fetch_array($getlaris);
                            $idobat = $laris['id_obat'];
                            $getobat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
                            echo $getobat['nama_obat'];
                        ?></strong> Dengan penjualan sebanyak <?php echo $laris['jumlah']; ?> obat.
                    </p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel-statistik-big" style="height:130px;background:#5B6E84;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'><?php echo date("d"); ?></h1>
                    <h4 style='color:#FFF;font-weight:300;'>
                        <?php echo date("M") ?>
                    </h4>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel-statistik-big" style="height:130px;background:#FF6C60;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'>Obat Kurang Peminat</h1>
                    <p style='color:#FFF;font-weight:300;'>
                        <strong><?php
                            $getlaris = mysql_query("SELECT id_obat, COUNT(id_obat) as jumlah FROM faktur_penjualan GROUP BY id_obat ORDER BY jumlah ASC");
                            $laris = mysql_fetch_array($getlaris);
                            $idobat = $laris['id_obat'];
                            $getobat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
                            echo $getobat['nama_obat'];
                        ?></strong> Dengan penjualan sebanyak <?php echo $laris['jumlah']; ?> obat.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if ($jabatan=="gudang") {
            ?>
            <div class='col-md-12 fade-in'>
            <?php 
            $getobat = mysql_query("SELECT * FROM obat WHERE stok<=20 AND stok!=0");
            while($getobat2 = mysql_fetch_array($getobat)) {
             ?>
            <div class="alert alert-dismissible alert-warning">
              <button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
              <h4>Peringatan!</h4>
              <p>Stok obat <strong><?php echo $getobat2['nama_obat']; ?></strong> tersisa <?php echo $getobat2['stok']; ?> lagi, segera tambah stok obat pada supplier</p>
            </div>
            <?php
            }
            $getobat = mysql_query("SELECT * FROM obat WHERE stok=0");
            while($getobat2 = mysql_fetch_array($getobat)) {
             ?>
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
              <h4>Peringatan!</h4>
              <p>Stok obat <strong><?php echo $getobat2['nama_obat'] ?></strong> HABIS, segera tambah stok obat pada supplier </p>
            </div>
            <?php
            }
            date_default_timezone_set("Asia/Pontianak");
            $hariini = date("Y"."-"."m"."-"."d"." "."H".":"."i".":"."s");
            $getkadaluarsa = mysql_query("SELECT * FROM obat WHERE kadaluarsa<'$hariini'");
            while ($kadaluarsa = mysql_fetch_array($getkadaluarsa)) {
            ?>
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
              <h4>Peringatan!</h4>
              <p>Obat <strong><?php echo $kadaluarsa['nama_obat'] ?></strong> SUDAH KADALUARSA </p>
            </div>
            <?php } } ?>
            <div class="col-lg-6 fade-in">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p style='margin:0;'>Transaksi Pembelian Obat <strong>Hari Ini</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                        <h5 class="pull-right">
                            <?php
                            date_default_timezone_set("Asia/Pontianak");
                            $namabulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            echo date("d") . " ";
                            $bulan = date("m") - 1;
                            echo $namabulan[$bulan] . " " . date("Y");
                            ?>
                        </h5>
                        <?php
                        $hari = date("d");
                        $gettime = mysql_query("SELECT * FROM faktur_pembelian WHERE DAY(tanggal)='$hari'");
                        while($time2 = mysql_fetch_array($gettime)){
                        $time = $time2['tanggal'];
                        ?>
                        <div class="activity terques">
                            <span>
                                <i class="fa fa-shopping-cart"></i>
                            </span>
                            <div class="activity-desk">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="arrow"></div>
                                        <i class=" fa fa-clock-o"></i>
                                        <h4>
                                            <?php 
                                                echo $time = date("H:i",strtotime($time));
                                            ?>
                                        </h4>
                                        <p>
                                            Pembelian <strong><?php echo $time2['jumlah']; ?>
                                            <?php
                                                $idobat = $time2['id_obat'];
                                                $getobat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
                                                echo $getobat['nama_obat'];
                                            ?></strong>
                                            dari pemasok oleh
                                            <strong>
                                                <?php
                                                $iduser = $time2['id_user'];
                                                $getuser = mysql_query("SELECT * FROM users WHERE id_user=$iduser");
                                                $user = mysql_fetch_array($getuser);
                                                echo $user['nama'];
                                                ?>
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="col-md-12">
                                <div class="panel-statistik-big" style="height:130px;background:#8DD7D6;padding:10px;text-align:center;">
                                    <h1 style='color:#FFF;font-weight:300;'>
                                        Rp.
                                        <?php
                                            $getdapathari = mysql_query("SELECT SUM(subtotal) FROM faktur_pembelian WHERE DAY(tanggal)=$hari");
                                            $dapathari = mysql_fetch_array($getdapathari);
                                            echo number_format($dapathari['SUM(subtotal)'],2,",",".");              
                                        ?>
                                    </h1>
                                    <p style='color:#FFF;font-weight:300;'>
                                        Pengeluaran Hari Ini
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 fade-in">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p style='margin:0;'>Transaksi Penjualan Obat Umum <strong>Hari Ini</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                        <h5 class="pull-right">
                            <?php
                            date_default_timezone_set("Asia/Pontianak");
                            $namabulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            echo date("d") . " ";
                            $bulan = date("m") - 1;
                            echo $namabulan[$bulan] . " " . date("Y");
                            ?>
                        </h5>
                        <?php
                        $gettime2 = mysql_query("SELECT * FROM faktur_penjualan WHERE DAY(tanggal)='$hari'");
                        while ($penjualan=mysql_fetch_array($gettime2)) {
                            $waktu = $penjualan['tanggal'];
                        ?>
                        <div class="activity alt blue">
                            <span>
                                <i class="fa fa-tags"></i>
                            </span>
                            <div class="activity-desk">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="arrow-alt"></div>
                                        <i class=" fa fa-clock-o"></i>
                                        <h4>
                                            <?php 
                                                echo $waktu = date("H:i",strtotime($waktu));
                                            ?>
                                        </h4>
                                        <p>
                                            Penjualan
                                            <strong>
                                                <?php
                                                    echo $penjualan['jumlah'];
                                                    echo ' ';
                                                    $idobat = $penjualan['id_obat'];
                                                    $obat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
                                                    echo $obat['nama_obat'];
                                                ?>
                                            </strong> 
                                            kepada konsumen oleh
                                            <strong>
                                                <?php
                                                    $iduser = $penjualan['id_user'];
                                                    $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id_user=$iduser"));
                                                    echo $user['nama'];
                                                ?>
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-md-12">
                                <div class="panel-statistik-big" style="height:130px;background:#90B4E6;padding:10px;text-align:center;">
                                    <h1 style='color:#FFF;font-weight:300;'>
                                        Rp.
                                        <?php
                                            $getjualhari = mysql_query("SELECT SUM(subtotal) FROM faktur_penjualan WHERE DAY(tanggal)=$hari");
                                            $jualhari = mysql_fetch_array($getjualhari);
                                            echo number_format($jualhari['SUM(subtotal)'],2,",",".");              
                                        ?>
                                    </h1>
                                    <p style='color:#FFF;font-weight:300;'>
                                        Pendapatan Hari Ini Berdasarkan Obat Umum
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($jabatan=="kasir" || $jabatan=="gudang") {
            ?>
            <div class="col-lg-6 fade-in">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-sign-in'></i> Entri Data Transaksi</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <?php if ($jabatan=="kasir") {
                        } else {?>
                        <a href="entri-data/beli-obat.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#57C8F2;">
                                <h1 class='fa fa-credit-card' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Pembelian Obat</p>
                        </div></a>
                        <?php } if ($jabatan=="gudang") {
                        } else {?>
                        <a href="entri-data/jual-obat.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#FCB322;">
                                <h1 class='fa fa-credit-card-alt' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Penjualan Obat</p>
                        </div></a>
                        <?php } ?>
                    </div>
                    </div>
                </div>
            </div>
            <?php } else if($jabatan=="admin"){ ?>
            <div class="col-lg-6 fade-in" id="manajemenuser">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-user'></i> Manajemen User</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <a href="entri-data/user.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#57C8F2;">
                                <h1 class='fa fa-user-plus' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Tambah User</p>
                        </div></a>
                        <a href="entri-data/supplier.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#3498DB;">
                                <h1 class='fa fa-user-plus' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Tambah Pemasok</p>
                        </div></a>
                        <a href="entri-data/dokter.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#306C94;">
                                <h1 class='fa fa-user-md' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Tambah Dokter</p>
                        </div></a>
                    </div>
                    </div>
                </div>
            </div>
            <?php } if ($jabatan=="pimpinan") {
            } else {?>
            <div class="col-lg-6 fade-in">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-search'></i> Lihat Data</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <?php if ($jabatan!="admin") {
                        } else {?>
                        <a href="lihat-data/user.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#00A8B3;">
                                <h1 class='fa fa-users' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data User</p>
                        </div></a>
                        <a href="lihat-data/dokter.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#00A8B3;">
                                <h1 class='fa fa-user-md' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Dokter</p>
                        </div></a>
                        <?php } if ($jabatan=="gudang" || $jabatan=="admin") {
                        ?>
                        <a href="lihat-data/pemasok.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#00A8B3;">
                                <h1 class='fa fa-user' style='margin:0;'></h1> 
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Pemasok</p>
                        </div></a>
                        <?php } ?>
                        <a href="lihat-data/obat.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#A9D86E;">
                                <h1 class='fa fa-archive' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Obat</p>
                        </div></a>
                        <?php if($jabatan=="kasir") { } else { ?>
                        <a href="lihat-data/pembelian-obat.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#8175C7;">
                                <h1 class='fa fa-line-chart' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Pembelian Obat</p>
                        </div></a>
                        <?php } if ($jabatan=="gudang") {
                        } else {?>
                        <a href="lihat-data/penjualan-obat.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#FF6C60;">
                                <h1 class='fa fa-line-chart' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Semua Penjualan Obat</p>
                        </div></a>
                        <!-- <a href="lihat-data/penjualan-obat-resep.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#B984DC;">
                                <h1 class='fa fa-medkit' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Penjualan Obat Resep</p>
                        </div></a>-->
                        <?php } if ($jabatan!="admin") {
                        } else { ?>
                        <a href="http://localhost/phpmyadmin/db_structure.php?db=apotik" target="_blank"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#428BCA;">
                                <h1 class='fa fa-database' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Buka phpmyadmin <i class='fa fa-external-link'></i></p>
                        </div></a>
                        <?php } ?>
                    </div>
                    </div>
                </div>
            </div>
            <?php } if ($jabatan=="kasir" || $jabatan=="pimpinan" || $jabatan=="gudang") {
            ?>
            <div class="col-lg-6 fade-in" id="print">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-print'></i> Laporan</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <a href="javascript:void(0);"
                           onclick="window.open('print/print-data-obat.php','Print Preview','size=800,height=800,scrollbars=yes,resizeable=no')"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#2980b9;">
                                <h1 class='fa fa-archive' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Stok Obat</p>
                        </div></a>
                        <?php if ($jabatan=="kasir") {
                        } else {?>
                        <a href="#" data-toggle="modal" data-target="#myModal"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#27ae60;">
                                <h1 class='fa fa-clock-o' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Pembelian Obat Bulanan</p>
                        </div></a>
                        <a href="print/print-rekap-pembelian-obat.php" target="_blank"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#2ecc71;">
                                <h1 class='fa fa-object-group' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Rekap Pembelian Obat</p>
                        </div></a>
                        <?php } if ($jabatan=="gudang") {
                        } else {?>
                        <a href="#" data-toggle="modal" data-target="#myModal2"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#c0392b;">
                                <h1 class='fa fa-clock-o' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Penjualan Obat Bulanan</p>
                        </div></a>
                        <a href="print/print-rekap-penjualan-obat.php" target="_blank"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#e74c3c;">
                                <h1 class='fa fa-object-group' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Rekap Penjualan Semua Obat</p>
                        </div></a>
                        <!-- <a href="#" data-toggle="modal" data-target="#myModal3"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#B984DC;">
                                <h1 class='fa fa-clock-o' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Penjualan Obat Resep Bulanan</p>
                        </div></a>
                        <a href="print/print-rekap-penjualan-obat-resep.php" target="_blank"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#7B5892;">
                                <h1 class='fa fa-object-group' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Rekap Penjualan Obat Resep</p>
                        </div></a> -->
                        <?php } ?>
                    </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-lg-6 fade-in">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-gears'></i> Pengaturan</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <a href="pengaturan/change-password.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#E56155;">
                                <h1 class='fa fa-wrench' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Ubah Password</p>
                        </div></a>
                        <?php if ($jabatan!="admin") {
                        } else {
                        if ($getmt['status']=="active") {
                        ?>
                        <a href="system/maintenance.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#E43725;">
                                <h1 class='fa fa-power-off' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Aktifkan Mode Maintenance</p>
                            <input type="hidden" name="info" value="mt">
                        </div></a>
                        <?php } elseif ($getmt['status']=="mt") {
                        ?>
                        <a href="system/maintenance-o.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#18BC9C;">
                                <h1 class='fa fa-power-off' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Nonaktifkan Mode Maintenance</p>
                            <input type="hidden" name="info" value="mt">
                        </div></a>
                        <?php
                        } } ?>
                    </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6 fade-in">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-gg'></i> Ekstra</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <a href="#"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#6BB9F0;">
                                <h1 class='fa fa-bullhorn' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Buat Pengumuman</p>
                        </div></a>
                        <a href="#"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#E87E04;">
                                <h1 class='fa fa-bell-o' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Notifikasi</p>
                        </div></a>
                        <a href="#"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#3CC051;">
                                <h1 class='fa fa-envelope-o' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Pesan</p>
                        </div></a>
                    </div>
                    </div>
                </div>
            </div> -->
        </div>
        <br>
    </div>
    <footer>
        <p class="text-center">&copy; Copyright 2016 <a href="http://ferdays.tk/" style="color:#EEE;" target="_blank">Ferdays.tk</a> <a href="#atas" style='float:right;color:#FFF;'><i class="fa fa-angle-up"></i></a></p>
    </footer>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Laporan Pembelian Obat Bulanan</h4>
          </div>
          <div class="modal-body">
            <form action="print/print-pembelian-bulanan.php" method="POST" role="form" target="_blank">
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select id="bulan" class="form-control" name="bulan">
                        <option selected="selected" disabled>Pilih Bulan</option>
                        <option value="0">Januari</option>
                        <option value="1">Februari</option>
                        <option value="2">Maret</option>
                        <option value="3">April</option>
                        <option value="4">Mei</option>
                        <option value="5">Juni</option>
                        <option value="6">Juli</option>
                        <option value="7">Agustus</option>
                        <option value="8">September</option>
                        <option value="9">Oktober</option>
                        <option value="10">November</option>
                        <option value="11">Desember</option>
                    </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Lihat</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
          </form>
        </div>

      </div>
    </div>
    </div>

    <!-- Modal -->
    <div id="myModal2" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Laporan Penjualan Obat Bulanan</h4>
          </div>
          <div class="modal-body">
            <form action="print/print-penjualan-bulanan.php" method="POST" role="form" target="_blank">
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select id="bulan" class="form-control" name="bulan">
                        <option selected="selected" disabled>Pilih Bulan</option>
                        <option value="0">Januari</option>
                        <option value="1">Februari</option>
                        <option value="2">Maret</option>
                        <option value="3">April</option>
                        <option value="4">Mei</option>
                        <option value="5">Juni</option>
                        <option value="6">Juli</option>
                        <option value="7">Agustus</option>
                        <option value="8">September</option>
                        <option value="9">Oktober</option>
                        <option value="10">November</option>
                        <option value="11">Desember</option>
                    </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Lihat</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
          </form>
        </div>

      </div>
    </div>
    </div>

    <!-- Modal -->
    <div id="myModal3" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Laporan Penjualan Obat Resep Bulanan</h4>
          </div>
          <div class="modal-body">
            <form action="print/print-penjualan-bulanan-resep.php" method="POST" role="form" target="_blank">
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select id="bulan" class="form-control" name="bulan">
                        <option selected="selected" disabled>Pilih Bulan</option>
                        <option value="0">Januari</option>
                        <option value="1">Februari</option>
                        <option value="2">Maret</option>
                        <option value="3">April</option>
                        <option value="4">Mei</option>
                        <option value="5">Juni</option>
                        <option value="6">Juli</option>
                        <option value="7">Agustus</option>
                        <option value="8">September</option>
                        <option value="9">Oktober</option>
                        <option value="10">November</option>
                        <option value="11">Desember</option>
                    </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Lihat</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
          </form>
        </div>

      </div>
    </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

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