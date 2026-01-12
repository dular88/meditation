<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Seva | Selfless Service with Love</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('assets/images/seva-bg.jpg') center/cover;
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
    <h1 class="fw-bold">Seva</h1>
    <p class="mt-2">Selfless Service – Love in Action</p>
</div>
</section>

<!-- INTRO -->
<section class="py-5">
<div class="container">
    <div class="card-box p-4 shadow-sm">
        <p class="section-text text-muted mb-0">
            <strong>Seva</strong> is selfless service performed without
            expectation of reward. It is an expression of compassion,
            humility, and gratitude. Through seva, spirituality moves
            from words into action.
        </p>
    </div>
</div>
</section>

<!-- TYPES OF SEVA -->
<section class="py-5">
<div class="container">
    <h2 class="fw-bold text-center mb-4">Forms of Seva</h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🤲 Physical Seva</h5>
                <p class="section-text text-muted mb-0">
                    Cleaning public places, serving food,
                    helping the needy, maintaining sacred spaces.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">💛 Emotional Seva</h5>
                <p class="section-text text-muted mb-0">
                    Listening with empathy, supporting others,
                    spreading positivity and hope.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h5 class="fw-semibold">🧠 Knowledge Seva</h5>
                <p class="section-text text-muted mb-0">
                    Teaching, guiding, sharing wisdom,
                    helping others grow consciously.
                </p>
            </div>
        </div>

    </div>
</div>
</section>

<!-- BENEFITS -->
<section class="py-5 bg-light">
<div class="container text-center">
    <h2 class="fw-bold mb-3">Why Seva Matters</h2>
    <p class="section-text text-muted mb-0">
        Seva dissolves ego, purifies the heart,
        builds unity, and creates joy without attachment.
    </p>
</div>
</section>

<!-- CTA -->
<section class="py-5 text-center bg-success text-white">
    <h2>Serve with Love • Live with Purpose</h2>
    <p class="mt-2">Seva is meditation in action</p>
    <a href="donation.php" class="btn btn-light btn-lg mt-3">
        Support Seva Activities
    </a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
