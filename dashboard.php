<?php
session_start();
include '../php/db.php';
include 'sidebar.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Example stats
$users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$messages = $conn->query("SELECT COUNT(*) as total FROM contact_messages")->fetch_assoc()['total'];
$designs = $conn->query("SELECT COUNT(*) as total FROM designs")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link rel="stylesheet" href="dashboard.css">
<link rel="stylesheet" href="sidebar.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo">
        <img src="front logo (white)png.png" alt="Logo">
        <h2>FELIZ <span>CREATION</span></h2>
    </div>

    <div class="menu">
        <a href="dashboard.php" class="active">🏠 Dashboard</a>
        <a href="viewmessage.php">📩 Messages</a>
        <a href="managedesign.php">🎨 Designs</a>
    </div>

    <div class="logout-box">
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <h2>WELCOME, <?php echo $_SESSION['admin']; ?> 👋</h2>
       
    </div>

    <!-- CARDS -->
    <div class="cards">

        <div class="card">
            <h4>Total Users</h4>
            <h1><?php echo $users; ?></h1>
        </div>

        <div class="card">
            <h4>Messages</h4>
            <h1><?php echo $messages; ?></h1>
        </div>

        <div class="card">
            <h4>Designs</h4>
            <h1><?php echo $designs; ?></h1>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="section">
        <h3>Quick Actions</h3>
        <div class="actions">
            <a href="managedesign.php" class="btn">Manage Designs</a>
            <a href="viewmessage.php" class="btn secondary">View Messages</a>
        </div>
    </div>

</div>

</body>
</html>