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
    </style>

    <title>Welcome to Forum Web - Coding Forums</title>
</head>

<body>
    <?php
    require"partials/_header.php";
    $thread_id=$_GET['thread_id'];
    $sql="select * from threads where thread_id=".$thread_id;
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $user_id=$row['user_id'];
    $sql2='select name from users where user_id='.$user_id;
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $posted_by=$row2['name'];
    ?>
    <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        // insert into comments table
        if(!empty(trim($_POST['comment']))){
            $comment=htmlentities($_POST['comment']);
            $user_id=$_SESSION['user_id'];
            $sql="insert into comments (text_comment,thread_id,comment_by) values('$comment','$thread_id',$user_id)";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
            }
        }
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added.
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
            <h1 class="display-4"><?php echo $row['title']?></h1>
            <p class="lead"><?php echo $row['description']?></p>
            <hr class="my-1">
            <p>This is a peer to peer forum for sharing knowledge with each other. No Spam / Advertising / Self-promote
                in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <p>Posted by <em><?php echo $posted_by?></em></p>
        </div>
    </div>
    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
        echo '<div class="container my-2">
        <h1>Comment your answer</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
                <label for="comment">Post a comment</label>
                <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
    </div>';
    }
    else{
        echo '<div class="container my-2">
        <h2>Start a Discussion</h2>
            <p class="lead">You are not logged in. You need to login to post a comment.</p>
        </div>';
    }

    ?>

    <div class="container my-3 mb-5" id="browse">
        <h3>Discussions (all comments for this thread)</h3>
        <?php
        $sql="select * from comments where thread_id=".$thread_id;
        $result=mysqli_query($conn,$sql);
        $noResult=true;
        while($row=mysqli_fetch_assoc($result))
        {
            $sql2='select name from users where user_id='.$row['comment_by'];
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            $noResult=false;
            echo '<div class="media my-3">
            <img src="img/user.png" width="40px" height="40px" class="mr-3" alt="user">
            <div class="media-body">
                <p class="font-weight-bold my-0">Comment by: '.$row2['name'].' @ '.$row['comment_time'].'</p>
                <p>'.$row['text_comment'].'</p>
            </div>
            </div>';
        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                <p class="display-4">No comments found.</p>
                <p class="lead">Be the first person to comment.</p>
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