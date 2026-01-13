<?php include_once "auth.php";  $isAdmin = ($_SESSION['role'] ?? '') === 'admin';?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meditation Centers CRUD</title>

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/dist/css/admin.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php include_once "sidebar.php"; ?>

<div class="content p-4">

<nav class="navbar bg-white shadow-sm p-3 rounded mb-4">
    <h4 class="m-0">Meditation Centers</h4>
</nav>

<button class="btn btn-primary mb-3" id="addCenterBtn">+ Add New Center</button>
<div id="alertBox"></div>

<div class="card shadow-sm">
<div class="card-body p-0">
<table class="table table-striped table-hover mb-0">
<thead class="table-light">
<tr>
    <th>#</th>
    <th>Center Name</th>
    <th>City</th>
    <th>Area</th>
    <th>Address</th>
     <th>Contact</th>
    <th width="140">Actions</th>
</tr>
</thead>
<tbody id="centerTable"></tbody>
</table>
</div>
</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="centerModal">
<div class="modal-dialog">
<form id="centerForm">
<div class="modal-content">

<div class="modal-header">
<h5 id="modalTitle">Add Center</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<input type="hidden" id="centerId">

<div class="mb-3">
<label>Center Name</label>
<input type="text" id="center_name" class="form-control" required>
</div>

<div class="mb-3">
<label>City</label>
<select id="city_id" class="form-control" required>
<option value="">Select City</option>
</select>
</div>

<div class="mb-3">
<label>Area</label>
<select id="area_id" class="form-control" required>
<option value="">Select Area</option>
</select>
</div>

<div class="mb-3">
<label>Contact Number</label>
<input type="text" id="contact_number" class="form-control" required>
</div>

<div class="mb-3">
<label>Address</label>
<textarea id="address" class="form-control" required></textarea>
</div>

<div class="mb-3">
<label>Google My Business URL</label>
<input type="url" id="google_business_url" class="form-control">
</div>

<div class="mb-3">
<label>YouTube URL</label>
<input type="url" id="youtube_url" class="form-control">
</div>

<div class="mb-3">
<label>Google Map URL</label>
<textarea id="google_map_url" class="form-control"></textarea>
</div>

</div>

<div class="modal-footer">
<button class="btn btn-primary">Save</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

</div>
</form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* =======================
   LOAD CITIES
======================= */
function loadCities(selected = "") {
    $.post("crud/city_area_api.php", { action: "get_cities" }, data => {
        let opt = `<option value="">Select City</option>`;
        data.forEach(c => {
            opt += `<option value="${c.id}" ${c.id == selected ? "selected" : ""}>${c.name}</option>`;
        });
        $("#city_id").html(opt);
    }, "json");
}

/* =======================
   LOAD AREAS BY CITY
======================= */
function loadAreas(city_id, selected = "") {
    if (!city_id) {
        $("#area_id").html(`<option value="">Select Area</option>`);
        return;
    }

    $.post("crud/city_area_api.php",
        { action: "get_areas", city_id },
        data => {
            let opt = `<option value="">Select Area</option>`;
            data.forEach(a => {
                opt += `<option value="${a.id}" ${a.id == selected ? "selected" : ""}>${a.name}</option>`;
            });
            $("#area_id").html(opt);
        },
        "json"
    );
}

$("#city_id").on("change", function () {
    loadAreas($(this).val());
});

/* =======================
   LOAD CENTERS
======================= */
function loadCenters() {
    $.post("crud/meditation_center_api.php", { action: "list" }, data => {
        let rows = "", i = 1;
        data.forEach(r => {
            rows += `
            <tr>
                <td>${i++}</td>
                <td>${r.center_name}</td>
                <td>${r.city}</td>
                <td>${r.area}</td>
                 <td>${r.address}</td>
                <td>${r.contact_number}</td>
               
                <td>
    <button class="btn btn-sm btn-warning editBtn" data-id="${r.id}">
        Edit
    </button>

    <?php if ($isAdmin) { ?>
        <button class="btn btn-sm btn-danger deleteBtn" data-id="${r.id}">
            Delete
        </button>
    <?php } ?>
</td>

            </tr>`;
        });
        $("#centerTable").html(rows);
    }, "json");
}
loadCenters();

/* =======================
   ADD CENTER
======================= */
$("#addCenterBtn").click(() => {
    $("#centerForm")[0].reset();
    $("#centerId").val("");
    loadCities();
    $("#area_id").html(`<option value="">Select Area</option>`);
    $("#modalTitle").text("Add Center");
    $("#centerModal").modal("show");
});

/* =======================
   EDIT CENTER
======================= */
$(document).on("click", ".editBtn", function () {
    let id = $(this).data("id");

    $.post("crud/meditation_center_api.php", { action: "get", id }, d => {

        $("#centerId").val(d.id);
        $("#center_name").val(d.center_name);
        $("#contact_number").val(d.contact_number);
        $("#address").val(d.address);
        $("#google_business_url").val(d.google_business_url);
        $("#youtube_url").val(d.youtube_url);
        $("#google_map_url").val(d.google_map_url);

        loadCities(d.city_id);
        setTimeout(() => loadAreas(d.city_id, d.area_id), 200);

        $("#modalTitle").text("Edit Center");
        $("#centerModal").modal("show");
    }, "json");
});

/* =======================
   SAVE CENTER
======================= */
$("#centerForm").submit(e => {
    e.preventDefault();

    let action = $("#centerId").val() ? "update" : "add";

    $.post("crud/meditation_center_api.php", {
        action,
        id: $("#centerId").val(),
        center_name: $("#center_name").val(),
        city_id: $("#city_id").val(),
        area_id: $("#area_id").val(),
        contact_number: $("#contact_number").val(),
        address: $("#address").val(),
        google_business_url: $("#google_business_url").val(),
        youtube_url: $("#youtube_url").val(),
        google_map_url: $("#google_map_url").val()
    }, res => {
        $("#centerModal").modal("hide");
        showAlert(res.success ? "Saved successfully!" : "Error saving data", res.success);
        loadCenters();
    }, "json");
});

/* =======================
   DELETE CENTER
======================= */
$(document).on("click", ".deleteBtn", function () {
    if (!confirm("Delete this center?")) return;

    $.post("crud/meditation_center_api.php",
        { action: "delete", id: $(this).data("id") },
        res => {
            showAlert(res.success ? "Deleted!" : "Delete failed", res.success);
            loadCenters();
        },
        "json"
    );
});

/* =======================
   ALERT
======================= */
function showAlert(msg, success = true) {
    $("#alertBox").html(
        `<div class="alert ${success ? "alert-success" : "alert-danger"}">${msg}</div>`
    );
    setTimeout(() => $("#alertBox").html(""), 2000);
}
</script>

</body>
</html>
