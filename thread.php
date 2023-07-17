<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
           body{
            margin: 0px;
            padding: 0px;
            margin-top: 0px;
        }
        .image {
            width: 100%;
            height: 550px;
        }

        .container {
            width: 75%;
            padding: 15px;

        }

        h5 {
            font-weight: bold;
        }

        h2 {
            font-weight: bolder;
        }

        p.time {
            text-align: right;
            font-weight: bold;
            color: #11a5f5;
              }

        #comments {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .media-body {
            width: 100%;
        }
    </style>

    <title>Comments</title>
</head>

<body>

    <!-- header starts  -->
    <?php include 'partials/dbconnect.php';  ?>
    <?php
    if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] = true) {
        include('accounts.php');
    } else {
        ob_start();
        include('navbar.php');
    }
    ?>
    <!-- header ends    -->

    <!-- main section starts  -->
    <div class="container">
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE `thread_id`= $id ";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $threadtitle = $row['thread_title'];
            $threaddesc  = $row['thread_desc'];
            $date = $row['date'];
            $userid = $row['thread_user_id'];
            $sql2 = "SELECT * FROM `users` WHERE user_id = $userid";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user = $row2['user_name'];
        ?>
            <div class="jumbotron">
                <h2 class=" my-4">Questions</h2>
                <h2 class="display-6 "><?php echo $threadtitle; ?></h2>
                <p class="lead"><?php echo $threaddesc; ?></p>
                <hr class="my-4">
                <p> Posted BY: <a href="#"><?php echo $user ?></a> </p>
                <p class="time"> <?php echo $date; ?> </p>
            </div>
        <?php } ?>
    </div>

    <hr>




    <!-- comments starts  -->

    <div class="container bg-light">
        <h2 class=" my-4">Comments</h2>
        <hr>
        <?php
        $thid = $_GET['threadid'];
        $sql = $sql = "SELECT * FROM `comments` WHERE `thread_id`= $thid ";
        $result = mysqli_query($conn, $sql);
        $empty = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $empty = false;
            // $commentid = $row['comment_id'];
            $commentdesc = $row['comments_desc'];
            $commentuser = $row['comment_user'];
            $time = $row['time'];
            $sql2 = "SELECT * FROM `users` WHERE user_id = $commentuser";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $commentuser = $row2['user_name'];
            echo '
            <div id="comments"> 
            <div class="media my-3 p-3 d-inline-flex">
            <img class="mr-3 m-3" src="partials/img/user.png" height=60px width=60px alt="Generic placeholder image">
            <div class="media-body">

            <p> Posted BY:  <a href="#">' .  $commentuser . '</a> </p>
            <p>' .  $commentdesc . '</p>
            <p class="time text-right">' . $time . '</p>
            </div>
        </div>
        </div>';
        }
        if ($empty) {
            echo '
            <div class="jumbotron jumbotron-fluid bg-light my-4">
            <div class="container">
              <h1 class="display-5">No Threads Founds</h1>
              <p class="lead">Yuu Are te first person in this catagory to <B>ADD question</b></p>
            </div>
          </div>';
        }

        ?>
    </div>

    <!-- commentrs ends  -->






    <!-- form section starts  -->

    <?php
    $showalert = false;
    $alert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {

        $comment_desc = $_POST['comment'];
        
        $comment_desc = str_replace("<", "&lt;", $comment_desc );
        $comment_desc = str_replace(">", "&gt;", $comment_desc ); 
        $sno = $_POST['user_id'];

        $sql = "INSERT INTO `comments` (`comments_id`, `comments_desc`, `thread_id`, `comment_user`, `time`) VALUES (NULL, '$comment_desc', '$thid', '$sno', current_timestamp());";
        $alert = true;
        $result = mysqli_query($conn, $sql);
    } else {
        $showalert = true;
    }
    ?>

    <div class="container bg-light">
        <h2 class=" text-center my-4">Post Comments</h2>

        <?php

        if ($showalert) {
            echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> Not Inserted </strong> You should check in some of those fields below. Your Question has Not been inserted.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
        }
        if ($alert) {
            echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Inserted Sucessfully </strong> Congradulation Sucessfully posted...
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
        }
        ?>


        <?php
        echo '
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
        <div class="form-group my-4">
        <label for="exampleFormControlTextarea1">ADD Comments</label>
        <textarea class="form-control my-4" id="exampleFormControlTextarea1" class="comment" name="comment" id="comment"
        rows="3"></textarea>
        <input type="hidden" name="user_id" id="user_id" value="' .  $_SESSION['user_id'] . '">
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
        </form>';  
        ?>

    </div>

    <!-- form section ends  -->






    <!-- main section ends  -->

    <!-- footer starts  -->
    <?php include('footer.php');  ?>
    <!-- footer ends   -->


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

</body>

</html>