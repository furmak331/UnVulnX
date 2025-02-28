<?php
// Enable error reporting for development only
// In production, errors should not be displayed to users
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "db";
$username = "dvwa";
$password = "dvwapassword";
$dbname = "dvwa";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize database if not already set up
function initializeDatabase($conn) {
    // Check if the users table exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows == 0) {
        // Create users table
        $sql = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            password VARCHAR(40) NOT NULL,
            email VARCHAR(50),
            is_admin TINYINT(1) DEFAULT 0
        )";
        
        if ($conn->query($sql) === TRUE) {
            // Insert sample data
            $sql = "INSERT INTO users (username, password, email, is_admin) VALUES
                ('admin', SHA1('supersecretpassword'), 'admin@example.com', 1),
                ('john', SHA1('password123'), 'john@example.com', 0),
                ('alice', SHA1('alicepass'), 'alice@example.com', 0),
                ('bob', SHA1('bobpass'), 'bob@example.com', 0),
                ('charlie', SHA1('charliepass'), 'charlie@example.com', 0)";
            $conn->query($sql);
        }
    }
}

// Initialize the database
initializeDatabase($conn);

// Handle user lookup
$userFound = false;
$error = "";
$result = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Vulnerable query - intentionally insecure for educational purposes
    $query = "SELECT id, username, email, is_admin FROM users WHERE id = '$id'";
    
    try {
        $result = $conn->query($query);
        if ($result === FALSE) {
            $error = "Query error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $userFound = true;
        }
    } catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
}

// Close the database connection
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Lookup System</title>
    <link rel="stylesheet" href="../../src/ui/style.css">
    <style>
        .container { 
            max-width: 800px; 
            margin: 0 auto; 
            padding: 20px;
        }
        .user-form {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .back-link {
            margin-top: 20px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Lookup System</h1>
        <p>Enter a user ID to look up user information.</p>
        
        <div class="user-form">
            <form method="GET">
                <label for="id">User ID:</label>
                <input type="text" id="id" name="id" placeholder="Enter User ID" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
                <button type="submit">Look Up</button>
            </form>
        </div>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['id']) && !$error): ?>
            <h2>Results:</h2>
            <?php if ($userFound): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row["id"]); ?></td>
                                <td><?php echo htmlspecialchars($row["username"]); ?></td>
                                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                <td><?php echo $row["is_admin"] ? 'Yes' : 'No'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No user found with that ID.</p>
            <?php endif; ?>
        <?php endif; ?>
        
        <a href="../../src/ui/index.html" class="back-link">← Back to Challenges</a>
    </div>
</body>
</html>