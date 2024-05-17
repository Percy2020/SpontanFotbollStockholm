<?php
include_once '../config/db.php';
include_once '../models/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);

// Assuming you have added security and connection checks here
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
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
    <title>Addera kommetar</title>
</head>
<body>
    <?php include '../template/header.php'; ?>
    <div class="container">
    <h2>Addera kommentar</h2>
    <form action="create.php" method="post">
    <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $_GET['parent_id']; ?>">
        <div class="form-outline">
            <label class="form-label" for="message">Meddelande</label>
            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
        </div>
        </br>
        <div class="form-group">
            <input class="btn btn-secondary btn-sm" type="submit" value="Add">
        </div>
    </form>
    </div>
    <?php include '../template/footer.php'; ?>
</body>
</html>