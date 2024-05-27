<?php
include 'db.php';
include 'header.php';

if (isset($_GET['library_id'])) {
    $library_id = $_GET['library_id'];

    // Fetch library details
    $library_sql = "SELECT * FROM library WHERE id=$library_id";
    $library_result = $conn->query($library_sql);
    $library = $library_result->fetch_assoc();

    // Fetch users associated with this library
    $user_sql = "SELECT * FROM users WHERE library_id=$library_id";
    $user_result = $conn->query($user_sql);
}
?>

<h2>Users of Library: <?php echo $library['address']; ?></h2>
<a href="index.php" class="btn btn-secondary">Back to Libraries</a>
<a href="create.php?library_id=<?php echo $library_id; ?>" class="btn btn-success">Add User to this Library</a>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($user_result->num_rows > 0) {
            while($row = $user_result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['phone']."</td>
                    <td>".$row['gender']."</td>
                    <td>
                        <a href='user_update.php?id=".$row['id']."' class='btn btn-primary'>Edit</a>
                        <a href='user_delete.php?id=".$row['id']."' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found for this library.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
