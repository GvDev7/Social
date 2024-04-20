<?php
require 'config/connection.php';

if(isset( $_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE  username='$userLoggedIn'"); 
    $user_detail = mysqli_fetch_array($user_details_query);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">DEV World!</a>
        </div>
        <nav>
            <a href="<?php echo $userLoggedIn; ?>">
                <?php echo $user_detail['first_name']; ?>
            </a>
            <a href="#">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            <a href="#">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </a>
            <a href="#">
                <i class="fa fa-users" aria-hidden="true"></i>
            </a>
            <a href="#">
                <i class="fa fa-bell" aria-hidden="true"></i>
            </a>
            <a href="#">
                <i class="fa fa-cogs" aria-hidden="true"></i>
            </a>
            <a href="includes/handlers/logout.php">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </a>
        </nav>
    </div>

    <div class="wrapper">