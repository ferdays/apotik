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
if ($jabatan!="kasir") {
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
    <link href="../css/bootstrap-select.min.css" rel="stylesheet">

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
                <li><a href="../">Dashboard</a></li>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entri Data <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <?php if ($jabatan=="gudang") {
                        ?>
                        <li><a href="../entri-data/beli-obat.php"><i class='fa fa-plus'></i> Pembelian Obat</a></li>
                        <?php } elseif ($jabatan=="kasir") {
                        ?>
                        <li class="active"><a href="../entri-data/jual-obat.php"><i class='fa fa-plus'></i> Penjualan Obat</a></li>
                        <?php }   else {?>
                        <li><a href="../entri-data/user.php"><i class='fa fa-plus'></i> Tambah User</a></li>
                        <li><a href="../entri-data/supplier.php"><i class='fa fa-plus'></i> Tambah Pemasok</a></li>
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
                        <li><a href="#"><i class='fa fa-folder-open-o'></i> Data User</a></li>
                        <li><a href="#"><i class='fa fa-folder-open-o'></i> Data Pemasok</a></li>
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
                        <li><a href=""><i class='fa fa-folder-open-o'></i> Data Pembelian Obat</a></li>
                        <li><a href="#"><i class='fa fa-folder-open-o'></i> Data Penjualan Obat</a></li>
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
                               onclick="window.open('../print/print-data-obat.php','Print Preview','size=800,height=800,scrollbars=yes,resizeable=no')"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal"><i class='fa fa-clock-o'></i> Pembelian Obat Bulanan</a></li>
                        <li><a href="../print/print-rekap-pembelian-obat.php" target="_blank"><i class='fa fa-print'></i> Rekap Pembelian Obat</a></li>
                        <?php } else if ($jabatan=="kasir") {
                        ?>
                        <li><a href="javascript:void(0);"
                               onclick="window.open('../print/print-data-obat.php','Print Preview','size=800,height=800,scrollbars=yes,resizeable=no')"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class='fa fa-clock-o'></i> Penjualan Obat Bulanan</a></li>
                        <li><a href="../print/print-rekap-penjualan-obat.php" target="_blank"><i class='fa fa-print'></i> Rekap Penjualan Obat</a></li>
                        <?php } else {?>
                        <li><a href="#"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#"><i class='fa fa-clock-o'></i> Penjualan Obat Bulanan</a></li>
                        <li><a href="#"><i class='fa fa-print'></i> Rekap Penjualan Obat</a></li>
                        <li><a href="#"><i class='fa fa-clock-o'></i> Pembelian Obat Bulanan</a></li>
                        <li><a href="#"><i class='fa fa-print'></i> Rekap Pembelian Obat</a></li>
                        <?php } ?>
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
                    <li><a href="../#manajemenuser">Entri Data</a></li>
                    <li class="active">Jual Obat</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-statistik-big" style="height:130px;background:#FCB322;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'>Entri Data</h1>
                    <p style='color:#FFF;font-weight:300;'>Penjualan Obat Kepada Pembeli</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                          <li class="active"><a aria-expanded="true" href="#home" data-toggle="tab">Obat Umum</a></li>
                          <li><a aria-expanded="false" href="#profile" data-toggle="tab">Resep Dokter</a></li>
                        </ul>
                        <span class="tools pull-right">
                        <span class="pull-right clickable" style='margin-top:-25px;'><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                    <?php
                        if(!empty($_GET['info'])) {
                               if($_GET['info'] == '1')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <p><strong>Gagal!</strong> Stok obat tidak cukup.</p>
                                </div>
                                <?php
                            }
                            }
                        ?> 
                    <form action="../system/keranjang-jual.php" method="POST" role="form">
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-md-12'>
                                    <label for="nama">Nama Obat</label>
                                    <select id="nama" name="nama" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0" disabled selected>Pilih Obat</option>
                                    <?php date_default_timezone_set("Asia/Pontianak"); $hariini = date("Y"."-"."m"."-"."d"." "."H".":"."i".":"."s"); $listobat = mysql_query("SELECT * FROM obat WHERE resep='0' AND kadaluarsa>'$hariini' ORDER BY id_obat DESC");
                                    while($data=mysql_fetch_array($listobat)){
                                    $data2 = json_encode($data);
                                    $decode = json_decode($data2);
                                    echo'<option value="'.$decode->id_obat.'" stok="'.$decode->stok.'">'.$decode->nama_obat.'</option>';
                                    } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Stok</label>
                            <input type="text" name="jumlah" class="form-control" id="stok" placeholder="Stok Obat" value="" disabled="disabled">
                            <input type="hidden" name="id_user" value="<?php echo $get2['id_user'] ?>">
                        </div>
                        <div class="form-group <?php if(!empty($_GET['info'])) {if($_GET['info'] == '1'){?>has-error <?php } } ?>">
                            <label for="nama">Jumlah Beli</label>
                            <input type="text" name="jumlah" class="form-control" id="" placeholder="Jumlah Beli">
                            <input type="hidden" name="id_user" value="<?php echo $get2['id_user'] ?>">
                        </div>
                        <p><button type="submit" class="btn btn-info"><i class='fa fa-cart-plus'></i> Tambahkan Ke Keranjang</button></p>
                    </form>
                    </div>

                    <div class="tab-pane fade in" id="profile">
                    <form action="../system/keranjang-jual.php" method="POST" role="form">
                        <div id="wrap">
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-md-12'>
                                    <label for="nama" style="width:100%;">Nama Obat <a class='label label-danger' style='float:right;'><i class='fa fa-close'></i></a></label>
                                    <select id="nama2" name="nama" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0" disabled selected>Pilih Obat</option>
                                    <?php $listobat = mysql_query("SELECT * FROM obat WHERE kadaluarsa>'$hariini' ORDER BY id_obat DESC");
                                    while($data=mysql_fetch_array($listobat)){
                                    $data2 = json_encode($data);
                                    $decode = json_decode($data2);
                                    echo'<option value="'.$decode->id_obat.'" stok2="'.$decode->stok.'" satuan="'.$decode->satuan.'">'.$decode->nama_obat.'</option>';
                                    } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Stok</label>
                            <input type="text" name="jumlah" class="form-control" id="stok2" placeholder="Stok Obat" value="" disabled="disabled">
                            <input type="hidden" name="id_user" value="<?php echo $get2['id_user'] ?>">
                        </div>
                        <div class="form-group">
                            <div class='row'>
                            <div class='col-md-7'>
                            <label for="nama">Jumlah Beli</label>
                            <input type="text" name="jumlah" class="form-control" id="" placeholder="Jumlah Beli">
                            <input type="hidden" name="id_user" value="<?php echo $get2['id_user'] ?>">
                            </div>
                            <div class='col-md-5'>
                            <label for="nama">&nbsp;</label>
                            <input class="form-control" type"text" id="satuan" value="" disabled="disabled">
                            <input name="resep" value="1" type="hidden">
                            </div>
                            </div>
                        </div>
                        </div>
                        <p>
                            <button type="submit" class="btn btn-info"><i class='fa fa-cart-plus'></i> Tambahkan Ke Keranjang</button>
                        </p>
                    </form>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-shopping-basket'></i> Keranjang Umum</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                        <form action="../system/jual-obat-umum.php" method="POST">
                        <?php
                        $carikodeumum = mysql_query("SELECT MAX(no_faktur) FROM penjualan");
                        $kodekodeumum = mysql_fetch_array($carikodeumum);
                        if ($kodekodeumum) {
                         $nilaikodeumum = substr($kodekodeumum[0], 4);
                         $kodeumum = (int) $nilaikodeumum;
                         $kodeumum = $kodeumum + 1;
                         $hasilkodeumum = "POU-".str_pad($kodeumum, 3, "0", STR_PAD_LEFT);
                        } else {
                         $hasilkodeumum = "POU-001";
                        }
                        ?>
                        <div class="form-group">
                            <input class="form-control" name="nofaktur" value="<?php echo $hasilkodeumum; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="namapasien" placeholder="Masukkan Nama Pasien">
                        </div>
                        <div class="form-group">
                            <select id="nama" name="iddokter" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                            <option value="0" disabled selected>Pilih Dokter</option>
                            <?php $listdokter = mysql_query("SELECT * FROM dokter ORDER BY id_dokter DESC");
                            while($datadokter=mysql_fetch_array($listdokter)){
                            $data = json_encode($datadokter);
                            $decode = json_decode($data);
                            echo'<option value="'.$decode->id_dokter.'">'.$decode->nama.'</option>';
                            } ?>
                            </select>
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Resep</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php
                                $hitungharga = mysql_query("SELECT * FROM keranjang WHERE tipe='jual' AND id_dokter='0'");
                                $totalbayar = 0;    
                                while ($data=mysql_fetch_array($hitungharga)) {
                                $hargaobat2 = $data['harga_beli'];
                                $stokobat = $data['jumlah'];
                                $totalbayar = $totalbayar + ($hargaobat2 * $stokobat);
                                $tanggalbeli = $data['tanggal_beli'];
                                }
                                ?>
                                <th colspan="5" class='text-right'><a onclick='location.reload(true);' style="text-decoration:none;cursor:pointer;"><span class="label label-warning"><i class="fa fa-refresh"></i> Refresh</span></a> Total Pembelian</th>
                                <th>Rp. <?php $totalbayar2 = number_format($totalbayar,2,",","."); echo $totalbayar2; ?> <input type="hidden" name="totalbayar" value="<?php echo $totalbayar; ?>"> <input type="hidden" name="tanggalbeli" value="<?php echo $tanggalbeli; ?>"> <input type="hidden" name="id_supplier" value="<?php echo $id_supplier; ?>"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody id="responds">
                                <?php
                                    $no=1;
                                    $getkeranjang = mysql_query("SELECT * FROM keranjang WHERE tipe='jual'");
                                    while ($keranjang=mysql_fetch_array($getkeranjang)) {
                                    $hargaobat = $keranjang['harga_beli'];
                                    $jumlah = $keranjang['jumlah'];
                                    $total = $hargaobat * $jumlah;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                        <?php
                                        $idobat = $keranjang['id_obat'];
                                        $obat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
                                        echo $obat['nama_obat'];
                                        ?> <input type="hidden" name="idobat[]" value="<?php echo $idobat; ?>">
                                    </td>
                                    <td>
                                        <?php
                                            if ($keranjang['resep']==0) {
                                                echo "Tanpa Resep";
                                            }
                                            elseif ($keranjang['resep']==1) {
                                                echo "Menggunakan Resep";
                                            }
                                        ?>
                                        <input type="hidden" name="resep[]" value="<?php echo $keranjang['resep']; ?>">
                                    </td>
                                    <td>Rp. <?php $harga = $keranjang['harga_beli']; $harga2 = number_format($harga,2,",","."); echo $harga2; ?> <input type="hidden" name="harga[]" value="<?php echo $keranjang['harga_beli']; ?>"></td>
                                    <td><?php echo $keranjang['jumlah']; ?> <input type="hidden" name="jumlah[]" value="<?php echo $keranjang['jumlah']; ?>"></td>
                                    <td>Rp. <?php $total2 = number_format($total,2,",","."); echo $total2; ?> <input type="hidden" name="id_user" value="<?php echo $keranjang['id_user']; ?>"> <input type="hidden" name="tanggal" value="<?php echo $keranjang['tanggal_beli']; ?>"> <input type="hidden" name="subtotal[]" value="<?php echo $total; ?>"></td>
                                    <td class='text-center'>
                                        <a href="../system/delete-keranjang.php?id=<?php echo $keranjang['id_keranjang']; ?>"><span class="label label-danger"><i class='fa fa-remove' data-toggle="tooltip" data-placement="top" data-original-title="Hapus"></i></span></a>
                                    </td>
                                </tr>
                                <?php 
                                $no++; }
                                ?>
                        </tbody>
                    </table>

                    <div class="row">
                        <?php 
                        $cek = mysql_query("SELECT * FROM keranjang WHERE tipe='jual' AND id_dokter='0'");
                        $cekada = mysql_num_rows($cek);
                        if ($cekada > 0) {
                            ?>
                        <?php
                        if(!empty($_GET['info'])) {
                               if($_GET['info'] == '2')
                                {
                                ?>
                                <div class='col-md-12'>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <p><strong>Gagal!</strong> Uangnya kurang mz.</p>
                                </div>
                                </div>
                                <?php
                            }
                            }
                        ?> 
                        <div class='col-md-6'>
                            <div class="form-group">
                              <label>Total Pembelian</label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input class="transaksi form-control total" type="text" disabled="disabled" value="<?php echo $totalbayar; ?>">
                              </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group <?php if(!empty($_GET['info'])) {if($_GET['info'] == '2'){?>has-error <?php } } ?>">
                              <label>Bayar <b class='text-danger'>*</b></label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input name="bayar" class="transaksi form-control bayar" type="text" required>
                              </div>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                              <label>Kembalian</label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input name="kembalian" id="kembalian" class="form-control" type="text" readonly>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-7"><button href="#" type="submit" class='btn btn-success' style="width:100%;"><p style="margin:0;">Lanjutkan Transaksi</p></button></div>
                        <div class="col-md-5"><a href="../system/delete-keranjang.php?id=all" type="button" class='btn btn-danger' style="width:100%;">Batal</a></div>
                        <?php } ?>
                    </div>
                    </form>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-shopping-basket'></i> Keranjang Resep</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                        <form action="../system/jual-obat-resep.php" method="POST">
                            <?php
                            $cariresep = mysql_query("SELECT MAX(no_resep) FROM penjualan_resep");
                            $koderesep = mysql_fetch_array($cariresep);
                            if ($koderesep) {
                             $nilaikoderesep = substr($koderesep[0], 4);
                             $koderesep = (int) $nilaikoderesep;
                             $koderesep = $koderesep + 1;
                             $hasilkoderesep = "RSP-".str_pad($koderesep, 3, "0", STR_PAD_LEFT);
                            } else {
                             $hasilkode = "RSP-001";
                            }
                            ?>
                        <div class="form-group">
                            <input class="form-control" name="idresep" value="<?php echo $hasilkoderesep; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="namapasien" class="form-control" placeholder="Masukkan Nama Pasien">
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="success">
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php
                                $hitungharga = mysql_query("SELECT * FROM keranjang WHERE tipe='jual' AND id_dokter!='0'");
                                $totalbayar = 0;    
                                while ($data=mysql_fetch_array($hitungharga)) {
                                $hargaobat2 = $data['harga_beli'];
                                $stokobat = $data['jumlah'];
                                $totalbayar = $totalbayar + ($hargaobat2 * $stokobat);
                                $tanggalbeli = $data['tanggal_beli'];
                                }
                                ?>
                                <th colspan="4" class='text-right'><a onclick='location.reload(true);' style="text-decoration:none;cursor:pointer;"><span class="label label-warning"><i class="fa fa-refresh"></i> Refresh</span></a> Total Pembelian</th>
                                <th>Rp. <?php $totalbayar2 = number_format($totalbayar,2,",","."); echo $totalbayar2; ?> <input type="hidden" name="totalbayar" value="<?php echo $totalbayar; ?>"> <input type="hidden" name="tanggalbeli" value="<?php echo $tanggalbeli; ?>"> <input type="hidden" name="id_supplier" value="<?php echo $id_supplier; ?>"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody id="responds">
                            <form action="../system/jual-obat-resep.php" method="POST">
                                <?php
                                    $no=1;
                                    $getkeranjang = mysql_query("SELECT * FROM keranjang WHERE tipe='jual' AND id_dokter!='0'");
                                    while ($keranjang=mysql_fetch_array($getkeranjang)) {
                                    $hargaobat = $keranjang['harga_beli'];
                                    $jumlah = $keranjang['jumlah'];
                                    $total = $hargaobat * $jumlah;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                        <?php
                                        $idobat = $keranjang['id_obat'];
                                        $obat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
                                        echo $obat['nama_obat'];
                                        ?> <input type="hidden" name="idobat[]" value="<?php echo $idobat; ?>"> <input type="hidden" name="iddokter" value="<?php echo $keranjang['id_dokter']; ?>">
                                    </td>
                                    <td>Rp. <?php $satuan2 = number_format($keranjang['harga_beli'],2,",","."); echo $satuan2; ?> <input type="hidden" name="harga[]" value="<?php echo $keranjang['harga_beli']; ?>"></td>
                                    <td><?php echo $keranjang['jumlah']; ?> <input type="hidden" name="jumlah[]" value="<?php echo $keranjang['jumlah']; ?>"></td>
                                    <td>Rp. <?php $total2 = number_format($total,2,",","."); echo $total2; ?> <input type="hidden" name="id_user" value="<?php echo $keranjang['id_user']; ?>"> <input type="hidden" name="tanggal" value="<?php echo $keranjang['tanggal_beli']; ?>"> <input type="hidden" name="subtotal[]" value="<?php echo $total; ?>"></td>
                                    <td class='text-center'>
                                        <a href="../system/delete-keranjang.php?id=<?php echo $keranjang['id_keranjang']; ?>"><span class="label label-danger"><i class='fa fa-remove' data-toggle="tooltip" data-placement="top" data-original-title="Hapus"></i></span></a>
                                    </td>
                                </tr>
                                <?php 
                                $no++; }
                                ?>
                            </form>
                        </tbody>
                    </table>

                    <div class="row">
                        <?php 
                        $cek = mysql_query("SELECT * FROM keranjang WHERE tipe='jual' AND id_dokter!='0'");
                        $cekada = mysql_num_rows($cek);
                        if ($cekada > 0) {
                            ?>
                        <?php
                        if(!empty($_GET['info'])) {
                               if($_GET['info'] == '2')
                                {
                                ?>
                                <div class='col-md-12'>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <p><strong>Gagal!</strong> Uangnya kurang mz.</p>
                                </div>
                                </div>
                                <?php
                            }
                            }
                        ?> 
                        <div class='col-md-6'>
                            <div class="form-group">
                              <label>Total Pembelian</label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input class="transaksi form-control total" type="text" disabled="disabled" value="<?php echo $totalbayar; ?>">
                              </div>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group <?php if(!empty($_GET['info'])) {if($_GET['info'] == '2'){?>has-error <?php } } ?>">
                              <label>Bayar <b class='text-danger'>*</b></label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input name="bayar" class="transaksi form-control bayar" type="text" required>
                              </div>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                              <label>Kembalian</label>
                              <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input name="kembalian" id="kembalian" class="form-control" type="text" readonly>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-7"><button href="#" type="submit" class='btn btn-success' style="width:100%;"><p style="margin:0;">Lanjutkan Transaksi</p></button></div>
                        <div class="col-md-5"><a href="../system/delete-keranjang.php?id=allresep" type="button" class='btn btn-danger' style="width:100%;">Batal</a></div>
                        <?php } ?>
                    </div>
                    </form>
                    </div>
                </div>
            </div> -->
        </div>
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
            <h4 class="modal-title">Tambah Dokter</h4>
          </div>
          <div class="modal-body">
            <form action="../system/add-dokter.php" method="POST" role="form">
                <?php
                $carikode = mysql_query("SELECT MAX(id_dokter) FROM dokter");
                $kodedokter = mysql_fetch_array($carikode);
                if ($kodedokter) {
                 $nilaikode = substr($kodedokter[0], 3);
                 $kode = (int) $nilaikode;
                 $kode = $kode + 1;
                 $hasilkode = "DK-".str_pad($kode, 3, "0", STR_PAD_LEFT);
                } else {
                 $hasilkode = "DK-001";
                }
                ?>
                <div class="form-group">
                    <input type="text" name="id" class="form-control" id="" value="<?php echo $hasilkode; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nama Dokter</label>
                    <input type="text" name="nama" class="form-control" id="" placeholder="Nama Dokter Baru">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="" placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="">No. Telepon</label>
                    <input type="text" name="telp" class="form-control" id="" placeholder="No Telepon">
                </div>
          </div>
          <div class="modal-footer">
            <button name="insert" type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          </form>
        </div>

      </div>
    </div>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <script>
    $(document).ready(function(){
        $("#nama").change(function(){
            var STOK     = $("option:selected", this).attr("stok");
            $("#stok").val(STOK);
        });
    });
    </script>
    <script>
    $(document).ready(function(){
        $("#nama2").change(function(){
            var STOK     = $("option:selected", this).attr("stok2");
            var SATUAN     = $("option:selected", this).attr("satuan");
            $("#stok2").val(STOK);
            $("#satuan").val(SATUAN);
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        $(".transaksi").keyup(function(){
              var val1 = +$(".total").val();
              var val2 = +$(".bayar").val();
              $("#kembalian").val(val2-val1);
       });
    });
    </script>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
    document.getElementById('tambahobat').onclick = repeat;

    var i = 0;
    var original = document.getElementById('wrap');

    function repeat() {
    var clone = original.cloneNode(true);
    clone.id = "wrap1" + ++i;
    original.parentNode.appendChild(clone);
    }
    </script>


    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Custom -->
    <script src="../js/bootstrap-select.min.js"></script>
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