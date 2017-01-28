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
if ($jabatan!="gudang") {
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
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css">  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../js/jquery.js"></script>
    <script>
    $(document).ready(function(){
        $("#nama").change(function(){
            var SATUANNYA     = $("option:selected", this).attr("satuanobat");
            var HARGABELINYA      = $("option:selected", this).attr("hargabeli");
            var HARGAJUALNYA      = $("option:selected", this).attr("hargajual");
            $("#satuan").val(SATUANNYA);
            $("#hargabeli").val(HARGABELINYA);
            $("#hargajual").val(HARGAJUALNYA);
        });
    });
    </script>

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
                <li><a href="../index.php">Dashboard</a></li>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entri Data <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <?php if ($jabatan=="kasir" || $jabatan=="gudang") {
                        ?>
                        <li><a href="../entri-data/beli-obat.php"><i class='fa fa-plus'></i> Pembelian Obat</a></li>
                        <?php if($jabatan=="gudang") { } else { ?>
                        <li><a href="#"><i class='fa fa-plus'></i> Penjualan Obat</a></li>
                        <?php } }  else {?>
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
                        <li><a href="../index.php#print"><i class='fa fa-clock-o'></i> Pembelian Obat Bulanan</a></li>
                        <li><a href="../print/print-rekap-pembelian-obat.php" target="_blank"><i class='fa fa-print'></i> Rekap Pembelian Obat</a></li>
                        <?php } else if ($jabatan=="kasir") {
                        ?>
                        <li><a href="#"><i class='fa fa-print'></i> Stok Obat</a></li>
                        <li><a href="#"><i class='fa fa-clock-o'></i> Penjualan Obat Bulanan</a></li>
                        <li><a href="#"><i class='fa fa-print'></i> Rekap Penjualan Obat</a></li>
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
                    <li class="active">Beli Obat</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-statistik-big" style="height:130px;background:#57C8F2;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'>Entri Data</h1>
                    <p style='color:#FFF;font-weight:300;'>Pembelian Obat Dari Pemasok</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-credit-card'></i> Tambah Obat</p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <form action="../system/add-keranjang.php" method="POST" role="form">

                        <?php
                        if(!empty($_GET['info'])) {
                               if($_GET['info'] == '1')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-success">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Sukses!</strong> Anda sukses menambah data obat baru
                                </div>
                                <?php }
                                else if($_GET['info'] == '2')
                                {
                                ?>
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                                    <strong>Kesalahan!</strong> Data obat sudah tersedia
                                </div>
                                <?php }
                            }
                        ?>
                        <div class="form-group">
                            <label for="nama">Pemasok</label>
                            <?php
                            $getkeranjang = mysql_query("SELECT * FROM keranjang WHERE tipe='beli'");
                            $keranjang = mysql_fetch_array($getkeranjang);
                            ?>
                            <select name="pemasok" id="pemasok" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                <option value="0" disabled selected>Pilih Pemasok</option>
                                <?php $listuser = mysql_query("SELECT * FROM supplier ORDER BY id_supplier DESC");
                                while($data=mysql_fetch_array($listuser)){
                                $data2 = json_encode($data);
                                $decode = json_decode($data2);
                                $keranjang = mysql_query("SELECT * FROM keranjang WHERE tipe='beli'");
                                $getkeranjang = mysql_fetch_array($keranjang);
                                $hitung = mysql_num_rows($keranjang);
                                ?>
                                <option value="<?php echo $decode->id_supplier; ?>"><?php echo $decode->nama; ?></option>
                                <?php } ?>
                              </select>
                        </div>
                        <div class="form-group">
                            <div class='row'>
                                <div class='col-md-9'>
                                    <label for="nama">Nama Obat <b style='font-weight:100;'>yang sudah ada</b></label>
                                    <select id="nama" name="nama" class="selectpicker form-control" data-show-subtext="true" data-live-search="true">
                                    <option value="0" disabled selected>Pilih Obat</option>
                                    <?php date_default_timezone_set("Asia/Pontianak"); $hariini = date("Y"."-"."m"."-"."d"." "."H".":"."i".":"."s"); $listobat = mysql_query("SELECT * FROM obat WHERE kadaluarsa>'$hariini' ORDER BY id_obat DESC");
                                    while($data=mysql_fetch_array($listobat)){
                                    $data2 = json_encode($data);
                                    $decode = json_decode($data2);
                                    echo'<option value="'.$decode->id_obat.'" satuanobat="'.$decode->satuan.'" hargabeli="'.$decode->harga_beli.'" hargajual="'.$decode->harga_jual.'">'.$decode->nama_obat.'</option>';
                                    } ?>
                                    </select>
                                </div>
                                <div class='col-md-3'>
                                    <label for="nama">&nbsp;</label>
                                    <a href="#" class='btn btn-primary' style='width:100%;' data-toggle="modal" data-target="#myModal"><i class='fa fa-plus'></i> Obat Baru</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Satuan</label>
                            <select id="satuan" class="form-control" name="satuan">
                              <option selected="selected" disabled>Pilih Satuan</option>
                              <option value="Botol">Botol</option>
                              <option value="Dos">Dos</option>
                              <option value="Lembar">Lembar</option>
                              <option value="Pcs">Pcs</option>
                              <option value="Strip">Strip</option>
                              <option value="Tablet">Tablet</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Kadaluarsa Obat</label>
                            <div class="input-group date form_datetime col-md-12" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="dtp_input1">
                            <input id="kadaluarsa" class="form-control" type="text" placeholder='Tanggal dan Waktu' name='kadaluarsa' date-format="dd-mm-yyyy hh:ii:ss" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Tanggal Pembelian</label>
                            <div class="input-group date form_datetime1 col-md-12" data-date-format="yyyy-mm-dd hh:ii:ss" data-link-field="dtp_input1">
                            <input id="tanggalwaktu" class="form-control" type="text" value="<?php date_default_timezone_set("Asia/Pontianak"); echo date("Y"."-"."m"."-"."d"." "."H".":"."i".":"."s"); ?>" placeholder='Tanggal dan Waktu' name='tanggalwaktu' date-format="dd-mm-yyyy hh:ii:ss" required>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" />
                        </div>
                        <div class="form-group">
                          <label for="harga-beli">Harga Beli</label>
                          <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input name="hrg_beli" id="hargabeli" class="form-control" type="text" placeholder="0">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="harga-jual">Harga Jual</label>
                          <div class="input-group">
                            <span class="input-group-addon">Rp.</span>
                            <input name="hrg_jual" id="hargajual" class="form-control" type="text" placeholder="0">
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumlah Beli</label>
                            <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Jumlah Beli" required>
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="resep" value="1"> Obat ini harus dijual dengan resep dokter
                            </label>
                        </div>
                        <button type="submit" class="btn btn-info"><p style="margin:0;">Tambahkan ke keranjang</p></button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-shopping-basket'></i> Keranjang</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                        <form action="../system/beli-obat.php" method="POST">
                        <?php
                        $carikodeumumbeli = mysql_query("SELECT MAX(no_faktur) FROM pembelian");
                        $kodekodeumumbeli = mysql_fetch_array($carikodeumumbeli);
                        if ($kodekodeumumbeli) {
                         $nilaikodeumumbeli = substr($kodekodeumumbeli[0], 4);
                         $kodeumumbeli = (int) $nilaikodeumumbeli;
                         $kodeumumbeli = $kodeumumbeli + 1;
                         $hasilkodeumumbeli = "BOU-".str_pad($kodeumumbeli, 3, "0", STR_PAD_LEFT);
                        } else {
                         $hasilkodeumumbeli = "BOU-001";
                        }
                        ?>
                        <div class="form-group">
                            <input name="kodebeli" class="form-control" value="<?php echo $hasilkodeumumbeli; ?>" readonly>
                        </div>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <?php
                                $hitungharga = mysql_query("SELECT * FROM keranjang WHERE tipe='beli'");
                                $totalbayar = 0;
                                while ($data=mysql_fetch_array($hitungharga)) {
                                $hargaobat2 = $data['harga_beli'];
                                $stokobat = $data['jumlah'];
                                $totalbayar = $totalbayar + ($hargaobat2 * $stokobat);
                                $tanggalbeli = $data['tanggal_beli'];
                                $id_supplier = $data['id_supplier'];
                                }
                                ?>
                                <th colspan="5" class='text-right'><a onclick='location.reload(true);' style="text-decoration:none;cursor:pointer;"><span class="label label-warning"><i class="fa fa-refresh"></i> Refresh</span></a> Total Pembelian</th>
                                <th>Rp. <?php $totalbayar2= number_format($totalbayar,2,",","."); echo $totalbayar2; ?> <input type="hidden" name="totalbayar" value="<?php echo $totalbayar; ?>"> <input type="hidden" name="tanggalbeli" value="<?php echo $tanggalbeli; ?>"> <input type="hidden" name="id_supplier" value="<?php echo $id_supplier; ?>"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody id="responds">
                            <?php
                            $dataobat = mysql_query("SELECT * FROM keranjang WHERE tipe='beli'");
                            $no=1;
                            $totalbayar = 0;
                            while ($data=mysql_fetch_array($dataobat)) {
                            $hargaobat2 = $data['harga_beli'];
                            $stokobat = $data['jumlah'];
                            $total = $hargaobat2 * $stokobat;
                            $totalbayar = $totalbayar + ($hargaobat2 * $stokobat);
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <?php
                                    $idobat = $data['id_obat'];
                                    $query = mysql_query("SELECT * FROM obat where id_obat='$idobat'");
                                    $query2 = mysql_fetch_array($query);
                                    echo $query2['nama_obat'];
                                    ?>
                                    <input type="hidden" class="form-control" name="id_obat[]" value="<?php echo $data['id_obat']; ?>">
                                    <input type="hidden" class="form-control" name="nama_obat" value="<?php echo $query2['nama_obat']; ?>">
                                    <input type="hidden" class="form-control" name="satuan[]" value="<?php echo $data['satuan']; ?>">
                                    <input type="hidden" class="form-control" name="harga_beli[]" value="<?php echo $data['harga_beli']; ?>">
                                    <input type="hidden" class="form-control" name="harga_jual[]" value="<?php echo $data['harga_jual']; ?>">
                                    <input type="hidden" class="form-control" name="jumlah[]" value="<?php echo $data['jumlah']; ?>">
                                    <input type="hidden" class="form-control" name="resep[]" value="<?php echo $data['resep']; ?>">
                                    <input type="hidden" class="form-control" name="id_supplier" value="<?php echo $data['id_supplier']; ?>">
                                    <input type="hidden" class="form-control" name="subtotal[]" value="<?php echo $total; ?>">
                                    <input type="hidden" class="form-control" name="kadaluarsa[]" value="<?php echo $data['kadaluarsa'] ?>">
                                    <input type="hidden" class="form-control" name="tanggal_beli[]" value="<?php echo $data['tanggal_beli']; ?>">
                                    <input type="hidden" class="form-control" name="id_user" value="<?php echo $data['id_user']; ?>">
                                </td>
                                <td><?php echo $data['satuan']; ?></td>
                                <td>
                                    Rp. <?php $hargabeli = $data['harga_beli']; $hargabeli2 = number_format($hargabeli,2,",","."); echo $hargabeli2?>
                                </td>
                                <td><?php echo $data['jumlah']; ?></td>
                                <td>Rp. <?php $total2 = number_format($total,2,",","."); echo $total2;?></td>
                                <td class='text-center'>
                                    <a href="../system/delete-keranjang.php?id=<?php echo $data['id_keranjang']; ?>"><span class="label label-danger"><i class='fa fa-remove' data-toggle="tooltip" data-placement="top" data-original-title="Hapus"></i></span></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="row">
                        <?php 
                        $cek = mysql_query("SELECT * FROM keranjang WHERE tipe='beli'");
                        $cekada = mysql_num_rows($cek);
                        if ($cekada > 0) {
                            ?>
                            <div class="col-md-7"><button href="#" type="submit" class='btn btn-success' style="width:100%;"><p style="margin:0;">Beli</p></button></div>
                        <div class="col-md-5"><a href="../system/delete-keranjang.php?id=all" type="button" class='btn btn-danger' style="width:100%;">Batal</a></div>
                        <?php
                        } else { } ?>
                    </div>
                    </form>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-tag'></i> Menu yang berhubungan</strong></p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <div class="row">
                        <a href="../lihat-data/pembelian-obat.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#8175C7;">
                                <h1 class='fa fa-line-chart' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Pembelian Obat</p>
                        </div></a>
                        <a href="../lihat-data/obat.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#A9D86E;">
                                <h1 class='fa fa-archive' style='margin:0;'></h1>
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Obat</p>
                        </div></a>
                        <a href="../lihat-data/pemasok.php"><div class="col-md-4">
                            <div class="manajemen-user" style="background:#00A8B3;">
                                <h1 class='fa fa-user' style='margin:0;'></h1> 
                            </div>
                            <p class='text-center' style='color:#333;font-weight:300;'>Data Pemasok</p>
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
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tambah Obat</h4>
          </div>
          <div class="modal-body">
            <form action="../system/insert-obat.php" method="POST" role="form">
                <div class="form-group">
                    <label for="">Nama Obat</label>
                    <input type="text" name="namaobatbaru" class="form-control" id="" placeholder="Nama Obat Baru">
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
    <script src="../js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
    var date = new Date();
      $('.form_datetime1').datetimepicker('setEndDate', date);
</script>
</body>
</html>
<?php } ?>