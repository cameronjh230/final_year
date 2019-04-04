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

    //gets the week1spend from monthly details table
    $sqlweek1="SELECT `week1spend` AS week1spend FROM `monthly_details` WHERE username='$loggedinuser'";
    $stmtweek1= $conn->prepare($sqlweek1);
    $stmtweek1->execute();

    //fetches the week 1 spend data and creates a variable
    $week1result=$stmtweek1->fetch(PDO::FETCH_ASSOC);
    $week1spend=$week1result['week1spend'];

    //gets the week2spend from monthly details
    $sqlweek2="SELECT `week2spend` AS week2spend FROM `monthly_details` WHERE username='$loggedinuser'";
    $stmtweek2= $conn->prepare($sqlweek2);
    $stmtweek2->execute();

    //fetches the week2 data and creates variable
    $week2result=$stmtweek2->fetch(PDO::FETCH_ASSOC);
    $week2spend=$week2result['week2spend'];

    //gets the week3spend from the monthly details table in the database
    $sqlweek3="SELECT `week3spend` AS week3spend FROM `monthly_details` WHERE username='$loggedinuser'";
    $stmtweek3= $conn->prepare($sqlweek3);
    $stmtweek3->execute();

    //fetches the week3 data and creates variable
    $week3result=$stmtweek3->fetch(PDO::FETCH_ASSOC);
    $week3spend=$week3result['week3spend'];

    //gets the week4spend from monthly details
    $sqlweek4="SELECT `week4spend` AS week4spend FROM `monthly_details` WHERE username='$loggedinuser'";
    $stmtweek4= $conn->prepare($sqlweek4);
    $stmtweek4->execute();

    //fetches the week4 data and creates variable
    $week4result=$stmtweek4->fetch(PDO::FETCH_ASSOC);
    $week4spend=$week4result['week4spend'];


    $monthpoints = array(
        array("y" => $week1spend, "label" => "Week 1 Spend" ),
        array("y" => $week2spend, "label" => "Week 2 Spend" ),
        array("y" => $week3spend, "label" => "Week 3 Spend" ),
        array("y" => $week4spend, "label" => "Week 4 Spend" )
    )
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        window.onload = function() {

            let chart = new CanvasJS.Chart("monthlychartContainer", {
                animationEnabled: true,
                theme: "dark1",
                title:{
                    text: "Monthly Spend"
                },
                axisY: {
                    title: "Spend (£)"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "£#,##0.##0",
                    dataPoints: <?php echo json_encode($monthpoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>

    <header>
        <h1>Your Monthly Budget</h1>
    </header>

    <div class="menu" id="menu-toggle"><img src="pictures/364-01-512.png" alt="menu" class="menubtn"></div>
    <nav id="menu-nav">
        <a href="index.php" >Home</a>
        <a href="monthlybudget.php" class="active">Monthly Budget</a>
        <a href="weeklybudget.php">Weekly Budget</a>
        <a href="spenddetails.php">Spend Details</a>
        <a href="account.php">Your Account</a>
        <?php if (isset($_SESSION['loggedin'])) {
            // If logged in
            echo '<a href="logout.php">Logout</a>';
        }else{
            echo '<a href="login.php">Log In</a>';
        }
        ?>
    </nav>

    </div>
    <div class="monthoptions">
        <div class="addbtns">
            <button class="addmonthlybudget" type="button" onclick="window.location.href='addmonthlybudget.php'">Add/Update Monthly Budget</button>
        </div>
        <button class="monthaccordion">Summary</button>
        <div class="panel">
            <p>Your budget is £<?php echo "$monhtlybudget"?></p>
            <p>You have so far spent £<?php echo "$totalmonthly"?> this month</p>
            <p>Your remaining budget is £<?php echo"$monthlyremaining"?></p>
        </div>
    </div>


    <br>

    <div class="monthchart" id="monthlychartContainer" "></div>



<script src="js/scripts.js"></script>
</body>
</html>


