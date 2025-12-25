<?php
header("Content-Type: application/json");
include "../../dbcon.php";

$action = $_POST['action'] ?? "";

/* ===================== STATES ===================== */
if ($action === "states") {

    $sql = "SELECT id, name FROM states ORDER BY name";
    $res = $conn->query($sql);

    if (!$res) {
        echo json_encode([
            "success" => false,
            "error" => $conn->error
        ]);
        exit;
    }

    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    exit;
}

/* ===================== CITIES ===================== */
if ($action === "cities") {

    if (!isset($_POST['state_id']) || empty($_POST['state_id'])) {
        echo json_encode([]);
        exit;
    }

    $state_id = (int)$_POST['state_id'];

    $stmt = $conn->prepare(
        "SELECT id, name FROM cities WHERE state_id=? ORDER BY name"
    );

    // ✅ IMPORTANT SAFETY CHECK
    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "error" => $conn->error
        ]);
        exit;
    }

    $stmt->bind_param("i", $state_id);
    $stmt->execute();

    $result = $stmt->get_result();
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    exit;
}
