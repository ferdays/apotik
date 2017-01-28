<?php
//include db configuration file
$username = "root"; //mysql username
$password = ""; //mysql password
$hostname = "localhost"; //hostname
$databasename = 'apotik'; //databasename

//connect to database
$mysqli = new mysqli($hostname, $username, $password, $databasename);

include('../system/koneksi.php');


if(isset($_POST["pemasok"]) && isset($_POST["obat"]) && isset($_POST["satuan"]) && isset($_POST["tanggalwaktu"]) && isset($_POST["hargabeli"]) && isset($_POST["hargajual"]) && isset($_POST["jumlah"])) 
{	//check $_POST["content_txt"] is not empty

	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$pemasok = $_POST["pemasok"];
	$obat = $_POST["obat"];
	$satuan = $_POST["satuan"];
	$tanggalwaktu = $_POST["tanggalwaktu"];
	$hargabeli = $_POST["hargabeli"];
	$hargajual = $_POST["hargajual"];
	$jumlah = $_POST["jumlah"];
	// Insert sanitize string in record
	$insert_row = $mysqli->query("INSERT INTO keranjang(id_supplier, id_obat, satuan, tanggal_beli, harga_beli, harga_jual, jumlah) VALUES('".$pemasok."','".$obat."','".$satuan."','','".$hargabeli."','".$hargajual."','".$jumlah."')");
	
	if($insert_row)
	{
	?>
	<?php
                            $dataobat = mysql_query("SELECT * FROM keranjang order by id_keranjang DESC");
                            $totalbayar = 0;
                            $data=mysql_fetch_array($dataobat);
                            $hargaobat2 = $data['harga_beli'];
                            $stokobat = $data['jumlah'];
                            $total = $hargaobat2 * $stokobat;
                            ?>
	<tr>
		<td></td>
        <td>
           <?php
           $idobat = $data['id_obat'];
           $query = mysql_query("SELECT * FROM obat where id_obat='$idobat'");
           $query2 = mysql_fetch_array($query);
           echo $query2['nama_obat'];
           ?>
        </td>
        <td><?php echo $satuan; ?></td>
        <td><?php echo $hargabeli; ?></td>
        <td><?php echo $jumlah; ?></td>
        <td><?php echo $total; ?></td>
        <td><a href="#" data-toggle="modal" data-target="#myModal" data-href="../system/delete-obat.php?id=<?php echo $data['id_obat']; ?>"><span class="label label-danger"><i class='fa fa-remove' data-toggle="tooltip" data-placement="top" data-original-title="Hapus"></i></span></a></td>
</tr>
<?php }else{
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}
elseif(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))
{	//do we have a delete request? $_POST["recordToDelete"]

	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
	//try deleting record using the record ID we received from POST
	$delete_row = $mysqli->query("DELETE FROM add_delete_record WHERE id=".$idToDelete);
	
	if(!$delete_row)
	{    
		//If mysql delete query was unsuccessful, output error 
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
	$mysqli->close(); //close db connection
}
else
{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>