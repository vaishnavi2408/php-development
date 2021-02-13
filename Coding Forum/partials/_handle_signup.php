<?php
$showError="false";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "_config.php";
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    // check if email already exists
    $sql="select * from users where email='$email'";
    $result=mysqli_query($conn,$sql);
    $numrows=mysqli_num_rows($result);
    if($numrows>0){
        $showError="Email already registered";
    }
    else{
        if($password==$cpassword){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="insert into users (name,email,password) values('$name','$email','$hash')";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
                header("location: ../index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError="Passwords do not match";
        }
    }
    header("location: ../index.php?signupsuccess=false&error=$showError");
}
?>