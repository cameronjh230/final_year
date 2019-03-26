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
        <h1>Budgeting Made Simple</h1>
    </header>

    <div class="menu" id="menu-toggle"><img src="pictures/364-01-512.png" alt="menu" class="menubtn"></div>
    <nav id="menu-nav">
        <a href="index.php" class="active">Home</a>
        <a href="budget.php">Budget</a>
        <a href="spenddetails.php">Spend Details</a>
        <a href="account.php">Your Account</a>
    </nav>

    <main>
        <p>
            Budgeting is an important part of life today, which allows for you to manage your money better and even start
            saving for something special.
        </p>

        <p>
            This site aims to make budgeting simple and hassle free. Forget the times of having to use pen and paper to
            write down you budget and then figure out how much is left. This site will do it all for you and then display
            it in a visual form as well making it easier to read. What's even better is the fact that you can access this
            on the go via your phone's browser too.
        </p>
    </main>

<script src="js/scripts.js"></script>
</body>
</html>

<?php

   include 'config.php';
   session_start();
   // this checks to see if user is logged in
   if (isset($_SESSION['loggedin'])) {
       // If logged in
       echo 'Welcome ' . $_SESSION['name'] . '! <br> 
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>';
   } else {
       // if they aren't logged in then it will take them to login page
       echo  '<br>
       <form action=login.php>
       <input type="submit" value="Login">
       </form>';
   }
   ?>
