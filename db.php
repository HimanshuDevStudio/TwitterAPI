
<?php
echo "</br>"; 

$user = "root";
$pass= "PASSWORD";
$host = "127.0.0.1";
$dbselector = "cms";
$conn = mysql_connect($host,$user,$pass) or die("unable to connect");

if (!empty($conn))
	{echo "db connected";

		if (mysql_select_db($dbselector))
			{
				echo "</br>db selected" ;
			}else
			{
				echo "not selected";
			}
			
		}
		
			else 
	{echo  "not connected";}
?>



