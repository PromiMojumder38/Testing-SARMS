<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>SUST Auto-Rickshaw</title>
    <meta charset="UTF-8">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <header>

        <div class="wrapper">
            <div class="logo">
                <img src="images/logo.png" alt="">

            </div>
            <ul class="nav-area">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Search</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class=" welcome-tex">

            <?php if (isset($user)): ?>

                <h3>Welcome <span class="name">
                <?= htmlspecialchars($user["name"]) ?> ! </span>
                </h3>

                <?php endif; ?>

        </div>

    


        <div class="welcome-text">
                    <h1>
                        <span>SUST</span>
                    </h1>
                    <h2>
                        <span>Auto-Rickshaw</span> Management <span>System</span>
                    </h2>

                    <?php if (isset($user)): ?>


                        <a href="process-owner-registration.php">Owner Registration</a>
                        <a href="process-autorickshaw-registration.php">Auto-Rickshaw Registration</a>
                        <a href="process-driver-registration.php">Driver Registration</a>
                        <a href="process-manager-registration.php">Manager Registration</a>
                        <a href="process-authority-registration.php">Authority Registration</a>
                        <a class="logout" href="logout.php">Log out</a>

                    <?php else: ?>

                        <a href="process-signup.php">Log in</a>
                        <a href="process-signup.php">sign up</a>

                    <?php endif; ?>


        </div>

    </header>



</body>

</html>