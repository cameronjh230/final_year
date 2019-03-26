<?php
include 'config.php';
session_start();
// this checks to see if user is logged in
if (isset($_SESSION['loggedin'])) {

    echo 'Welcome ' . $_SESSION['name'] . '! <br> 
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>';
} else {
    // if they aren't logged in then it will take them to login page
    header('Location: login.php');}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1>
        Spend Details
    </h1>
</header>

<div class="menu" id="menu-toggle"><img src="pictures/364-01-512.png" alt="menu" class="menubtn"></div>
<nav id="menu-nav">
    <a href="index.php">Home</a>
    <a href="budget.php">Budget</a>
    <a href="spenddetails.php" class="active">Spend Details</a>
    <a href="account.php" >Your Account</a>
</nav>

<div class="addbtns">
    <button class="addspenddetails">
        <a href="addspenddetails.php">Add Spend Details</a>
    </button>
</div>


</body>
</html>
