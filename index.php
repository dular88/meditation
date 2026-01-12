<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ekta Pyramid Spiritual Society</title>
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

.breath-card {
  max-width: 360px;
  margin: 40px auto;
  padding: 24px;
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #e0e0e0;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  font-family: "Segoe UI", sans-serif;
  text-align: center;
}

.breath-card p {
  font-size: 18px;
  margin: 16px 0;
  color: #333;
}

.breath-card strong {
  color: #2c7a7b;
}

.breath-card span {
  font-style: italic;
  color: #555;
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
<section class="bg-soft">
    <div class="container">
        <div class="row align-items-center">

            <!-- LEFT COLUMN -->
            <div class="col-md-6">
                <h2 class="fw-bold">Anapanasati Meditation</h2>
                <div class="breath-card">
  <p><strong>‘Ana’</strong> means <span>‘In-Breath’</span></p>
  <p><strong>‘Apana’</strong> means <span>‘Out-Breath’</span></p>
  <p><strong>‘Sati’</strong> means <span>‘Be With’</span></p>
</div>

                <p class="mt-3">

In “Anapanasati Meditation“,
the attention of the mind should constantly be on the normal, natural breath.
The task on hand is effortful, joyful oneness with the breath.
No ”mantra” to be chanted…
no form of any ‘ deity ‘ to be entertained in the mind…
no hathayogic pranayama like ‘ kumbhaka ‘..
holding the breath.. should be attempted.                </p>
                
                
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
