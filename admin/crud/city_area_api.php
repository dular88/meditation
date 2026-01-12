<?php
header("Content-Type: application/json");
include "../../dbcon.php";
session_start();
$role = $_SESSION['role'] ?? null;
$session_city_id = $_SESSION['city_id'] ?? null;
$action = $_POST['action'] ?? "";

/* =======================
   FETCH CITIES (Parent)
======================= */

if ($action === "get_cities") {

    if ($role === "manager" && $session_city_id) {
        $sql = "SELECT id, name FROM cities WHERE id=? ORDER BY name";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $session_city_id);
        $stmt->execute();
        echo json_encode($stmt->get_result()->fetch_all(MYSQLI_ASSOC));
        exit;
    }

    $res = $conn->query("SELECT id, name FROM cities ORDER BY name");
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    exit;
}


/* =======================
   FETCH AREAS BY CITY
======================= */

if ($action === "get_areas") {

    if (!isset($_POST['city_id']) || empty($_POST['city_id'])) {
        echo json_encode([]);
        exit;
    }

    $city_id = (int) $_POST['city_id'];

    $stmt = $conn->prepare(
        "SELECT id, name FROM areas WHERE city_id=? ORDER BY name"
    );

    // ✅ SAFETY CHECK
    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "error" => $conn->error
        ]);
        exit;
    }

    $stmt->bind_param("i", $city_id);
    $stmt->execute();

    $result = $stmt->get_result();
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    exit;
}

/* =======================
   INVALID ACTION
======================= */

echo json_encode([
    "success" => false,
    "message" => "Invalid action"
]);
exit;
