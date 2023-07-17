<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Search</title>
    <style>
        #cont{
            min-height: 100vh;
        }
        .display-5{
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] = true) {
        include('accounts.php');
    } else {
        ob_start();
        include('navbar.php');
    }
    ?>
    <?php include 'partials/dbconnect.php';  ?>
    <!-- header ends    -->


    <!--search section starts  -->

    <div id="cont" class="container">
        <div class="row">
            <div class="col-md-8 left-side-sidebar">
                <div class="row text-center">
                    <hr class="invisible small">
                </div>
                <div class="col-md-12">
                    <div class="v-heading-v2">
                        <h4 class="v-search-result-count">Search Results for "<b><?php echo $_GET['search']; ?></b>" </h4>
                    </div>
                </div>
            </div>
            <hr>
            </hr>
            <div class="clearfix mt-40">
            <?php
            $querry = $_GET["search"];
            $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$querry')";
            $result = mysqli_query($conn, $sql);
            $empty = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $empty = false;
                $threadid = $row['thread_id'];
                $threadtitle = $row['thread_title'];
                $threaddesc = $row['thread_desc'];
                $url = "thread.php?threadid=" . $threadid;
                $time = $row['date'];
                echo '
                          <ul class="xsearch-items">
                              <li class="search-item">
                                  <div class="search-item-img">
                                      <a href="#">
                                          <img src="https://bootdey.com/img/Content/avatar/avatar2.png" width="70" height="70">
                                      </a>
                                  </div>
                                  <div class="search-item-content">
                                      <h3 class="search-item-caption"><a href="' . $url . '">' . $threadtitle . '</a></h3>
                                      <div class="search-item-meta mb-15">
                                          <ul class="list-inline">
                                              <li class=' . $time . '></li>
                                              <li><a href="#">0 Comments</a></li>
                                          </ul>
                                      </div>
                                      <div>
                                         ' . $threaddesc . '
                                      </div>
                                 </div>
                              </li>
                         </ul>
                ';
            }
            //cheacks
            if ($empty) {
                echo '
        <div class="jumbotron jumbotron-fluid bg-light my-4 warning">
            <div class="container ">
                <h1 class="display-5"><b>No Result Founds</b></h1>
                <h3>Sugestions:</h3>
                    <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords..</li>
                        <li>Try more general keywords.</li>
                        <li>Try fewer keywords.</li>
                    </ul>
        
            </div>
        </div>
        </div>
        </div>
        </div>';
            }

            ?>
        </div>
        </div>
    </div>


    <!-- footer starts  -->
    <?php include('footer.php');  ?>
    <!-- footer ends   -->


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