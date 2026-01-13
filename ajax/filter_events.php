<?php
include "../dbcon.php";
$city_id    = isset($_POST['city_id']) ? (int)$_POST['city_id'] : 0;
$area_id    = isset($_POST['area_id']) ? (int)$_POST['area_id'] : 0;
$event_type = $_POST['event_type'] ?? '';
function seo_slug($string){
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    $string = preg_replace('/\s+/', '-', $string);
    return trim($string, '-');
}

$where = "WHERE 1";

/* ================= CITY & AREA ================= */
if ($city_id > 0) {
    $where .= " AND mc.city_id = $city_id";
}
if ($area_id > 0) {
    $where .= " AND mc.area_id = $area_id";
}


/* ================= EVENT TYPE ================= */
if ($event_type === "upcoming") {
    $where .= " AND e.start_date > CURDATE()";
}
elseif ($event_type === "ongoing") {
    $where .= " AND e.start_date <= CURDATE() AND e.end_date >= CURDATE()";
}
elseif ($event_type === "completed") {
    $where .= " AND e.end_date < CURDATE()";
}

/* ================= QUERY ================= */
$sql = "
SELECT 
    e.id,
    e.name,
    e.start_date,
    e.end_date,
    e.photo,
    mc.center_name,
    ci.name AS city,
    ar.name AS area
FROM events e
JOIN meditation_centers mc ON mc.id = e.center_id
JOIN cities ci ON ci.id = mc.city_id
JOIN areas ar ON ar.id = mc.area_id
$where
ORDER BY e.start_date DESC
";


$q = mysqli_query($conn, $sql);

if (!$q || mysqli_num_rows($q) === 0) {
    echo '<div class="col-12 text-center text-muted">No events found</div>';
    exit;
}

while ($row = mysqli_fetch_assoc($q)) {
    $event_slug = seo_slug($row['name']);
?>
<div class="col-md-4 mb-4">
    <div class="card event-card shadow-sm h-100">

        <!-- EVENT IMAGE -->
        <?php if (!empty($row['photo'])) { ?>
            <img src="admin/crud/<?= htmlspecialchars($row['photo']) ?>"
                 class="event-img w-100"
                 alt="<?= htmlspecialchars($row['name']) ?>">
        <?php } ?>

        <div class="card-body">

            <!-- EVENT NAME -->
            <h5 class="fw-bold mb-2">
                <?= htmlspecialchars($row['name']) ?>
            </h5>

            <!-- EVENT DATES -->
            <p class="small text-muted mb-1">
                📅 
                <?= date("d M Y", strtotime($row['start_date'])) ?>
                –
                <?= date("d M Y", strtotime($row['end_date'])) ?>
            </p>

            <!-- ORGANIZER -->
            <p class="small mb-0">
                🧘 Organized by:
                <strong><?= htmlspecialchars($row['center_name']) ?></strong>
            </p>

        </div>

        <div class="card-footer bg-white border-0">
            <a href="event-detail.php?id=<?= $row['id'] ?>&event=<?= $event_slug ?>&city=<?= $row['city'] ?>"  class="btn btn-outline-success w-100">
    View Details
</a>
        </div>

    </div>
</div>
<?php } ?>
