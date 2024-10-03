<?php
// Connect to database
$host = 'localhost';
$db = 'user_auth';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $message = "Login successful!";
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "No user found with that email.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <p><?php echo $message; ?></p>
        <p>Don't have an account? <a href="signup.php">Signup here</a></p>
    </div>
</body>
</html>
