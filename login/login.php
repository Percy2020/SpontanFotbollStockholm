<?php
session_start();
include_once '../config/db.php';
include_once '../models/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user->name = $_POST['name'];
    $user->password = $_POST['password'];

    $result = $user->login();

    if ($result->rowCount() > 0 ) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $_SESSION['userid'] = $user_id;
            }

            // Om användaren klickade på "Kom ihåg mig"
            if (!empty($_POST['remember'])) {
                // Skapa en cookie som håller i 30 dagar
                //setcookie('username', $username, time() + (86400 * 30), "/");
                setcookie('password', $password, time() + (86400 * 30), "/"); // Notera: Detta är inte säkert, bättre att använda en säker token
            }

            header("Location: ../index.php");
            exit;
        } else {
            //Användaren finns inte; show error to do,
            header("Location: loginUser.php");
            exit;
        }
       
}
?>