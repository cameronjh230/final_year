<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="weeklyform">
        <h1>
            Add Weekly Budget
        </h1>
        <form class="weekly" method="post">
            <input type="number" step="0.01" min="0" name="weekly_budget" placeholder="Weekly Budget" required>
            <input type="submit" name="addweekly" value="Add Weekly Budget">
        </form>
        <form class="day1" method="post">
            <input type="number" step="0.01" min="0" name="day1_spend" placeholder="Day 1 Spend" required>
            <input type="submit" name="addday1" value="Add Day 1 Spend">
        </form>
        <form class="day2" method="post">
            <input type="number" step="0.01" min="0" name="day2_spend" placeholder="Day 2 Spend" required>
            <input type="submit" name="addday2" value="Add Day 2 Spend">
        </form>
        <form class="day3" method="post">
            <input type="number" step="0.01" min="0" name="day3_spend" placeholder="Day 3 Spend" required>
            <input type="submit" name="addday3" value="Add Day 3 Spend">
        </form>
        <form class="day4" method="post">
            <input type="number" step="0.01" min="0" name="day4_spend" placeholder="Day 4 Spend" required>
            <input type="submit" name="addday4" value="Add Day 4 Spend">
        </form>
        <form class="day5" method="post">
            <input type="number" step="0.01" min="0" name="day5_spend" placeholder="Day 5 Spend" required>
            <input type="submit" name="addday5" value="Add Day 5 Spend">
        </form>
        <form class="day6" method="post">
            <input type="number" step="0.01" min="0" name="day6_spend" placeholder="Day 6 Spend" required>
            <input type="submit" name="addday6" value="Add Day 6 Spend">
        </form>
        <form class="day7" method="post">
            <input type="number" step="0.01" min="0" name="day7_spend" placeholder="Day 7 Spend" required>
            <input type="submit" name="addday7" value="Add Day 7 Spend">
        </form>

        <br>
        <button class="home" type="button" ><a href="weeklybudget.php">Back</a> </button>

    </div>

<script src="js/scripts.js"></script>
</body>
</html>


<?php
include 'config.php';
session_start();
// this checks to see if user is logged in
if (isset($_SESSION['loggedin'])) {

    echo 'Welcome ' . $_SESSION['name'] . '! <br>';
} else {
    // if they aren't logged in then it will take them to login page
    header('Location: login.php');
}

$loggedinuser = $_SESSION['name'];

if(isset($_POST['addweekly'])){
    $weeklybudget = $_POST['weekly_budget'];

    $sql = "UPDATE `weekly_details` SET weeklybudget='$weeklybudget' WHERE username='$loggedinuser'";

    $stmt= $conn->prepare($sql);
    $stmt->execute();

    echo "Added Weekly Budget";
}

if(isset($_POST['addday1'])){
    $day1spend = $_POST['day1_spend'];

    $sql2 = "UPDATE `weekly_details` SET day1spend='$day1spend' WHERE username='$loggedinuser'";

    $stmt2= $conn->prepare($sql2);
    $stmt2->execute();

    echo "Added Your Day 1 Spend";
}

if(isset($_POST['addday2'])){
    $day2spend = $_POST['day2_spend'];

    $sql3 = "UPDATE `weekly_details` SET day2spend='$day2spend' WHERE username='$loggedinuser'";

    $stmt3= $conn->prepare($sql3);
    $stmt3->execute();

    echo "Added Your Day 2 Spend";
}

if(isset($_POST['addday3'])){
    $day3spend = $_POST['day3_spend'];

    $sql4 = "UPDATE `weekly_details` SET day3spend='$day3spend' WHERE username='$loggedinuser'";

    $stmt4= $conn->prepare($sql4);
    $stmt4->execute();

    echo "Added Your Day 3 Spend";
}

if(isset($_POST['addday4'])){
    $day4spend = $_POST['day4_spend'];

    $sql5 = "UPDATE `weekly_details` SET day4spend='$day4spend' WHERE username='$loggedinuser'";

    $stmt5= $conn->prepare($sql5);
    $stmt5->execute();

    echo "Added Your Day 4 Spend";
}

if(isset($_POST['addday5'])){
    $day5spend = $_POST['day5_spend'];

    $sql6 = "UPDATE `weekly_details` SET day5spend='$day5spend' WHERE username='$loggedinuser'";

    $stmt6= $conn->prepare($sql6);
    $stmt6->execute();

    echo "Added Your Day 5 Spend";
}

if(isset($_POST['addday6'])){
    $day6spend = $_POST['day6_spend'];

    $sql7 = "UPDATE `weekly_details` SET day6spend='$day6spend' WHERE username='$loggedinuser'";

    $stmt7= $conn->prepare($sql7);
    $stmt7->execute();

    echo "Added Your Day 6 Spend";
}

if(isset($_POST['addday7'])){
    $day7spend = $_POST['day7_spend'];

    $sql8 = "UPDATE `weekly_details` SET day7spend='$day7spend' WHERE username='$loggedinuser'";

    $stmt8= $conn->prepare($sql8);
    $stmt8->execute();

    echo "Added Your Day 7 Spend";
}

//calculates a users weekly spend
$sqlsum="SELECT SUM(day1spend) + SUM(day2spend) + SUM(day3spend) + SUM(day4spend) + SUM(day5spend) + SUM(day6spend) + SUM(day7spend) AS weeklysum FROM weekly_details WHERE username='$loggedinuser' ";
$sumstmt= $conn->prepare($sqlsum);
$sumstmt->execute();

$result=$sumstmt->fetch(PDO::FETCH_ASSOC);

$weeklyspend=$result['weeklysum'];
//adds the weekly spend to the table
$sqlweeksum="UPDATE `weekly_details` SET totalweeklyspend='$weeklyspend' WHERE username='$loggedinuser'";
$weekstmt= $conn->prepare($sqlweeksum);
$weekstmt->execute();

//this works out a users remaining weekly budget
$sqlsum2="SELECT SUM(weeklybudget) - SUM(totalweeklyspend) AS remainweek FROM weekly_details WHERE username='$loggedinuser'";
$sumstmt2= $conn->prepare($sqlsum2);
$sumstmt2->execute();
//fetches result
$result2=$sumstmt2->fetch(PDO::FETCH_ASSOC);

$remainingweekly = $result2['remainweek'];
//adds the remaining budget to the table
$sqlremaining="UPDATE `weekly_details` SET weeklyleft='$remainingweekly' WHERE username='$loggedinuser'";
$remainstmt= $conn->prepare($sqlremaining);
$remainstmt->execute();


?>