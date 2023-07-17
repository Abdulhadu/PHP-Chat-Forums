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
    body {
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

    h1 {
      font-weight: 1200;
      text-decoration: underline;
      text-align: center;

    }

    h5 {
      font-weight: bold;
    }

    h2 {
      font-weight: bolder;
    }

    h2 {
      text-align: center;
      margin-top: 200px;
      margin-bottom: 200px;
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

    #contact {
      align-items: center;
      text-align: center;
      margin: auto;
    }

    .img1 {
      align-items: center;
      justify-content: center;
      display: flex;
      margin-left: auto;
      margin-right: auto;
      margin-top: 70px;
    }

    .para {
      align-items: center;
      justify-content: center;
      display: flex;
      margin-left: auto;
      margin-right: auto;
    }

    a {
      padding: 5px;
    }

    .box{
      padding: 15px;
      height: 280px;
      width: 600px;
    }
    .heading{
      margin-top: 50px;
      margin-bottom: 100px;
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


  <div class="container" id="contact">
    <svg aria-hidden="true" class="img1" width="96" height="96">
      <path opacity=".2" d="M8 37.9l34.75 21.51a5.8 5.8 0 005.88-.04l36.6-22.54A5.8 5.8 0 0194 41.8v46.4c0 3.2-2.6 5.8-5.8 5.8H13.8A5.8 5.8 0 018 88.2V37.9z"></path>
      <path d="M11 7.5A4.5 4.5 0 0115.5 3h60A4.5 4.5 0 0180 7.5v18a1.5 1.5 0 01-3 0v-18c0-.83-.67-1.5-1.5-1.5h-60c-.83 0-1.5.67-1.5 1.5v18a1.5 1.5 0 01-3 0v-18zM31.55 13a3.2 3.2 0 00-3 2.59A3.4 3.4 0 0025.38 13a3.3 3.3 0 00-2.54 1.06 3.2 3.2 0 00-.8 2.61c0 3.03 3.96 5.82 5.63 7l.09.06a1.2 1.2 0 001.51 0l.26-.18c1.66-1.2 5.47-3.96 5.47-6.88 0-1.61-.48-3.67-3.45-3.67zM1 23.5A4.5 4.5 0 015.5 19h2a1.5 1.5 0 010 3h-2c-.83 0-1.5.67-1.5 1.5v4.36l41.23 26.2c.17.1.37.1.54 0L87 27.85V23.5c0-.83-.67-1.5-1.5-1.5h-2a1.5 1.5 0 010-3h2a4.5 4.5 0 014.5 4.5v62a4.5 4.5 0 01-4.5 4.5h-80A4.5 4.5 0 011 85.5v-62zm86 7.91L56.75 50.63l22.81 22.8a1.5 1.5 0 01-2.12 2.13L54.16 52.28l-6.78 4.3a3.5 3.5 0 01-3.76 0l-6.78-4.3-23.28 23.28a1.5 1.5 0 01-2.12-2.12l22.8-22.81L4 31.41V85.5c0 .83.67 1.5 1.5 1.5h80c.83 0 1.5-.67 1.5-1.5V31.41zM42.5 24a1.5 1.5 0 000 3h26a1.5 1.5 0 000-3h-26zM41 16.5c0-.83.67-1.5 1.5-1.5h17a1.5 1.5 0 010 3h-17a1.5 1.5 0 01-1.5-1.5zM42.5 33a1.5 1.5 0 000 3h16a1.5 1.5 0 000-3h-16z"></path>
    </svg>
    <h2 class="fs-display1 p-ff-roboto-slab mb16">Support &amp; Feedback</h2>
    <p class="para" class="fs-subheading fc-black-600 p-lh-md mb0 wmx5 mx-auto">
      If you need help, please
      <a href="https://stackoverflow.com/contact?referrer=https://stackoverflow.co"> contact us </a>
      . To share product feedback on our products, please
      <a href="https://meta.stackoverflow.com/">visit our community here</a>
      .
    </p>
  </div>

  <?php
  $showalert = false;
  $alert = false;
  $method = $_SERVER['REQUEST_METHOD'];
  if ($method == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `contact` (`id`, `name`, `email`, `text`, `time`) VALUES (NULL, '$name', '$email', '$message', current_timestamp());";
    $alert = true;
    $result = mysqli_query($conn, $sql);
  } else {
    $showalert = true;
  }
  ?>



  <!-- main section starts  -->
  <h2 class="my-5 p-ff-roboto-slab mb16">Contact Form</h2>
  <hr>
  <div class="container my-5 py-4">
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
    <!-- Bootstrap 5 starter form -->
    <form id="contactForm" action="<?php $_SERVER["REQUEST_URI"] ?>" method="post">

      <!-- Name input -->
      <div class="mb-3">
        <label class="form-label" for="name">Name</label>
        <input class="form-control" id="name" type="text" name="name" id="name" placeholder="Name" data-sb-validations="required" />
        <div class="invalid-feedback" data-sb-feedback="name:required">Name is required.</div>
      </div>

      <!-- Email address input -->
      <div class="mb-3">
        <label class="form-label" for="emailAddress">Email Address</label>
        <input class="form-control" name="email" id="email" type="email" placeholder="Email Address" data-sb-validations="required, email" />
        <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
        <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
      </div>

      <!-- Message input -->

      <div class="mb-3 ">
        <label class="form-label" for="message">Message</label>
        <textarea class="form-control" name="message" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
        <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
      </div>

      <!-- Form submissions success message -->
      <div class="d-none" id="submitSuccessMessage">
        <div class="text-center mb-3">Form submission successful!</div>
      </div>

      <!-- Form submissions error message -->
      <div class="d-none" id="submitErrorMessage">
        <div class="text-center text-danger mb-3">Error sending message!</div>
      </div>

      <!-- Form submit button -->
      <div class="d-grid">
        <button class="btn btn-primary btn-lg" type="submit">Submit</button>
      </div>

    </form>

  </div>





  <!-- Our products and services  -->

  <div class="container-lg">

    <h2 class="fs-headline2 p-ff-roboto-slab mb32 heading"> Our products &amp; services </h2>
    <hr>
    <div class="d-flex flex__allitems6 sm:fd-column gs64 bg-black-025 bar-lg my32">
      <div class="flex--item box">
        <h3 class="fs-title p-ff-roboto-slab-bold mb16"><a href="https://stackoverflow.com/teams">Teams</a></h3>
        <p class="fs-subheading fc-black-600 p-lh-md mb24">
          A private, secure home for your team’s questions and answers. Perfect for teams of 10-500 members. No
          more digging through stale wikis and lost emails—give your team back the time it needs to build better
          products.
        </p> <a href="https://stackoverflow.com/teams" class="fs-body3 p-ff-source-bold fc-black-400 h:fc-black-600"><svg aria-hidden="true" width="18" height="18" class="va-middle mr4 mtn2 svg-icon iconLightbulb">
            <path d="M15 6.38A6.48 6.48 0 007.78.04h-.02A6.49 6.49 0 002.05 5.6a6.31 6.31 0 002.39 5.75c.49.39.76.93.76 1.5v.24c0 1.07.89 1.9 1.92 1.9h2.75c1.04 0 1.92-.83 1.92-1.9v-.2c0-.6.26-1.15.7-1.48A6.32 6.32 0 0015 6.37zM4.03 5.85A4.49 4.49 0 018 2.02a4.48 4.48 0 015 4.36 4.3 4.3 0 01-1.72 3.44c-.98.74-1.5 1.9-1.5 3.08v.1H7.2v-.14c0-1.23-.6-2.34-1.53-3.07a4.32 4.32 0 01-1.64-3.94zM10 18a1 1 0 000-2H7a1 1 0 100 2h3z"></path>
          </svg>
          Learn more
        </a>
      </div>
      <div class="flex--item box">
        <h3 class="fs-title p-ff-roboto-slab-bold mb16"><a href="https://stackoverflow.com/enterprise"> Bigger organization? </a></h3>
        <p class="fs-subheading fc-black-600 p-lh-md mb24">
          Stack Overflow Enterprise is a private, secure home for your organization’s questions and answers.
          Empower your teams to find and share information without disrupting their workflows.
        </p> <a href="https://stackoverflow.com/enterprise/get-started" class="fs-body3 p-ff-source-bold fc-black-400 h:fc-black-600"><svg aria-hidden="true" width="18" height="18" class="va-middle mr4 mtn2 svg-icon iconMail">
            <path d="M1 6l8 5 8-5V4L9 9 1 4c0-1.1.9-2 2-2h12c1.09 0 2 .91 2 2v10c0 1.09-.91 2-2 2H3c-1.09 0-2-.91-2-2V6z"></path>
          </svg>
          Get in touch
        </a>
      </div>
    </div>
    <div class="d-flex flex__allitems6 gs64 sm:fd-column">
      <div class="flex--item box">
        <h3 class="fs-title p-ff-roboto-slab-bold mb16"><a href="https://stackoverflow.com/talent">Talent</a></h3>
        <p class="fs-subheading fc-black-600 p-lh-md mb24">
          Employer branding solutions for technology teams. Reach the world’s largest collection of tech talent.
        </p> <a href="https://stackoverflow.com/talent/contact" class="fs-body3 p-ff-source-bold fc-black-400 h:fc-black-600"><svg aria-hidden="true" width="18" height="18" class="va-middle mr4 mtn2 svg-icon iconMail">
            <path d="M1 6l8 5 8-5V4L9 9 1 4c0-1.1.9-2 2-2h12c1.09 0 2 .91 2 2v10c0 1.09-.91 2-2 2H3c-1.09 0-2-.91-2-2V6z"></path>
          </svg>
          Request a demo
        </a>
        <div class="bt bc-black-050 pt24 mt24">
          <p class="mb8"><svg aria-hidden="true" width="18" height="18" class="svg-icon iconPhone">
              <path d="M5 8c1.12 2.2 2.8 3.87 5 5l2-2h2a2 2 0 012 2v1.5c0 .88-.63 1.5-1.5 1.5C7.2 16 2 10.8 2 3.5 2 2.62 2.63 2 3.5 2H5a2 2 0 012 2v2L5 8z"></path>
            </svg> <span class="p-ff-source-bold mr6">US</span> <span class="fs-body2 mr4">+1 (212)232-8294</span> <small class="fs-body1 fc-black-500"> 9am–5pm U.S. Eastern Time </small></p>
          <p><svg aria-hidden="true" width="18" height="18" class="svg-icon iconPhone">
              <path d="M5 8c1.12 2.2 2.8 3.87 5 5l2-2h2a2 2 0 012 2v1.5c0 .88-.63 1.5-1.5 1.5C7.2 16 2 10.8 2 3.5 2 2.62 2.63 2 3.5 2H5a2 2 0 012 2v2L5 8z"></path>
            </svg> <span class="p-ff-source-bold mr6">UK</span> <span class="fs-body2 mr4">+44 800 048 8989</span> <small class="fs-body1 fc-black-500">9am–5pm GMT/BST</small></p>
        </div>
      </div>
      <div class="flex--item box">
        <h3 class="fs-title p-ff-roboto-slab-bold mb16"><a href="https://stackoverflow.com/advertising">Advertising</a></h3>
        <p class="fs-subheading fc-black-600 p-lh-md mb24">
          Stack Overflow Advertising provides a highly relevant and brand safe environment to engage with
          developers and the technical community. Find out how we can build an advertising strategy that supports
          your marketing and business goals.
        </p> <a href="https://stackoverflow.com/advertising/contact" class="fs-body3 p-ff-source-bold fc-black-400 h:fc-black-600"><svg aria-hidden="true" width="18" height="18" class="va-middle mr4 mtn2 svg-icon iconMail">
            <path d="M1 6l8 5 8-5V4L9 9 1 4c0-1.1.9-2 2-2h12c1.09 0 2 .91 2 2v10c0 1.09-.91 2-2 2H3c-1.09 0-2-.91-2-2V6z"></path>
          </svg>
          Talk to an expert
        </a>
      </div>
    </div>
  </div>

  <!-- services section sends  -->




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