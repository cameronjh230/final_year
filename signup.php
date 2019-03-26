<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="signup">
    <h1>Sign Up</h1>
    <form method="post">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="forename" placeholder="Forename" required>
        <input type="text" name="surname" placeholder="Surname" required>
        <input type="submit" name="signupsubmit" namme="Submit" required>
    </form>

    <br>
    <p><a href="login.php">Already have an account. Please Log in here</a> </p>
</div>

<script src="js/scripts.js"></script>
</body>
</html>

<?php
include 'config.php';

if (isset($_POST['signupsubmit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $forename = $_POST['forename'];
    $surname = $_POST['surname'];

    if (!empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['email']) || !empty($_POST['forename']) || !empty($_POST['surname'])) {

        $sqlcheck1 = "SELECT COUNT(username) AS number1 FROM user_details WHERE username = :username";

        $stmtcheck1 = $conn->prepare($sqlcheck1);
        $stmtcheck1->bindValue(':username', $username);
        $stmtcheck1->execute();

        $rownum1 = $stmtcheck1->fetch(PDO::FETCH_ASSOC);
        if ($rownum1['number1'] > 0) {
            echo "Sorry pick another username";
            die();
        } else {
            $sqlcheck2 = "SELECT COUNT(email) AS number2 FROM user_details WHERE email = :email";

            $stmtcheck2 = $conn->prepare($sqlcheck2);
            $stmtcheck2->bindValue(':email', $email);
            $stmtcheck2->execute();
            $rownum2 = $stmtcheck2->fetch(PDO::FETCH_ASSOC);
            if ($rownum2['number2'] > 0) {
                echo "Sorry email is already in use";
                die();
            } else {
                $password2 = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $sql = "INSERT INTO `user_details` (`username`, `password`, `email`, `forename`, `surname`)
                VALUES ('$username', '$password2', '$email', '$forename', '$surname')";

                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $sql2 = "INSERT INTO `monthly_details` (`username`) VALUE ('$username')";

                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute();

                $sql3 = "INSERT INTO `weekly_details` (`username`) VALUE ('$username')";

                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute();

                $sql4 = "INSERT INTO `spend_details` (`username`) VALUE ('$username')";
                $stmt4 = $conn->prepare($sql4);
                $stmt4->execute();


                echo "successful";

                header("Location: login.php");
            }
        }
    } else {
            die ('Please complete the registration form!<br><a href="signup.html">Back</a>');
        }


}
?>