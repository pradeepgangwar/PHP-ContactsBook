<?php 

    session_start();
    $idpass = $_SESSION['deleteid'];

    if(isset($_POST['submit5'])){
        define('MyConst', TRUE);
    }

    if(!defined('MyConst')){
        echo '<script language="javascript">';
        echo 'alert("Access Denied")';
        echo '</script>';   
        header("Refresh: 1; url=index.php");
        exit();
    }

    if(isset($_POST['submit5'])){

        try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "address";
            $tbname = "contacts";

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM $tbname WHERE id = :id");
            $do = $stmt->execute(['id' => $idpass]);  

            if($do){
                    echo '<script language="javascript">';
                    echo 'alert("Deleted Successfully. Click Ok")';
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
                echo '$sql . . $e->getMessage();';
                echo '</script>';   
                header("Refresh: 1; url=index.php");
        }

        $conn = null;
    }
 ?>