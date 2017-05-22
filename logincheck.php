<?php 

    session_start();
    if($_SESSION['isactive'] == true){
        header("location: welcome.php");
    }
    else{
        header("location: index.php");
    }

    if(isset($_POST['email']) && isset($_POST['password'])){
    	$pass = md5(htmlentities($_POST['password']));
    	$email = htmlentities($_POST['email']);
    }
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "address";
    $tbname = "users";

    try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	$stmt = $conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
		$stmt->execute(['email' => $email, 'password' => $pass]);
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user == Null){
			echo '<script language="javascript">';
	      	echo 'alert("Invalid credentials! Try Again")';
	      	echo '</script>';   
	      	header("Refresh: 1; url=index.php"); 
		}


		else{		    
            $_SESSION['user'] = $email;
            $_SESSION['isactive'] = true;
	      	header("location: welcome.php"); 
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