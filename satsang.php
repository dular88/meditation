<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Satsang | Path of Truth & Awareness</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('assets/images/satsang-bg.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}
.section-text{
    line-height:1.9;
    font-size:15px;
}
.card-box{
    background:#f8f9fa;
    border-radius:15px;
}
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<!-- HERO -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold">Satsang</h1>
    <p class="mt-2">The Path of Truth, Awareness & Inner Peace</p>
</div>
</section>

<!-- INTRO -->
<section class="py-5">
<div class="container">
    <div class="card-box p-4 shadow-sm">
        <p class="section-text text-muted mb-0">
            <strong>Satsang</strong> means being in the company of truth.
            It is the practice of associating with positive thoughts,
            spiritual wisdom, meditation, and enlightened guidance.
            Through satsang, the mind slowly turns inward and becomes peaceful.
        </p>
    </div>
</div>
</section>

<!-- BENEFITS -->
<section class="py-5">
<div class="container">
    <h2 class="fw-bold text-center mb-4">Benefits of Satsang</h2>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🕊️ Mental Purity</h5>
                <ul class="section-text text-muted mb-0">
                    <li>Removes negative thinking</li>
                    <li>Calms restless mind</li>
                    <li>Creates inner silence</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🌼 Spiritual Growth</h5>
                <ul class="section-text text-muted mb-0">
                    <li>Develops awareness</li>
                    <li>Strengthens faith</li>
                    <li>Supports meditation practice</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>

<!-- PRACTICE -->
<section class="py-5 bg-light">
<div class="container text-center">
    <h2 class="fw-bold mb-3">Forms of Satsang</h2>
    <p class="section-text text-muted mb-0">
        Spiritual discourses • Group meditation • Chanting • Silence •
        Study of scriptures • Company of conscious people
    </p>
</div>
</section>

<!-- CTA -->
<section class="py-5 text-center bg-success text-white">
    <h2>Come • Listen • Reflect</h2>
    <p class="mt-2">Experience peace through Satsang</p>
    <a href="gallery.php" class="btn btn-light btn-lg mt-3">
        View Satsang Moments
    </a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
