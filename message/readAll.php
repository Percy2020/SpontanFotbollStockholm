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
    if ($isRoot || !$isRoot) {
        echo '<ul>';
    }

    foreach ($tree as $node) {
        echo '<li><b>' . $node['username'] . '</b><textarea disabled rows="' . count(explode("\n", $node['message'])) . '" class="form-control">' . htmlspecialchars($node['message']) . '</textarea>';
        echo "<div>";
        echo "<a href='editMessagePage.php?message_id=" . $node['message_id'] . "'><i class='fa fa-edit'></i></a> <a href='addMessagePage.php?parent_id=". $node['message_id'] . "'> <i class='fa fa-plus'></i></a> <a href='#'><i class='fa fa-trash'></i></a></div>";
        if (!empty($node['children'])) {
            printTree($node['children'], false);
        }
        echo '</li>';
    }

    if ($isRoot || !$isRoot) {
        echo '</ul>';
    }
}

// Display the tree
printTree($tree);