<?php
include 'db.php';
include 'header.php';

// Get the user count from the users table
$user_count_sql = "SELECT COUNT(*) as user_count FROM users";
$user_count_result = $conn->query($user_count_sql);
$user_count_row = $user_count_result->fetch_assoc();
$user_count = $user_count_row['user_count'];

// Get the library records
$sql = "SELECT * FROM library";
$result = $conn->query($sql);
?>

<h2>Library List</h2>
<a href="library_create.php" class="btn btn-primary mb-3">Add Library</a>

<style>
    .operations {
        display: flex;
        gap: 10px;
    }
</style>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No of Users</th>
            <th>No of Books</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["no_of_users"]."</td>
                        <td>".$row["no_of_books"]."</td>
                        <td>".$row["phone"]."</td>
                        <td>".$row["address"]."</td>
                        <td class='operations'>
                            <a href='library_update.php?id=".$row["id"]."' class='btn btn-warning'>Edit</a> 
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No libraries found</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>
