<?php
include "dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Events | Ekta Pyramid Spiritual Trust</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.65),rgba(0,0,0,.65)),
    url('assets/images/event.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}
.event-card{
    border-radius:15px;
    transition:.3s;
}
.event-card:hover{
    transform: translateY(-6px);
}
.event-img{
    height:200px;
    object-fit:cover;
}
</style>
</head>

<body>

<?php include "includes/header.php"; ?>

<!-- ================= HERO ================= -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold">Meditation Events & Workshops</h1>
    <p class="mt-3">
        Join pyramid meditation events, spiritual gatherings,
        and group practices near you.
    </p>
</div>
</section>

<!-- ================= FILTER ================= -->
<section class="py-4 bg-light border-bottom">
<div class="container">

<form class="row g-3 align-items-end">

    <div class="col-md-3">
        <label class="form-label fw-semibold">State</label>
        <select id="state_id" class="form-select">
            <option value="">All States</option>
            <?php
            $states = mysqli_query($conn,"SELECT id,name FROM states ORDER BY name");
            while($s=mysqli_fetch_assoc($states)){
                echo "<option value='{$s['id']}'>{$s['name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label fw-semibold">City</label>
        <select id="city_id" class="form-select" disabled>
            <option value="">All Cities</option>
        </select>
    </div>

    <!-- ✅ NEW EVENT TYPE -->
    <div class="col-md-3">
        <label class="form-label fw-semibold">Event Type</label>
        <select id="event_type" class="form-select">
            <option value="">All Events</option>
            <option value="upcoming">Upcoming</option>
            <option value="ongoing">Ongoing</option>
            <option value="completed">Completed</option>
        </select>
    </div>

    <div class="col-md-3">
        <button type="button" id="filterBtn" class="btn btn-success w-100">
            Apply Filter
        </button>
    </div>

</form>


</div>
</section>

<!-- ================= EVENTS ================= -->
<section class="py-5 bg-light">
<div class="container">
    <div class="row" id="eventsResult"></div>
</div>
</section>

<!-- ================= CTA ================= -->
<section class="py-5 text-center bg-success text-white">
    <h2>Participate in Group Meditation</h2>
    <p class="mt-2">Meditate • Heal • Transform</p>
    <a href="contact.php" class="btn btn-light btn-lg mt-3">
        Contact Us
    </a>
</section>

<?php include "includes/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(function(){

    loadEvents();

    // Load cities when state changes
    $("#state_id").change(function(){
        let state_id = $(this).val();

        $("#city_id").html('<option value="">All Cities</option>')
                     .prop("disabled", true);

        if(!state_id){
            loadEvents();
            return;
        }

        $.post("ajax/get_cities.php",{state_id},function(res){
            let html = '<option value="">All Cities</option>';
            res.forEach(c=>{
                html += `<option value="${c.id}">${c.name}</option>`;
            });
            $("#city_id").html(html).prop("disabled", false);
        },"json");

        loadEvents();
    });

    $("#filterBtn").click(function(){
        loadEvents();
    });

function loadEvents(){
    $.post("ajax/filter_events.php",{
        state_id: $("#state_id").val(),
        city_id: $("#city_id").val(),
        event_type: $("#event_type").val() // ✅ NEW
    },function(html){
        $("#eventsResult").html(html);
    });
}


});
</script>

</body>
</html>
