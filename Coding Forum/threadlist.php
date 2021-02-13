<?php
require "partials/_config.php";

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
    #browse {
        min-height: 150px;
    }
    .media:hover{
        background-color:#f1f3fc;
    }
    </style>

    <title>Welcome to Forum Web - Coding Forums</title>
</head>

<body>
    <?php
    require"partials/_header.php";
    $cat_id=$_GET['cat_id'];
    $sql="select * from categories where category_id=".$cat_id;
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    ?>
    <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        if(!empty(trim($_POST['title']))){
            $title=htmlentities($_POST['title']);
            $desc=htmlentities($_POST['desc']);
            $user_id=$_SESSION['user_id'];
            $sql="insert into threads (title,description,user_id,category_id) values('$title','$desc',$user_id,$cat_id)";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
            }
        }
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your thread has been added. Please wait for responses from the community.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          $showAlert=false;
        }
    }
    ?>
    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $row['name']?> Forums</h1>
            <p class="lead"><?php echo $row['description']?></p>
            <hr class="my-1">
            <p>This is a peer to peer forum for sharing knowledge with each other. No Spam / Advertising / Self-promote
                in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <button class="btn btn-success">Learn more</button>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
    echo '<div class="container my-2">
        <h1>Start a Discussion</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title short and crisp as possible.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate Your Problem</label>
                <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        </div>';
    }
    else{
        echo '<div class="container my-2">
        <h2>Start a Discussion</h2>
            <p class="lead">You are not logged in. You need to login to start a discussion.</p>
        </div>';
    }
    ?>

    <div class="container my-3 mb-5" id="browse">
        <h3>Browse Questions</h3>
        <?php
        $sql="select * from threads where category_id=".$cat_id;
        $result=mysqli_query($conn,$sql);
        $noResult=true;
        while($row=mysqli_fetch_assoc($result))
        {
            $sql2='select name from users where user_id='.$row['user_id'];
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            $noResult=false;
            echo '<div class="media my-3">
            <img src="img/user.png" width="70px" height="70px" class="mr-3" alt="user">
            <div class="media-body">
                <h5 class="mt-0"><a href="thread.php?thread_id='.$row['thread_id'].'" class="text-dark">'.$row['title'].'</a></h5>
                <p class="my-0 mb-1">'.$row['description'].'</p>
                <p class="font-weight-bold float-right m-0 mr-2">Asked by: '.$row2['name'].' @ '.$row['timestamp'].'</p>
            </div>
            </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                <p class="display-4">No threads in this category</p>
                <p class="lead">Be the first person to ask a question</p>
                </div>
            </div>';
        }
        ?>
    </div>
    <?php require"partials/_footer.php"?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

</body>

</html>