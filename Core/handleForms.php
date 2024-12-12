<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$user = new User($pdo);

if (isset($_POST['register'])) {
    $role = $_POST['role'];
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
    $stmt->bindParam(':role', $role);
}

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