<?php
session_start();
include "../../dbcon.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    $_SESSION['error'] = "Invalid request!";
    header("Location: ../events.php");
    exit;
}

$id         = intval($_POST['id']);
$name       = trim($_POST['name']);
$center_id  = intval($_POST['center_id']); // ✅ ADDED
$start_date = trim($_POST['start_date']);
$end_date   = trim($_POST['end_date']);
$details    = trim($_POST['details']);
$old_photo  = $_POST['old_photo'];

$photo_path = $old_photo;

// ✅ IMAGE UPLOAD
if (!empty($_FILES['photo']['name'])) {

    $allowed = ['image/jpeg','image/png','image/webp','image/jpg'];
    $file_type = mime_content_type($_FILES['photo']['tmp_name']);

    if (!in_array($file_type, $allowed)) {
        $_SESSION['error'] = "Invalid image type!";
        header("Location: ../edit_event.php?id=$id");
        exit;
    }

    $folder = "uploads/events/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $newname = time() . "_" . uniqid() . "." . $ext;
    $photo_path = $folder . $newname;

    move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);

    // Delete old photo
    if ($old_photo && file_exists($old_photo)) {
        unlink($old_photo);
    }
}

// ✅ UPDATE QUERY WITH CENTER ID
$sql = "UPDATE events 
        SET name=?, center_id=?, start_date=?, end_date=?, details=?, photo=? 
        WHERE id=?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "sissssi",
    $name,
    $center_id,
    $start_date,
    $end_date,
    $details,
    $photo_path,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Event updated successfully!";
} else {
    $_SESSION['error'] = "Update failed!";
}

header("Location: ../events.php");
exit;
