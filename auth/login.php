<?php
session_start();
$message="";
if(count($_POST)>0) {
include("../system/koneksi.php");
$pass=md5($_POST['password']); 
$result = mysql_query("SELECT * FROM users WHERE username='" . $_POST["username"] . "' and password = '". $pass."' AND status='active'");
$row  = mysql_fetch_array($result);
if(is_array($row)) {
$_SESSION["id_user"] = $row[id_user];
$_SESSION["username"] = $row[username];
} else{
$message = "Username atau Password salah";
}
}
if(isset($_SESSION["id_user"])) {
header("Location:../");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login Page</title>

		<!-- Bootstrap CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/style.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/font.css">
		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.min.css">
		<style type="text/css">
		html, body {
			background: #1C3C50;
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
		<div class="loginform fade-in">
			<h3>User Login</h3>
			<p style='color:#F77B6F;font-weight:300;'><?php if($message!="") { echo $message; } ?></p>
			<br>
			<form name="frmUser" method="POST" action="" role="form">
			
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon" style='background:#1C3C50;border:#1C3C50;'><i class="fa fa-user" style='color:#FFF;'></i></span>
				    <input class="form-control" name="username" type="text" placeholder="Username" autocomplete="off">
				  </div>
				</div>
				<div class="form-group">
				  <div class="input-group">
				    <span class="input-group-addon" style='background:#1C3C50;border:#1C3C50;'><i class="fa fa-lock" style='color:#FFF;'></i></span>
				    <input class="form-control" name="password" type="password" placeholder="Password">
				  </div>
				</div>

				<button type="submit" class="btn btn-success" style='width:100%;background:#F77B6F;border:#F77B6F;'><p style='font-weight:300;margin:0;'>SIGN IN</p></button>
			</form>
		</div>
		<!-- jQuery -->
		<script src="../js/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>