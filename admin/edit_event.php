<?php
session_start();
include "../dbcon.php";

if (!isset($_GET['id'])) {
    $_SESSION["error"] = "Invalid request!";
    header("Location: events.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch event
$stmt = mysqli_prepare($conn, "SELECT * FROM events WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    $_SESSION["error"] = "Event not found!";
    header("Location: events.php");
    exit;
}

// Fetch meditation centers
$centers = mysqli_query($conn, "SELECT id, center_name FROM meditation_centers ORDER BY center_name");

if (!$centers) {
    die("Center Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="../assets/dist/css/admin.css" rel="stylesheet">
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content p-4">
    <nav class="navbar navbar-light bg-white shadow-sm rounded mb-4">
        <div class="container-fluid">
            <span class="navbar-brand">Edit Event</span>
        </div>
    </nav>

    <div class="container">

        <!-- SHOW MESSAGES -->
        <?php if (isset($_SESSION["success"])) { ?>
            <div class="alert alert-success"><?= $_SESSION["success"]; ?></div>
            <?php unset($_SESSION["success"]); ?>
        <?php } ?>

        <?php if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger"><?= $_SESSION["error"]; ?></div>
            <?php unset($_SESSION["error"]); ?>
        <?php } ?>

        <div class="box">
            <h3 class="mb-4">Update Event</h3>

            <form action="crud/update_event.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $event['id']; ?>">
                <input type="hidden" name="old_photo" value="<?= $event['photo']; ?>">

                <div class="mb-3">
                    <label class="form-label">Event Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($event['name']); ?>" required>
                </div>

                <div class="mb-3">
    <label class="form-label">Meditation Center</label>
    <select name="center_id" class="form-control" required>
        <option value="">Select Center</option>

        <?php while ($c = mysqli_fetch_assoc($centers)) { ?>
            <option value="<?= $c['id']; ?>"
                <?= ($c['id'] == $event['center_id']) ? 'selected' : ''; ?>>
                <?= htmlspecialchars($c['center_name']); ?>
            </option>
        <?php } ?>

    </select>
</div>


                <div class="mb-3">
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?= $event['start_date']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?= $event['end_date']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Details</label>
                    <textarea name="details" rows="4" class="form-control" required><?= $event['details']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Old Photo</label><br>
                    <img src="http://localhost/ekta/admin/crud/<?= $event['photo']; ?>" 
                         width="120" height="120" style="object-fit:cover;border-radius:5px;">
                </div>

                <div class="mb-3">
                    <label>Upload New Photo (Optional)</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>

                <button class="btn btn-warning w-100">Update Event</button>

            </form>
        </div>

    </div>
</div>

</body>
</html>
