<?php
require_once 'Core/dbConfig.php';

$application_id = $_GET['application_id'];

$query = "UPDATE applications SET status = 'rejected' WHERE id = '$application_id'";
$pdo->query($query);

?>
<html>
    <head>
        <title>Reject Application</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="container">
            <div class="reject-box">
                <h1>Application Rejected</h1>
                <p>Application rejected successfully.</p>
                <div class="button-group">
                    <a href="hr_dashboard.php" class="button">Back to HR Dashboard</a>
                </div>
            </div>
        </div>
    </body>
</html>