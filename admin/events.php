<?php
include_once "../dbcon.php";
 include_once "auth.php";

/* Fetch meditation centers */
$centers = [];
$res = mysqli_query($conn, "SELECT id, center_name FROM meditation_centers ORDER BY center_name");
while ($row = mysqli_fetch_assoc($res)) {
    $centers[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Admin Panel</title>

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/dist/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">
</head>
<body>

<!-- Sidebar -->
<?php include_once "sidebar.php"; ?>

<div class="content p-4">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Events</a>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <div class="container">
        <div class="box">
            <h3 class="mb-4 text-center">Create New Event</h3>

            <form action="crud/save_event.php" method="POST" enctype="multipart/form-data">

                <!-- Meditation Center Dropdown -->
                <div class="mb-3">
                    <label class="form-label">Organised By</label>
                    <select name="center_id" class="form-select" required>
                        <option value="">Select Center</option>
                        <?php foreach ($centers as $c) { ?>
                            <option value="<?= $c['id']; ?>">
                                <?= htmlspecialchars($c['center_name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Event Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Event Name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Event Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Event Details</label>
                    <textarea name="details" rows="4" class="form-control" required></textarea>
                </div>

                <button class="btn btn-primary w-100">Save Event</button>
            </form>
        </div>

        <?php include "../admin/crud/event_list.php"; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
