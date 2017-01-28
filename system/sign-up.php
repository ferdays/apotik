<?php
include("koneksi.php");
$nama = $_POST['nama'];
$email = $_POST['email'];
$role = $_POST['role'];
$username = $_POST['username'];
$pass1 = md5($_POST['pass']);
$pass2 = md5($_POST['ulangi_pass']);
if(!empty($nama)){
    if(!empty($email)){
        $sql = mysql_query("SELECT * FROM users WHERE email='$email'");
        $hasil = mysql_fetch_array($sql);
        if ($hasil['email'] != $email){
            if (!empty($username)){
                $sql = mysql_query("SELECT * FROM users WHERE username='$username'");
                $hasil = mysql_fetch_array($sql);
                if ($hasil['username'] != $username){
                    if (!empty($pass1)){
                        if (!empty($pass2)){
                            if ($pass1 == $pass2){
                                mysql_query("INSERT INTO users VALUES('','$username','$pass1','$role','$nama','$email','active')");
                                header("Location:../entri-data/user.php?info=1");
                            }
                            else{  
                                header("Location:../entri-data/user.php?info=2");                
                            }
                        }
                        else{
                            header("Location:../entri-data/user.php?info=3");
                        }
                    }
                    else{
                        header("Location:../entri-data/user.php?info=4");           
                    }
                }
                else{   
                    header("Location:../entri-data/user.php?info=5");        
                }   
            }
            else{
                header("Location:../entri-data/user.php?info=6");       
            }
        }
        else{
            header("Location:../entri-data/user.php?info=7");           
        }   
    }
    else{
        header("Location:../entri-data/user.php?info=8");   
    }
}
else{
    header("Location:../entri-data/user.php?info=9");       
}
?> 