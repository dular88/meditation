<?php
include "../dbcon.php";

$query = "
    SELECT 
        e.*,
        c.center_name
    FROM events e
    LEFT JOIN meditation_centers c ON c.id = e.center_id
    ORDER BY e.id DESC
";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

?>

<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Event List</h5>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Organised By</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
               <tbody>
<?php 
if ($result && mysqli_num_rows($result) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $i++; ?></td>

            <td>
                <?php if (!empty($row['photo'])) { ?>
                    <img src="<?= URL ?>/admin/crud/<?= htmlspecialchars($row['photo']); ?>"
                         width="60" height="60"
                         style="object-fit:cover; border-radius:5px;">
                <?php } ?>
            </td>

            <td><?= htmlspecialchars($row['name']); ?></td>

            <!-- ✅ CENTER NAME -->
            <td><?= htmlspecialchars($row['center_name'] ?? 'N/A'); ?></td>

            <td><?= htmlspecialchars($row['start_date']); ?></td>
            <td><?= htmlspecialchars($row['end_date']); ?></td>

            <td>
                <?= strlen($row['details']) > 40
                    ? htmlspecialchars(substr($row['details'], 0, 40)) . "..."
                    : htmlspecialchars($row['details']); ?>
            </td>

            <td>
                <a href="edit_event.php?id=<?= $row['id']; ?>"
                   class="btn btn-warning btn-sm">Edit</a>

                <a href="crud/delete_event.php?id=<?= $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this event?');">
                   Delete
                </a>
            </td>
        </tr>
<?php 
    }
} else { ?>
    <tr>
        <td colspan="8" class="text-center text-muted">No events found</td>
    </tr>
<?php } ?>
</tbody>

            </tbody>

        </table>
    </div>
</div>
