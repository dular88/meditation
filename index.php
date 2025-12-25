<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ekta Pyramid Spiritual Trust</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{ font-family: 'Segoe UI', sans-serif; }

.hero{
    background: linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('assets/images/banner.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}

.hero h1{ font-size:3rem; font-weight:700; }

.z-box{
    padding:70px 0;
}

.z-box img{
    border-radius:15px;
}

.bg-soft{
    background:#f8f9fa;
}
</style>
</head>

<body>
<?php include_once "includes/header.php" ?>


<!-- ================= Z MIDDLE (Visual Focus) ================= -->
<section class="z-box text-center">
<div class="container">
    <img src="assets/images/banner.png" class="img-fluid shadow-lg mb-4" width="900">
    <h2 class="fw-bold">Awaken the Inner Self Through Pyramid Meditation</h2>
    <p class="mt-3">
        Pyramid meditation enhances concentration, balances energy,
        and helps connect deeply with the universe.
    </p>
</div>
</section>



<!-- ================= MEDITATION INFO ================= -->
<section class="z-box bg-soft">
    <div class="container">
        <div class="row g-5 align-items-center">

            <!-- LEFT COLUMN -->
            <div class="col-md-6">
                <h2 class="fw-bold">Anapanasati Meditation</h2>
                <p class="mt-3">
                    Anapanasati is a simple yet powerful meditation technique
                    based on awareness of natural breathing.
                    The word <strong>Anapanasati</strong> means
                    mindfulness of inhalation and exhalation.
                </p>
                <p>
                    In this practice, the meditator gently observes the breath
                    as it flows in and out, without controlling it.
                    This awareness calms the mind, reduces thoughts,
                    and gradually leads to deep inner silence.
                </p>
                <p>
                    Practicing Anapanasati inside a pyramid enhances
                    energy flow and accelerates spiritual growth.
                </p>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="col-md-6">
                <h2 class="fw-bold">Benefits of Meditation</h2>
                <ul class="mt-3">
                    <li>Improves concentration and mental clarity</li>
                    <li>Reduces stress, anxiety, and emotional imbalance</li>
                    <li>Enhances inner peace and self-awareness</li>
                    <li>Balances physical, mental, and emotional energy</li>
                    <li>Improves sleep quality and overall health</li>
                    <li>Helps in spiritual awakening and consciousness growth</li>
                </ul>
                <p class="mt-3">
                    Regular meditation practice leads to a disciplined,
                    joyful, and meaningful life connected with universal energy.
                </p>
            </div>

        </div>
    </div>
</section>


<!-- ================= CTA ================= -->
<section class="z-box text-center bg-success text-white">
    <h2>Begin Your Spiritual Journey Today</h2>
    <p class="mt-2">Meditate • Heal • Transform</p>
    <a href="contact.php" class="btn btn-light btn-lg mt-3">
        Contact Us
    </a>
</section>

<!-- ================= FOOTER ================= -->
<?php include_once "includes/footer.php" ?>

</body>
</html>
