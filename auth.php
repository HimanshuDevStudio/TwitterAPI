<?php
session_start();


$_SESSION['name'] = $_POST['username'];
$_SESSION['pass'] = $_POST['password'];

$con = mysql_connect("127.0.0.1","root","PASSWORD") or die("Could not connect");
mysql_selectdb("cms", $con);
$query = 'SELECT * FROM users';
$res = mysql_query($query, $con) or die(mysql_error());
$row = mysql_fetch_array($res);
echo $row['name'] . "</br> " . $row['email'] . " </br>"; 



	if( $_SESSION['name'] == $row['name']  && $_SESSION['pass'] == $row['password'])
	{
	echo "match";
$_SESSION['sss'] =  md5($_SESSION['pass']);
$_SESSION['uv'] =  md5($_SESSION['name']);
header('Location: profile.php');
	}
	else 
	{
		$_SESSION['status'] = " Access Denied";
header('Location: index.php');
	}

?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>











</body>
</html>