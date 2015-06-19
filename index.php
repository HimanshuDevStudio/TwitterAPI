<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<style type="text/css">
	.fa-twitter{color: #55acee; font-size: 20px;}
</style>
<body>
<?php
session_start();
if(!empty($_SESSION['status'])) 
{
$_SESSION['stat'] = $_SESSION['status']; 
}
else 
{
 $_SESSION['stat'] = "WELCOME";
 } 
?>
<center style="margin-top:22%">
<div class="login">
<form action="auth.php" method="post">
<p><?php 
echo $_SESSION['stat']; ?></p>
<input type="text" name="username" placeholder="Username"></br>
<input type="password" name="password" placeholder="Password"></br>
<input type="submit" value="Login!!">
</form>
<a href="login.php" name="login"> Login with twitter !!  <i class="fa fa-twitter"></i></a >
</div>
</center>
</body>
</html>
