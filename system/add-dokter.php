<?php
include("koneksi.php");
$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
if(!empty($nama)){
    if(!empty($alamat)){
            if (!empty($telp)){
                    mysql_query("INSERT INTO dokter VALUES('$id','$nama','$alamat','$telp')");
                        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?info=1');
                    }
        else{
            header("Location:../entri-data/dokter.php?info=2");           
        }   
    }
    else{
        header("Location:../entri-data/dokter.php?info=3");   
    }
}
else{
    header("Location:../entri-data/dokter.php?info=4");       
}
?> 