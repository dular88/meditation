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
<form class="row g-3 align-items-end">

    <div class="col-md-4">
        <label class="form-label fw-semibold">State</label>
        <select name="state" class="form-select">
            <option value="">All States</option>
            <?php
            $states = mysqli_query($conn,"SELECT id,name FROM states ORDER BY name");
            while($s=mysqli_fetch_assoc($states)){
                echo "<option value='{$s['id']}'>{$s['name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-semibold">City</label>
        <select name="city" class="form-select" disabled>
            <option value="">All Cities</option>
        </select>
    </div>

    <div class="col-md-4">
        <button type="submit" class="btn btn-success w-100">Apply Filter</button>
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

    // Load meditators initially
    loadMeditators();

    // Load cities dynamically when state changes
    $('select[name="state"]').change(function(){
        let state_id = $(this).val();
        let citySelect = $('select[name="city"]');

        citySelect.html('<option value="">All Cities</option>').prop("disabled", true);

        if(!state_id){
            loadMeditators();
            return;
        }

        $.post("ajax/get_cities.php",{state_id},function(res){
            let html = '<option value="">All Cities</option>';
            res.forEach(c=>{
                html += `<option value="${c.id}">${c.name}</option>`;
            });
            citySelect.html(html).prop("disabled", false);
        },"json");

        loadMeditators();
    });

    // Filter form submit
    $('form').submit(function(e){
        e.preventDefault();
        loadMeditators();
    });

    function loadMeditators(){
        $.post("ajax/filter_meditators.php",{
            state_id: $('select[name="state"]').val(),
            city_id: $('select[name="city"]').val()
        },function(html){
            $('#meditatorsResult').html(html);
        });
    }

});
</script>
</body>
</html>
