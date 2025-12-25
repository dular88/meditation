<?php
include "../dbcon.php";

$state_id   = isset($_POST['state_id']) ? (int)$_POST['state_id'] : 0;
$city_id    = isset($_POST['city_id']) ? (int)$_POST['city_id'] : 0;
$event_type = $_POST['event_type'] ?? '';

$where = "WHERE 1";

/* ================= STATE & CITY ================= */
if ($state_id > 0) {
    $where .= " AND mc.state_id = $state_id";
}
if ($city_id > 0) {
    $where .= " AND mc.city_id = $city_id";
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
    mc.center_name
FROM events e
JOIN meditation_centers mc ON mc.id = e.center_id
$where
ORDER BY e.start_date DESC
";

$q = mysqli_query($conn, $sql);

if (!$q || mysqli_num_rows($q) === 0) {
    echo '<div class="col-12 text-center text-muted">No events found</div>';
    exit;
}

while ($row = mysqli_fetch_assoc($q)) {
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
            <a href="event-detail.php?id=<?= $row['id'] ?>"
               class="btn btn-outline-success w-100">
                View Details
            </a>
        </div>

    </div>
</div>
<?php } ?>
