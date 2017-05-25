<?php 

    session_start();
    $id = $_SESSION['id'];

    if(isset($_POST['submit2'])){
        define('MyConst', TRUE);
    }

    if(!defined('MyConst')){
        echo '<script language="javascript">';
        echo 'alert("Access Denied")';
        echo '</script>';   
        header("Refresh: 1; url=index.php");
        exit();
    }

    else{

        if(isset($_POST['name']) && isset($_POST['phone'])){
        	$name = htmlentities($_POST['name']);
        	$email = htmlentities($_POST['email']);
            $phone = htmlentities($_POST['phone']);
            $address = htmlentities($_POST['address']);
            $group = htmlentities($_POST['group']);
        }
        else{
                    echo '<script language="javascript">';
                    echo 'alert("Fill all values. Try Again!")';
                    echo '</script>';   
                    header("Refresh: 1; url=newcontact.php");
                }
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "address";
        $tbname = "contacts";

        try {
        	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        	$stmt = $conn->prepare("INSERT INTO $tbname (name,phone,address,email,localgroup,user) VALUES (:name,:phone,:address,:email,:group,:user)");
            $do = $stmt->execute(['name' => $name,'phone' => $phone,'address' => $address,'email' => $email,'group' => $group,'user' => $id]);

                if($do){
                    echo '<script language="javascript">';
                    echo 'alert("Saved Successfully. Click Ok")';
                    echo '</script>';   
                    header("Refresh: 1; url=index.php"); 
                }
                  
                else{
                    echo '<script language="javascript">';
                    echo 'alert("Oops! Looks like there is some error. Try Again!")';
                    echo '</script>';   
                    header("Refresh: 1; url=index.php");
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