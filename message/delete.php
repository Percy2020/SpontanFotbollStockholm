<?php
include_once '../config/db.php';
include_once '../models/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
    
 if (!is_null($id)) {
    $message->message_id = $id;
    if ($message->delete()) {
        //Message was deleted
         /* header("Location: messagesList.php");
         exit;  */
         echo json_encode(['message' => 'Record deleted successfully']);
    } else {
        echo json_encode(['message' => 'Record deleted successfully']);
    }
}
?>