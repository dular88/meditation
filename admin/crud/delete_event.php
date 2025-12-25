<?php
session_start();
include "../../dbcon.php"; // db connection

if (!isset($_GET['id'])) {
    $_SESSION['error'] = "Invalid request!";
    header("Location: ../events.php");
    exit();
}

$event_id = intval($_GET['id']);

// Fetch event photo to delete from folder
$sql = "SELECT photo FROM events WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    $_SESSION['error'] = "Event not found!";
    header("Location: ../events.php");
    exit();
}

// Delete photo from uploads folder
if (!empty($event['photo']) && file_exists("../../uploads/" . $event['photo'])) {
    unlink("../../uploads/" . $event['photo']);
}

// Delete the event record
$sql = "DELETE FROM events WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $event_id);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Event deleted successfully!";
} else {
    $_SESSION['error'] = "Error: Could not delete event!";
}

header("Location: ../events.php");
exit();
?>
