<?php
$servername = "db";
$username = "dvwa";
$password = "dvwapassword";
$dbname = "dvwa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($query);

    echo "<h2>Results:</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "User: " . $row["username"] . "<br>";
    }
}
?>
<form method="GET">
    <input type="text" name="id" placeholder="Enter User ID">
    <button type="submit">Submit</button>
</form>
