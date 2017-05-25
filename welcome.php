<?php
	
		session_start();
		if(!isset($_SESSION['user'])){  
	  		 echo '<script language="javascript">';
      	 echo 'alert("What? Dude login first :P")';
      	 echo '</script>';   
      	 header("Refresh: 1; url=index.php"); 
      	 exit();
		}
		else{
			$email = $_SESSION['user'];
      		$id = $_SESSION['id'];
		}
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title> Home Page</title>
	<!--Stylesheets-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css"/>

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>

<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Contacts Book</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      
      <ul class="nav navbar-nav navbar-right">
        <li><a href=""><?php echo $email ?></a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="text-center">
  <a href="newcontact.php" class="btn btn-success" role="button">Add New Contact</a>
</div>

  <h2 class="text-center"> <b> See Your Contacts below: </b></h2>
  <br>


  <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "address";
        $tbname = "contacts";

        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          $stmt = $conn->prepare("SELECT * FROM $tbname WHERE user = :id");
          $stmt->execute(['id' => $id]);
          $result = $stmt->fetchAll();

          	if($result != Null){
	            echo '<table class="table table-hover table-responsive" id="contacttable">';
	            echo '<thead>';
	            echo '<tr>';
	            echo '<th>Name</th><th>Address</th><th>Email</th><th>Phone</th><th>Group</th><th>Option</th>';
	            echo '</tr>';
	            echo '</thead>';
	            echo '<tbody>';
	            foreach ($result as $out){
	                echo '<tr>';
	                echo '<td>' .$out['name']. '</td>';
	                echo '<td>' .$out['address']. '</td>';
	                echo '<td>' .$out['email']. '</td>';
	                echo '<td>' .$out['phone']. '</td>';
	                echo '<td>' .$out['localgroup']. '</td>';
	                echo '<td> <a href="contactsedit.php?id=' .$out['id']. '&user=' .$out['user']. '" class="btn btn-primary btn-xs" role="button"> Edit </a>  <a href="contactsdelete.php?id=' .$out['id']. '&user=' .$out['user']. '"class="btn btn-danger btn-xs" role="button"> Delete </a> </td>';
	                echo '</tr>';
	            }
	            echo '</tbody></table>';
          	}
          	else{
          		echo '<h3 class="text-center" style="color: red;"> No contacts to display</h3>';
          	}

          
        }

      
        catch(PDOException $e){
              echo '<script language="javascript">';
              echo '$sql . "<br>" . $e->getMessage();';
              echo '</script>';   
              header("Refresh: 1; url=index.php");
          }

        $conn = null;
?>

<footer class="footer">
      <div class="container">
        <b><p class="text-muted" style="float: left;">&copy; Pradeep 2017</p></b>
        <a href="https://github.com/pradeepgangwar/PHP-ContactsBook" class="btn btn-success btn-xs text-muted" role="button" style="float: right;"> Source Code </a> 
        <b><p class="text-muted" style="float: right; padding-right: 10px;">GitHub:</p></b>        
      </div>
    </footer>
 

<!-- Scripts -->

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>