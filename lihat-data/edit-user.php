<form action="../system/edit-user.php" method="post">
<?php 
include("../system/koneksi.php");
$id = $_POST['id'];
$get = mysql_query("SELECT * FROM users WHERE id_user='$id'");
$get2 = mysql_fetch_array($get);
?>
	<div class="form-group">
		<input type="hidden" name="id" value="<?php echo $get2['id_user']; ?>">
		<label for="Nama Obat">Nama User</label>
		<input name="nama" class="form-control" value="<?php echo $get2['nama']; ?>">
	</div>
	<div class="form-group">
		<label for="Satuan">Hak Akses</label>
		<select name="jabatan" id="satuan" class="form-control" name="satuan">
        	<option <?php if ($get2['role']=="admin") { ?> selected <?php } else {}?> value="admin">Admin</option>
       	 	<option <?php if ($get2['role']=="pimpinan") { ?> selected <?php } else {}?> value="pimpinan">Pimpinan</option>
        	<option <?php if ($get2['role']=="kasir") { ?> selected <?php } else {}?> value="kasir">Kasir</option>
        	<option <?php if ($get2['role']=="gudang") { ?> selected <?php } else {}?> value="gudang">Gudang</option>
      	</select>
	</div>
	<br>
	<button type="submit" class="btn btn-info" style="width:100%;">Save</button>
	</form>