<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Swadhyay | Self-Study & Inner Awareness</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('assets/images/swadhyay-bg.jpg') center/cover;
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

<!-- ================= HERO ================= -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold">Swadhyay</h1>
    <p class="mt-2">Self-Study • Self-Reflection • Self-Transformation</p>
</div>
</section>

<!-- ================= INTRO ================= -->
<section class="py-5">
<div class="container">
    <div class="card-box p-4 shadow-sm">
        <p class="section-text text-muted mb-0">
            <strong>Swadhyay</strong> means the study of the self.
            It includes reading spiritual literature, reflecting on life,
            and observing one’s own thoughts, emotions, and actions.
            Swadhyay builds awareness and transforms knowledge into wisdom.
        </p>
    </div>
</div>
</section>

<!-- ================= WHAT IS SWADHYAY ================= -->
<section class="py-5">
<div class="container">
    <h2 class="fw-bold text-center mb-4">What is Swadhyay?</h2>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">📖 Scriptural Study</h5>
                <p class="section-text text-muted mb-0">
                    Reading sacred texts like the Bhagavad Gita,
                    Upanishads, and teachings of enlightened masters
                    to gain clarity and direction in life.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🪞 Self-Observation</h5>
                <p class="section-text text-muted mb-0">
                    Watching thoughts and emotions without judgment,
                    understanding habits, and correcting oneself
                    with awareness rather than guilt.
                </p>
            </div>
        </div>

    </div>
</div>
</section>

<!-- ================= BENEFITS ================= -->
<section class="py-5 bg-light">
<div class="container">
    <h2 class="fw-bold text-center mb-4">Benefits of Swadhyay</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🧠 Mental Clarity</h5>
                <p class="section-text text-muted mb-0">
                    Removes confusion, improves focus,
                    and strengthens decision-making.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🌼 Character Building</h5>
                <p class="section-text text-muted mb-0">
                    Develops discipline, humility,
                    and conscious living.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🌱 Spiritual Growth</h5>
                <p class="section-text text-muted mb-0">
                    Deepens understanding, strengthens faith,
                    and prepares the mind for meditation.
                </p>
            </div>
        </div>

    </div>
</div>
</section>

<!-- ================= PRACTICE ================= -->
<section class="py-5">
<div class="container text-center">
    <h2 class="fw-bold mb-3">How to Practice Swadhyay</h2>
    <p class="section-text text-muted mb-0">
        Daily reading • Reflection & journaling •
        Applying teachings in daily life • Silent observation
    </p>
</div>
</section>

<!-- ================= CTA ================= -->
<section class="py-5 text-center bg-success text-white">
    <h2>Learn • Reflect • Transform</h2>
    <p class="mt-2">Swadhyay is the path from knowledge to wisdom</p>
    <a href="books.php" class="btn btn-light btn-lg mt-3">
        Explore Spiritual Books
    </a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
