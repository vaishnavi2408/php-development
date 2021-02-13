<?php include "partials/_config.php"?>
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
    #maincontainer {
        min-height: 75vh;
    }
    </style>

    <title>Welcome to Forum Web - Coding Forums</title>
</head>

<body>
    <?php include "partials/_header.php"?>
    <!-- SELECT * FROM threads WHERE MATCH (title,description) against ('python') -->

    <div class="container my-3" id="maincontainer">
        <h1>Search results for <em>`<?php echo $_GET['search']?>`</em></h1>
        <ul>
        <?php
        $noResults=true;
        $query=$_GET['search'];
        $sql="select * from threads where match(title,description) against ('$query')";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
            $noResults=false;
            echo '<li><div class="result">
            <h3><a href="thread.php?thread_id='.$row['thread_id'].'" class="text-dark">'.$row['title'].'</a></h3>
                <p>'.$row['description'].'</p>
            <hr>
            </div></li>';
        }
        if($noResults){
            echo '<div class="jumbotron">
                <div class="container">
                    <p class="display-4">No results found.</p>
                    <p class="lead">Your search - '.$_GET['search'].' - did not match any documents.</p>
                    <p>Suggestions:
                    <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords.</p></li>
                    </ul>
                </div>
            </div>';
        }
        ?>
        </ul>
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