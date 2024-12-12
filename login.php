<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$user = new User($pdo);

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $userExist = $user->login($email, $password);
    if ($userExist) {
        $_SESSION['user_id'] = $userExist['id'];
        $_SESSION['role'] = $userExist['role'];
        if ($userExist['role'] == 'applicant') {
            header('Location: applicant_dashboard.php');
        } elseif ($userExist['role'] == 'hr') {
            header('Location: hr_dashboard.php');
        }
    } else {
        echo "Invalid email or password";
    }
}
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="login-box">
                <h1>Login</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <input type="submit" name="login" value="Login">
                </form>
            </div>
            <p><a href="register.php" class="button">Register</a></p>
        </div>
    </body>
</html>