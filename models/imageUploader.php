<?php
class ImageUploader {
    private $targetDirectory = "../uploads/";
    private $maxFileSize = 2000000; // 500 KB
    private $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
    private $db;
    private $table_name = "images";
    public $message_id;

    public function __construct($db) {
        $this->db = $db;
    }

    public function upload($file) {
        $targetFile = $this->targetDirectory . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate the image
        if (!$this->isRealImage($file["tmp_name"]) ||
            $file["size"] > $this->maxFileSize ||
            !in_array($imageFileType, $this->allowedTypes) ||
            file_exists($targetFile)) {
            return "Validation failed for the image.";
        }

        // Try to upload file
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            $this->saveFileData($file["name"], $targetFile, $this->message_id);
            return true;
        } else {
            return false;
        }
    }

     // Read all users
    public function uploadingImagesByUserId() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY message_id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }

    private function isRealImage($file) {
        $check = getimagesize($file);
        return $check !== false;
    }

    private function saveFileData($filename, $filepath, $message_id) {
        $query = "INSERT INTO " . $this->table_name . " SET filename=:filename, filepath=:filepath, message_id=:message_id";
        $stmt = $this->db->prepare($query);
        // bind values
        $stmt->bindParam(":filename", $filename);
        $stmt->bindParam(":filepath", $filepath);
        $stmt->bindParam(":message_id", $message_id);
        $stmt->execute();
    }
}
?>