<?php
include "../dbcon.php";

$city_id = intval($_POST['city_id']);

$q = mysqli_query($conn,"SELECT id,name FROM area WHERE city_id=$city_id ORDER BY name");

$data=[];
while($row=mysqli_fetch_assoc($q)){
    $data[]=$row;
}

echo json_encode($data);
