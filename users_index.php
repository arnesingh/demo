<?php
include 'db.php';
include 'header.php';

// Fetch users along with their library information
$sql = "SELECT users.*, library.address AS library_address FROM users LEFT JOIN library ON users.library_id = library.id";
$result = $conn->query($sql);
?>

<h2>Users</h2>
<a href="create.php" class="btn btn-success">Add User</a>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Library</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['phone']."</td>
                    <td>".$row['gender']."</td>
                    <td>".$row['library_address']."</td>
                    <td>
                        <a href='update.php?id=".$row['id']."' class='btn btn-primary'>Edit</a>
                        <a href='delete.php?id=".$row['id']."' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
