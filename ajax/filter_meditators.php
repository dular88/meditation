<?php
include "../dbcon.php";

$state_id = isset($_POST['state_id']) ? (int)$_POST['state_id'] : 0;
$city_id  = isset($_POST['city_id']) ? (int)$_POST['city_id'] : 0;

$where = "WHERE 1";
if($state_id > 0) $where .= " AND m.state_id=$state_id";
if($city_id > 0) $where .= " AND m.city_id=$city_id";

// Join with states and cities to get names
$sql = "
SELECT 
    m.*,
    s.name AS state,
    c.name AS city
FROM meditators m
JOIN states s ON s.id = m.state_id
JOIN cities c ON c.id = m.city_id
$where
ORDER BY m.name ASC
";

$q = mysqli_query($conn, $sql);

if(!$q || mysqli_num_rows($q) == 0){
    echo '<div class="col-12 text-center text-muted">No meditators found</div>';
    exit;
}

while($row=mysqli_fetch_assoc($q)){
?>
<div class="col-md-4 mb-4">
    <div class="card meditator-card shadow-sm p-4">
        <div class="meditator-name mb-2">👤 <?= htmlspecialchars($row['name']) ?></div>
        <p class="meditator-text mb-1">📍 <?= htmlspecialchars($row['city']) ?>, <?= htmlspecialchars($row['state']) ?></p>
        <p class="meditator-text mb-1">🏠 <?= nl2br(htmlspecialchars($row['address'])) ?></p>
        <?php if(!empty($row['contact'])){ ?>
        <p class="meditator-text mb-0">📞 <?= htmlspecialchars($row['contact']) ?></p>
        <?php } ?>
    </div>
</div>
<?php } ?>
