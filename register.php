<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$user = new User($pdo);

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $userExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userExist) {
        echo "Email already exists";
    } else {
        $user->register($username, $email, $password, $role);
        echo "Registration successful";
    }
}
?>

<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="register-box">
                <h1>Register</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="role">
                            <option value="applicant">Applicant</option>
                            <option value="hr">HR</option>
                        </select>
                    </div>
                    <input type="submit" name="register" value="Register">
                </form>
            </div>
            <p><a href="login.php" class="button">Login</a></p>
        </div>
    </body>
</html>