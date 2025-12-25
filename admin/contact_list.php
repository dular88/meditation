<?php
include "../dbcon.php";

$query = "
    SELECT *
    FROM contacts
    ORDER BY id DESC
";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<div class="card shadow-sm mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Contact List</h5>
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
                    <th>Action</th>
                </tr>
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
            <td>
                <?= strlen($row['message']) > 40
                    ? htmlspecialchars(substr($row['message'], 0, 40)) . "..."
                    : htmlspecialchars($row['message']); ?>
            </td>
            <td><?= htmlspecialchars($row['created_at']); ?></td>
            <td>
                <a href="delete_contact.php?id=<?= $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this contact?');">
                   Delete
                </a>
            </td>
        </tr>
<?php 
    }
} else { ?>
    <tr>
        <td colspan="8" class="text-center text-muted">No contacts found</td>
    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>
