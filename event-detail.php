<?php
include "dbcon.php";

if (!isset($_GET['id'])) {
    die("Event not found");
}

$event_id = (int)$_GET['id'];

/* ================= FETCH EVENT ================= */
$sql = "
SELECT 
    e.*,
    mc.center_name,
    mc.address,
    mc.contact_number,
    mc.email,
    mc.google_map_url,
    ci.name AS city,
    a.name AS area
FROM events e
JOIN meditation_centers mc ON mc.id = e.center_id
JOIN cities ci ON ci.id = mc.city_id
LEFT JOIN areas a ON a.id = mc.area_id
WHERE e.id = ?
";

// Prepare statement
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $event_id);
$stmt->execute();

$result = $stmt->get_result();
if (!$result) {
    die("Query failed: " . $stmt->error);
}

$event = $result->fetch_assoc();
if (!$event) {
    die("Event not found");
}

$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($event['name']) ?> | Meditation Event</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('<?= $event['photo'] ?: "assets/images/event-default.jpg" ?>')
    center/cover;
    color:#fff;
    padding:120px 0;
}
.info-box{
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
        <h1 class="fw-bold"><?= ucwords(htmlspecialchars($event['name'])) ?></h1>
        <p class="mt-2">
            📍 <?= $event['area'] ?>, <?= $event['city'] ?> Chhattisgarh
        </p>
    </div>
</section>

<!-- ================= EVENT DETAILS ================= -->
<section class="py-5">
<div class="container">
<div class="row g-4">

    <!-- LEFT CONTENT -->
    <div class="col-md-8">
        <div class="card shadow border-0 p-4">

            <!-- EVENT PHOTO -->
            <div class="mb-4">
                <img 
                    src="admin/crud/<?= !empty($event['photo']) 
                        ? htmlspecialchars($event['photo']) 
                        : 'assets/images/event-default.jpg' ?>"
                    class="img-fluid rounded w-100"
                    alt="<?= htmlspecialchars($event['name']) ?>">
            </div>

            <h3 class="fw-bold mb-3">Event Details</h3>

            <p>
                <strong>🗓 Start:</strong>
                <?= date("d M Y", strtotime($event['start_date'])) ?>
            </p>

            <p>
                <strong>🗓 End:</strong>
                <?= date("d M Y", strtotime($event['end_date'])) ?>
            </p>

            <hr>

            <div>
                <?= nl2br(htmlspecialchars($event['details'])) ?>
            </div>

        </div>
    </div>

    <!-- RIGHT SIDEBAR -->
    <div class="col-md-4">

        <div class="info-box p-4 mb-4">
            <h5 class="fw-bold">Meditation Center</h5>
            <p class="mb-1"><?= htmlspecialchars($event['center_name']) ?></p>
            <p class="small text-muted">
                <?= htmlspecialchars($event['address']) ?><br>
                <?= htmlspecialchars($event['area']) ?>, <?= htmlspecialchars($event['city']) ?> Chhattisgarh
            </p>

            <?php if (!empty($event['contact_number'])) { ?>
                <p>📞 <?= htmlspecialchars($event['contact_number']) ?></p>
            <?php } ?>

            <?php if (!empty($event['email'])) { ?>
                <p>📧 <?= htmlspecialchars($event['email']) ?></p>
            <?php } ?>

            <?php if (!empty($event['google_map_url'])) { ?>
                <a href="<?= htmlspecialchars($event['google_map_url']) ?>" target="_blank"
                   class="btn btn-outline-primary btn-sm w-100">
                   📍 View on Map
                </a>
            <?php } ?>
            <?php if (!empty($event['link'])) { ?>
    <a href="<?= htmlspecialchars($event['link']) ?>"
       target="_blank"
       rel="noopener noreferrer"
       class="btn btn-outline-success btn-sm w-100 mt-2">
       🔗 Event Link
    </a>
<?php } ?>

        </div>

        <div class="info-box p-4 text-center">
            <h5>Join the Event</h5>
            <p class="small text-muted">
                Experience group meditation, silence & healing energy
            </p>
            <a href="contact.php" class="btn btn-success w-100">
                Contact Organizer
            </a>
        </div>

    </div>

</div>
</div>
</section>


<?php include "includes/footer.php"; ?>

</body>
</html>
