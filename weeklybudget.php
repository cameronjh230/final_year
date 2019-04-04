<?php

include 'config.php';
session_start();
// this checks to see if user is logged in
if (isset($_SESSION['loggedin'])) {
} else {
    // if they aren't logged in then it will take them to login page
    header('Location: login.php');}

    $loggedinuser = $_SESSION['name'];

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

    //gets the day 1 spend from the weekly details table
    $sqlday1="SELECT `day1spend` AS day1spend FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtday1= $conn->prepare($sqlday1);
    $stmtday1->execute();

    //fetches the day 1 data and creates a variable
    $day1result=$stmtday1->fetch(PDO::FETCH_ASSOC);
    $day1=$day1result['day1spend'];

    //gets the day 2 data from the table
    $sqlday2="SELECT `day2spend` AS day2spend FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtday2= $conn->prepare($sqlday2);
    $stmtday2->execute();

    //fetches day 2 data and creates variable with it
    $day2result=$stmtday2->fetch(PDO::FETCH_ASSOC);
    $day2=$day2result['day2spend'];

    //gets the day 3 data from the table
    $sqlday3="SELECT `day3spend` AS day3spend FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtday3= $conn->prepare($sqlday3);
    $stmtday3->execute();

    //fetches day 3 data and creates variable with it
    $day3result=$stmtday3->fetch(PDO::FETCH_ASSOC);
    $day3=$day3result['day3spend'];

    //gets the day 4 data from the table
    $sqlday4="SELECT `day4spend` AS day4spend FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtday4= $conn->prepare($sqlday4);
    $stmtday4->execute();

    //fetches day 4 data and creates a variable
    $day4result=$stmtday4->fetch(PDO::FETCH_ASSOC);
    $day4=$day4result['day4spend'];

    //gets the day 5 data from the table
    $sqlday5="SELECT `day5spend` AS day5spend FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtday5= $conn->prepare($sqlday5);
    $stmtday5->execute();

    //fetches day 5 data and creates variable
    $day5result=$stmtday5->fetch(PDO::FETCH_ASSOC);
    $day5=$day5result['day5spend'];

    //gets the day 6 data from the table
    $sqlday6="SELECT `day6spend` AS day6spend FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtday6= $conn->prepare($sqlday6);
    $stmtday6->execute();

    //fetches the day 6 data and creates variable
    $day6result=$stmtday6->fetch(PDO::FETCH_ASSOC);
    $day6=$day6result['day6spend'];

    //gets the day 7 data from table
    $sqlday7="SELECT `day7spend` AS day7spend FROM `weekly_details` WHERE username='$loggedinuser'";
    $stmtday7= $conn->prepare($sqlday7);
    $stmtday7->execute();

    //fetches the day 7 data and creates a variable
    $day7result=$stmtday7->fetch(PDO::FETCH_ASSOC);
    $day7=$day7result['day7spend'];

    $weeklypoints = array(
        array("y" => $day1, "label" => "Day 1 Spend" ),
        array("y" => $day2, "label" => "Day 2 Spend" ),
        array("y" => $day3, "label" => "Day 3 Spend" ),
        array("y" => $day4, "label" => "Day 4 Spend" ),
        array("y" => $day5, "label" => "Day 5 Spend" ),
        array("y" => $day6, "label" => "Day 6 Spend" ),
        array("y" => $day7, "label" => "Day 7 Spend" )
    );
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

            let chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "dark1",
                title:{
                    text: "Weekly Spend"
                },
                axisY: {
                    title: "Spend (£)"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "£#,##0.##0",
                    dataPoints: <?php echo json_encode($weeklypoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>

    <header>
        <h1>Your Weekly Budget</h1>
    </header>

    <div class="menu" id="menu-toggle"><img src="pictures/364-01-512.png" alt="menu" class="menubtn"></div>
    <nav id="menu-nav">
        <a href="index.php" >Home</a>
        <a href="monthlybudget.php">Monthly Budget</a>
        <a href="weeklybudget.php" class="active"">Weekly Budget</a>
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

    <div class="weekoptions">
        <div class="addbtns">
            <button class="addweeklybudget" type="button" onclick="window.location.href='addweeklybudget.php'">Add/Weekly Budget
            </button>
        </div>
        <div class="weeksummaryacc">
            <button class="weeklysummaryaccordion">Summary</button>
            <div class="panel">
                <p>Your weekly budget is £<?php echo "$weekbudget"?></p>
                <p>You have so far spent £<?php echo "$totalweekly"?></p>
                <p>Your remaining budget is £<?php echo "$remainweekly"?></p>
            </div>
        </div>
    </div>
    <br>
    <div class="weeklychart" id="chartContainer"></div>

<script src="js/scripts.js"></script>
</body>
</html>