<?php
header("Content-Type: application/json");
include "../../dbcon.php";

$action = $_POST['action'] ?? "";

/* ================= ADD / UPDATE ================= */
if ($action == "save") {

    $id       = $_POST['id'] ?? "";
    $name     = $_POST['name'];
    $state_id = $_POST['state_id'];
    $city_id  = $_POST['city_id'];
    $address  = $_POST['address'];
    $contact  = $_POST['contact'];

    if ($id == "") {
        // ADD
        $stmt = $conn->prepare("
            INSERT INTO meditators (name, state_id, city_id, address, contact)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("siiss", $name, $state_id, $city_id, $address, $contact);
        $success = $stmt->execute();
        $msg = "Meditator Added";

    } else {
        // UPDATE
        $stmt = $conn->prepare("
            UPDATE meditators SET
                name=?,
                state_id=?,
                city_id=?,
                address=?,
                contact=?
            WHERE id=?
        ");
        $stmt->bind_param("siissi", $name, $state_id, $city_id, $address, $contact, $id);
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
if ($action == "list") {

    $sql = "
        SELECT m.id, m.name, m.address, m.contact,
               s.name AS state,
               c.name AS city
        FROM meditators m
        LEFT JOIN states s ON s.id = m.state_id
        LEFT JOIN cities c ON c.id = m.city_id
        ORDER BY m.id DESC
    ";

    $res = $conn->query($sql);
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    exit;
}

/* ================= GET SINGLE ================= */
if ($action == "get") {

    $id = $_POST['id'];

    $stmt = $conn->prepare("SELECT * FROM meditators WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode($stmt->get_result()->fetch_assoc());
    exit;
}

/* ================= DELETE ================= */
if ($action == "delete") {

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM meditators WHERE id=?");
    $stmt->bind_param("i", $id);

    echo json_encode([
        "success" => $stmt->execute(),
        "message" => "Meditator Deleted"
    ]);
    exit;
}
