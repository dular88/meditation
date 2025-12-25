<?php
session_start();
include_once "../../dbcon.php";

/* Admin only */
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Unauthorized access.";
    header("Location: ../users.php");
    exit;
}

$id       = intval($_POST['id']);
$name     = trim($_POST['name']);
$phone    = trim($_POST['phone']);
$password = trim($_POST['password']);

/* Validation */
if ($name === '') {
    $_SESSION['error'] = "Name is required.";
    header("Location: ../users.php");
    exit;
}

if (!preg_match('/^[0-9]{10}$/', $phone)) {
    $_SESSION['error'] = "Phone must be 10 digits.";
    header("Location: ../users.php");
    exit;
}

/* Duplicate phone check (exclude self) */
$chk = mysqli_prepare($conn,
    "SELECT id FROM users WHERE phone=? AND id!=?"
);
mysqli_stmt_bind_param($chk, "si", $phone, $id);
mysqli_stmt_execute($chk);
mysqli_stmt_store_result($chk);

if (mysqli_stmt_num_rows($chk) > 0) {
    $_SESSION['error'] = "Phone already used by another user.";
    header("Location: ../users.php");
    exit;
}

/* Update */
if ($password !== '') {
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = mysqli_prepare($conn,
        "UPDATE users SET name=?, phone=?, password=? WHERE id=?"
    );
    mysqli_stmt_bind_param($stmt, "sssi", $name, $phone, $hash, $id);
} else {
    $stmt = mysqli_prepare($conn,
        "UPDATE users SET name=?, phone=? WHERE id=?"
    );
    mysqli_stmt_bind_param($stmt, "ssi", $name, $phone, $id);
}

mysqli_stmt_execute($stmt);

$_SESSION['success'] = "User updated successfully.";
header("Location: ../users.php");
exit;
