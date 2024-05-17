<?php
include_once '../config/db.php';
include_once '../models/imageUploader.php';

$database = new Database();
$db = $database->getConnection();

$imageUploader = new ImageUploader($db);
$result = $imageUploader->uploadingImagesByUserId();
// Function to print the tree into a nested HTML list
function printUploadinImages($result) {
    
$max_per_row = 3;
$item_count = 0;

    echo "<table class='table table-bordered'>";
    echo "<tr>";
     foreach ($result as $image) {
        if ($item_count == $max_per_row)
            {
                echo "</tr><tr>";
                $item_count = 0;
            }
            echo "<td><div class='text-center'><img src='" . $image['filepath']  . "' class='img-fluid img-thumbnail' /></div></td>";
            $item_count++;
    }
    echo "</tr>";
    echo "</table>";
}

// Display the uploadingImages
printUploadinImages($result);
?>