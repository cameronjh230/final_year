<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="spendform">
        <h1>
            Add Spend Details
        </h1>
        <form class="bills" method="post">
            <input type="number" step="0.01" min="0" name="billsspend" placeholder="Bills" required>
            <input type="submit" name="addbills" value="Add money that goes on bills">
        </form>
        <form class="food" method="post">
            <input type="number" step="0.01" min="0" name="foodspend" placeholder="Food Spend" required>
            <input type="submit" name="addfood" value="Add Food spending">
        </form>
        <form class="transport" method="post">
            <input type="number" step="0.01" min="0" name="transportspend" placeholder="Transport" required>
            <input type="submit" name="addtransport" value="Add Transport Spending">
        </form>
        <form class="entertainment" method="post">
            <input type="number" step="0.01" min="0" name="entertainmentspend" placeholder="Entertainment Spend" required>
            <input type="submit" name="addentertainment" value="Add Entertainment Spend">
        </form>
        <form class="luxuries" method="post">
            <input type="number" step="0.01" min="0" name="luxuriesspend" placeholder="Luxuries Spend" required>
            <input type="submit" name="addluxuries" value="Add Luxuries Spend">
        </form>
        <form class="savings" method="post">
            <input type="number" step="0.01" min="0" name="savingsspend" placeholder="Savings Expenses" required>
            <input type="submit" name="addsavings" value="Add Savings Expenses">
        </form>

        <br>
        <button class="home" type="button" onclick="window.location.href='spenddetails.php'">Back</button>

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

if(isset($_POST['addbills'])){
    $bills=$_POST['billsspend'];

    //this gets data from the bills column in the database
    $sqlexistbill="SELECT `bills` AS existbills FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtexistb= $conn->prepare($sqlexistbill);
    $stmtexistb->execute();
    //fetches the data and creates a variable
    $billresult=$stmtexistb->fetch(PDO::FETCH_ASSOC);
    $existingbill=$billresult['existbills'];
    //creates a new variable that adds inputted data with what is already in database
    $newbill=$existingbill+$bills;
    //adds new number into database
    $sqlnewbill="UPDATE `spend_details` SET bills='$newbill' WHERE username='$loggedinuser'";
    $stmtbill= $conn->prepare($sqlnewbill);
    $stmtbill->execute();

    //shows user a confirmation message
    echo "Added Bill Expenditure Successfully";
}

if(isset($_POST['addfood'])){
    $food=$_POST['foodspend'];

    //this gets data from the food column in the database
    $sqlexistfood="SELECT `food` AS existfood FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtexistf= $conn->prepare($sqlexistfood);
    $stmtexistf->execute();
    //fetches the data and creates a variable
    $foodresult=$stmtexistf->fetch(PDO::FETCH_ASSOC);
    $existingfood=$foodresult['existfood'];
    //creates a new variable that adds inputted data with what is already in database
    $newfood=$existingfood+$food;
    //adds new number into database
    $sqlnewfood="UPDATE `spend_details` SET food='$newfood' WHERE username='$loggedinuser'";
    $stmtfood= $conn->prepare($sqlnewfood);
    $stmtfood->execute();

    //shows user a confirmation message
    echo "Added Food Expenditure Successfully";
}
if(isset($_POST['addtransport'])){
    $transport=$_POST['transportspend'];

    //this gets data from the transport column in the database
    $sqlexisttransport="SELECT `transport` AS existtransport FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtexisttrans= $conn->prepare($sqlexisttransport);
    $stmtexisttrans->execute();
    //fetches the data and creates a variable
    $transresult=$stmtexisttrans->fetch(PDO::FETCH_ASSOC);
    $existingtransport=$transresult['existtransport'];
    //creates a new variable that adds inputted data with what is already in database
    $newtrans=$existingtransport+$transport;
    //adds new number into database
    $sqlnewtransp="UPDATE `spend_details` SET transport='$newtrans' WHERE username='$loggedinuser'";
    $stmttrans= $conn->prepare($sqlnewtransp);
    $stmttrans->execute();

    //shows user a confirmation message
    echo "Added Transport Expenditure Successfully";
}

if(isset($_POST['addentertainment'])){
    $entertainment=$_POST['entertainmentspend'];

    //this gets data from the entertainment column in the database
    $sqlexistent="SELECT `entertainment` AS existentertainment FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtexiste= $conn->prepare($sqlexistent);
    $stmtexiste->execute();
    //fetches the data and creates a variable
    $entertainmentresult=$stmtexiste->fetch(PDO::FETCH_ASSOC);
    $existingent=$entertainmentresult['existentertainment'];
    //creates a new variable that adds inputted data with what is already in database
    $newent=$existingent+$entertainment;
    //adds new number into database
    $sqlnewent="UPDATE `spend_details` SET entertainment='$newent' WHERE username='$loggedinuser'";
    $stmtent= $conn->prepare($sqlnewent);
    $stmtent->execute();

    //shows user a confirmation message
    echo "Added Entertainment Expenditure Successfully";
}

if(isset($_POST['addluxuries'])){
    $luxuries=$_POST['luxuriesspend'];

    //this gets data from the luxuries column in the database
    $sqlexistlux="SELECT `luxuries` AS existluxuries FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtexistl= $conn->prepare($sqlexistlux);
    $stmtexistl->execute();
    //fetches the data and creates a variable
    $luxuriesresult=$stmtexistl->fetch(PDO::FETCH_ASSOC);
    $existinglux=$luxuriesresult['existluxuries'];
    //creates a new variable that adds inputted data with what is already in database
    $newlux=$existinglux+$luxuries;
    //adds new number into database
    $sqlnewlux="UPDATE `spend_details` SET luxuries='$newlux' WHERE username='$loggedinuser'";
    $stmtlux= $conn->prepare($sqlnewlux);
    $stmtlux->execute();

    //shows user a confirmation message
    echo "Added Luxuries Expenditure Successfully";
}

if(isset($_POST['addsavings'])){
    $savings=$_POST['savingsspend'];

    //this gets data from the entertainment column in the database
    $sqlexistsav="SELECT `savings` AS existsavings FROM `spend_details` WHERE username='$loggedinuser'";
    $stmtexists= $conn->prepare($sqlexistsav);
    $stmtexists->execute();
    //fetches the data and creates a variable
    $savingsresult=$stmtexists->fetch(PDO::FETCH_ASSOC);
    $existingsav=$savingsresult['existsavings'];
    //creates a new variable that adds inputted data with what is already in database
    $newsav=$existingsav+$savings;
    //adds new number into database
    $sqlnewsav="UPDATE `spend_details` SET savings='$newsav' WHERE username='$loggedinuser'";
    $stmtsav= $conn->prepare($sqlnewsav);
    $stmtsav->execute();

    //shows user a confirmation message
    echo "Added Savings Expenditure Successfully";
}
?>

