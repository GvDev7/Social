<?php
require 'config/connection.php';

if(isset( $_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
} else {
    header("Location: register.php");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEV-World</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">DEV World!</a>
        </div>
    </div>