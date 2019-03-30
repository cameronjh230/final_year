<?php
include 'config.php';
session_start();
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
        <h1>Budgeting Made Simple</h1>
    </header>

    <div class="menu" id="menu-toggle"><img src="pictures/364-01-512.png" alt="menu" class="menubtn"></div>
    <nav id="menu-nav">
        <a href="index.php" class="active">Home</a>
        <a href="monthlybudget.php">Monthly Budget</a>
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
    <div class="picture1">
        <img src="pictures/budgetpic.jpg" alt="budget" class="budgpic">
    </div>

    <button class="tipaccordion">Top Tips</button>
    <div class="panel">
        <ul>
            <li>Use the popular 50/30/20 rule to budgeting. This involves dividing your income (after tax
            if it applies) and then putting 50% on the needs, 30% on things you want and then 20% into savings</li>
            <li>Actually keep a track of your spending. This can be done either electronically, for example through this
            website, or by using pen and paper</li>
            <li>This website has options where you can set both a weekly and monthly budget. This is because, when it comes
            to budgeting it is highly encouraged to come up with a budget so that you know how much you can spend in week/month</li>
            <li>Remember some months will be different and have different expenses. So be prepared to alter the budget to fit in the
            new expenses. For example, things such as birthdays and christmas</li>
            <li>Keep some money aside for unexpected expenses-this will lead to less stress when that money is needed</li>
            <li>Set a realistic budget that is doable for you and do not try cutting necessities massively for things you want</li>
        </ul>
    </div>



<script src="js/scripts.js"></script>
</body>
</html>

