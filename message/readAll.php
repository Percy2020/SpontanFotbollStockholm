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
        echo "<a href='editMessagePage.php?message_id=" . $node['message_id'] . "'><i class='fa fa-edit'></i></a> <a href='addMessagePage.php?parent_id=". $node['message_id'] . "'> <i class='fa fa-plus'></i></a> <a href='#' onclick='confirmDelete(" . $node['message_id'] . ")'><i class='fa fa-trash'></i></a></div>";
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

?>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>
<script>
function confirmDelete(itemId) {
  // Set the item ID in the delete button for later use
  document.getElementById('deleteButton').dataset.itemId = itemId;
  var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
  myModal.show();
}

document.getElementById('deleteButton').addEventListener('click', function() {
  var itemId = this.dataset.itemId; // Get item ID stored in the button

  fetch('delete.php', {
    method: 'POST',
    body: JSON.stringify({ id: itemId }),
    headers: {
      'Content-Type': 'application/json'
    }
  })
  .then(response => response.json())
  .then(data => {
    console.log(data.message);
    // Optionally close the modal and update the UI here
    bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
    // Reload or update the page content as needed
    location.reload();
  })
  .catch(error => console.error('Error:', error));
});
</script>