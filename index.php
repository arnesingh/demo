<?php
include 'db.php';
include 'header.php';

// Fetch all libraries
$sql = "SELECT * FROM library";
$result = $conn->query($sql);
?>

<h2>Libraries</h2>
<a href="library_create.php" class="btn btn-success">Add Library</a>
<table class="table">
    <thead>
        <tr>
            <th>Address</th>
            <th>Phone</th>
            <th>No. of Books</th>
            <th>No. of Users</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['address']."</td>
                    <td>".$row['phone']."</td>
                    <td>".$row['no_of_books']."</td>
                    <td>".$row['no_of_users']."</td>
                    <td>
                        <a href='library_update.php?id=".$row['id']."' class='btn btn-primary'>Edit</a>
                        <a href='library_users.php?library_id=".$row['id']."' class='btn btn-info'>View Users</a>
                    </td>
                </tr>";
            }
        }
        ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
