<?php
require_once 'Core/dbConfig.php';

$file = $_GET['file'];

if (file_exists($file)) {
    $fileType = mime_content_type($file);

    header('Content-Type: ' . $fileType);
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));

    readfile($file);
} else {
    echo 'File not found.';
}
?>