<?php
include_once '../config/db.php';
include_once '../models/message.php';

$database = new Database();
$db = $database->getConnection();

$message = new Message($db);
$result = $message->readAll();
$tree = $message->getTree();
// Function to print the tree into a nested HTML list
function printTree($tree, $isRoot = true) {
    
    if (!$isRoot) {
        echo '<ul>';
    }else{
        echo '<div><ul id="myUL">';
    }

    foreach ($tree as $node) {

        $level1 = is_null($node['parent_id']) ? true : false;
        if ($level1) {
            echo '<div class="row"><div class="card card-body">';
        }

        echo '<li><b>' . $node['username'] . '</b><textarea disabled rows="' . count(explode("\n", $node['message'])) . '" class="form-control">' . htmlspecialchars($node['message']) . '</textarea>';
        echo "<div>";
        echo "<a href='editMessagePage.php?message_id=" . $node['message_id'] . "'><i class='fa fa-edit'></i></a> <a href='addMessagePage.php?parent_id=". $node['message_id'] . "'> <i class='fa fa-plus'></i></a> <a href='#' onclick='confirmDelete(" . $node['message_id'] . ")'><i class='fa fa-trash'></i></a></div>";
        if (!empty($node['children'])) {
            $level1 = is_null($node['parent_id']) ? true : false;
            printTree($node['children'], false, $level1);
        }
        echo '</li>';

        if ($level1) {
            echo '</div></div></br>';
        }
    }

    if (!$isRoot) {
        echo '</ul>';
    }else{
        echo '</ul></div>';
    }
}

// Display the tree
printTree($tree);
include('messageModal.html');
?>