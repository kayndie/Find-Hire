<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$message = new Message($pdo);

if (isset($_GET['message_id'])) {
    $message_id = $_GET['message_id'];
    $message_data = $message->getMessages($_SESSION['user_id'], $_SESSION['role']);
    ?>
    <html>
        <head>
            <title>Reply to Message</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="container">
                <div class="reply-message-box">
                    <h1>Reply to Message</h1>
                    <form action="reply_message.php" method="post">
                        <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
                        <label for="reply">Reply:</label>
                        <textarea name="reply" id="reply" cols="30" rows="10"></textarea>
                        <input type="submit" value="Reply">
                    </form>
                    <?php if (isset($_POST['message_id']) && isset($_POST['reply'])) { ?>
                        <p>Reply sent successfully</p>
                    <?php } ?>
                </div>
                <div class="button-group">
                    <a href="hr_dashboard.php" class="button">Back to Dashboard</a>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header('Location: hr_dashboard.php');
}

if (isset($_POST['message_id']) && isset($_POST['reply'])) {
    $message_id = $_POST['message_id'];
    $reply = $_POST['reply'];
    $message->sendMessage($_SESSION['user_id'], $message_id, $reply);
    header('Location: hr_dashboard.php');
}
?>