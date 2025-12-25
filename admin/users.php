<?php
 include_once "auth.php"; 

include_once "../dbcon.php";
/* ❌ block non-admin */
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}

/* fetch users except admin */
$users = mysqli_query($conn,
    "SELECT * FROM users WHERE role != 'admin' ORDER BY id DESC"
);
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/dist/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="content p-4">

<nav class="navbar bg-white shadow-sm mb-4">
    <h5 class="mb-0">User Management</h5>
</nav>

<!-- FLASH -->
<?php if(isset($_SESSION['success'])){ ?>
<div class="alert alert-success"><?= $_SESSION['success']; ?></div>
<?php unset($_SESSION['success']); } ?>

<?php if(isset($_SESSION['error'])){ ?>
<div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
<?php unset($_SESSION['error']); } ?>

<!-- CREATE USER -->
<div class="card shadow-sm mb-4">
<div class="card-body">
<h5 class="mb-3">Create User</h5>

<form method="post" action="crud/save_user.php">
    <div class="row">
        <div class="col-md-4 mb-3">
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>

        <div class="col-md-4 mb-3">
            <input name="phone"
       class="form-control"
       placeholder="10 Digit Phone"
       maxlength="10"
       pattern="[0-9]{10}"
       inputmode="numeric"
       oninput="this.value = this.value.replace(/[^0-9]/g,'')"
       required />
        </div>

        <div class="col-md-4 mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
    </div>

    <button class="btn btn-primary">Create User</button>
</form>
</div>
</div>

<!-- USER LIST -->
<div class="card shadow-sm">
<div class="card-header">Users List</div>
<div class="card-body p-0">
<table class="table table-striped mb-0">
<thead>
<tr>
<th>#</th>
<th>Name</th>
<th>Phone</th>
<th>Role</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php $i=1; while($u=mysqli_fetch_assoc($users)){ ?>
<tr>
<td><?= $i++; ?></td>
<td><?= htmlspecialchars($u['name']); ?></td>
<td><?= htmlspecialchars($u['phone']); ?></td>
<td><?= ucfirst($u['role']); ?></td>
<td>
    <button 
        class="btn btn-warning btn-sm editBtn"
        data-id="<?= $u['id']; ?>"
        data-name="<?= htmlspecialchars($u['name']); ?>"
        data-phone="<?= htmlspecialchars($u['phone']); ?>">
        Edit
    </button>
<a href="crud/delete_user.php?id=<?= $u['id']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Delete this user?')">
Delete
</a>
</td>
</tr>
<?php } ?>

</tbody>
</table>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll(".editBtn").forEach(btn => {
    btn.addEventListener("click", () => {
        document.getElementById("edit_id").value = btn.dataset.id;
        document.getElementById("edit_name").value = btn.dataset.name;
        document.getElementById("edit_phone").value = btn.dataset.phone;

        new bootstrap.Modal(document.getElementById("editUserModal")).show();
    });
});
</script>
<!-- EDIT USER MODAL -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" action="crud/user_update.php" class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <input type="hidden" name="id" id="edit_id">

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" id="edit_name"
                 class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text"
                 name="phone"
                 id="edit_phone"
                 class="form-control"
                 maxlength="10"
                 pattern="[0-9]{10}"
                 inputmode="numeric"
                 oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                 required>
        </div>

        <div class="mb-3">
          <label class="form-label">
            New Password <small class="text-muted">(optional)</small>
          </label>
          <input type="password" name="password"
                 class="form-control"
                 placeholder="Leave blank to keep old password">
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary">Update User</button>
        <button type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Cancel</button>
      </div>

    </form>
  </div>
</div>

</body>
</html>
