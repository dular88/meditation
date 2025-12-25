<?php
$res = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<div class="card shadow-sm mt-4">
    <div class="card-header">Users List</div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; while($row=mysqli_fetch_assoc($res)){ ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= $row['phone']; ?></td>
                    <td class="text-capitalize"><?= $row['role']; ?></td>
                    <td><?= date("d M Y", strtotime($row['created_at'])); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
