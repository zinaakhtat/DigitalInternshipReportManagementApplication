<?php

    $host="127.0.0.1:3303";
    $user_name="root";
    $password="";
    $db_name="database";
    $conn=mysqli_connect($host,$user_name,$password,$db_name);
    if(!$conn) die(mysqli_connect_error());
    //else echo "connected";

?>