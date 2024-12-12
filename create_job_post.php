<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$jobPost = new JobPost($pdo);

if (isset($_POST['create_job_post'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $hr_id = $_SESSION['user_id'];

    try {
        $jobPost->createJobPost($title, $description, $hr_id);
        echo "Job post created successfully";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
<html>
    <head>
        <title>Create Job Post</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="create-job-post-box">
                <h1>Create Job Post</h1>
                <form method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title"><br><br>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description"></textarea><br><br>
                    <input type="submit" name="create_job_post" value="Create Job Post">
                </form>
                <?php if (isset($_POST['create_job_post'])) { ?>
                    <p>Job post details:</p>
                    <p>Title: <?php echo $_POST['title']; ?></p>
                    <p>Description: <?php echo $_POST['description']; ?></p>
                    <p>HR ID: <?php echo $_SESSION['user_id']; ?></p>
                <?php } ?>
            </div>
            <div class="button-group">
                <a href="hr_dashboard.php" class="button">HR Dashboard</a>
                <a href="index.php" class="button">Home</a>
                <a href="logout.php" class="button">Logout</a>
            </div>
        </div>
    </body>
</html>