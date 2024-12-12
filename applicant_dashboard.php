<?php
require_once 'Core/dbConfig.php';
require_once 'Core/models.php';

$user = new User($pdo);
$jobPost = new JobPost($pdo);
$message = new Message($pdo);

if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'applicant') {
    $jobPosts = $jobPost->getJobPosts();
    $messages = $message->getMessages($_SESSION['user_id'], $_SESSION['role']);
    ?>
    <html>
        <head>
            <title>Applicant Dashboard</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="container">
                <div class="applicant-dashboard-box">
                    <h1>Job Posts</h1>
                    <ul>
                        <?php foreach ($jobPosts as $jobPost) { ?>
                            <li>
                                <h2><?php echo $jobPost['title']; ?></h2>
                                <p><?php echo $jobPost['description']; ?></p>
                                <a href="apply.php?job_post_id=<?php echo $jobPost['id']; ?>">Apply</a>
                                <a href="message_hr.php?hr_id=<?php echo $jobPost['hr_id']; ?>">Message HR</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="dashboard-box">
                    <h1>Messages</h1>
                    <ul>
                        <?php if (!empty($messages)) { ?>
                        <?php foreach ($messages as $msg) { ?>
                        <?php if (is_array($msg)) { ?>
                    <li>
                        <h2><?php echo $msg['message']; ?></h2>
                        <?php if (!empty($user->login($msg['sender_id'], ''))) { ?>
                            <p>From: <?php echo $user->login($msg['sender_id'], '')['username']; ?></p>
                        <?php } else { ?>
                            <p>From: Unknown</p>
                        <?php } ?>
                        <p>Reply: <a href="reply_message.php?message_id=<?php echo $msg['id']; ?>">Reply</a></p>
                    </li>
                        <?php } ?>
                        <?php } ?>
                        <?php } else { ?>
                    <li>No messages found.</li>
                        <?php } ?>
                    </ul>
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