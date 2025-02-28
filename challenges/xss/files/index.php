<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize messages array (in a real app, this would be stored in a database)
session_start();

if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = [
        [
            'name' => 'Admin',
            'message' => 'Welcome to our message board! Feel free to leave a comment.',
            'time' => '2023-01-01 10:00:00'
        ],
        [
            'name' => 'John',
            'message' => 'This is a great site!',
            'time' => '2023-01-01 10:30:00'
        ],
        [
            'name' => 'Alice',
            'message' => 'I have a question about security...',
            'time' => '2023-01-01 11:15:00'
        ]
    ];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $message = $_POST['message']; 
    
    // Vulnerable implementation - intentionally not sanitizing input
    // In a secure application, you would use htmlspecialchars() or similar
    
    $newMessage = [
        'name' => $name,
        'message' => $message,
        'time' => date('Y-m-d H:i:s')
    ];
    
    // Add message to the beginning of the array
    array_unshift($_SESSION['messages'], $newMessage);
}

// Function to reset the messages (for testing)
if (isset($_GET['reset']) && $_GET['reset'] === 'true') {
    $_SESSION['messages'] = [
        [
            'name' => 'Admin',
            'message' => 'Welcome to our message board! Feel free to leave a comment.',
            'time' => '2023-01-01 10:00:00'
        ],
        [
            'name' => 'John',
            'message' => 'This is a great site!',
            'time' => '2023-01-01 10:30:00'
        ],
        [
            'name' => 'Alice',
            'message' => 'I have a question about security...',
            'time' => '2023-01-01 11:15:00'
        ]
    ];
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Board</title>
    <link rel="stylesheet" href="../../src/ui/style.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .message-form {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .form-group textarea {
            min-height: 100px;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .message-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .message-time {
            color: #666;
            font-size: 0.8em;
        }
        .back-link {
            margin-top: 20px;
            display: block;
        }
        .actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Message Board</h1>
        <p>Share your thoughts with the community! Be respectful and have fun.</p>
        
        <div class="message-form">
            <h2>Post a Message</h2>
            <form method="POST" action="index.php">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="message">Your Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Post Message</button>
            </form>
        </div>
        
        <h2>Messages</h2>
        
        <?php foreach ($_SESSION['messages'] as $message): ?>
            <div class="message">
                <div class="message-header">
                    <span><?php echo $message['name']; ?></span>
                    <span class="message-time"><?php echo $message['time']; ?></span>
                </div>
                <div class="message-content">
                    <?php echo $message['message']; ?>
                </div>
            </div>
        <?php endforeach; ?>
        
        <div class="actions">
            <a href="../../src/ui/index.html" class="back-link">← Back to Challenges</a>
            <a href="index.php?reset=true">Reset Messages</a>
        </div>
    </div>
</body>
</html>