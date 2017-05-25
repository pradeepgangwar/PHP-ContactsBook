<?php
  
    session_start();
    $user_id = $_GET['user'];
    $idpass = $_GET['id'];
    $id = $_SESSION['id'];

    if(!isset($_SESSION['user'])){  
        echo '<script language="javascript">';
        echo 'alert("What? Dude login first :P")';
        echo '</script>';   
        header("Refresh: 1; url=index.php"); 
        exit();
    }
    elseif ($user_id != $id) {
        echo '<script language="javascript">';
        echo 'alert("You are not allowed to access this")';
        echo '</script>';   
        header("Refresh: 1; url=index.php"); 
        exit();
    }
    else{
        $email = $_SESSION['user'];
        $_SESSION['deleteid'] = $idpass;

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "address";
        $tbname = "contacts";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM $tbname WHERE id = :id");
            $stmt->execute(['id' => $idpass]);
            $query = $stmt->fetch(PDO::FETCH_ASSOC);        
        }
        catch(PDOException $e){
                echo '<script language="javascript">';
                echo '$sql . "<br>" . $e->getMessage();';
                echo '</script>';   
                header("Refresh: 1; url=index.php");
            }

        if ($query['user'] != $id) {
            echo '<script language="javascript">';
            echo 'alert("You are not allowed to access this")';
            echo '</script>';   
            header("Refresh: 1; url=index.php"); 
            exit();
        }

        $conn = null;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title> Delete Contact</title>
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
      <a class="navbar-brand" href="index.php">Contacts Book</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="welcome.php"><?php echo $email ?></a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <h3 class="text-center">Delete Contact <b> <?php echo $query['name']; ?> </b> </h3>
  <br>
 
 <form class="form-horizontal" method="POST" action="contactsdeleteconfirm.php">
  <div class="form-group text-center" style="margin-left: 12%;">
    <div class="col-sm-10">

      <a href="index.php" class="btn btn-danger" role="button">No</a>
      <button type="submit" class="btn btn-primary" name="submit5">Yes</button>
    </div>
  </div>

</form>

<br>

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