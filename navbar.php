<?php
include 'partials/loginModal.php';
include 'partials/signupModal.php';
?>


<?php
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#" >HADI</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Catagories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#">Python</a></li>
          <li><a class="dropdown-item" href="#">Javascript</a></li>
          <li><a class="dropdown-item" href="#">Kotlin</a></li>
        </ul>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Blogs</a>
      </li>
    </ul>';

// <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['username'] . ' </p>
// <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a> 

if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {

  echo ' <form class="d-flex" method="get" action="search.php" >
  <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
    <div class="dropdown mx-3">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    ' . $_SESSION['username'] . '
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><a class="dropdown-item" href="#">Dashboard</a></li>
      <li><a class="dropdown-item" href="partials/logout.php">Log out</a></li>
    </ul>
  </div>
  </div>
  </div>
  </nav>';
} else {
  echo '  <form class="d-flex" method="get" action="search.php" >
  <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
      <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#signupModal"> signup </button>
        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#loginModal"> Login </button>
      </div>
      </div>
      </nav>';
}
