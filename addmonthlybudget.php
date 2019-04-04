<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <div class="monthlyform">
        <h1>
            Add Monthly Budget
        </h1>
        <form class="monthly" method="post">
            <input type="number" step="0.01" min="0" name="monthly_budget" placeholder="Monthly Budget" required>
            <input type="submit" name="addmonthly" value="Add Monthly Budget">
        </form>
        <form class="week1" method="post">
            <input type="number" step="0.01" min="0" name="week1_spend" placeholder="Week 1 Spend" required>
            <input type="submit" name="addweek1" value="Add Week 1 Spend">
        </form>
        <form class="week2" method="post">
            <input type="number" step="0.01" min="0" name="week2_spend" placeholder="Week 2 Spend" required>
            <input type="submit" name="addweek2" value="Add Week 2 Spend">
        </form>
        <form class="week3" method="post">
            <input type="number" step="0.01" min="0" name="week3_spend" placeholder="Week 3 Spend" required>
            <input type="submit" name="addweek3" value="Add Week 3 Spend">
        </form>
        <form class="week4" method="post">
            <input type="number" step="0.01" min="0" name="week4_spend" placeholder="Week 4 Spend" required>
            <input type="submit" name="addweek4" value="Add Week 4 Spend">
            <br>
        </form>

        <br>

    </div>

    <div class="monthbtn">
      <button class="home" type="button" onclick="window.location.href='monthlybudget.php'">Back </button>
      <br>
      <form method="post">
            <input type="submit" name="resetmonthly" value="Reset Values">
      </form>
    </div>
<script src="js/scripts.js"></script>
</body>
</html>


<?php
include 'config.php';
session_start();
// this checks to see if user is logged in
if (isset($_SESSION['loggedin'])) {
} else {
    // if they aren't logged in then it will take them to login page
    header('Location: login.php');
}

$loggedinuser = $_SESSION['name'];

if (isset($_POST['addmonthly'])) {
    $monthlybudget = $_POST['monthly_budget'];

    $sql = "UPDATE `monthly_details` SET monthlybudget='$monthlybudget' WHERE username ='$loggedinuser'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    echo "Added Monthly Budget";
}


if (isset($_POST['addweek1'])) {
    $week1spend = $_POST['week1_spend'];

    $sql2 = "UPDATE `monthly_details` SET week1spend='$week1spend' WHERE username='$loggedinuser'";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();

    echo "Added week 1 spend";
}

if (isset($_POST['addweek2'])){
    $week2spend = $_POST['week2_spend'];

    $sql3 = "UPDATE `monthly_details` SET week2spend='$week2spend' WHERE username='$loggedinuser'";

    $stmt3 = $conn->prepare($sql3);
    $stmt3->execute();

    echo "Added week 2 spend";
}

if (isset($_POST['addweek3'])){
    $week3spend = $_POST['week3_spend'];

    $sql4 = "UPDATE `monthly_details` SET week3spend='$week3spend' WHERE username='$loggedinuser'";

    $stmt4 = $conn->prepare($sql4);
    $stmt4->execute();

    echo "Added week 3 spend";
}

if (isset($_POST['addweek4'])){
    $week4spend = $_POST['week4_spend'];

    $sql5 = "UPDATE `monthly_details` SET week4spend='$week4spend' WHERE username='$loggedinuser'";

    $stmt5 = $conn->prepare($sql5);
    $stmt5->execute();

    echo "Added week 4 spend";
}

//this works out a users total spend throughout a month
$sqlsum="SELECT SUM(week1spend) + SUM(week2spend) + SUM(week3spend) + SUM(week4spend) AS monthlysum FROM monthly_details WHERE username='$loggedinuser' ";
$sumstmt= $conn->prepare($sqlsum);
$sumstmt->execute();
//fetches result
$result=$sumstmt->fetch(PDO::FETCH_ASSOC);

$monthlyspend = $result['monthlysum'];
//adds the total spend value into the table
$sqltotalspend="UPDATE `monthly_details` SET monthtotal='$monthlyspend' WHERE username='$loggedinuser'";
$totalstmt= $conn->prepare($sqltotalspend);
$totalstmt->execute();

//this works out a users remaining budget
$sqlsum2="SELECT SUM(monthlybudget) - SUM(monthtotal) AS remainmonth FROM monthly_details WHERE username='$loggedinuser'";
$sumstmt2= $conn->prepare($sqlsum2);
$sumstmt2->execute();
//fetches result
$result2=$sumstmt2->fetch(PDO::FETCH_ASSOC);

$remainingmonthly = $result2['remainmonth'];
//adds the remaining budget to the table
$sqlremaining="UPDATE `monthly_details` SET monthleft='$remainingmonthly' WHERE username='$loggedinuser'";
$remainstmt= $conn->prepare($sqlremaining);
$remainstmt->execute();

//code for reset button, if its clicked all attributes will be set to NULL
if(isset($_POST['resetmonthly'])) {
    $sqlreset1 = "UPDATE `monthly_details` SET monthlybudget=NULL";
    $stmtreset1 = $conn->prepare($sqlreset1);
    $stmtreset1->execute();

    $sqlreset2 = "UPDATE `monthly_details` SET week1spend=NULL";
    $stmtreset2 = $conn->prepare($sqlreset2);
    $stmtreset2->execute();

    $sqlreset3 = "UPDATE `monthly_details` SET week2spend=NULL";
    $stmtreset3 = $conn->prepare($sqlreset3);
    $stmtreset3->execute();

    $sqlreset4 = "UPDATE `monthly_details` SET week3spend=NULL";
    $stmtreset4 = $conn->prepare($sqlreset4);
    $stmtreset4->execute();

    $sqlreset5 = "UPDATE `monthly_details` SET week4spend=NULL";
    $stmtreset5 = $conn->prepare($sqlreset5);
    $stmtreset5->execute();

    $sqlreset6 = "UPDATE `monthly_details` SET monthtotal=NULL";
    $stmtreset6 = $conn->prepare($sqlreset6);
    $stmtreset6->execute();

    $sqlreset7 = "UPDATE `monthly_details` SET monthleft=NULL";
    $stmtreset7 = $conn->prepare($sqlreset7);
    $stmtreset7->execute();

    echo "Reset monthly details";
}

?>

