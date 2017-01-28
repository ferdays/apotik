<form action="../system/edit-pemasok.php" method="post">
<?php 
include("../system/koneksi.php");
$id = $_POST['id'];
$get = mysql_query("SELECT * FROM supplier WHERE id_supplier='$id'");
$get2 = mysql_fetch_array($get);
?>
	<div class="form-group">
		<input type="hidden" name="id" value="<?php echo $get2['id_supplier']; ?>">
		<label for="Nama Obat">Nama Pemasok</label>
		<input name="nama" class="form-control" value="<?php echo $get2['nama']; ?>">
	</div>
	<div class="form-group">
		<label for="Nama Obat">Alamat</label>
		<input name="alamat" class="form-control" value="<?php echo $get2['alamat']; ?>">
	</div>
	<div class="form-group">
		<label for="Nama Obat">No. Telepon</label>
		<input name="notelp" class="form-control" value="<?php echo $get2['telepon_supplier']; ?>">
	</div>
	<br>
	<button type="submit" class="btn btn-info" style="width:100%;">Save</button>
	</form>