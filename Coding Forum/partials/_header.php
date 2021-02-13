<?php
require "_config.php";
require "_login_modal.php";
require "_signup_modal.php";
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="index.php">ForumWeb</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

    $sql="select * from categories limit 3";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){

      echo '<a class="dropdown-item" href="threadlist.php?cat_id='.$row['category_id'].'">'.$row['name'].'</a>';
    }
        // <a class="dropdown-item" href="#">Another action</a>
        // <div class="dropdown-divider"></div>
        // <a class="dropdown-item" href="#">Something else here</a>
      
      echo '</div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
    </li>
  </ul>
  <form class="d-flex" action="search.php">
  <input class="form-control mr-2" name="search" type="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-success" type="submit">Search</button>
    </form>';

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<p class="text-light m-2">Welcome, '.$_SESSION['username'].'</p>
    <a href="partials/_logout.php" class="btn btn-outline-success" role="button">Logout</a>';
  }
  else{
    echo '<div class="mx-2 my-1">
      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#loginModal">
      Log in
      </button>
      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#signupModal">
      Sign up
    </button>';
}
echo '</div>
</div>
</nav>';

// <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
//   Launch demo modal
// </button>

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='true'){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> Your account is created. You can now login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}
else if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='false'){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Error!</strong> '.$_GET['error'].'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}

?>