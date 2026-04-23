 <?php
 
$conn = mysqli_connect("localhost", "root", "", "table 1");  

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $sql = "INSERT INTO entry (name, age, email) VALUES ('$name', '$age', '$email')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        header("Location: index.php");
    } else {
        echo "Insert Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
</head>
<body>

<h1>Student Profile</h1>

<form method="post">
    <label>Name</label>
    <input type="text" name="name" required><br><br>

    <label>Age</label>
    <input type="number" name="age" required><br><br>

    <label>Email</label>
    <input type="email" name="email" required><br><br>

    <input type="submit" value="Submit">
</form>

<hr>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Age</th>
    <th>Email</th>
</tr>

<?php
 
$r = mysqli_query($conn, "SELECT * FROM entry");

if (!$r) {
    die("Select Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($r) > 0) {
     while ($row = mysqli_fetch_assoc($r)) {

    $id = isset($row['S.No']) ? $row['S.No'] : '';
    $name = isset($row['Name']) ? $row['Name'] : '';
    $age = isset($row['age']) ? $row['age'] : '';
    $email = isset($row['Email']) ? $row['Email'] : '';

    echo "<tr>
            <td>" . htmlspecialchars($id) . "</td>
            <td>" . htmlspecialchars($name) . "</td>
            <td>" . htmlspecialchars($age) . "</td>
            <td>" . htmlspecialchars($email) . "</td>
          </tr>";
}
    
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}
?>

</table>

</body>
</html>