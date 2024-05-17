<?php
include_once '../config/db.php';
include_once '../models/imageUploader.php';

$database = new Database();
$db = $database->getConnection();

$uploader = new ImageUploader($db);
    
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($uploader->upload($_FILES["fileToUpload"])) {
        //Message was created
         header("Location: ../message/messagesList.php");
         exit;
    } else {
        echo "Unable to create user.";
    }
}
?>