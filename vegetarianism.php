<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Vegetarianism | A Way of Healthy, Compassionate Living</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('assets/images/vegetarian-bg.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}

.content-box{
    background:#f8f9fa;
    border-radius:15px;
}

.section-text{
    line-height:1.9;
    font-size:15px;
}

.icon-box{
    background:#ffffff;
    border-radius:12px;
    padding:20px;
    height:100%;
}
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<!-- ================= HERO ================= -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold">Vegetarianism</h1>
    <p class="mt-2">A Way of Healthy, Compassionate Living</p>
</div>
</section>

<!-- ================= INTRO ================= -->
<section class="py-2">
<div class="container">
    <div class="content-box p-4 shadow-sm">
        <p class="section-text mb-0 text-muted">
            Vegetarianism is not just a diet; it is a lifestyle that promotes
            <strong>health, compassion, and harmony with nature</strong>.
            By choosing plant-based foods, we take a conscious step toward
            caring for our body, protecting the environment, and respecting
            all living beings.
        </p>
    </div>
</div>
</section>

<!-- ================= BENEFITS ================= -->
<section class="py-2">
<div class="container">

    <h2 class="text-center fw-bold mb-4">🥗 Benefits of Vegetarianism</h2>

    <div class="row g-4">

        <!-- Health -->
        <div class="col-md-6">
            <div class="icon-box shadow-sm">
                <h5 class="fw-semibold">1️⃣ Better Health</h5>
                <ul class="section-text text-muted mb-0">
                    <li>Rich in vitamins, minerals, and fiber</li>
                    <li>Helps reduce risk of heart disease, diabetes, and obesity</li>
                    <li>Improves digestion and boosts immunity</li>
                </ul>
            </div>
        </div>

        <!-- Peaceful Mind -->
        <div class="col-md-6">
            <div class="icon-box shadow-sm">
                <h5 class="fw-semibold">2️⃣ Peaceful Mind & Spiritual Growth</h5>
                <ul class="section-text text-muted mb-0">
                    <li>Light and sattvic food keeps the mind calm</li>
                    <li>Supports meditation, focus, and inner balance</li>
                    <li>Encourages self-discipline and clarity of thought</li>
                </ul>
            </div>
        </div>

        <!-- Compassion -->
        <div class="col-md-6">
            <div class="icon-box shadow-sm">
                <h5 class="fw-semibold">3️⃣ Compassion for All Living Beings</h5>
                <ul class="section-text text-muted mb-0">
                    <li>Promotes non-violence (Ahimsa)</li>
                    <li>Reduces animal suffering</li>
                    <li>Encourages kindness and empathy</li>
                </ul>
            </div>
        </div>

        <!-- Environment -->
        <div class="col-md-6">
            <div class="icon-box shadow-sm">
                <h5 class="fw-semibold">4️⃣ Environmental Protection</h5>
                <ul class="section-text text-muted mb-0">
                    <li>Saves water and natural resources</li>
                    <li>Reduces carbon footprint</li>
                    <li>Supports sustainable living</li>
                </ul>
            </div>
        </div>

    </div>
</div>
</section>

<!-- ================= FOODS ================= -->
<section class="py-5 bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold mb-3">🌱 Simple Vegetarian Foods</h2>
            <p class="section-text text-muted mb-0">
                Fruits and vegetables • Grains, pulses, and legumes •
                Nuts and seeds • Milk, curd, and plant-based alternatives
            </p>
        </div>
    </div>
</div>
</section>

<!-- ================= IMPACT ================= -->
<section class="py-5">
<div class="container text-center">
    <h2 class="fw-bold mb-3">🌍 A Small Choice, A Big Impact</h2>
    <p class="section-text text-muted">
        By choosing vegetarian food even <strong>one day a week</strong>,
        we contribute to a healthier planet and a more peaceful world.
    </p>

    <p class="fw-semibold mt-4">
        ✨ Eat clean. Think pure. Live consciously.
    </p>
</div>
</section>

<!-- ================= CTA ================= -->
<section class="py-5 text-center bg-success text-white">
    <h2>Healthy Body • Peaceful Mind • Compassionate Life</h2>
    <p class="mt-2">
        Embrace vegetarianism as a path of awareness and harmony
    </p>
    <a href="contact.php" class="btn btn-light btn-lg mt-3">
        Know More
    </a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
