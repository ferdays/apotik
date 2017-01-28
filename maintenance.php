<?php
session_start();
include("system/koneksi.php");
if(!isset($_SESSION['id_user'])){
    header("Location: auth/login.php");
}
include("system/function.php");
$id_user = $_SESSION['id_user'];
$get = mysql_query("SELECT * FROM users WHERE id_user=$id_user");
$get2 = mysql_fetch_array($get);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Maintenance</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/font.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript">
    var colours=['#663399','#22313F','#4183D7','#1BBC9B','#F39C12'];  // List of colors
    var tempID=0;
    var changeInterval=5000;    // Change interval in miliseconds
    var objectID='#bgDiv';      // Object to change colours. 
    
    $(document).ready(function(){        
        setInterval(function(){
                $(objectID).animate({backgroundColor: colours[tempID]},1500);
                tempID=tempID+1;
                if (tempID>colours.length-1) tempID=0;
            },changeInterval);
    });
    </script>
</head>

<body style="background:#58C9F3;padding:0;" id="bgDiv">
    <div class='mt fade-in'>
        <h1 style="font-size:80px;font-weight:100;color:#FFF;" class="text-center">APO<span style='color:#F77B6F;'>TIK</span></h1>
        <hr>
        <p class="text-center" style='color:#FFF;'>
            Mohon maaf <?php echo $get2['nama']; ?>. Aplikasi <span class="label label-primary">APO<span style='color:#F77B6F;'>TIK</span></span> sedang dalam proses perbaikan. Silahkan coba beberapa saat lagi. Hubungi admin untuk info lebih lanjut
            <br><br>
            <a class='btn btn-info' href="system/logout.php" style='color:#FFF;'><i class='fa fa-sign-out'></i> Logout</a>
        </p>
    </div>
    <footer style="position:absolute;bottom:0;background:none;"><p class="text-center">&copy; Copyright <a href="http://ferdays.tk" target="_blank" style="color:#EEE;">Ferdays.tk</a></p></footer>
</body>
</html>