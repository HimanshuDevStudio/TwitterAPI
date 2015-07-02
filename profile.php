<!DOCTYPE html>

<?php 
session_start();
if(!empty($_SESSION['vtk']) || !empty($_SESSION['uv']) || !empty($_SESSION['sss'])){


include('inc/twitteroauth.php');
$cosumerkey = "EdmjGXeIYhpyfbJpLY55lVB5E";
$consumersecret = "NpAnzDp3uRCuaw6iv8tsNR1CmVQG04Wqw1IdzncCcfaY1FchtN";
$accesstoken = "3238321282-4f2LArzCAmj1UwIVVP2HlUj4a3tZqldLmC0YKHs";
$accesstokensecret = "S57wlUP8gS5BJCgTB6OyAjPiDE3dz66UVAVxTyjmllsFO";
$TOA = new TwitterOAuth($cosumerkey,$consumersecret,$accesstoken,$accesstokensecret);
} 

else {
	$_SESSION['status'] = " Access Denied";
	session_unset();
	session_destroy();
header('Location: index.php');
	exit();
}


?>



<html>
<head>
	<title></title>
	<style>
	body {font-family: futura;}
.status {float: right;width: 50%;border: 2px #000 solid;padding: 10px;top: 5%;right: 0;position: absolute;}
.row {margin-top: 2%;border-top: #0091FF 2px solid;width: 100%;}
input[type="text"] {border: 2px blue solid;}
label {text-transform: uppercase;}
.friends {float: left; width:30%; border: 2px #000 solid; padding:10px; margin-top: 1%;}
.foll{float: left; width:30%; border: 2px #000 solid; padding:10px; margin-left: 1%; margin-top: 1%} 
.navright { float: left;}
.navleft{ float:right;}
.sample{width:30%; float: left;border: 2px #000 solid; padding:10px; margin-left: 1%; margin-top: 1%}
header { background:#55acee; height: 20px;}
header a { color: #fff; font-family: sans-serif; letter-spacing: 2px;padding: 0 10px 0 10px;}
.topsection {background-image: url("<?php echo $background; ?>");}
</style>
</head>
<body>
<header>
	<nav class="navright">
		<a href="#"> Home </a>
	</nav>
	<nav class="navleft">
		<a href="logout.php">Logout</a>
	</nav>
</header>
<div class="topsection">
<form action="" method="get">
<div class="searchbox">
<label>Search by screen name or just type a name :- </label> <input type="text" name="user"></div>
</form>

<?php

if(isset($_GET['user'])){
$searchuser = $TOA->get("https://api.twitter.com/1.1/users/search.json?q=".$_GET['user']."&page=1&count=1");

$stats = $TOA->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$_GET['user']."&count=5");

$listf=$TOA->get("https://api.twitter.com/1.1/followers/ids.json?cursor=-1&screen_name=".$_GET['user']."&count=5000");

$twets=$TOA->get("https://api.twitter.com/1.1/search/tweets.json?q=".$_GET['user']."&result_type=mixed&count=4");

//$frndz=$TOA->get("https://api.twitter.com/1.1/friends/ids.json?cursor=-1&screen_name=".$_GET['user']."&count=5000");

$frndzz=$TOA->get("https://api.twitter.com/1.1/friends/list.json?cursor=-1&screen_name=".$_GET['user']."&skip_status=true&include_user_entities=false");

$result = $TOA->get("https://api.twitter.com/1.1/followers/list.json?screen_name=".$_GET['user']."&count=10000");


foreach ($searchuser as $value) {
	# code...
	
	$img = $value->profile_image_url;
	echo "Name :- ".$value->name ."</br>";
	echo "Status Count :- ". $value->statuses_count . "</br>";
	echo "Followers :- ".$value->followers_count ."</br>";
	echo "Friends :- ".$value->friends_count ."</br>";
	echo "Profile name :- " .$value->screen_name."<br>";
	$background = $value->profile_background_image_url_https . "<br>";
	echo "Profile Created at:". $value->created_at. "<br>";
	$bimg = preg_replace('/^[0-9]+_/', '', $background);
	$_SESSION['followers'] = $value->followers_count;
	$_SESSION['friendz'] = $value->friends_count ;
	$_SESSION['statuses_count'] = $value->statuses_count;
echo "<img src =".$img."><br>"; 


}?>

<div class="status">
<?php
foreach ($stats as $key) {
	# code...
	echo  " user status:-" . $key->text . "<br>";
}
//folowings//friends
?>
</div>

</div>
<div class="row">
<div class="friends">
<h4>Friends</h4>
<?php
if (is_array($frndzz) || is_object($frndzz)){
foreach ($frndzz as $var ) {

foreach ($var as $keychain) {

	echo  "name :-" . $keychain->name . "<br>";
	echo  "screen name :-" . $keychain->screen_name . "<br>";

}


 }}

 
?>
</div>

<div class="foll">
<h4>Followers</h4>
<?php
//followers 
$newFollowers = array();
	foreach ($result->users as $follower) {
		$id = $follower->id;
		$name = $follower->name;
		$screen_name = $follower->screen_name;
		$newFollowers[$id] = array('screen_name'=>$screen_name, 'username'=>$name);

echo " <br>follower id :-". $id ." <br> "; echo "follower name:-" . $name. "<br>"; echo " Follower screen name:-". $screen_name ."<br><hr> </hr> <br>"; 
	}

//followers print
//print_r($searchuser);
	//print_r($twets);
?></div>
<div class="sample">
<?php
include('data.php');
?>
</div>
<?php }
else 
{echo "not posted";}
 //print_r($stats);
//$stats = $TOA->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$_POST['user']."&count=5");
//foreach ($stats as $sta) {
//	foreach ( $sta as $t ) {
//echo "<img src=".$t->profile_image_url .">" .$t->text . " </br>"   ;   
//	}
//}
?>
</div>

</body>
</html>