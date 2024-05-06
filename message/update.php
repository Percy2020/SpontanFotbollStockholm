<?php
include_once '../config/db.php';
include_once '../models/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);
    
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message->message = $_POST['message'];
    $message->message_id = $_POST["message_id"];
    if ($message->update()) {
        //Message was created
         header("Location: messagesList.php");
         exit;
    } else {
        echo "Unable to update message.";
    }
}
?>