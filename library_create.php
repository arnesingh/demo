<?php
include 'db.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_of_books = $_POST['no_of_books'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO library (no_of_books, phone, address) VALUES ('$no_of_books', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header('Location: index.php'); // Redirect to the library list
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<h2>Create Library</h2>
<form id="libraryForm" method="post">
    <div class="form-group">
        <label for="no_of_books">No of Books:</label>
        <input type="number" class="form-control" name="no_of_books" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" name="phone" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" name="address" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include 'footer.php'; ?>
