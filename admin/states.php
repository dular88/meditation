<?php include_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>States CRUD</title>

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/dist/css/admin.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<?php include_once "sidebar.php"; ?>

<div class="content p-4">

<nav class="navbar bg-white shadow-sm p-3 rounded mb-4">
    <h4 class="m-0">States</h4>
</nav>

<button class="btn btn-primary mb-3" id="addStateBtn">+ Add State</button>
<div id="alertBox"></div>

<div class="card shadow-sm">
<div class="card-body p-0">
<table class="table table-striped mb-0">
<thead>
<tr>
<th>#</th>
<th>State Name</th>
<th width="140">Action</th>
</tr>
</thead>
<tbody id="stateTable"></tbody>
</table>
</div>
</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="stateModal">
<div class="modal-dialog">
<form id="stateForm">
<div class="modal-content">

<div class="modal-header">
<h5 id="modalTitle">Add State</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<input type="hidden" id="stateId">
<input type="text" id="stateName" class="form-control" placeholder="State Name" required>
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
function loadStates() {
    $.post("crud/state_city_crud.php", { action: "list_states" }, function(data) {
        let rows = "", i=1;
        data.forEach(row => {
            rows += `
            <tr>
                <td>${i++}</td>
                <td>${row.name}</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn" data-id="${row.id}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="${row.id}">Delete</button>
                </td>
            </tr>`;
        });
        $("#stateTable").html(rows);
    }, "json");
}
loadStates();

$("#addStateBtn").click(() => {
    $("#stateForm")[0].reset();
    $("#stateId").val("");
    $("#modalTitle").text("Add State");
    $("#stateModal").modal("show");
});

$(document).on("click",".editBtn",function(){
    $.post("crud/state_city_crud.php",
        { action:"get_state", id:$(this).data("id") },
        data => {
            $("#stateId").val(data.id);
            $("#stateName").val(data.name);
            $("#modalTitle").text("Edit State");
            $("#stateModal").modal("show");
        }, "json"
    );
});

$("#stateForm").submit(function(e){
    e.preventDefault();
    let action = $("#stateId").val() ? "update_state" : "add_state";

    $.post("crud/state_city_crud.php", {
        action,
        id: $("#stateId").val(),
        name: $("#stateName").val()
    }, res => {
        $("#stateModal").modal("hide");
        showAlert("Saved successfully");
        loadStates();
    }, "json");
});

$(document).on("click",".deleteBtn",function(){
    if(!confirm("Delete this state?")) return;
    $.post("crud/state_city_crud.php",
        { action:"delete_state", id:$(this).data("id") },
        () => loadStates(), "json"
    );
});

function showAlert(msg){
    $("#alertBox").html(`<div class="alert alert-success">${msg}</div>`);
    setTimeout(()=>$("#alertBox").html(""),2000);
}
</script>

</body>
</html>
