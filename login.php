<?php
session_start();
include '../php/db.php';

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        // If using plain text password
        if ($password === $user['password']) {

            $_SESSION['admin'] = $user['username'];
            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Invalid password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="login.css">

</head>

<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <div class="logo-area">
            <img src="front logo (white)png.png" alt="logo">
            <h1><span class="dark-text">FELIZ</span><span class="light-text"> CREATION</span></h1>
        </div>
    </div>

    <!-- DIVIDER -->
    <div class="divider"></div>

    <!-- RIGHT SIDE -->
    <div class="right">
        <div class="login-box">

            <h2>Welcome</h2>
            <p>Please login to admin dashboard.</p>

            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>

                <button name="login">Login</button>
            </form>

            <p class="forgot">Forgotten Your Password?</p>

        </div>
    </div>

</div>

</body>
</html>