<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Meditators | Ekta Pyramid Spiritual Trust</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
    url('assets/images/meditator.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}
.meditator-card{
    border-radius:16px;
    height:100%;
    transition:.3s;
}
.meditator-card:hover{
    transform: translateY(-5px);
}
.meditator-name{
    font-weight:600;
    font-size:18px;
}
.meditator-text{
    font-size:14px;
    color:#555;
}
</style>
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- HERO -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold">Our Meditators</h1>
    <p class="mt-2">Find and connect with your nearest meditators</p>
</div>
</section>

<!-- FILTER -->
<section class="py-4 bg-light border-bottom">
<div class="container">
<form class="row g-3 align-items-end" id="filterForm">

    <!-- CITY -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">City</label>
        <select id="city_id" class="form-select">
            <option value="">All Cities</option>
            <?php
            $cities = mysqli_query($conn,"SELECT id,name FROM cities ORDER BY name");
            while($c=mysqli_fetch_assoc($cities)){
                echo "<option value='{$c['id']}'>{$c['name']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- AREA -->
    <div class="col-md-4">
        <label class="form-label fw-semibold">Area</label>
        <select id="area_id" class="form-select" disabled>
            <option value="">All Areas</option>
        </select>
    </div>

    <div class="col-md-4">
        <button type="submit" class="btn btn-success w-100">
            Apply Filter
        </button>
    </div>

</form>
</div>
</section>

<!-- MEDITATORS LIST -->
<section class="py-5 bg-light">
<div class="container">
<div class="row g-4" id="meditatorsResult"></div>
</div>
</section>

<?php include "includes/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(function(){

    loadMeditators();

    // City → Load Areas
    $("#city_id").change(function(){

        let city_id = $(this).val();

        $("#area_id")
            .html('<option value="">All Areas</option>')
            .prop("disabled", true);

        if(!city_id){
            loadMeditators();
            return;
        }

        $.ajax({
            url: "admin/crud/city_area_api.php",
            type: "POST",
            dataType: "json",
            data: {
                action: "get_areas",
                city_id: city_id
            },
            success: function(res){

                let html = '<option value="">All Areas</option>';

                if(Array.isArray(res) && res.length){
                    res.forEach(a=>{
                        html += `<option value="${a.id}">${a.name}</option>`;
                    });
                    $("#area_id").html(html).prop("disabled", false);
                }
            }
        });

        loadMeditators();
    });

    // Filter submit
    $("#filterForm").submit(function(e){
        e.preventDefault();
        loadMeditators();
    });

    function loadMeditators(){
        $.post("ajax/filter_meditators.php",{
            city_id: $("#city_id").val(),
            area_id: $("#area_id").val(),
              action: "list",
        },function(html){
            $("#meditatorsResult").html(html);
        });
    }

});
</script>

</body>
</html>
