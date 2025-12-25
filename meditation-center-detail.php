<?php
include "dbcon.php";

if (!isset($_GET['id'])) {
    die("Center not found");
}

$id = (int)$_GET['id'];

$q = mysqli_query($conn, "
    SELECT c.*, s.name AS state, ci.name AS city
    FROM meditation_centers c
    JOIN states s ON s.id = c.state_id
    JOIN cities ci ON ci.id = c.city_id
    WHERE c.id = $id
");

$center = mysqli_fetch_assoc($q);
if (!$center) {
    die("Center not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($center['center_name']) ?> | Meditation Center</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
    url('assets/images/center.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}
.detail-card{
    border-radius:20px;
}
.icon-box{
    font-size:1.1rem;
}
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<!-- ================= HERO ================= -->
<section class="hero text-center">
    <div class="container">
        <h1 class="fw-bold"><?= htmlspecialchars($center['center_name']) ?></h1>
        <p class="mt-2">
            <?= htmlspecialchars($center['city']) ?>, <?= htmlspecialchars($center['state']) ?>
        </p>
    </div>
</section>

<!-- ================= DETAIL CARD ================= -->
<section class="py-5">
<div class="container">

<div class="card shadow detail-card">
<div class="row g-0">

    <!-- IMAGE -->
    <div class="col-md-5">
        <img src="assets/images/pyramid-details.png"
             class="img-fluid h-100 w-100 rounded-start"
             style="object-fit:cover;"
             alt="Meditation Center">
    </div>

    <!-- CONTENT -->
    <div class="col-md-7">
        <div class="card-body p-4">

            <h3 class="fw-bold"><?= htmlspecialchars($center['center_name']) ?></h3>

            <p class="text-muted mb-3">
                📍 <?= htmlspecialchars($center['address']) ?>
            </p>

            <div class="mb-3 icon-box">
                <strong>City:</strong> <?= htmlspecialchars($center['city']) ?><br>
                <strong>State:</strong> <?= htmlspecialchars($center['state']) ?>
            </div>

            <?php if (!empty($center['contact_number'])) { ?>
                <p class="mb-2">📞 <?= htmlspecialchars($center['contact_number']) ?></p>
            <?php } ?>

            <?php if (!empty($center['email'])) { ?>
                <p class="mb-2">📧 <?= htmlspecialchars($center['email']) ?></p>
            <?php } ?>

            <p class="mt-3">
                This sacred pyramid meditation center supports
                <strong>Anapanasati</strong> and group meditation,
                helping practitioners experience inner silence,
                healing energy, and self-realization.
            </p>

            <div class="d-flex gap-2 flex-wrap mt-4">
                <?php if (!empty($center['google_map_url'])) { ?>
                    <a href="<?= $center['google_map_url'] ?>" target="_blank"
                       class="btn btn-outline-primary">
                        📍 View on Map
                    </a>
                <?php } ?>

                 <?php if (!empty($center['google_business_url'])) { ?>
                    <a href="<?= $center['google_business_url'] ?>" target="_blank"
                    class="btn btn-outline-warning">
                        ⭐ Google Reviews
                    </a>
                <?php } ?>

                <?php if (!empty($center['youtube_url'])) { ?>
                    <a href="<?= $center['youtube_url'] ?>" target="_blank"
                       class="btn btn-outline-danger">
                        ▶ Watch Video
                    </a>
                <?php } ?>
            </div>

        </div>
    </div>

</div>
</div>

</div>
</section>

<!-- ================= CTA ================= -->
<section class="py-5 text-center bg-success text-white">
    <h2>Experience Group Meditation</h2>
    <p class="mt-2">
        Meditate • Heal • Awaken
    </p>
    <a href="contact.php" class="btn btn-light btn-lg mt-3">
        Contact This Center
    </a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
