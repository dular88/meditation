<?php
session_start();
include "../../dbcon.php";

// Debug (disable in production)
error_reporting(E_ALL);
ini_set("display_errors", 1);

/* ================= VALIDATE REQUEST ================= */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $_SESSION['error'] = "Invalid request!";
    header("Location: ../events.php");
    exit;
}

/* ================= SANITIZE INPUT ================= */
$name       = trim($_POST['name'] ?? '');
$center_id  = intval($_POST['center_id'] ?? 0);
$start_date = trim($_POST['start_date'] ?? '');
$end_date   = trim($_POST['end_date'] ?? '');
$details    = trim($_POST['details'] ?? '');

/* ================= VALIDATION ================= */
if (empty($name) || empty($start_date) || empty($end_date) || $center_id <= 0) {
    $_SESSION['error'] = "All required fields must be filled.";
    header("Location: ../events.php");
    exit;
}

/* ================= IMAGE UPLOAD ================= */
$photo_path = null;

if (!empty($_FILES['photo']['name'])) {

    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if (!is_uploaded_file($_FILES['photo']['tmp_name'])) {
        $_SESSION['error'] = "Invalid file upload.";
        header("Location: ../events.php");
        exit;
    }

    $file_type = mime_content_type($_FILES['photo']['tmp_name']);
    $file_size = $_FILES['photo']['size'];

    if (!in_array($file_type, $allowed_types)) {
        $_SESSION['error'] = "Only JPG, PNG & WEBP images allowed.";
        header("Location: ../events.php");
        exit;
    }

    if ($file_size > $max_size) {
        $_SESSION['error'] = "Image must be less than 2MB.";
        header("Location: ../events.php");
        exit;
    }

    $upload_dir = "../../uploads/events/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $file_name = time() . "_" . uniqid() . "." . $ext;
    $photo_path = "uploads/events/" . $file_name;

    move_uploaded_file(
        $_FILES['photo']['tmp_name'],
        "../../" . $photo_path
    );
}

/* ================= INSERT DATA ================= */
$sql = "
    INSERT INTO events 
    (center_id, name, start_date, end_date, photo, details)
    VALUES (?, ?, ?, ?, ?, ?)
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "isssss",
    $center_id,
    $name,
    $start_date,
    $end_date,
    $photo_path,
    $details
);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Event created successfully!";
} else {
    $_SESSION['error'] = "Database error. Event not saved.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: ../events.php");
exit;
