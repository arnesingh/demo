<?php
include 'db.php';
include 'header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM library WHERE id=$id";
    $result = $conn->query($sql);
    $library = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $no_of_books = $_POST['no_of_books'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE library SET no_of_books='$no_of_books', phone='$phone', address='$address' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: library_index.php'); // Redirect to the library list
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<h2>Update Library</h2>
<form id="libraryForm" method="post">
    <input type="hidden" name="id" value="<?php echo $library['id']; ?>">
    <div class="form-group">
        <label for="no_of_books">No of Books:</label>
        <input type="number" class="form-control" name="no_of_books" value="<?php echo $library['no_of_books']; ?>" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $library['phone']; ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" name="address" required><?php echo $library['address']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'footer.php'; ?>
