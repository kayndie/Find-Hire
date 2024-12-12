<?php
require_once 'Core/dbConfig.php';

$job_post_id = $_GET['job_post_id'];

$query = "SELECT * FROM applications WHERE job_post_id = '$job_post_id'";
$result = $pdo->query($query);

if ($result->rowCount() > 0) {
    ?>
    <html>
        <head>
            <title>View Applications</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="container">
                <div class="applications-box">
                    <h1>Applications for Job Post #<?php echo $job_post_id; ?></h1>
                    <?php while ($row = $result->fetch()) { ?>
                        <div class="application">
                            <h2>Application ID: <?php echo $row['id']; ?></h2>
                            <p>Job Post ID: <?php echo $row['job_post_id']; ?></p>
                            <p>Application Status: <?php echo $row['status']; ?></p>
                            <p>Resume: <a href="download.php?file=<?php echo $row['resume']; ?>">Download Resume</a></p>
                            <div class="button-group">
                                <a href="accept_application.php?application_id=<?php echo $row['id']; ?>" class="button">Accept Application</a>
                                <a href="reject_application.php?application_id=<?php echo $row['id']; ?>" class="button">Reject Application</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <center><a href="index.php" class="button">Home</a></center>
        </body>
    </html>
    <?php
} else {
    ?>
    <html>
        <head>
            <title>View Applications</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="container">
                <div class="applications-box">
                    <h1>No applications found for this job post.</h1>
                </div>
            </div>
        </body>
    </html>
    <?php
}
?>