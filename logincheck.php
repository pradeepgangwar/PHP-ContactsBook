<?php 

    session_start();

    if(isset($_POST['submit1'])){
        define('MyConst', TRUE);
    }

    if(!defined('MyConst')){
        echo '<script language="javascript">';
        echo 'alert("Access Denied")';
        echo '</script>';   
        header("Refresh: 1; url=index.php");
    }

    else{

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
                $id = $user['id'];
                $_SESSION['user'] = $email;
                $_SESSION['id'] = $id;
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
    }

?>