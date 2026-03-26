<?php
include 'php/db.php';

function getDesigns($conn, $category) {
    return $conn->query("SELECT * FROM designs WHERE category='$category' ORDER BY created_at DESC");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designs</title>
    <link rel="stylesheet" href="designs-css.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
    <header>
    <div class="logo">
        <img src="front logo (white)png.png" alt="feliz creation logo">
        <h1><span class="dark-text">FELIZ</span><span class="light-text"> CREATION</span></h1>
    </div>

    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about-us.html">About us</a></li>
            <li><a href="our-services.html">Our Services</a></li>
            <li><a href="designs.php" class="active">Designs</a></li>
            <li><a href="contact-us.html">Contact us</a></li>
        </ul>
    </nav>
</header>

<section class="intro">
    <h2>Our Design Gallery</h2>
    <p>Explore our creative projects,organized by design category.</p>
</section>

<main class="design-gallery">
    <section id="social-media" class="design-category">
        <h3>Social Media Posts</h3>

        <div class="design-grid-wrapper">
            <button class="scroll-left" onclick="scrollleft(this)">&#10094;</button>
            

        <div class="design-grid">
            <?php $data = getDesigns($conn, "Social Media Posts"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>" alt="design">
<?php endwhile; ?>
        </div>
        <button class="scroll-right" onclick="scrollright(this)">&#10095;</button>
        </div>
    </section>

    <section id="cover-page" class="design-category">
        <h3>Cover Pages</h3>

        <div class="design-grid-wrapper">
            <button class="scroll-left" onclick="scrollleft(this)">&#10094;</button>

        <div class="design-grid">
            <?php $data = getDesigns($conn, "Cover Pages"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>">
<?php endwhile; ?>
        </div>
        <button class="scroll-right" onclick="scrollright(this)">&#10095;</button>
        </div>
    </section>

    <section id="banner" class="design-category">
        <h3>Banner Designs</h3>
      
        <div class="design-grid-wrapper">
            <button class="scroll-left" onclick="scrollleft(this)">&#10094;</button>
        <div class="design-grid">
            <?php $data = getDesigns($conn, "Banner"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>">
<?php endwhile; ?>
    
        </div>
        <button class="scroll-right" onclick="scrollright(this)">&#10095;</button>
        </div>
    </section>

    <section id="leaflets" class="design-category">
        <h3>Leaflets</h3>
        <div class="design-grid">
            <?php $data = getDesigns($conn, "Leaflets"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>">
<?php endwhile; ?>
        </div>
    </section>

    <section id="file-covers" class="design-category">
        <h3>File Covers</h3>
        <div class="design-grid">
            <?php $data = getDesigns($conn, "File Covers"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>">
<?php endwhile; ?>
        </div>
    </section>

    <section id="business-card" class="design-category">
        <h3>Business Cards</h3>
        <div class="design-grid">
            <?php $data = getDesigns($conn, "Business Cards"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>">
<?php endwhile; ?>
        </div>
    </section>

    <section id="logo" class="design-category">
        <h3>Logo Designs</h3>
        <div class="design-grid">
            <?php $data = getDesigns($conn, "Logo Designs"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>">
<?php endwhile; ?>
            

        </div>
    </section>

    <section id="custom" class="design-category">
        <h3>Custom Designs</h3>
        <div class="design-grid">
            <?php $data = getDesigns($conn, "Custom Designs"); ?>
<?php while($row = $data->fetch_assoc()): ?>
    <img src="uploads/<?php echo $row['image']; ?>">
<?php endwhile; ?>
        </div>
    </section>
</main>


<footer>
    <p>
        © 2025 FELIZ CREATION. All Rights Reserved.
    </p>
    <p>Owned by <strong>Mr.Kevin Nanayakkara</strong></p>
</footer>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    function scrollleft(button){
        const grid = button.nextElementSibling;
        grid.scrollBy({left: -400,behavior:'smooth'});
    }
    function scrollright(button){
        const grid = button.previousElementSibling;
        grid.scrollBy({left: 400,behavior:'smooth'});
    }
</script>
</body>
</html>