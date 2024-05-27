<?php
include 'db.php';
include 'header.php';

$library_id = isset($_GET['library_id']) ? $_GET['library_id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $library_id = $_POST['library_id'];

    // Insert the new user into the users table
    $sql = "INSERT INTO users (name, email, phone, gender, password, library_id) VALUES ('$name', '$email', '$phone', '$gender', '$password', '$library_id')";

    if ($conn->query($sql) === TRUE) {
        // Increment the number of users in the selected library
        $update_library_sql = "UPDATE library SET no_of_users = no_of_users + 1 WHERE id=$library_id";
        $conn->query($update_library_sql);

        echo "New user created successfully";
        header('Location: library_users.php?library_id=' . $library_id); // Redirect to the library's user list
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<h2>Create User</h2>
<form method="post">
    <input type="hidden" name="library_id" value="<?php echo $library_id; ?>">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" name="phone" required>
    </div>
    <div class="form-group">
        <label for="gender">Gender:</label>
        <select class="form-control" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include 'footer.php'; ?>
