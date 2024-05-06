<?php
include_once '../config/db.php';
include_once '../models/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);

// Assuming you have added security and connection checks here
if (isset($_GET['message_id']) && is_numeric($_GET['message_id'])) {
    $id = $_GET['message_id'];
    $message->getMessageById($id); 
    // Display message details
    if ($message->message_id !== null) {
        // Message found, continue with displaying the form
    } else {
        echo "No message found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit message</title>
</head>
<body>
    <?php include '../template/header.php'; ?>
    
    <h2>Edit message</h2>
    <form action="update.php" method="post">
    <input type="hidden" id="message_id" name="message_id" value="<?php echo $_GET['message_id']; ?>">
        <div class="form-outline">
            <label class="form-label" for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="4"><?php echo htmlspecialchars($message->message) ?></textarea>
        </div>
        </br>
        <div class="form-group">
            <input class="btn btn-secondary btn-sm" type="submit" value="Update">
        </div>
    </form>
    </div>
    <?php include '../template/footer.php'; ?>
</body>
</html>