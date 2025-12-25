<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Spiritual Books | Ekta Pyramid Spiritual Trust</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('assets/images/books.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}

.book-card{
    border-radius:18px;
    transition:.3s;
    height:100%;
}

.book-card:hover{
    transform: translateY(-6px);
}

.book-img{
    height:260px;
    object-fit:cover;
    border-top-left-radius:18px;
    border-top-right-radius:18px;
}

.book-author{
    font-size:14px;
    color:#6c757d;
}

.book-summary{
    font-size:14px;
    line-height:1.6;
}
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<!-- ================= HERO ================= -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold">Spiritual Books</h1>
    <p class="mt-3">
        Books that inspire silence, awareness, meditation & self-realization
    </p>
</div>
</section>

<!-- ================= BOOK LIST ================= -->
<section class="py-5 bg-light">
<div class="container">

<div class="row g-4">

<?php
$q = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");

if (!$q || mysqli_num_rows($q) == 0) {
    echo '<div class="col-12 text-center text-muted">No books available</div>';
}

while ($row = mysqli_fetch_assoc($q)) {
?>
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="card book-card shadow-sm">

        <!-- BOOK IMAGE (CLICKABLE) -->
        <a href="book-detail.php?id=<?= $row['id'] ?>" class="text-decoration-none">
            <img src="admin/crud/uploads/books/<?= !empty($row['image']) 
                ? htmlspecialchars($row['image']) 
                : 'assets/images/book-default.jpg' ?>"
                 class="book-img w-100"
                 alt="<?= htmlspecialchars($row['name']) ?>">
        </a>

        <div class="card-body">

            <!-- BOOK NAME (CLICKABLE) -->
            <h6 class="fw-bold">
                <a href="book-detail.php?id=<?= $row['id'] ?>" 
                   class="text-dark text-decoration-none">
                    <?= htmlspecialchars($row['name']) ?>
                </a>
            </h6>

            <p class="book-author mb-2">
                ✍ Written by <?= htmlspecialchars($row['written_by']) ?>
            </p>

            <p class="book-summary">
                <?= substr(strip_tags($row['summary']), 0, 110) ?>...
            </p>

            <!-- READ MORE BUTTON -->
            <a href="book-detail.php?id=<?= $row['id'] ?>" 
               class="btn btn-outline-success btn-sm w-100 mt-2">
                Read More
            </a>

        </div>

    </div>
</div>

<?php } ?>

</div>
</div>
</section>

<!-- ================= CTA ================= -->
<section class="py-5 text-center bg-success text-white">
    <h2>Read • Reflect • Meditate</h2>
    <p class="mt-2">
        Books that guide you towards inner silence
    </p>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
