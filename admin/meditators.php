<?php include_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meditators CRUD</title>

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/dist/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<!-- Sidebar -->
<?php include_once "sidebar.php"; ?>

<div class="content p-4">

    <nav class="navbar navbar-light bg-white shadow-sm p-3 rounded mb-4">
        <h4 class="m-0">Meditators</h4>
    </nav>

    <button class="btn btn-primary mb-3" id="addMeditatorBtn">+ Add Meditator</button>
    <div id="alertBox"></div>

    <div class="card shadow-sm">
        <div class="card-header">Meditators List</div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Contact</th>
                        <th width="140">Actions</th>
                    </tr>
                </thead>
                <tbody id="meditatorsTable"></tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="meditatorModal">
    <div class="modal-dialog">
        <form id="meditatorForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="modalTitle">Add Meditator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="meditatorId">

                   <div class="mb-3">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control" required>
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
                        <label>Address</label>
                        <textarea id="address" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Contact Number</label>
                        <input type="text" id="contact" class="form-control" required>
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

// ================= LOAD STATES =================
function loadStates(selectedState = "", selectedCity = "") {
    $.post("crud/state_city_api.php", { action: "states" }, function (states) {

        let html = `<option value="">Select State</option>`;
        states.forEach(s => {
            html += `<option value="${s.id}" ${s.id == selectedState ? 'selected' : ''}>${s.name}</option>`;
        });

        $("#state_id").html(html);

        // 👉 If editing, load cities AFTER states
        if (selectedState) {
            loadCities(selectedState, selectedCity);
        }

    }, "json");
}

// ================= LOAD CITIES =================
function loadCities(state_id, selectedCity = "") {

    if (!state_id) {
        $("#city_id").html(`<option value="">Select City</option>`);
        return;
    }

    $.post("crud/state_city_api.php", {
        action: "cities",
        state_id: state_id
    }, function (cities) {

        let html = `<option value="">Select City</option>`;
        cities.forEach(c => {
            html += `<option value="${c.id}" ${c.id == selectedCity ? 'selected' : ''}>${c.name}</option>`;
        });

        $("#city_id").html(html);

    }, "json");
}

// ================= STATE CHANGE =================
$("#state_id").on("change", function () {
    loadCities(this.value);
});

// ================= LOAD LIST =================
function loadMeditators() {
    $.post("crud/meditators_api.php", { action: "list" }, function (data) {

        let rows = "";
        let i = 1;

        data.forEach(row => {
            rows += `
            <tr>
                <td>${i++}</td>
                <td>${row.name}</td>
                <td>${row.address}</td>
                <td>${row.state}</td>
                <td>${row.city}</td>
                <td>${row.contact}</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn" data-id="${row.id}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="${row.id}">Delete</button>
                </td>
            </tr>`;
        });

        $("#meditatorsTable").html(rows);

    }, "json");
}
loadMeditators();

// ================= ADD =================
$("#addMeditatorBtn").click(function () {
    $("#modalTitle").text("Add Meditator");
    $("#meditatorForm")[0].reset();
    $("#meditatorId").val("");

    loadStates(); // fresh load
    $("#city_id").html(`<option value="">Select City</option>`);

    $("#meditatorModal").modal("show");
});

// ================= EDIT =================
$(document).on("click", ".editBtn", function () {

    let id = $(this).data("id");

    $.post("crud/meditators_api.php", { action: "get", id }, function (data) {

        $("#modalTitle").text("Edit Meditator");

        $("#meditatorId").val(data.id);
        $("#name").val(data.name);
        $("#address").val(data.address);
        $("#contact").val(data.contact);

        // ✅ Correct loading order
        loadStates(data.state_id, data.city_id);

        $("#meditatorModal").modal("show");

    }, "json");
});

// ================= SAVE =================
$("#meditatorForm").submit(function (e) {
    e.preventDefault();

    $.post("crud/meditators_api.php", {
        action: "save",
        id: $("#meditatorId").val(),
        name: $("#name").val(),
        state_id: $("#state_id").val(),
        city_id: $("#city_id").val(),
        address: $("#address").val(),
        contact: $("#contact").val()
    }, function (res) {

        $("#meditatorModal").modal("hide");
        showAlert(res.message, true);
        loadMeditators();

    }, "json");
});

// ================= DELETE =================
$(document).on("click", ".deleteBtn", function () {

    if (!confirm("Delete this meditator?")) return;

    $.post("crud/meditators_api.php", {
        action: "delete",
        id: $(this).data("id")
    }, function (res) {

        showAlert(res.message, true);
        loadMeditators();

    }, "json");
});

// ================= ALERT =================
function showAlert(msg, success) {
    $("#alertBox").html(`
        <div class="alert ${success ? "alert-success" : "alert-danger"}">${msg}</div>
    `);
    setTimeout(() => $("#alertBox").html(""), 2000);
}

</script>



</body>
</html>
