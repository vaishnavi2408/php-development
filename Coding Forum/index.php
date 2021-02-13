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

    <title>Welcome to Forum Web - Coding Forums</title>
</head>

<body>
    <?php include "partials/_header.php"?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1600x500/?code,program" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/slider3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- cards -->
    <div class="container my-4">
        <h2 class="text-center">ForumWeb - Browse Categories</h2>
        <div class="row">
            <?php
			$sql="select * from categories";
			$result=mysqli_query($conn,$sql);
			if($result){
				while($row=mysqli_fetch_assoc($result)){
					echo '<div class="col-md-4 my-2">
						<div class="card" style="width: 18rem;">
							<img src="https://source.unsplash.com/400x300/?coding,'.$row['name'].'" class="card-img-top" alt="'.$row['name'].' img">
							<div class="card-body">
								<h5 class="card-title"><a href="threadlist.php?cat_id='.$row['category_id'].'">'.$row['name'].'</a></h5>
								<p class="card-text">'.substr($row['description'],0,90).'...</p>
								<a href="threadlist.php?cat_id='.$row['category_id'].'" class="btn btn-primary">View Threads</a>
							</div>
						</div>
					</div>';
				}
			}
			?>
        </div>
    </div>

    <?php require"partials/_footer.php"?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>

</html>