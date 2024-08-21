
<style>
/* General styling for the chatbox */
.chatbox {
    border: 1px solid #ccc;
    padding: 10px;
    max-width: 600px;
    margin: 0 auto;
    background-color: #f9f9f9;
    overflow: auto; /* Clearfix for floated elements */
}

/* Common styling for all messages */
.message {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
    max-width: 70%;
    clear: both;
    display: inline-block;
}

/* Styling for messages sent by the user (Message From) */
.sent {
    background-color: #d1ffd6; /* Light green background */
    float: right; /* Float to the left */
    margin-right: 20px; /* Add some spacing from the right edge */
}

/* Styling for messages received by the user (Message To) */
.received {
    background-color: #d1e0ff; /* Light blue background */
    float: left; /* Float to the right */
    margin-left: 20px; /* Add some spacing from the left edge */
}

/* Styling for the message content */
.message p {
    margin: 0;
}

/* Styling for the date and message sender information */
.message p small {
    color: #777;
    font-size: 0.8em;
}


</style>

<?php
require_once '../config.php';
?>
<br><br><br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ask Questions?</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="submit_message.php" method="POST">
          <!-- Hidden field for user_id -->

          <div class="mb-3">
            <label for="user_id" class="col-form-label">Recipient:</label>
            <select class="form-control" id="user_id" name="user_id" required>
              <option value="">Select Recipient</option>
              <?php
              // Fetch users with role Doctor or Patient from the user table
              $result_users = $connection->query("SELECT username FROM user WHERE role IN ('Doctor', 'Patient')");
              if ($result_users->num_rows > 0) {
                  while ($row = $result_users->fetch_assoc()) {
                      echo '<option value="' . htmlspecialchars($row['username']) . '">' . htmlspecialchars($row['username']) . '</option>';
                  }
              } else {
                  echo '<option value="">No users available</option>';
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message-text" required></textarea>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--chat box starts here-->
<?php
// Include database configuration file to establish connection
require_once '../config.php';

// Start session to get the active user's username

$active_user = $_SESSION['username'];

// Fetch messages from the 'reviews' table where recipient is the active user or user_id is the active user
$query = "SELECT message, date, user_id, recipient FROM reviews WHERE recipient = ? OR user_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $active_user, $active_user);
$stmt->execute();
$result = $stmt->get_result();
// die(var_dump($result));
if ($result->num_rows > 0) {
    // Display messages in a chatbox format
    echo '<div class="chatbox">';
    while ($row = $result->fetch_assoc()) {
        // Determine if the message is sent or received
        if ($row['user_id'] === $active_user) {
            $message_label = 'My Message:';
            $message_class = 'sent'; // Optional: for CSS styling
        } else if ($row['recipient'] === $active_user) {
            $message_label = 'Message From:';
            $message_class = 'received'; // Optional: for CSS styling
        } else {
            continue; // Skip messages that don't match the criteria
        }

        echo '<div class="message ' . $message_class . '">';
        echo '<p><strong>' . htmlspecialchars($message_label) . '</strong> ' . htmlspecialchars($row['user_id']) . '</p>';
        echo '<p>' . htmlspecialchars($row['message']) . '</p>';
        echo '<p><small>' . htmlspecialchars($row['date']) . '</small></p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    // If no messages are found, display a message
    echo '<p>No messages found.</p>';
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>
