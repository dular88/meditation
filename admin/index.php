<?php
include "../dbcon.php";
include_once "auth.php";
// Fetch contact messages
$query = "SELECT * FROM contacts ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ekta Pyramid Spiritual Society Admin Panel</title>

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/dist/css/admin.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">

</head>
<body>

<?php include_once "sidebar.php"; ?>

<div class="content p-4">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Cards Row -->
<?php


// Fetch total counts dynamically
$totalMeditators = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM meditators"))['total'];
$totalCenters = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM meditation_centers"))['total'];
$totalBooks = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"))['total'];
$totalEvents = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM events"))['total'];
?>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h5>Total Meditators</h5>
            <h3><?= $totalMeditators ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h5>Total Meditation Centers</h5>
            <h3><?= $totalCenters ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h5>Total Books</h5>
            <h3><?= $totalBooks ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h5>Total Events</h5>
            <h3><?= $totalEvents ?></h3>
        </div>
    </div>
</div>


    <!-- Contact Messages Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Contact Messages</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                </thead>
                <tbody>
                <?php 
                if ($result && mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= htmlspecialchars($row['subject']); ?></td>
                            <td><?= strlen($row['message']) > 40 
                                    ? htmlspecialchars(substr($row['message'],0,40)) . "..." 
                                    : htmlspecialchars($row['message']); ?></td>
                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                            
                        </tr>
                    <?php } 
                } else { ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No contacts found</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
