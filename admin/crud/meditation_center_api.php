<?php
header("Content-Type: application/json");
include "../../dbcon.php";

$action = $_POST['action'] ?? "";

/* =======================
   ADD CENTER
======================= */
if ($action == "add") {

    $center_name = $_POST['center_name'];
    $state_id = $_POST['state_id'];
    $city_id = $_POST['city_id'];
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];

    $google_business_url = $_POST['google_business_url'] ?? "";
    $youtube_url = $_POST['youtube_url'] ?? "";
    $google_map_url = $_POST['google_map_url'] ?? "";

$stmt = $conn->prepare("
    INSERT INTO meditation_centers
    (center_name, state_id, city_id, address, contact_number,
     google_business_url, youtube_url, google_map_url)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "error" => $conn->error
    ]);
    exit;
}


    $stmt->bind_param(
        "siisssss",
        $center_name,
        $state_id,
        $city_id,
        $address,
        $contact,
        $google_business_url,
        $youtube_url,
        $google_map_url
    );

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

/* =======================
   LIST CENTERS
======================= */
if ($action == "list") {

    $sql = "
        SELECT mc.*,
               s.name AS state,
               c.name AS city
        FROM meditation_centers mc
        LEFT JOIN states s ON s.id = mc.state_id
        LEFT JOIN cities c ON c.id = mc.city_id
        ORDER BY mc.id DESC
    ";

    $result = $conn->query($sql);

    if (!$result) {
        echo json_encode([
            "success" => false,
            "sql_error" => $conn->error
        ]);
        exit;
    }

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
    exit;
}


/* =======================
   GET SINGLE CENTER
======================= */
if ($action == "get") {

    $id = $_POST['id'];

    $stmt = $conn->prepare("SELECT * FROM meditation_centers WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode($stmt->get_result()->fetch_assoc());
    exit;
}

/* =======================
   UPDATE CENTER
======================= */
if ($action == "update") {

    $id = $_POST['id'];
    $center_name = $_POST['center_name'];
    $state_id = $_POST['state_id'];
    $city_id = $_POST['city_id'];
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];

    $google_business_url = $_POST['google_business_url'] ?? "";
    $youtube_url = $_POST['youtube_url'] ?? "";
    $google_map_url = $_POST['google_map_url'] ?? "";

    $stmt = $conn->prepare("
        UPDATE meditation_centers SET
            center_name=?,
            state_id=?,
            city_id=?,
            address=?,
            contact_number=?,
            google_business_url=?,
            youtube_url=?,
            google_map_url=?
        WHERE id=?
    ");

    $stmt->bind_param(
        "siisssssi",
        $center_name,
        $state_id,
        $city_id,
        $address,
        $contact,
        $google_business_url,
        $youtube_url,
        $google_map_url,
        $id
    );

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

/* =======================
   DELETE CENTER
======================= */
if ($action == "delete") {

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM meditation_centers WHERE id=?");
    $stmt->bind_param("i", $id);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}
?>
