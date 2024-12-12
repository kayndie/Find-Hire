<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$user = new User($pdo);
$jobPost = new JobPost($pdo);
$application = new Application($pdo);

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['apply'])) {
        $job_post_id = $_GET['job_post_id'];
        $applicant_id = $_SESSION['user_id'];
        $description = $_POST['description'];

        if (isset($_FILES['resume'])) {
            $resume = $_FILES['resume'];

            if ($resume['type'] == 'application/pdf') {
                $uploadDir = 'uploads/';
                $fileName = basename($resume['name']);
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($resume['tmp_name'], $filePath)) {
                    $application->apply($job_post_id, $applicant_id, $filePath, $description);
                    echo "Application submitted successfully";
                } else {
                    echo "Error uploading file";
                }
            } else {
                echo "Only PDF files are allowed";
            }
        } else {
            echo "Please select a file to upload";
        }
    }
    ?>
    <html>
        <head>
            <title>Apply for Job</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="container">
                <div class="apply-box">
                    <h1>Apply for Job</h1>
                    <form method="post" enctype="multipart/form-data">
                        <label for="resume">Resume:</label>
                        <input type="file" id="resume" name="resume" accept=".pdf"><br><br>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description"></textarea><br><br>
                        <input type="submit" name="apply" value="Apply">
                    </form>
                    <?php if (isset($_POST['apply'])) { ?>
                        <p>Application submitted successfully</p>
                    <?php } ?>
                </div>
                <div class="button-group">
                    <a href="index.php" class="button">Home</a>
                    <a href="logout.php" class="button">Logout</a>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: login.php');
}
?>