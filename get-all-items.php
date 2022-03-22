<?php

include('config/dbconfig.php');


$getItem = "SELECT * FROM items WHERE i_active=1 AND i_cat='Classic Cupcackes'";
$getItemE = $conn->prepare($getItem);
$getItemE->execute();
$catrow = $getItemE->rowCount();
if ($catrow>0) {
$item = array();

while($itemfetch = $getItemE->fetch()){

    $temp = array();
	$temp['i_name'] = $itemfetch['i_name'];
	$temp['i_cat'] = $itemfetch['i_cat'];
    $temp['i_qty'] = $itemfetch['i_qty'];
    $temp['i_price'] = $itemfetch['i_price'];
    $temp['i_ingredients'] = $itemfetch['i_ingredients'];
    $temp['i_message'] = $itemfetch['i_message'];



	array_push($item,$temp);
	}

	echo json_encode($item);
}else{
    $result["success"] = "0";
    $result["message"] = "No Category Found";
    echo json_encode($result);
}