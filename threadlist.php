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

        #time {
            text-decoration: underline;
            font-weight: 500;
            color: #11a5f5;
        }

        .page-link {
            font-weight: 800;
            background-color: #11a5f5;
        }
    </style>

    <title>Threads</title>
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
        if (!isset($_GET['catid'])) {
            $id = 1;
        } else {
            $id = $_GET['catid'];
        }
        $sql = "SELECT * FROM `catagories` WHERE `catagories-id`= $id ";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $catname = $row['catagories-name'];

            $catdesc = $row['catagories-desc'];
        ?>
            <div class="jumbotron">
                <h2 class="display-5 ">Welcome to <?php echo $catname; ?> FORUMS</h2>
                <p class="lead"><?php echo $catdesc; ?></p>
                <hr class="my-4">
                <p>It is special forum for all the devolopers to share their knowlege and build carrer.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
            </div>
        <?php } ?>
    </div>

    <!-- Line  -->
    <hr>

    <!-- form section starts  -->

    <?php
    $showalert = false;
    $alert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);
        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);
        $th_cat = $_POST['cat'];
        $sno = $_POST['user_id'];
        $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `date`) VALUES (NULL, '$th_title', ' $th_desc', '$th_cat', '$sno', current_timestamp());";
        $alert = true;
        $result = mysqli_query($conn, $sql);
    } else {
        $showalert = true;
    }
    ?>

    <div class="container bg-light">


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
                    <strong>Inserted Sucessfully </strong> Congradulation Your question are added successfully Our comunity definitely solve your issue thanks..
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
        } ?>


        <h2 class=" text-center my-4">ADD Questions</h2>

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true) {
            echo '
            <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="form-group my-2">
                <label for="exampleFormControlInput1">ADD a Question</label>
                <input type="text" class="form-control form-control-lg" class="title" name="title" id="title" placeholder="Querry">
            </div>
            <div class="form-group my-2">
                <label for="exampleFormControlSelect1">Select catagory</label>
                <select class="form-control form-control-lg " id="exampleFormControlSelect1" class="cat" name="cat" id="cat">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <input type="hidden" name="user_id" id="user_id" value="' .  $_SESSION['user_id'] . '">
            <div class="form-group my-3">
                <label for="exampleFormControlTextarea1">ADD Discription</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" class="desc" name="desc" id="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> ';
        } else {
            echo ' <div class="jumbotron">
            <h1 class="display-4">SORRY..!!</h1>
            <p class="lead">YOu dont allow to post A queation.......</p>
            <hr class="my-4">
            <p>Please first signup or Register to Add a queation and become part od discussion</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Login</a>
        </div>
            ';
        }
        ?>
    </div>

    <!-- form section ends  -->


    <!-- cards starts  -->
    <div class="container bg-light">
        <h2 class=" my-4">Related Questions</h2>


        <?php
        // define how many results you want per page
        $results_per_page = 5;

        // find out the number of results stored in database
        $sql = 'SELECT * FROM  `threads`';
        $result = mysqli_query($conn, $sql);
        $number_of_results = mysqli_num_rows($result);

        // determine number of total pages available
        $number_of_pages = ceil($number_of_results / $results_per_page);

        // determine which page number visitor is currently on
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        // determine the sql LIMIT starting number for the results on the displaying page
        $this_page_first_result = ($page - 1) * $results_per_page;

        // retrieve selected results from database and display them on page
        if (!isset($_GET['catid'])) {
            $thid = 1;
        } else {
            $thid = $_GET['catid'];
        }
        $sql = 'SELECT * FROM `threads` WHERE thread_cat_id = ' . $thid . ' LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
        $result = mysqli_query($conn, $sql);
        $empty = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $empty = false;
            $threadid = $row['thread_id'];
            $threadtitle = $row['thread_title'];
            $threaddesc = $row['thread_desc'];
            $threadcat = $row['thread_cat_id'];
            $thread_user_id = $row['thread_user_id'];
            $time = $row['date'];
            $sql2 = "SELECT * FROM `users` WHERE user_id = $thread_user_id";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $user = $row2['user_name'];
            echo '
            <div class="flex-column">
            <div class="media my-3 p-3  d-inline-flex border border-dark rounded-left">
            <div class="search-item-img">
            <img class="mr-3 m-3" itemprop="image" width="70" height="70" src="https://bootdey.com/img/Content/avatar/avatar3.png" height=60px width=60px alt="Generic placeholder image">
            </div>
            <div class="media-body">
                <h5 class="mt-0 "><a class="text-dark text-decoration-none
                font-weight-bold" href="thread.php?threadid=' . $threadid . '"</a>' . $threadtitle . ' </h5> 
                <p > Posted BY:  <a href="#">' . $user . '</a> </p>
                <p id="time" >' . $time . '</p>
                <P>' . $threaddesc . '</P>
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
        } ?>


        <!-- paginatiom -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link prev" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item">
                    <?php
                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        echo '<a class="page-link d-inline" href="threadlist.php?page=' . $page . '">' . $page . '</a> ';
                    }
                    ?>
                </li>
                <li class="page-item">
                    <a class="page-link next" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <!-- -------Ends----------- -->

    </div>
    <!-- cards ends   -->


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
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.next').click(function() {
                $('.pagination').find('.page-item.active').next().addClass('active');
                $('.pagination').find('.page-item.active').prev().removeClass('active');
            })
            $('.prev').click(function() {
                $('.pagination').find('.page-item.active').prev().addClass('active');
                $('.pagination').find('.page-item.active').next().removeClass('active');
            })
        })
    </script>

</body>

</html>