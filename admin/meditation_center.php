<?php include_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meditation Centers CRUD</title>

    <!-- Bootstrap 5 -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/dist/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<!-- Sidebar -->
<?php include_once "sidebar.php";  ?>

<div class="content p-4">

    <!-- NAVBAR -->
    <nav class="navbar navbar-light bg-white shadow-sm p-3 rounded mb-4">
        <h4 class="m-0">Meditation Centers</h4>
    </nav>

    <button class="btn btn-primary mb-3" id="addCenterBtn">+ Add New Center</button>

    <div id="alertBox"></div>

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="card-header">Centers List</div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Center Name</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Contact</th>
                        <th>Address</th>
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
                        <label>State</label>
                        <select id="state_id" class="form-control" required>
                            <option value="">Select State</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>City</label>
                        <select id="city_id" class="form-control" required>
                            <option value="">Select City</option>
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
                        <input type="url" id="google_business_url" class="form-control"
                            placeholder="https://g.page/your-business">
                    </div>

                    <div class="mb-3">
                        <label>YouTube URL</label>
                        <input type="url" id="youtube_url" class="form-control"
                            placeholder="https://youtube.com/@channel">
                    </div>

<div class="mb-3">
    <label>Google Map URL</label>
    <textarea id="google_map_url" class="form-control"
              placeholder="Paste Google Map embed or location link"></textarea>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// =======================
// LOAD STATES
// =======================
function loadStates(selectedState = "") {
    $.post("crud/state_city_crud.php", { action: "list_states" }, function (data) {
        let options = `<option value="">Select State</option>`;
        data.forEach(state => {
            options += `<option value="${state.id}" ${state.id == selectedState ? "selected" : ""}>${state.name}</option>`;
        });
        $("#state_id").html(options);
    }, "json");
}

loadStates();

// =======================
// LOAD CITIES BY STATE
// =======================
function loadCities(state_id, selectedCity = "") {

    if (!state_id) {
        $("#city_id").html(`<option value="">Select City</option>`);
        return;
    }

    $.post("crud/state_city_crud.php", { action: "list_cities" }, function (data) {
        let options = `<option value="">Select City</option>`;
        data.forEach(city => {
            if (city.state_id == state_id) {
                options += `<option value="${city.id}" ${city.id == selectedCity ? "selected" : ""}>${city.city}</option>`;
            }
        });
        $("#city_id").html(options);
    }, "json");
}

$("#state_id").on("change", function () {
    loadCities($(this).val());
});

// =======================
// LOAD CENTERS
// =======================
function loadCenters() {
    $.post("crud/meditation_center_api.php", { action: "list" }, function (data) {
        let rows = "";
        let i = 1;

        data.forEach(row => {
            rows += `
                <tr>
                    <td>${i++}</td>
                    <td>${row.center_name}</td>
                    <td>${row.state}</td>
                    <td>${row.city}</td>
                    <td>${row.contact_number}</td>
                    <td>${row.address}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editBtn" data-id="${row.id}">Edit</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${row.id}">Delete</button>
                    </td>
                </tr>`;
        });

        $("#centerTable").html(rows);
    }, "json");
}
loadCenters();

// =======================
// ADD CENTER
// =======================
$("#addCenterBtn").click(function () {
    $("#modalTitle").text("Add Center");
    $("#centerForm")[0].reset();
    $("#centerId").val("");
    $("#city_id").html(`<option value="">Select City</option>`);
    loadStates();
    $("#centerModal").modal("show");
});

// =======================
// EDIT CENTER
// =======================
$(document).on("click", ".editBtn", function () {
    let id = $(this).data("id");

    $.post("crud/meditation_center_api.php", { action: "get", id }, function (d) {

        $("#modalTitle").text("Edit Center");

        $("#centerId").val(d.id);
        $("#center_name").val(d.center_name);
        $("#contact_number").val(d.contact_number);
        $("#address").val(d.address);

        $("#google_business_url").val(d.google_business_url);
        $("#youtube_url").val(d.youtube_url);
        $("#google_map_url").val(d.google_map_url);

        loadStates(d.state_id);
        setTimeout(() => loadCities(d.state_id, d.city_id), 300);

        $("#centerModal").modal("show");
    }, "json");
});

// =======================
// SAVE (ADD / UPDATE)
// =======================
$("#centerForm").submit(function (e) {
    e.preventDefault();

    let action = $("#centerId").val() ? "update" : "add";

    $.post("crud/meditation_center_api.php", {
        action: action,
        id: $("#centerId").val(),
        center_name: $("#center_name").val(),
        state_id: $("#state_id").val(),
        city_id: $("#city_id").val(),
        contact_number: $("#contact_number").val(),
        address: $("#address").val(),
        google_business_url: $("#google_business_url").val(),
        youtube_url: $("#youtube_url").val(),
        google_map_url: $("#google_map_url").val()
    }, function (res) {

        $("#centerModal").modal("hide");
        showAlert(res.success ? "Saved Successfully!" : "Error Saving Data!", res.success);
        loadCenters();

    }, "json");
});

// =======================
// DELETE
// =======================
$(document).on("click", ".deleteBtn", function () {
    if (!confirm("Delete this center?")) return;

    let id = $(this).data("id");

    $.post("crud/meditation_center_api.php", { action: "delete", id }, function (res) {
        showAlert(res.success ? "Deleted!" : "Error!", res.success);
        loadCenters();
    }, "json");
});

// =======================
// ALERT
// =======================
function showAlert(msg, success = true) {
    $("#alertBox").html(`
        <div class="alert ${success ? "alert-success" : "alert-danger"}">${msg}</div>
    `);
    setTimeout(() => $("#alertBox").html(""), 2000);
}
</script>


</body>
</html>
