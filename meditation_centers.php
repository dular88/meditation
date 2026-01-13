<?php include "dbcon.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Meditation Centers | Ekta Pyramid Spiritual Society</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
    url('assets/images/center.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}

.z-box{ padding:70px 0; }
.bg-soft{ background:#f8f9fa; }

.center-card{
    border-radius:15px;
    transition:0.3s;
}
.center-card:hover{
    transform: translateY(-5px);
}
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<!-- ================= HERO ================= -->
<section class="hero text-center">
    <div class="container">
        <h1 class="fw-bold">Our Meditation Centers in Chhattisgarh</h1>
        <p class="mt-3">
            Experience deep peace and spiritual energy at our pyramid
            meditation centers spread across different states and cities.
        </p>
    </div>
</section>

<!-- ================= INTRO ================= -->
<section class="text-center">
    <div class="container">
        <h2 class="fw-bold">Sacred Spaces for Inner Transformation</h2>
        <p class="mt-3">
            Each meditation center is designed to support Anapanasati
            and pyramid meditation practices, helping seekers connect
            with universal consciousness and inner silence.
        </p>
    </div>
</section>
<!-- ================= FILTER ================= -->
<section class="bg-soft">
<div class="container">

<form class="row g-3 align-items-end">

    <div class="col-md-4">
        <label class="form-label fw-semibold">City</label>
        <select id="city_id" class="form-select">
            <option value="">Select City</option>
            <?php
            $cities = mysqli_query($conn,"SELECT id,name FROM cities ORDER BY name");
            while($s=mysqli_fetch_assoc($cities)){
                echo "<option value='{$s['id']}'>{$s['name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">Area</label>
        <select id="area_id" class="form-select" disabled>
            <option value="">Select Area</option>
        </select>
    </div>

    <div class="col-md-4">
        <button type="button" id="filterBtn" class="btn btn-success w-100">
            Apply Filter
        </button>
    </div>

</form>

</div>
</section>
<section class="z-box">
<div class="container">
    <div class="row" id="centersResult"></div>
</div>
</section>



<!-- ================= CTA ================= -->
<section class="z-box text-center bg-success text-white">
    <h2>Join Group Meditation Near You</h2>
    <p class="mt-2">
        Meditate together • Heal together • Grow together
    </p>
    <a href="contact.php" class="btn btn-light btn-lg mt-3">
        Contact Us
    </a>
</section>

<?php include "includes/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(function(){

    // Load all centers on page load
    loadCenters();

    // City change → Load areas
    $("#city_id").change(function(){

    let city_id = $(this).val();

    $("#area_id")
        .html('<option value="">Select Area</option>')
        .prop("disabled", true);

    if(!city_id){
        loadCenters();
        return;
    }

    $.ajax({
        url: "admin/crud/city_area_api.php",
        type: "POST",
        dataType: "json",
        data: {
            action: "get_areas",   // ✅ REQUIRED
            city_id: city_id
        },
        success: function(res){

    let html = '<option value="">Select Area</option>';

    // ✅ SAFETY CHECK (MOST IMPORTANT)
    if (!Array.isArray(res)) {
        console.error("Area API response error:", res);
        html += '<option value="">No areas found</option>';
        $("#area_id").html(html).prop("disabled", true);
        return;
    }

    if (res.length === 0) {
        html += '<option value="">No areas found</option>';
    } else {
        res.forEach(a => {
            html += `<option value="${a.id}">${a.name}</option>`;
        });
    }

    $("#area_id").html(html).prop("disabled", false);
}
,
        error: function(){
            alert("Failed to load areas");
        }
    });

    loadCenters();
});


    // Area change → reload centers
    $("#area_id").change(function(){
        loadCenters();
    });

    // Apply filter
    $("#filterBtn").click(function(){
        loadCenters();
    });

    function loadCenters(){
        $.post("ajax/filter_centers.php",{
            city_id: $("#city_id").val(),
            area_id: $("#area_id").val()
        },function(html){
            $("#centersResult").html(html);
        });
    }

});
</script>


</body>
</html>
