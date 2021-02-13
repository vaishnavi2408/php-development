<!-- https://datatables.net/ -->
<!-- https://code.jquery.com/ -->
<!-- ?update=true -->
<?php

// Connect to db
$conn = mysqli_connect("localhost","root","","harry_login");
if(!$conn)
{
    die("Error connecting to database<br>".mysqli_connect_error());
}

$insert=false;
$update=false;
$deleted=false;

if(isset($_GET['delete']))
{
    $sno=$_GET['delete'];
    // echo $sno;
    $sql1="DELETE FROM `notes` WHERE `notes`.`id` = $sno";
    $result1=mysqli_query($conn,$sql1);
    if($result1)
    {
        $deleted=true;
        header("location: index.php");
        return;
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['srnoEdit']))
    {
        // Update record
        $sno = $_POST['srnoEdit'];
        $title = $_POST['titleEdit'];
        $description = $_POST['descEdit'];
        $sql="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`id` = $sno";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            // echo "updated successfully";
            $update = true;
        }
        else{
            echo "update failed";
        }
    }
    else
    {
        $title = $_POST['title'];
        $description = $_POST['desc'];
        $sql="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description');";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            // echo "record inserted successfully";
            $insert=true;
        }
        else
        {
            echo "error... ".mysqli_error($conn);
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- data table css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <title>Todo List (PHP CRUD)</title>
</head>

<body>

    <!--Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="srnoEdit" id="srnoEdit">
                        <div class="form-group">
                            <label for="titleEdit">Title</label>
                            <input type="text" class="form-control" name="titleEdit" id="titleEdit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="descEdit">Description</label>
                            <textarea class="form-control" name="descEdit" id="descEdit" rows="3"></textarea>
                        </div>
                        <!-- <button type="submit" class="btn btn-primary">Update Note</button> -->
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="php_logo.svg" height="42px" width="42px" alt="php logo">
            iNotes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
        if($insert)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your note is added successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
        if($update)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your note is updated successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
        if($deleted)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your note is deleted successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    ?>

    <div class="container my-4">
        <h2>Add a note to iNotes</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-4">
        <table class="table table-sm table-bordered table-hover" id="myTable">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Sr.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    $sql="SELECT * FROM `notes` order by title";
                    $result=mysqli_query($conn,$sql);
                    $i=1;
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo "<tr>
                        <th scope='row'>".$i++."</th>
                        <td>".$row['title']."</td>
                        <td>".$row['description']."</td>
                        <td><button class='btn btn-sm btn-primary edit' id=".$row['id']." data-toggle='modal' data-target='#editModal'>Edit</button> <button class='delete btn btn-sm btn-danger' id=d".$row['id'].">Delete</button></td>
                    </tr>";
                    }
                ?>

            </tbody>
        </table>
    </div>
    <hr>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>

    <!-- data table js -->
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
    <!-- data table js end -->
    <script>
    edits = document.getElementsByClassName("edit");
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            // console.log("edit");
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            // console.log(title,description);
            titleEdit.value = title;
            descEdit.value = description;
            srnoEdit.value = e.target.id;
            // console.log(e.target.id);
            $('#editModal').modal('toggle');
        })
    })


    deletes = document.getElementsByClassName("delete");
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            // console.log("edit");
            sno = e.target.id.substr(1, );

            if (confirm("Are you sure you want to delete this note?")) {
                console.log("yes");
                window.location = `/harry/todolist/index.php?delete=${sno}`;

                // TODO: Create a from and use post request to submit the form
            } else {
                console.log("no");
            }
        })
    })
    </script>

</body>

</html>