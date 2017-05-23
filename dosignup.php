<?php 

    if(isset($_POST['submit'])){
        define('MyConst', TRUE);
    }

    if(!defined('MyConst')){
        echo '<script language="javascript">';
        echo 'alert("Access Denied")';
        echo '</script>';   
        header("Refresh: 1; url=signup.php");
    }

    else{

        if(isset($_POST['email']) && isset($_POST['password'])){
            $pass = md5(htmlentities($_POST['password']));
            $email = htmlentities($_POST['email']);
        }
        else{
                    echo '<script language="javascript">';
                    echo 'alert("Fill all values. Try Again!")';
                    echo '</script>';   
                    header("Refresh: 1; url=signup.php");
                }

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "address";
        $tbname = "users";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user != Null){
                echo '<script language="javascript">';
                echo 'alert("Email Already exists")';
                echo '</script>';   
                header("Refresh: 1; url=signup.php"); 
            }

            else{
                $sql = $conn->prepare("INSERT INTO $tbname (email,password) VALUES (:email,:pass)");
                $do = $sql->execute(['email' => $email,'pass' => $pass]);

                if($do){
                    echo '<script language="javascript">';
                    echo 'alert("Created Successfully. You can Login Now")';
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

        }
        
        catch(PDOException $e){
                echo '<script language="javascript">';
                echo '$sql . "<br>" . $e->getMessage();';
                echo '</script>';   
                header("Refresh: 1; url=signup.php");
            }

        $conn = null;
    }

?>