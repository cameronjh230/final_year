<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="loginsubmit" value="Login">
        </form>

        <br>
        <p><a href="signup.php">Don't have an account please sign up here</a> </p>
        <br>
        <button class="home" type="button" ><a href="index.php">Back</a> </button>
    </div>


<script src="js/scripts.js"></script>
</body>
</html>


<?php
include 'config.php';
session_start();

if (isset($_POST['loginsubmit'])){

    $loginuser = $_POST['username'];
    $loginpassword = $_POST['password'];

    $sql = "SELECT `userid`, `password` FROM `user_details` WHERE `username` = :loginuser";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':loginuser', $loginuser);
    $stmt->execute();
    //$stmt->store_result();



    $numrows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($numrows === false){
         echo "User does not exist";

     } else {

        $validpassword = password_verify($_POST['password'], $numrows['password']);

        if ($validpassword) {
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            header("Location: budget.php");
        } else{
            echo "Incorrect Username or Password";
        }

    }

}