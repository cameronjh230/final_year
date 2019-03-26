<?php

include 'config.php';
session_start();
// this checks to see if user is logged in
if (isset($_SESSION['loggedin'])) {
} else {
    // if they aren't logged in then it will take them to login page
    header('Location: login.php');}

    $loggedinuser = $_SESSION['name'];

    //gets the monthly budget data from table
    $sqlbudg="SELECT `monthlybudget` AS monthbudget FROM `monthly_details` WHERE username='$loggedinuser'";
    $stmtbudg= $conn->prepare($sqlbudg);
    $stmtbudg->execute();
    //fetches data and creates variable so it can be used elsewhere
    $budgetresult=$stmtbudg->fetch(PDO::FETCH_ASSOC);
    $monhtlybudget=$budgetresult['monthbudget'];

    //this sql command gets the user's remaining monthly budget
    $sqlremain="SELECT `monthleft` AS remainingmonth FROM `monthly_details` WHERE username='$loggedinuser'";
    $stmtrem= $conn->prepare($sqlremain);
    $stmtrem->execute();

    //gets the data and creates a variable with that data
    $remainresult=$stmtrem->fetch(PDO::FETCH_ASSOC);
    $monthlyremaining=$remainresult['remainingmonth'];

    //this sql gets the users total spend
    $sqltotal="SELECT `monthtotal` AS totalmonth FROM `monthly_details` WHERE username='$loggedinuser'";
    $stmttotal= $conn->prepare($sqltotal);
    $stmttotal->execute();

    //gets the data from the query and creates variable with it
    $totalresult=$stmttotal->fetch(PDO::FETCH_ASSOC);
    $totalmonthly=$totalresult['totalmonth'];

    //this sql query gets the users weekly budget
    $sqlweek="SELECT `weeklybudget` AS budgetweekly FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtweek= $conn->prepare($sqlweek);
    $stmtweek->execute();

    //gets the data and creates variable
    $weekresult=$stmtweek->fetch(PDO::FETCH_ASSOC);
    $weekbudget=$weekresult['budgetweekly'];

    //gets weekly spend data
    $sqlweektotal="SELECT `totalweeklyspend` AS totalweekly FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmttotweek= $conn->prepare($sqlweektotal);
    $stmttotweek->execute();

    //fetches data and creates variable
    $totalweekresult=$stmttotweek->fetch(PDO::FETCH_ASSOC);
    $totalweekly=$totalweekresult['totalweekly'];

    //gets remaining weekly budget
    $sqlweekrem="SELECT `weeklyleft` AS remainingweekly FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtremaining= $conn->prepare($sqlweekrem);
    $stmtremaining->execute();

    //fetches the user's data and creates variable
    $remainweekresult=$stmtremaining->fetch(PDO::FETCH_ASSOC);
    $remainweekly=$remainweekresult['remainingweekly'];


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
        <h1>Your Budget</h1>
    </header>

    <div class="menu" id="menu-toggle"><img src="pictures/364-01-512.png" alt="menu" class="menubtn"></div>
    <nav id="menu-nav">
        <a href="index.php" >Home</a>
        <a href="budget.php" class="active">Budget</a>
        <a href="spenddetails.php">Spend Details</a>
        <a href="account.php">Your Account</a>
    </nav>

    <div class="addbtns">
        <button class="addmonthlybudget" type="button">
            <a href="addmonthlybudget.php">Add/Update Monthly Budget</a>
        </button>

        <button class="addweeklybudget" type="button">
            <a href="addweeklybudget.php">Add/Update Weekly Budget</a>
        </button>
    </div>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <br>

    <button class="budgetaccordion">
        <h2>Monthly Budget</h2>
    </button>
    <div class="panel">
        <p>Your budget is £<?php echo "$monhtlybudget"?></p>
        <p>You have so far spent £<?php echo "$totalmonthly"?> this month</p>
        <p>Your remaining budget is £<?php echo"$monthlyremaining"?></p>
    </div>

    <button class="budgetaccordion">
        <h2>Weekly Budget</h2>
    </button>
    <div class="panel">
        <p>Your weekly budget is £<?php echo "$weekbudget"?></p>
        <p>You have so far spent £<?php echo "$totalweekly"?></p>
        <p>Your remaining budget is £<?php echo "$remainweekly"?></p>
    </div>



<script src="js/scripts.js"></script>
</body>
</html>


