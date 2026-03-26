<?php
session_start();
include '../php/db.php';
include 'sidebar.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

/* DELETE DESIGN */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $img = $conn->query("SELECT image FROM designs WHERE design_id=$id")->fetch_assoc();
    if ($img && $img['image']) {
        unlink("../uploads/" . $img['image']);
    }

    $conn->query("DELETE FROM designs WHERE design_id=$id");
    header("Location: managedesign.php");
    exit();
}

/* ADD DESIGN */
/* ADD DESIGN */
if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // Create unique file name
    $imageName = time() . "_" . basename($image);

    // Correct relative path
    $target = "../uploads/" . $imageName;

    // Move file
    if (move_uploaded_file($tmp, $target)) {

        $conn->query("INSERT INTO designs (title, category, image)
                      VALUES ('$title', '$category', '$imageName')");

        header("Location: managedesign.php");
        exit();

    } else {
        echo "❌ Image upload failed!";
    }
}

/* FILTER */
$filter = "";
if (isset($_GET['category']) && $_GET['category'] != "") {
    $cat = $_GET['category'];
    $filter = "WHERE category='$cat'";
}

$designs = $conn->query("SELECT * FROM designs $filter ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Designs</title>

<link rel="stylesheet" href="sidebar.css">
<link rel="stylesheet" href="managedesign.css">
<!--<link rel="stylesheet" href="sidebar.css">-->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>



<div class="main">

<h2>🎨 Manage Designs</h2>

<!-- ADD FORM -->
<div class="form-box">
    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="Design Title" required>

        <select name="category" required>
            <option value="">Select Category</option>
            <option>Social Media Posts</option>
            <option>Cover Pages</option>
            <option>Banner</option>
            <option>Leaflets</option>
            <option>File Covers</option>
            <option>Business Cards</option>
            <option>Logo Designs</option>
            <option>Custom Designs</option>
        </select>

        <input type="file" name="image" required>

        <button type="submit" name="add">Add Design</button>

    </form>
</div>

<!-- FILTER -->
<div class="filter-box">
    <form method="GET">
        <select name="category" onchange="this.form.submit()">
            <option value="">All Categories</option>
            <option>Social Media Posts</option>
            <option>Cover Pages</option>
            <option>Banner</option>
            <option>Leaflets</option>
            <option>File Covers</option>
            <option>Business Cards</option>
            <option>Logo Designs</option>
            <option>Custom Designs</option>
        </select>
    </form>
</div>

<!-- GRID -->
<div class="grid">

<?php while($row = $designs->fetch_assoc()): ?>

    <div class="card">

        <img src="../uploads/<?php echo $row['image']; ?>">

        <h4><?php echo $row['title']; ?></h4>
        <p><?php echo $row['category']; ?></p>

        <a href="?delete=<?php echo $row['design_id']; ?>"
           onclick="return confirm('Delete this design?')">
           Delete
        </a>

    </div>

<?php endwhile; ?>

</div>

</div>

</body>
</html>