<?php
header("Content-Type: application/json");
include "../../dbcon.php";

$action = $_POST['action'] ?? "";

/* ================= ADD / UPDATE ================= */
if ($action === "save") {

    $id      = $_POST['id'] ?? "";
    $name    = trim($_POST['name'] ?? "");
    $city_id = intval($_POST['city_id'] ?? 0);
    $area_id = intval($_POST['area_id'] ?? 0);
    $address = trim($_POST['address'] ?? "");
    $contact = trim($_POST['contact'] ?? "");

    // Validation
    if ($name === "" || $city_id === 0 || $area_id === 0) {
        echo json_encode([
            "success" => false,
            "message" => "Required fields missing"
        ]);
        exit;
    }

    if ($id === "") {
        // ADD
        $stmt = $conn->prepare(
            "INSERT INTO meditators (name, city_id, area_id, address, contact)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("siiss", $name, $city_id, $area_id, $address, $contact);
        $success = $stmt->execute();
        $msg = "Meditator Added";
    } else {
        // UPDATE
        $stmt = $conn->prepare(
            "UPDATE meditators SET
                name = ?,
                city_id = ?,
                area_id = ?,
                address = ?,
                contact = ?
             WHERE id = ?"
        );
        $stmt->bind_param("siissi", $name, $city_id, $area_id, $address, $contact, $id);
        $success = $stmt->execute();
        $msg = "Meditator Updated";
    }

    echo json_encode([
        "success" => $success,
        "message" => $msg
    ]);
    exit;
}

/* ================= LIST ================= */
if ($action === "list") {

    $sql = "
        SELECT 
            m.id,
            m.name,
            m.address,
            m.contact,
            c.name AS city,
            a.name AS area
        FROM meditators m
        LEFT JOIN cities c ON c.id = m.city_id
        LEFT JOIN areas a ON a.id = m.area_id
        ORDER BY m.id DESC
    ";

    $res = $conn->query($sql);
    echo json_encode($res ? $res->fetch_all(MYSQLI_ASSOC) : []);
    exit;
}

/* ================= GET SINGLE ================= */
if ($action === "get") {

    $id = intval($_POST['id'] ?? 0);

    if ($id === 0) {
        echo json_encode(null);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM meditators WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode($stmt->get_result()->fetch_assoc());
    exit;
}

/* ================= DELETE ================= */
if ($action === "delete") {

    $id = intval($_POST['id'] ?? 0);

    if ($id === 0) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid ID"
        ]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM meditators WHERE id = ?");
    $stmt->bind_param("i", $id);

    echo json_encode([
        "success" => $stmt->execute(),
        "message" => "Meditator Deleted"
    ]);
    exit;
}

/* ================= INVALID ACTION ================= */
echo json_encode([
    "success" => false,
    "message" => "Invalid action"
]);
