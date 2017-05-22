<?php
	
		session_start();
		if(!isset($_SESSION['user'])){  
	  		echo '<script language="javascript">';
      		echo 'alert("What? Dude login first :P")';
      		echo '</script>';   
      		header("Refresh: 1; url=index.php"); 
      		exit();
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
Welcome<br> <a href="logout.php">logout</a>
</body>
</html>