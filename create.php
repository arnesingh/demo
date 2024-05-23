<?php
include 'db.php';
include 'header.php';

// Fetch libraries for the dropdown
$library_sql = "SELECT id, address FROM library";
$library_result = $conn->query($library_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $library_id = $_POST['library_id'];

    // Insert the user into the users table
    $sql = "INSERT INTO users (name, email, phone, gender, password, library_id) VALUES ('$name', '$email', '$phone', '$gender', '$password', '$library_id')";

    if ($conn->query($sql) === TRUE) {
        // Increment the no_of_users in the selected library
        $increment_sql = "UPDATE library SET no_of_users = no_of_users + 1 WHERE id = $library_id";
        $conn->query($increment_sql);

        echo "New user created successfully";
        header('Location: index.php'); // Redirect to the user list
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<h2>Create User</h2>
<form id="userForm" method="post">
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
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="library_id">Library:</label>
        <select class="form-control" name="library_id" required>
            <option value="">Select a library</option>
            <?php
            if ($library_result->num_rows > 0) {
                while($row = $library_result->fetch_assoc()) {
                    echo "<option value='".$row["id"]."'>".$row["address"]."</option>";
                }
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include 'footer.php'; ?>
