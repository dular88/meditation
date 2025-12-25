<?php
include "../dbcon.php";

$where = "WHERE 1";

if(!empty($_POST['state_id'])){
    $where .= " AND c.state_id=".intval($_POST['state_id']);
}

if(!empty($_POST['city_id'])){
    $where .= " AND c.city_id=".intval($_POST['city_id']);
}

$q = mysqli_query($conn,"
SELECT c.*, s.name AS state, ci.name AS city
FROM meditation_centers c
JOIN states s ON s.id=c.state_id
JOIN cities ci ON ci.id=c.city_id
$where
ORDER BY c.id DESC
");

if(mysqli_num_rows($q)==0){
    echo '<div class="text-center text-muted">No meditation centers found</div>';
    exit;
}

while($row=mysqli_fetch_assoc($q)){ ?>

<div class="col-md-4 mb-4">
  <div class="card shadow-sm h-100">
    <div class="card-body">
      <h5 class="fw-bold"><?= htmlspecialchars($row['center_name']) ?></h5>
      <p class="text-muted"><?= $row['city'] ?>, <?= $row['state'] ?></p>
      <p><?= htmlspecialchars($row['address']) ?></p>

      <div class="d-flex gap-2">
        <?php if($row['google_map_url']){ ?>
          <a href="<?= $row['google_map_url'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">Map</a>
        <?php } ?>

        <?php if($row['youtube_url']){ ?>
          <a href="<?= $row['youtube_url'] ?>" target="_blank" class="btn btn-sm btn-outline-danger">YouTube</a>
        <?php } ?>
        <a href="meditation-center-detail.php?id=<?= $row['id'] ?>"
   class="btn btn-sm btn-success">
   View Details
</a>

      </div>
    </div>
  </div>
</div>

<?php } ?>
