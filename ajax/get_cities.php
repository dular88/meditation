<?php
include "../dbcon.php";

$state_id = intval($_POST['state_id']);

$q = mysqli_query($conn,"SELECT id,name FROM cities WHERE state_id=$state_id ORDER BY name");

$data=[];
while($row=mysqli_fetch_assoc($q)){
    $data[]=$row;
}

echo json_encode($data);
