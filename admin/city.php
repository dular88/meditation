<?php include_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cities CRUD</title>

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/dist/css/admin.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/fa/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

<?php include_once "sidebar.php"; ?>

<div class="content p-4">

<nav class="navbar bg-white shadow-sm p-3 rounded mb-4">
    <h4 class="m-0">Cities</h4>
</nav>

<button class="btn btn-primary mb-3" id="addCityBtn">+ Add City</button>
<div id="alertBox"></div>

<div class="card shadow-sm">
<div class="card-body p-0">
<table class="table table-striped mb-0">
<thead>
<tr>
<th>#</th>
<th>State</th>
<th>City</th>
<th width="140">Action</th>
</tr>
</thead>
<tbody id="cityTable"></tbody>
</table>
</div>
</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="cityModal">
<div class="modal-dialog">
<form id="cityForm">
<div class="modal-content">

<div class="modal-header">
<h5 id="modalTitle">Add City</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<input type="hidden" id="cityId">

<select id="stateId" class="form-control mb-2" required></select>
<input type="text" id="cityName" class="form-control" placeholder="City Name" required>
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
function loadStatesDropdown(){
    $.post("crud/state_city_crud.php",{action:"list_states"},data=>{
        let opt="<option value=''>Select State</option>";
        data.forEach(s=> opt+=`<option value="${s.id}">${s.name}</option>`);
        $("#stateId").html(opt);
    },"json");
}

function loadCities(){
    $.post("crud/state_city_crud.php",{action:"list_cities"},data=>{
        let rows="",i=1;
        data.forEach(r=>{
            rows+=`
            <tr>
                <td>${i++}</td>
                <td>${r.state}</td>
                <td>${r.city}</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn" data-id="${r.id}">Edit</button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="${r.id}">Delete</button>
                </td>
            </tr>`;
        });
        $("#cityTable").html(rows);
    },"json");
}

loadCities();

$("#addCityBtn").click(()=>{
    $("#cityForm")[0].reset();
    $("#cityId").val("");
    loadStatesDropdown();
    $("#modalTitle").text("Add City");
    $("#cityModal").modal("show");
});

$(document).on("click",".editBtn",function(){
    let id=$(this).data("id");
    loadStatesDropdown();
    $.post("crud/state_city_crud.php",{action:"get_city",id},data=>{
        $("#cityId").val(data.id);
        $("#cityName").val(data.name);
        $("#stateId").val(data.state_id);
        $("#modalTitle").text("Edit City");
        $("#cityModal").modal("show");
    },"json");
});

$("#cityForm").submit(function(e){
    e.preventDefault();
    let action=$("#cityId").val()?"update_city":"add_city";

    $.post("crud/state_city_crud.php",{
        action,
        id:$("#cityId").val(),
        state_id:$("#stateId").val(),
        name:$("#cityName").val()
    },()=>{
        $("#cityModal").modal("hide");
        loadCities();
    },"json");
});

$(document).on("click",".deleteBtn",function(){
    if(!confirm("Delete city?"))return;
    $.post("crud/state_city_crud.php",
        {action:"delete_city",id:$(this).data("id")},
        ()=>loadCities(),"json"
    );
});
</script>

</body>
</html>
