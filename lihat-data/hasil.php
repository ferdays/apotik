<form action="../system/edit-obat.php" method="post">
<?php 
include("../system/koneksi.php");
$id = $_POST['id'];
$get = mysql_query("SELECT * FROM obat WHERE id_obat='$id'");
$get2 = mysql_fetch_array($get);
?>
	<div class="form-group">
		<input type="hidden" name="id_obat" value="<?php echo $get2['id_obat']; ?>">
		<label for="Nama Obat">Nama Obat</label>
		<input name="nama" class="form-control" value="<?php echo $get2['nama_obat']; ?>">
	</div>
	<div class="form-group">
		<label for="Satuan">Satuan</label>
		<select name="satuan" id="satuan" class="form-control" name="satuan">
        	<option <?php if ($get2['satuan']=="") { ?> selected <?php } else {}?> disabled>Pilih Satuan</option>
       	 	<option <?php if ($get2['satuan']=="Botol") { ?> selected <?php } else {}?> value="Botol">Botol</option>
        	<option <?php if ($get2['satuan']=="Dos") { ?> selected <?php } else {}?> value="Dos">Dos</option>
        	<option <?php if ($get2['satuan']=="Lembar") { ?> selected <?php } else {}?> value="Lembar">Lembar</option>
        	<option <?php if ($get2['satuan']=="Pcs") { ?> selected <?php } else {}?> value="Pcs">Pcs</option>
        	<option <?php if ($get2['satuan']=="Strip") { ?> selected <?php } else {}?> value="Strip">Strip</option>
        	<option <?php if ($get2['satuan']=="Tablet") { ?> selected <?php } else {}?> value="Tablet">Tablet</option>
      	</select>
	</div>
	<div class="form-group">
		<label for="Harga Beli">Harga Beli</label>
		<div class="input-group">
	        <span class="input-group-addon">Rp.</span>
			<input name="hrg_beli" class="form-control" value="<?php echo $get2['harga_beli']; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="Harga Beli">Harga Jual</label>
		<div class="input-group">
	        <span class="input-group-addon">Rp.</span>
			<input name="hrg_jual" class="form-control" value="<?php echo $get2['harga_jual']; ?>">
		</div>
	</div>
	<div class="checkbox">
       <label>
         <input type="checkbox" name="resep" value="1" <?php if ($get2['resep']==1) {?>checked<?php } ?>> Obat ini harus dijual dengan resep dokter
       </label>
   	</div>
	<br>
	<button type="submit" class="btn btn-info" style="width:100%;">Save</button>
	</form>