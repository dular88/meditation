<?php
header("Content-Type: application/json");
include "../../dbcon.php";  // database connection

$action = $_POST['action'] ?? '';

$uploadPath = __DIR__ . "/uploads/books/";  // <-- Correct upload folder
if (!is_dir($uploadPath)) {
    mkdir($uploadPath, 0777, true);
}

if ($action == "add") {

    $name = $_POST['name'];
    $written_by = $_POST['written_by'];
    $summary = $_POST['summary'];

    // Upload image
    $imageName = "";
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO books (name, image, written_by, summary) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $imageName, $written_by, $summary);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action == "list") {
    $result = $conn->query("SELECT * FROM books ORDER BY id DESC");
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
    exit;
}

if ($action == "get") {
    $id = $_POST['id'];
    $stmt = $conn->prepare("SELECT * FROM books WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    echo json_encode($data);
    exit;
}

if ($action == "update") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $written_by = $_POST['written_by'];
    $summary = $_POST['summary'];

    $imageName = $_POST['old_image'];

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath . $imageName);
    }

    $stmt = $conn->prepare("UPDATE books SET name=?, image=?, written_by=?, summary=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $imageName, $written_by, $summary, $id);

    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

if ($action == "delete") {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM books WHERE id=?");
    $stmt->bind_param("i", $id);
    echo json_encode(["success" => $stmt->execute()]);
    exit;
}

?>
