<?php
session_start();
$user = array();
if(isset($_SESSION['userID'])){
    require ('partials/dbconnect.php');
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <style>
    .image {
        width: 100%;
        height: 550px;
    }
    </style>

    <title>Forums</title>
  </head>
<body>
<?php require 'navbar.php' ?>
</body>
</html>

