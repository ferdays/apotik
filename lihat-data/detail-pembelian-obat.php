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
$getnofaktur = $_GET['nofaktur'];
$getmt = mysql_fetch_array(mysql_query("SELECT * FROM pengaturanweb"));
if ($jabatan!="admin") {
    if ($getmt['status']=="mt") {
        header("Location: ../maintenance.php");
    }
}
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
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css">
    <style type="text/css">
    .results tr[visible='false'],
    .no-result{
      display:none;
    }

    .results tr[visible='true']{
      display:table-row;
    }

    .counter{
      padding:8px; 
      color:#ccc;
    }
    </style>
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
                <li><a href="../index.php">Dashboard</a></li>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown">
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
                        <li><a href="../entri-data/dokter.php"><i class='fa fa-plus'></i> Tambah Dokter</a></li>
                        <?php } ?>
                        </ul>
                </li>
                <?php } ?>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown active">
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
                    <li><a href="../#manajemenuser">Lihat Data</a></li>
                    <li><a href="pembelian-obat.php">Data Pembelian Obat</a></li>
                    <li class="active">Detail</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-statistik-big" style="height:130px;background:#8175C7;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'>Lihat Data</h1>
                    <p style='color:#FFF;font-weight:300;'>Detail Pembelian Obat / No. Faktur: <strong><?php echo $getnofaktur; ?></strong></p>
                </div>
                <?php 
                    if (!empty($_GET['info'])) {
                        if ($_GET['info']=="1") {
                ?>
                <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                    <strong>Sukses!</strong> Membeli obat.
                </div>
                <?php } } ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-10 fade-in">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-line-chart'></i> Detail Pembelian Obat</p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Pembelian</th>
                                <th>Harga Beli</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total</th>
                                <th>
                                    Rp. <?php 
                                    $gettotal = mysql_fetch_array(mysql_query("SELECT * FROM pembelian WHERE no_faktur='$getnofaktur'"));
                                    $total = number_format($gettotal['total'],2,",","."); echo $total;
                                     ?>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $dataobat = mysql_query("SELECT * FROM faktur_pembelian WHERE no_faktur='$getnofaktur'");
                            $no=1;
                            while ($data=mysql_fetch_array($dataobat)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <?php
                                    $idobat = $data['id_obat'];
                                    $namaobat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
                                    echo $namaobat['nama_obat'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $data['jumlah'];
                                    ?> <?php echo $namaobat['satuan']; ?>
                                </td>
                                <td>Rp. <?php $beli = number_format($data['harga_beli'],2,",","."); echo $beli; ?></td>
                                <td>Rp. <?php $subtotal = number_format($data['subtotal'],2,",","."); echo $subtotal; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <a onclick="history.back()" class='btn btn-warning' style='width:100%;margin-bottom:20px;'><i class='fa fa-angle-left'></i> Kembali</a>
            </div>
            
            <div class="col-md-2">
                <a  href="javascript:void(0);"
                    onclick="window.open('../print/print-detail-pembelian-obat.php?nofaktur=<?php echo $getnofaktur; ?>','Print Preview','size=800,height=800,scrollbars=yes,resizeable=no')" class='btn btn-info' style='width:100%;margin-bottom:20px;'><i class='fa fa-print'></i> Print</a>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-center">&copy; Copyright 2016 <a href="http://ferdays.tk/" style="color:#EEE;" target="_blank">Ferdays.tk</a> <a href="#atas" style='float:right;color:#FFF;'><i class="fa fa-angle-up"></i></a></p>
    </footer>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><i class='fa fa-close'></i></button>
            <h4 class="modal-title">Konfirmasi Hapus</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <a type="button" class='btn btn-danger btn-ok'>Hapus</a>
            <button type="button" class="btn btn-default btn-ok" data-dismiss="modal">Tutup</button>
          </div>
        </div>

      </div>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Custom -->
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
    <script type="text/javascript">
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( { 
    } );
    } );
    </script>
    <script>
        $('#myModal').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('#url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
</body>
</html>