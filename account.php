<?php
include 'config.php';
session_start();

if (isset($_SESSION['loggedin'])) {
} else {
    // if they aren't logged in then it will take them to login page
    header('Location: login.php');}

$loggedinuser = $_SESSION['name'];

if (isset($_POST['alter_forename'])){
    $newforname=$_POST['change_forename'];

    $sql1="UPDATE `user_details` SET forename='$newforname' WHERE username='$loggedinuser'";

    $stmt1= $conn->prepare($sql1);
    $stmt1->execute();
}
if (isset($_POST['alter_surname'])){
    $newsurname=$_POST['change_surname'];

    $sql2="UPDATE `user_details` SET surname='$newsurname' WHERE username='$loggedinuser'";

    $stmt2= $conn->prepare($sql2);
    $stmt2->execute();
}
if (isset($_POST['alter_email'])){
    $newemail=$_POST['change_email'];

    $sql3="UPDATE `user_details` SET email='$newemail' WHERE username='$loggedinuser'";

    $stmt3= $conn->prepare($sql3);
    $stmt3->execute();
}
if (isset($_POST['alter_password'])){
    $newpassword= password_hash($_POST['change_password'], PASSWORD_DEFAULT);

    $sql4="UPDATE `user_details` SET password='$newpassword' WHERE username='$loggedinuser'";

    $stmt4= $conn->prepare($sql4);
    $stmt4->execute();
}

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

    <div class="intro">
        <p>Hello <?php echo "$loggedinuser"?> welcome to your account. Here you can change your forename, surname, email or even your
        password</p>
    </div>

    <div class="alterform">
        <h2>Alter Your details</h2>
        <form class="forenamechange" method="post">
            <input type="text" name="change_forename" placeholder="Change Your Forename" required>
            <input type="submit" name="alter_forename" value="Confirm">
        </form>
        <form class="surnamechange" method="post">
            <input type="text" name="change_surname" placeholder="Change Your Surname" required>
            <input type="submit" name="alter_surname" value="Confirm">
        </form>
        <form class="emailchange" method="post">
            <input type="email"  name="change_email" placeholder="Change Your Email" required>
            <input type="submit" name="alter_email" value="Confirm">
        </form>
        <form class="changepass" method="post">
            <input type="password" name="change_password" placeholder="Change Your Password" required>
            <input type="submit" name="alter_password" value="Confirm">
        </form>
    </div>
<?php
if (isset($_POST['alter_forename'])){
    echo "Successfully changed forename";
}
if (isset($_POST['alter_surname'])){
    echo "Successfully changed surname";
}
if(isset($_POST['alter_email'])){
    echo "Successfully changed email";
}
if(isset($_POST['alter_password'])){
    echo "Successfully changed password";
}
?>

<script src="js/scripts.js"></script>
</body>
</html>

