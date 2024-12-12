<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$user = new User($pdo);

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'applicant') {
        header('Location: applicant_dashboard.php');
    } elseif ($_SESSION['role'] == 'hr') {
        header('Location: hr_dashboard.php');
    }
} else {
    ?>
    <html>
        <head>
            <title>FindHire Job Application System</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <div class="container">
                <h1>FindHire Job Application System</h1>
                <ul>
                    <li><a href="login.php" class="button">Login</a></li>
                    <li><a href="register.php" class="button">Register</a></li>
                </ul>
            </div>
        </body>
    </html>
    <?php
}
?>