<?php 

    session_start();
    $idpass = $_SESSION['editid'];

    if(isset($_POST['submit6'])){
        define('MyConst', TRUE);
    }

    if(!defined('MyConst')){
        echo '<script language="javascript">';
        echo 'alert("Access Denied")';
        echo '</script>';   
        header("Refresh: 1; url=index.php");
        exit();
    }

    if(isset($_POST['submit6'])){

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

        try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "address";
            $tbname = "contacts";

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("UPDATE $tbname SET name = :name,phone = :phone,address = :address,email = :email,localgroup = :group WHERE id = :idpass");
            $do = $stmt->execute(['name' => $name,'phone' => $phone,'address' => $address,'email' => $email,'group' => $group,'idpass' => $idpass]);  

            if($do){
                    echo '<script language="javascript">';
                    echo 'alert("Edited Successfully. Click Ok")';
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
                echo 'alert("$sql . . $e->getMessage();")';
                echo '</script>';   
                header("Refresh: 1; url=index.php");
        }

        $conn = null;
    }
 ?>