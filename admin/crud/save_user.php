<?php
session_start();
include_once "../../dbcon.php";

/* Admin only */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Unauthorized access.";
    header("Location: ../login.php");
    exit;
}

$name     = trim($_POST['name'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$password = trim($_POST['password'] ?? '');

/* Validation */
if ($name === '' || $password === '') {
    $_SESSION['error'] = "Name and password are required.";
    header("Location: ../users.php");
    exit;
}

if (!preg_match('/^[0-9]{10}$/', $phone)) {
    $_SESSION['error'] = "Phone number must be exactly 10 digits.";
    header("Location: ../users.php");
    exit;
}

/* Duplicate phone check */
$check = mysqli_prepare($conn, "SELECT id FROM users WHERE phone = ?");
mysqli_stmt_bind_param($check, "s", $phone);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);

if (mysqli_stmt_num_rows($check) > 0) {
    $_SESSION['error'] = "User with this phone already exists.";
    header("Location: ../users.php");
    exit;
}

/* Force role */
$role = 'manager';
$hash = password_hash($password, PASSWORD_BCRYPT);

/* Insert user */
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO users (name, phone, password, role, created_at)
     VALUES (?, ?, ?, ?, NOW())"
);

mysqli_stmt_bind_param($stmt, "ssss", $name, $phone, $hash, $role);

/* ✅ EXECUTE ONLY ONCE */
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "User created successfully.";
    unset($_SESSION['error']);
} else {
    $_SESSION['error'] = mysqli_stmt_error($stmt);
}

header("Location: ../users.php");
exit;
