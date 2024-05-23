<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the library_id for the user to be deleted
    $user_sql = "SELECT library_id FROM users WHERE id = $id";
    $user_result = $conn->query($user_sql);
    $user = $user_result->fetch_assoc();
    $library_id = $user['library_id'];

    // Delete the user
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Decrement the no_of_users in the associated library
        $decrement_sql = "UPDATE library SET no_of_users = no_of_users - 1 WHERE id = $library_id";
        $conn->query($decrement_sql);

        echo "User deleted successfully";
        header('Location: user_index.php'); // Redirect to the user list
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $conn->close();
}
?>
