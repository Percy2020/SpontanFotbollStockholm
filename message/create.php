<?php
include_once '../config/db.php';
include_once '../models/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);
    
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message->message = $_POST['message'];
    $message->user_id = $_SESSION["userid"];
    $message->parent_id = isset($_POST["parent_id"]) ? $_POST["parent_id"] : NULL;
    if ($message->create()) {
        //Message was created
         header("Location: messagesList.php");
         exit;
    } else {
        echo "Unable to create user.";
    }
}
?>