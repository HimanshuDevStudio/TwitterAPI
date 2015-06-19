<?php
session_start(); 
session_unset($_SESSION['request_token']);
session_unset($_SESSION['request_token']);//to ensure you are using same session
session_destroy($_SESSION['uv']);
session_destroy($_SESSION['vtk']); //destroy the session
header("location:index.php"); //to redirect back to "index.php" after logging out
exit();
?>  
