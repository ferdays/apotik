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
                <li class=""><a href="../">Dashboard</a></li>
                <?php if ($jabatan!="pimpinan") {
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entri Data <b class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <?php if ($jabatan=="kasir") {
                        ?>
                        <li><a href="#"><i class='fa fa-plus'></i> Pembelian Obat</a></li>
                        <li><a href="#"><i class='fa fa-plus'></i> Penjualan Obat</a></li>
                        <?php }  else {?>
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
                    <li><a href="../#manajemenuser">Lihat Data</a></li>
                    <li class="active">Data User</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-statistik-big" style="height:130px;background:#00A8B3;padding:10px;text-align:center;">
                    <h1 style='color:#FFF;font-weight:300;'>Lihat Data</h1>
                    <p style='color:#FFF;font-weight:300;'>Data User</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 fade-in">
                <div class="panel">
                    <div class="panel-heading">
                        <p style='margin:0;'><i class='fa fa-users'></i> Data User</p>
                        <span class="tools pull-right">
                        <span class="pull-right clickable"><i class="fa fa-angle-up"></i></span>
                    </span>
                    </div>
                    <div class="panel-body profile-activity">
                    <?php 
                    if (!empty($_GET['info'])) {
                        if ($_GET['info']=="1") {
                    ?>
                    <div class="alert alert-dismissible alert-success">
                      <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                      <strong>Sukses!</strong> Menghapus akun.
                    </div>
                    <?php 
                    }
                    elseif ($_GET['info']=="2") {
                    ?>
                    <div class="alert alert-dismissible alert-success">
                      <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                      <strong>Sukses!</strong> Mengaktifkan akun.
                    </div>
                    <?php
                    }
                    elseif ($_GET['info']=="3") {
                    ?>
                    <div class="alert alert-dismissible alert-warning">
                      <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                      <strong>Sukses!</strong> Menonaktifkan akun.
                    </div>
                    <?php
                    }
                    elseif ($_GET['info']=="4") {
                    ?>
                    <div class="alert alert-dismissible alert-success">
                      <button type="button" class="close" data-dismiss="alert"><i class='fa fa-close'></i></button>
                      <strong>Sukses!</strong> Memperbarui akun.
                    </div>
                    <?php
                    }
                    }
                     ?>
                    <div class="form-group pull-right">
                        <input type="text" class="search form-control" placeholder="Siapa yang anda cari?">
                    </div>
                    <span class="counter pull-right"></span>
                    <table class="table table-hover table-bordered results" style='text-transform:capitalize;'>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="col-md-4 col-xs-4">Nama</th>
                          <th class="col-md-3 col-xs-3">Username</th>
                          <th class="col-md-2 col-xs-2">Hak Akses</th>
                          <th class="col-md-1 col-xs-1">Status</th>
                          <th class="col-md-2 col-xs-2">Aksi</th>
                        </tr>
                        <tr class="danger no-result">
                          <td colspan="6"><i class="fa fa-warning"></i> Tidak ada hasil</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $listuser = mysql_query("SELECT * FROM users");
                        $no = 1;
                        while($data=mysql_fetch_array($listuser)){
                        ?>
                        <tr <?php if ($data['id_user']==$id_user) { ?>class='active'<?php }?>>
                          <th scope="row"><?php echo $no; ?></th>
                          <td><?php echo $data['nama']; ?></td>
                          <td><?php echo $data['username']; ?></td>
                          <td class='<?php if ($data['role']=="admin") {?>text-info<?php } elseif ($data['role']=="pimpinan") {?>text-success<?php } ?>'><?php echo $data['role']; ?></td>
                          <td>
                            <?php if ($data['status']=="active") {
                            ?>
                            <span class="label label-info">Active</span>
                            <?php } elseif ($data['status']=="inactive") {
                            ?>
                            <span class="label label-danger">Inactive</span>
                            <?php } ?>
                          </td>
                          <td class='text-center'>
                            <a href="#" class="edit-record" data-id="<?php echo $data['id_user']; ?>"><span class="label label-warning"><i class='fa fa-edit' data-toggle="tooltip" data-placement="top" data-original-title="Edit"></i></span></a>
                            <?php if ($data['id_user']==$id_user) {
                            }
                            elseif ($data['status']=="active") {
                            ?>
                            <a href="../system/active-account.php?id=<?php echo $data['id_user']; ?>"><span class="label label-info"><i class='fa fa-toggle-on' data-toggle="tooltip" data-placement="top" data-original-title="Nonaktifkan"></i></span></a>
                            <?php } elseif ($data['status']=="inactive") {
                            ?>
                            <a href="../system/inactive-account.php?id=<?php echo $data['id_user']; ?>"><span class="label label-info"><i class='fa fa-toggle-off' data-toggle="tooltip" data-placement="top" data-original-title="Aktifkan"></i></span></a>
                            <?php }
                            if ($data['id_user']==$id_user) {
                            } else {
                            ?>
                            <a href="#" data-toggle="modal" data-target="#myModal" data-href="../system/delete-account.php?id=<?php echo $data['id_user']; ?>"><span class="label label-danger"><i class='fa fa-remove' data-toggle="tooltip" data-placement="top" data-original-title="Hapus"></i></span></a>
                            <?php } ?>
                          </td>
                        </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                    </div>
                </div>
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

    <!-- Modal Edit -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-close"></i></span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
                    </div>
                    <div class="modal-body">
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
    $(document).ready(function() {
      $(".search").keyup(function () {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
        
      $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
      });
        
      $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
        $(this).attr('visible','false');
      });

      $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
        $(this).attr('visible','true');
      });

      var jobCount = $('.results tbody tr[visible="true"]').length;
        $('.counter').text(jobCount + ' Orang');

      if(jobCount == '0') {$('.no-result').show();}
        else {$('.no-result').hide();}
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
    <script type="text/javascript">
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
    <script>
        $('#myModal').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('#url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModal2").modal('show');
                $.post('edit-user.php',
                    {id:$(this).attr('data-id')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    </script>
</body>
</html>
<?php } ?>