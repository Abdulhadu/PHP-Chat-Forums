<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $username = $_POST["loginuser"];
    $password = $_POST["loginpass"]; 
    
     
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "SELECT * FROM `users` WHERE user_name ='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){ 

                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $username;
                header("location: /forums/index.php");
            } 
            else{
                echo 'Invalid Credentials';
            }
        }
        
    } 
    else{
        echo  'Invalid error';
    }
}
    
?>