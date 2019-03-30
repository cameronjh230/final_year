<?php
include 'config.php';
session_start();
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
    <h1>Your Account</h1>
</header>

<div class="menu" id="menu-toggle"><img src="pictures/364-01-512.png" alt="menu" class="menubtn"></div>
<nav id="menu-nav">
    <a href="index.php">Home</a>
    <a href="monthlybudget.php">Monthly Budget</a>
    <a href="weeklybudget.php">Weekly Budget</a>
    <a href="spenddetails.php">Spend Details</a>
    <a href="account.php" class="active">Your Account</a>
    <?php if (isset($_SESSION['loggedin'])) {
        // If logged in
        echo '<a href="logout.php">Logout</a>';
    }else{
        echo '<a href="login.php">Log In</a>';
    }
    ?>
</nav>


<script src="js/scripts.js"></script>
</body>
</html>