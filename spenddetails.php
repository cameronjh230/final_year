<?php
include 'config.php';
session_start();
// this checks to see if user is logged in
if (isset($_SESSION['loggedin'])) {
    ;
   }else {
    // if they aren't logged in then it will take them to login page
    header('Location: login.php');}

    $loggedinuser = $_SESSION['name'];

    //selects the bill data from database
    $sqlbills="SELECT `bills` AS billsspend FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtbills= $conn->prepare($sqlbills);
    $stmtbills->execute();
    //gets the data and creates variable so it can be used elsewhere
    $billresult=$stmtbills->fetch(PDO::FETCH_ASSOC);
    $userbills=$billresult['billsspend'];

    //selects the food data from database
    $sqlfood="SELECT `food` AS foodspend FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtfood= $conn->prepare($sqlfood);
    $stmtfood->execute();
    //gets the data and creates variable so it can be used elsewhere
    $foodresult=$stmtfood->fetch(PDO::FETCH_ASSOC);
    $userfood=$foodresult['foodspend'];

    //selects the transport data from database
    $sqltransport="SELECT `transport` AS transportspend FROM `spend_details` WHERE username='$loggedinuser'";
    $stmttrans= $conn->prepare($sqltransport);
    $stmttrans->execute();
    //gets the data and creates variable so it can be used elsewhere
    $transresult=$stmttrans->fetch(PDO::FETCH_ASSOC);
    $usertransport=$transresult['transportspend'];


    //selects the entertainment data from database
    $sqlentertainment="SELECT `entertainment` AS entertainmentspend FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtent= $conn->prepare($sqlentertainment);
    $stmtent->execute();
    //gets the data and creates variable so it can be used elsewhere
    $entertainmentresult=$stmtent->fetch(PDO::FETCH_ASSOC);
    $userentertainment=$entertainmentresult['entertainmentspend'];

    //selects the luxuries data from database
    $sqlluxuries="SELECT `luxuries` AS luxuriesspend FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtlux= $conn->prepare($sqlluxuries);
    $stmtlux->execute();
    //gets the data and creates variable so it can be used elsewhere
    $luxuriesresult=$stmtlux->fetch(PDO::FETCH_ASSOC);
    $userluxuries=$luxuriesresult['luxuriesspend'];

    //selects the savings data from database
    $sqlsavings="SELECT `savings` AS savingsspend FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtsav= $conn->prepare($sqlsavings);
    $stmtsav->execute();
    //gets the data and creates variable so it can be used elsewhere
    $savingsresult=$stmtsav->fetch(PDO::FETCH_ASSOC);
    $usersavings=$savingsresult['savingsspend'];



    $spendpoints = array(
        array("y" =>$userbills, "label" => "Bills" ),
        array("y" =>$userfood, "label" => "Food" ),
        array("y" =>$usertransport, "label" => "Transport" ),
        array("y" =>$userentertainment, "label" => "Entertainment" ),
        array("y" =>$userluxuries, "label" => "Luxuries" ),
        array("y" =>$usersavings, "label" => "Savings" ),
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


            var chart = new CanvasJS.Chart("piechartContainer", {
                animationEnabled: true,
                theme: "dark1",
                title: {
                    text: "Pie Chart of your Spend Details"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "£#,##0.00",
                    dataPoints: <?php echo json_encode($spendpoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
        <a href="monthlybudget.php">Monthly     Budget</a>
        <a href="weeklybudget.php">Weekly Budget</a>
        <a href="spenddetails.php" class="active">Spend Details</a>
        <a href="account.php" >Your Account</a>
        <?php if (isset($_SESSION['loggedin'])) {
            // If logged in
            echo '<a href="logout.php">Logout</a>';
        }else{
            echo '<a href="login.php">Log In</a>';
        }
        ?>
    </nav>

    <div class="addbtns">
        <button class="addspenddetails" type="button" onclick="window.location.href='addspenddetails.php'">Add Spend Details
        </button>
    </div>

    <button class="detailsaccordion">Summary</button>
    <div class="panel">
        <p>You have spent £<?php echo "$userbills"?> on bills this month</p>
        <p>You have spent £<?php echo "$userfood"?> on food this month</p>
        <p>You have spent £<?php echo "$usertransport"?> on transport this month</p>
        <p>You have spent £<?php echo "$userentertainment"?> on entertainment this month</p>
        <p>You have spent £<?php echo "$userluxuries"?> on luxuries this month</p>
        <p>You have put £<?php echo "$usersavings"?> into savings this month </p>
    </div>



    <div class="piehchart" id="piechartContainer"></div>

    <br>
    <div class="resetbtn">
        <form method="post">
            <input type="submit" name="resetdetails" value="Reset Values">
        </form>
        <?php
        //code for reset button, if its clicked all attributes will be set to NULL
        if(isset($_POST['resetdetails'])) {
            $sqlreset1="UPDATE `spend_details` SET bills=NULL";
            $stmtreset1= $conn->prepare($sqlreset1);
            $stmtreset1->execute();

            $sqlreset2="UPDATE `spend_details` SET food=NULL";
            $stmtreset2= $conn->prepare($sqlreset2);
            $stmtreset2->execute();

            $sqlreset3="UPDATE `spend_details` SET transport=NULL";
            $stmtreset3= $conn->prepare($sqlreset3);
            $stmtreset3->execute();

            $sqlreset4="UPDATE `spend_details` SET entertainment=NULL";
            $stmtreset4= $conn->prepare($sqlreset4);
            $stmtreset4->execute();

            $sqlreset5="UPDATE `spend_details` SET luxuries=NULL";
            $stmtreset5= $conn->prepare($sqlreset5);
            $stmtreset5->execute();

            $sqlreset6="UPDATE `spend_details` SET savings=NULL";
            $stmtreset6= $conn->prepare($sqlreset6);
            $stmtreset6->execute();

            echo "Reset spend details";
            header('Location: spenddetails.php');
        }

        ?>

<script src="js/scripts.js"></script>
</body>
</html>
