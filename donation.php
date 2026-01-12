<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Donate | Ekta Pyramid Spiritual Society</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('assets/images/donation-bg.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}

.qr-box{
    background:#f8f9fa;
    border-radius:15px;
    padding:10px;
}

.qr-img{
    max-width:260px;
    border-radius:12px;
}

.donation-text{
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
    <h1 class="fw-bold">Support the Mission</h1>
    <p class="mt-2">Your contribution helps spread Satsang, Swadhyay & Seva</p>
</div>
</section>

<!-- ================= DONATION CONTENT ================= -->
<section class="py-5">
<div class="container">
<div class="row g-4 align-items-center">

    <!-- LEFT CONTENT -->
    <div class="col-md-7">
        <div class="card shadow-sm border-0 p-4">
            <h3 class="fw-semibold mb-3">Why Donate?</h3>

            <div class="donation-text text-muted">
                <p>
                    Your donation supports spiritual activities such as
                    <strong>Satsang</strong>, <strong>Swadhyay</strong>,
                    meditation programs, and <strong>Seva</strong> initiatives.
                </p>

                <p>
                    With your help, we organize free meditation sessions,
                    spiritual learning programs, social service activities,
                    and maintain the sacred pyramid space for seekers.
                </p>

                <p class="mb-0">
                    🌸 Every contribution, big or small, creates positive
                    energy and collective upliftment.
                </p>
            </div>
        </div>
    </div>

    <!-- RIGHT QR CODE -->
    <div class="col-md-5">
        <div class="qr-box text-center shadow-sm">
            <h4 class="fw-semibold mb-3">Scan & Donate</h4>

            <img
                src="assets/images/ekta-qr.jpeg"
                alt="Donation QR Code"
                class="img-fluid qr-img mb-3">

            <p class="small text-muted mb-1">
                Scan the QR code using any UPI app
            </p>

            <p class="fw-semibold mb-0">
                Ekta Pyramid Spiritual Society
            </p>
        </div>
    </div>

</div>
</div>
</section>

<!-- ================= NOTE ================= -->
<section class="py-4 bg-light">
<div class="container text-center">
    <p class="mb-0 text-muted">
        🙏 Donations are used solely for spiritual, educational,
        and service-oriented activities.
    </p>
</div>
</section>

<!-- ================= CTA ================= -->
<section class="py-5 text-center bg-success text-white">
    <h2>Give with Faith • Serve with Love</h2>
    <p class="mt-2">
        Your generosity fuels spiritual growth and social harmony
    </p>
    <a href="contact.php" class="btn btn-light btn-lg mt-3">
        Contact Us
    </a>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
