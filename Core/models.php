<?php
require_once 'Core/dbConfig.php';
class User {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function register($username, $email, $password, $role) {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsernameById($id) {
        $stmt = $this->pdo->prepare("SELECT username FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['username'];
    }
}

class JobPost {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function createJobPost($title, $description, $hr_id) {
        $stmt = $this->pdo->prepare("INSERT INTO job_posts (title, description, hr_id) VALUES (:title, :description, :hr_id)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':hr_id', $hr_id);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    function getJobPosts() {
        $stmt = $this->pdo->prepare("SELECT * FROM job_posts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

class Application {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function apply($job_post_id, $applicant_id, $resume, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO applications (job_post_id, applicant_id, resume, description) VALUES (:job_post_id, :applicant_id, :resume, :description)");
        $stmt->bindParam(':job_post_id', $job_post_id);
        $stmt->bindParam(':applicant_id', $applicant_id);
        $stmt->bindParam(':resume', $resume);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    function getApplications($hr_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM applications WHERE hr_id = :hr_id");
        $stmt->bindParam(':hr_id', $hr_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateApplicationStatus($application_id, $status) {
        $stmt = $this->pdo->prepare("UPDATE applications SET status = :status WHERE id = :application_id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':application_id', $application_id);
        $stmt->execute();
    }
}

class Message {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function sendMessage($sender_id, $receiver_id, $message) {
        $stmt = $this->pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (:sender_id, :receiver_id, :message)");
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':receiver_id', $receiver_id);
        $stmt->bindParam(':message', $message);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMessages($user_id, $role) {
        $query = "SELECT * FROM messages WHERE receiver_id = '$user_id'";
        $result = $this->pdo->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($messages)) {
            foreach ($messages as $msg) {
            }
        } else {
            echo "No messages found.";
        }
    }
}


?>