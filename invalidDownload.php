<?php
$original_filename = 'index.html';
$new_filename = '.png';

// headers to send your file
header("Content-Type: application/video");
header("Content-Length: " . filesize($original_filename));
header('Content-Disposition: attachment; filename="' . $new_filename . '"');

// upload the file to the user and quit
readfile($original_filename);
exit;
?>