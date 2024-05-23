<?php
include 'db.php';
include 'header.php';

$sql = "SELECT id, name, email, phone, gender, password FROM users";
$result = $conn->query($sql);
?>

<h2>Users List</h2>
<a href="create.php" class="btn btn-primary mb-3">Add User</a>

<style>
    .operations {
        display: flex;
        gap: 5px;
    }
</style>

<table class="table table-bordered m-1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Password</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["phone"] . "</td>
                        <td>" . $row["gender"] . "</td>
                        <td>" . $row["password"] . "</td>
                        <td class='operations'>

                            <a href='update.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning'>Edit</a> 
                            <a href='delete.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>