<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$message = new Message($pdo);

if (isset($_GET['hr_id'])) {
    $hr_id = $_GET['hr_id'];
    ?>
    <html>
        <head>
            <title>Message HR</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="container">
                <div class="message-hr-box">
                    <h1>Message HR</h1>
                    <form action="message_hr.php" method="post">
                        <input type="hidden" name="hr_id" value="<?php echo $hr_id; ?>">
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" cols="30" rows="10"></textarea>
                        <input type="submit" value="Send">
                    </form>
                    <?php if (isset($_POST['hr_id']) && isset($_POST['message'])) { ?>
                        <p>Message sent successfully</p>
                    <?php } ?>
                </div>
                <div class="button-group">
                    <a href="applicant_dashboard.php" class="button">Back to Dashboard</a>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: applicant_dashboard.php');
}

if (isset($_POST['hr_id']) && isset($_POST['message'])) {
    $hr_id = $_POST['hr_id'];
    $message_text = $_POST['message'];
    $message->sendMessage($_SESSION['user_id'], $hr_id, $message_text);
    header('Location: applicant_dashboard.php');
    exit;
}
?>