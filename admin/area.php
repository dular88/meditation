<?php include_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Areas CRUD</title>

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/dist/css/admin.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<?php include_once "sidebar.php"; ?>

<div class="content p-4">

<nav class="navbar bg-white shadow-sm p-3 rounded mb-4">
    <h4 class="m-0">Areas</h4>
</nav>

<button class="btn btn-primary mb-3" id="addAreaBtn">+ Add Area</button>
<div id="alertBox"></div>

<div class="card shadow-sm">
<div class="card-body p-0">
<table class="table table-striped mb-0">
<thead>
<tr>
<th>#</th>
<th>City</th>
<th>Area</th>
<th width="140">Action</th>
</tr>
</thead>
<tbody id="areaTable"></tbody>
</table>
</div>
</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="areaModal">
<div class="modal-dialog">
<form id="areaForm">
<div class="modal-content">

<div class="modal-header">
<h5 id="modalTitle">Add Area</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<input type="hidden" id="areaId">

<select id="cityId" class="form-control mb-2" required>
    <option value="">Select City</option>
</select>

<input type="text" id="areaName" class="form-control" placeholder="Area Name" required>
</div>

<div class="modal-footer">
<button class="btn btn-primary">Save</button>
</div>

</div>
</form>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ======================
   LOAD CITY DROPDOWN
====================== */
function loadCityDropdown() {
    $.post("crud/city_area_api.php",
        { action: "get_cities" },
        function (data) {
            let opt = "<option value=''>Select City</option>";
            data.forEach(c => {
                opt += `<option value="${c.id}">${c.name}</option>`;
            });
            $("#cityId").html(opt);
        },
        "json"
    );
}

/* ======================
   LOAD AREAS TABLE
====================== */
function loadAreas() {
    $.post("crud/city_area_crud.php",
        { action: "list_areas" },
        function (data) {
            let rows = "", i = 1;
            data.forEach(r => {
                rows += `
                <tr>
                    <td>${i++}</td>
                    <td>${r.city}</td>
                    <td>${r.area}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editBtn" data-id="${r.id}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${r.id}">Delete</button>
                    </td>
                </tr>`;
            });
            $("#areaTable").html(rows);
        },
        "json"
    );
}

loadAreas();

/* ======================
   ADD AREA
====================== */
$("#addAreaBtn").click(() => {
    $("#areaForm")[0].reset();
    $("#areaId").val("");
    loadCityDropdown();
    $("#modalTitle").text("Add Area");
    $("#areaModal").modal("show");
});

/* ======================
   EDIT AREA
====================== */
$(document).on("click", ".editBtn", function () {
    let id = $(this).data("id");
    loadCityDropdown();

    $.post("crud/city_area_crud.php",
        { action: "get_area", id },
        function (data) {
            $("#areaId").val(data.id);
            $("#areaName").val(data.name);
            $("#cityId").val(data.city_id);
            $("#modalTitle").text("Edit Area");
            $("#areaModal").modal("show");
        },
        "json"
    );
});

/* ======================
   SAVE AREA
====================== */
$("#areaForm").submit(function (e) {
    e.preventDefault();

    let action = $("#areaId").val() ? "update_area" : "add_area";

    $.post("crud/city_area_crud.php", {
        action: action,
        id: $("#areaId").val(),
        city_id: $("#cityId").val(),
        name: $("#areaName").val()
    }, function () {
        $("#areaModal").modal("hide");
        loadAreas();
    }, "json");
});

/* ======================
   DELETE AREA
====================== */
$(document).on("click", ".deleteBtn", function () {
    if (!confirm("Delete Area?")) return;

    $.post("crud/city_area_crud.php",
        { action: "delete_area", id: $(this).data("id") },
        function () {
            loadAreas();
        },
        "json"
    );
});
</script>

</body>
</html>
