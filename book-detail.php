<?php
include "dbcon.php";

if (!isset($_GET['id'])) {
    die("Book not found");
}

$book_id = (int)$_GET['id'];

/* ================= FETCH BOOK ================= */
$q = mysqli_query($conn, "SELECT * FROM books WHERE id = $book_id");
$book = mysqli_fetch_assoc($q);

if (!$book) {
    die("Book not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($book['name']) ?> | Spiritual Book</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
    url('<?= !empty($book['image']) ? htmlspecialchars($book['image']) : "assets/images/book-default.jpg" ?>')
    center/cover;
    color:#fff;
    padding:120px 0;
}

.book-cover{
    max-height:420px;
    object-fit:cover;
    border-radius:15px;
}

.info-box{
    background:#f8f9fa;
    border-radius:15px;
}

.book-summary{
    line-height:1.8;
    font-size:15px;
}
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<!-- ================= HERO ================= -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold"><?= htmlspecialchars($book['name']) ?></h1>
    <p class="mt-2">✍ Written by <?= htmlspecialchars($book['written_by']) ?></p>
</div>
</section>

<!-- ================= BOOK DETAILS ================= -->
<section class="py-5">
<div class="container">
<div class="row g-4 align-items-start">

    <!-- LEFT IMAGE -->
    <div class="col-md-4 text-center">
        <img 
            src="<?= !empty($book['image']) ? 'admin/crud/uploads/books/'.htmlspecialchars($book['image']) : 'assets/images/book-default.jpg' ?>"
            class="img-fluid book-cover shadow"
            alt="<?= htmlspecialchars($book['name']) ?>">
    </div>

    <!-- RIGHT CONTENT -->
    <div class="col-md-8">
        <div class="card shadow border-0 p-4">

            <h3 class="fw-bold"><?= htmlspecialchars($book['name']) ?></h3>

            <p class="text-muted mb-2">
                ✍ Author: <strong><?= htmlspecialchars($book['written_by']) ?></strong>
            </p>

            <hr>

            <h5 class="fw-semibold mb-3">About this Book</h5>

            <div class="book-summary">
                <?= nl2br(htmlspecialchars($book['summary'])) ?>
            </div>

        </div>
    </div>

</div>
</div>
</section>

<!-- ================= CTA ================= -->
<section class="py-5 text-center bg-success text-white">
    <h2>Read • Reflect • Meditate</h2>
    <p class="mt-2">
        Books that guide you towards inner silence and awareness
    </p>
    <a href="books.php" class="btn btn-light btn-lg mt-3">
        Back to Books
    </a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
