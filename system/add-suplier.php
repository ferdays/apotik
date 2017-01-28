<?php
include("koneksi.php");
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
if(!empty($nama)){
    if(!empty($alamat)){
            if (!empty($telp)){
                    mysql_query("INSERT INTO supplier VALUES('','$nama','$alamat','$telp')");
                        header("Location:../entri-data/supplier.php?info=1");
                    }
        else{
            header("Location:../entri-data/supplier.php?info=2");           
        }   
    }
    else{
        header("Location:../entri-data/supplier.php?info=3");   
    }
}
else{
    header("Location:../entri-data/supplier.php?info=4");       
}
?> 