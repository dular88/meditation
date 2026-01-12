<?php
header("Content-Type: application/json");
include "../../dbcon.php";

$action = $_POST['action'] ?? '';

function cap($str) {
    return ucwords(strtolower(trim($str)));
}

/* =======================
   CITY CRUD (Parent)
======================= */

if ($action === "add_city") {
    $name = cap($_POST['name']);

    $stmt = $conn->prepare("INSERT INTO cities (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action === "list_cities") {
    $result = $conn->query("SELECT * FROM cities ORDER BY id DESC");
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    exit;
}

if ($action === "get_city") {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("SELECT * FROM cities WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode($stmt->get_result()->fetch_assoc());
    exit;
}

if ($action === "update_city") {
    $id = intval($_POST['id']);
    $name = cap($_POST['name']);

    $stmt = $conn->prepare("UPDATE cities SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action === "delete_city") {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM cities WHERE id=?");
    $stmt->bind_param("i", $id);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

/* =======================
   AREA CRUD (Dependent)
======================= */

if ($action === "add_area") {
    $city_id = intval($_POST['city_id']);
    $name = cap($_POST['name']);

    $stmt = $conn->prepare(
        "INSERT INTO areas (city_id, name) VALUES (?, ?)"
    );
    $stmt->bind_param("is", $city_id, $name);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action === "list_areas") {
    $sql = "
        SELECT 
            a.id,
            a.name AS area,
            c.name AS city,
            c.id AS city_id
        FROM areas a
        INNER JOIN cities c ON a.city_id = c.id
        ORDER BY a.id DESC
    ";

    $result = $conn->query($sql);
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    exit;
}

if ($action === "get_area") {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("SELECT * FROM areas WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode($stmt->get_result()->fetch_assoc());
    exit;
}

if ($action === "update_area") {
    $id = intval($_POST['id']);
    $city_id = intval($_POST['city_id']);
    $name = cap($_POST['name']);

    $stmt = $conn->prepare(
        "UPDATE areas SET city_id=?, name=? WHERE id=?"
    );
    $stmt->bind_param("isi", $city_id, $name, $id);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action === "delete_area") {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM areas WHERE id=?");
    $stmt->bind_param("i", $id);

    echo json_encode(["success" => $stmt->execute()]);
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
