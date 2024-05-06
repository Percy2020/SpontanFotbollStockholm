<?php
include_once '../config/db.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->create()) {
        echo "User was created.";
    } else {
        echo "Unable to create user.";
    }
}
?>