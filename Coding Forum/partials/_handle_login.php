<?php
$showError="false";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "_config.php";
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="select * from users where email='$email'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    if($numRows==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password,$row['password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['username']=$email;
            echo "Logged in: ".$email;
        }
    }
    header("Location: ../index.php");
}
?>