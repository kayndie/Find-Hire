<?php
require_once 'Core/dbConfig.php';

$job_post_id = $_GET['job_post_id'];

$query = "SELECT * FROM job_posts WHERE id = '$job_post_id'";
$result = $pdo->query($query);

if ($result->rowCount() > 0) {
    $row = $result->fetch();
    echo 'Job Title: ' . $row['title'] . '<br>';
    echo 'Job Description: ' . $row['description'] . '<br>';
    echo 'Job HR: ' . $row['hr_id'] . '<br>';
} else {
    echo 'Job post not found.';
}
?>