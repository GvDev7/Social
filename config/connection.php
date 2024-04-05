<?php
    ob_start();
    session_start();

    $timezone = date_default_timezone_set("America/New_York");  //Set the timezone to Eastern Standard Time (EST)

    $con = mysqli_connect("localhost", "root", "", "social");

    if(mysqli_connect_errno()){
        echo 'Error: Could not connect to MySql: '.mysqli_connect_error();
    }


?>