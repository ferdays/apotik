<form action="../system/edit-dokter.php" method="post">
<?php 
include("../system/koneksi.php");
$id = $_POST['id'];
$get = mysql_query("SELECT * FROM dokter WHERE id_dokter='$id'");
$get2 = mysql_fetch_array($get);
?>
	<div class="form-group">
		<input type="hidden" name="id_dokter" value="<?php echo $get2['id_dokter']; ?>">
		<label for="Nama Obat">Nama Dokter</label>
		<input name="nama" class="form-control" value="<?php echo $get2['nama']; ?>">
	</div>
	<div class="form-group">
		<label for="Harga Beli">Alamat</label>
		<input name="alamat" class="form-control" value="<?php echo $get2['alamat']; ?>">
	</div>
	<div class="form-group">
		<label for="Harga Beli">Nomor Telepon</label>
		<input name="no_telepon" class="form-control" value="<?php echo $get2['no_telepon']; ?>">
	</div>
	<br>
	<button type="submit" class="btn btn-info" style="width:100%;">Save</button>
	</form>