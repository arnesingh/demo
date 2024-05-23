<?php
include 'db.php';
include 'header.php';

// Fetch libraries for the dropdown
$library_sql = "SELECT id, address FROM library";
$library_result = $conn->query($library_sql);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $new_library_id = $_POST['library_id'];

    $old_library_id = $user['library_id'];

    $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', gender='$gender', password='$password', library_id='$new_library_id' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        if ($old_library_id != $new_library_id) {
            // Decrement the no_of_users in the old library
            $decrement_sql = "UPDATE library SET no_of_users = no_of_users - 1 WHERE id = $old_library_id";
            $conn->query($decrement_sql);

            // Increment the no_of_users in the new library
            $increment_sql = "UPDATE library SET no_of_users = no_of_users + 1 WHERE id = $new_library_id";
            $conn->query($increment_sql);
        }

        echo "User updated successfully";
        header('Location: index.php'); // Redirect to the user list
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $conn->close();
}
?>

<h2>Update User</h2>
<form id="userForm" method="post">
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" required>
    </div>
    <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" name="gender" required>
            <option value="">Select</option>
            <option value="Male" <?php if($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" value="<?php echo $user['password']; ?>" required>
    </div>
    <div class="form-group">
        <label for="library_id">Library:</label>
        <select class="form-control" name="library_id" required>
            <option value="">Select a library</option>
            <?php
            if ($library_result->num_rows > 0) {
                while($row = $library_result->fetch_assoc()) {
                    echo "<option value='".$row["id"]."'".($user['library_id'] == $row['id'] ? ' selected' : '').">".$row["address"]."</option>";
                }
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'footer.php'; ?>
