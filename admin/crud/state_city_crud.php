<?php
header("Content-Type: application/json");
include "../../dbcon.php";

$action = $_POST['action'] ?? '';

/* =======================
   STATE CRUD
======================= */

if ($action === "add_state") {

    $name = trim($_POST['name']);

    $stmt = $conn->prepare("INSERT INTO states (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action === "list_states") {

    $result = $conn->query("SELECT * FROM states ORDER BY id DESC");
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    exit;
}

if ($action === "get_state") {

    $id = intval($_POST['id']);
    $stmt = $conn->prepare("SELECT * FROM states WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode($stmt->get_result()->fetch_assoc());
    exit;
}

if ($action === "update_state") {

    $id = intval($_POST['id']);
    $name = trim($_POST['name']);

    $stmt = $conn->prepare("UPDATE states SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action === "delete_state") {

    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM states WHERE id=?");
    $stmt->bind_param("i", $id);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

/* =======================
   CITY CRUD (Dependent)
======================= */

if ($action === "add_city") {

    $state_id = intval($_POST['state_id']);
    $name = trim($_POST['name']);

    $stmt = $conn->prepare("INSERT INTO cities (state_id, name) VALUES (?, ?)");
    $stmt->bind_param("is", $state_id, $name);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action === "list_cities") {

    $sql = "
        SELECT c.id, c.name AS city, s.name AS state, s.id AS state_id
        FROM cities c
        JOIN states s ON c.state_id = s.id
        ORDER BY c.id DESC
    ";

    $result = $conn->query($sql);
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
    $state_id = intval($_POST['state_id']);
    $name = trim($_POST['name']);

    $stmt = $conn->prepare("UPDATE cities SET state_id=?, name=? WHERE id=?");
    $stmt->bind_param("isi", $state_id, $name, $id);

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
   INVALID ACTION
======================= */

echo json_encode(["success" => false, "message" => "Invalid action"]);
exit;
?>
