<?php
class Message {
    private $conn;
    private $table_name = "messages";

    public $message_id;
    public $user_id;
    public $message;
    public $parent_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new message
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET message=:message, user_id=:user_id, parent_id=:parent_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->parent_id = is_null($this->parent_id) ? null : htmlspecialchars(strip_tags($this->parent_id));
        // bind values
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":parent_id", $this->parent_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
// Get tree
    public function getTree($parent_id = NULL) {
        $query = "SELECT * FROM " . $this->table_name . " INNER JOIN users on messages.user_id = users.user_id WHERE parent_id";
        $query .= is_null($parent_id) ? " IS NULL" : "=:parent_id";
        $query .= " ORDER BY message_id DESC";
        echo("<script>console.log('PHP: " . $query . "');</script>");
        $stmt = $this->conn->prepare($query);
        
        if (!is_null($parent_id)) {
            $stmt->bindParam(":parent_id", $parent_id);
        }
        
        $stmt->execute();

        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['children'] = $this->getTree($row['message_id']);  // Recursive call
            $categories[] = $row;
        }

        return $categories;
    }

     // Method to get user by ID
    public function getMessageById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE message_id=:message_id";
        $stmt = $this->conn->prepare($query);

        $this->message_id = htmlspecialchars(strip_tags($id));

        $stmt->bindParam(":message_id", $this->message_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo("<script>console.log('PHP: " . $row['message'] . "');</script>");
        if($row) {
            $this->message_id = $row['message_id'];
            $this->message = $row['message'];
        } else {
            return null;
        }
    }

    // Read all users
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY message_id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    } 
    
    // Login user
    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username=:name, password=:password";
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":password", $this->password);
        
        $stmt->execute();
        
        return $stmt;
    }

    // Update a message
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET message = :message WHERE message_id = :message_id";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->message));
        $this->message_id = htmlspecialchars(strip_tags($this->message_id));

        // bind values
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':message_id', $this->message_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete a message
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE message_id = :message_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->message_id = htmlspecialchars(strip_tags($this->message_id));

        // bind id
        $stmt->bindParam(':message_id', $this->message_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>