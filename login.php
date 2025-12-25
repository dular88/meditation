<?php
session_start();
include "dbcon.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login_id = trim($_POST['login_id'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($login_id === '' || $password === '') {
        $error = "Login ID and Password are required";
    } else {

        /* Detect admin by email */
        if (filter_var($login_id, FILTER_VALIDATE_EMAIL)) {

            // 👉 ADMIN LOGIN (EMAIL)
            $stmt = mysqli_prepare($conn,
                "SELECT id,name,password,role,status 
                 FROM users 
                 WHERE email=? AND role='admin' 
                 LIMIT 1"
            );
            mysqli_stmt_bind_param($stmt, "s", $login_id);

        } else {

            // 👉 USER LOGIN (PHONE)
            $stmt = mysqli_prepare($conn,
                "SELECT id,name,password,role,status 
                 FROM users 
                 WHERE phone=? AND role!='admin' 
                 LIMIT 1"
            );
            mysqli_stmt_bind_param($stmt, "s", $login_id);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {

            if ($user['status'] == 0) {
                $error = "Account is inactive. Contact admin.";
            }
            elseif (password_verify($password, $user['password'])) {

                /* Set session */
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name']    = $user['name'];
                $_SESSION['role']    = $user['role'];

                /* Role based redirect */
                if ($user['role'] === 'admin') {
                    header("Location: admin/index.php");
                } else {
                    header("Location: admin/index.php"); // or manager dashboard
                }
                exit;

            } else {
                $error = "Invalid password";
            }

        } else {
            $error = "Account not found";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login | Ekta Pyramid</title>
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-4">

<div class="card shadow-sm">
<div class="card-body">

<h4 class="text-center mb-3">Login</h4>

<?php if($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">

<div class="mb-3">
    <label>Email / Phone </label>
    <input type="text" name="login_id" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-success w-100">Login</button>

</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>
