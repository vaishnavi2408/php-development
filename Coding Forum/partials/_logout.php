<?php
session_start();
echo "Logging out. Please wait...";
session_destroy();
header("Location: ../index.php");
?>