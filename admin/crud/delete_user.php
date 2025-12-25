<?php
session_start();
include "../../dbcon.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../users.php");
    exit;
}

$id = (int)$_GET['id'];

mysqli_query($conn, "DELETE FROM users WHERE id=$id AND role!='admin'");

$_SESSION['success'] = "User deleted";
header("Location: ../users.php");
