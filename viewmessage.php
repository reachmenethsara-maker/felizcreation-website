<?php
session_start();
include '../php/db.php';
include 'sidebar.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contact_messages WHERE message_id = $id");
    header("Location: viewmessage.php");
    exit();
}

/* MARK AS READ */
if (isset($_GET['read'])) {
    $id = intval($_GET['read']);
    $conn->query("UPDATE contact_messages SET status='read' WHERE message_id = $id");
    header("Location: viewmessage.php");
    exit();
}

/* COUNT UNREAD */
$countUnread = $conn->query("SELECT COUNT(*) as total FROM contact_messages WHERE status='unread'")
->fetch_assoc()['total'];

/* UNREAD MESSAGES */
$unread = $conn->query("SELECT * FROM contact_messages WHERE status='unread' ORDER BY created_at DESC");

/* READ + SEARCH */
$search = "";
$query = "SELECT * FROM contact_messages WHERE status='read'";

if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $query .= " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
}

$query .= " ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Messages</title>

<link rel="stylesheet" href="viewmessage.css">
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
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="viewmessage.php" class="active">📩 Messages</a>
        <a href="managedesign.php">🎨 Designs</a>
    </div>

     <div class="logout-box">
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <!-- NOTIFICATION -->
    <?php if($countUnread > 0): ?>
    <div class="notification">
        🔔 You have <?php echo $countUnread; ?> new message(s)
    </div>
    <?php endif; ?>

    <!-- TOPBAR -->
    <div class="topbar">
        <h3>Messages</h3>
        <!--<a href="logout.php" class="logout">Logout</a>-->
    </div>

    <!-- SEARCH -->
    <form method="GET" class="search-box">
        <input type="text" name="search" placeholder="Search name or email..." value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>

    <!-- UNREAD -->
    <h3>🔴 Unread Messages</h3>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>

            <?php while($row = $unread->fetch_assoc()): ?>
            <tr style="background: rgba(255,0,0,0.1);">
                <td><?php echo $row['message_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="mailto:<?php echo $row['email']; ?>" class="btn">Reply</a>

                    <a href="?read=<?php echo $row['message_id']; ?>" class="btn secondary">
                        Mark Read
                    </a>

                    <a href="?delete=<?php echo $row['message_id']; ?>" 
                       onclick="return confirm('Delete this message?')" 
                       class="btn danger">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>

    <!-- READ -->
    <h3>📩 All Messages</h3>
    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>

            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['message_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="mailto:<?php echo $row['email']; ?>" class="btn">Reply</a>

                    <a href="?delete=<?php echo $row['message_id']; ?>" 
                       onclick="return confirm('Delete this message?')" 
                       class="btn danger">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>

        </table>
    </div>

</div>

</body>
</html>