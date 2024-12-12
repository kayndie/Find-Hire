<?php
require_once 'Core/dbConfig.php';

$application_id = $_GET['application_id'];

$query = "UPDATE applications SET status = 'accepted' WHERE id = '$application_id'";
$pdo->query($query);

?>
<html>
    <head>
        <title>Accept Application</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="accept-box">
                <h1>Application Accepted</h1>
                <p>Application accepted successfully.</p>
                <div class="button-group">
                    <a href="hr_dashboard.php" class="button">Back to HR Dashboard</a>
                </div>
            </div>
        </div>
    </body>
</html>