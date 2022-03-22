<?php

include('config/dbconfig.php');


$getCat = "SELECT c_name, c_desc FROM categories WHERE c_active=1";
$getCatE = $conn->prepare($getCat);
$getCatE->execute();
$catrow = $getCatE->rowCount();
if ($catrow>0) {
$cat = array();

while($catfetch = $getCatE->fetch()){

    $temp = array();
	$temp['c_name'] = $catfetch['c_name'];
	$temp['c_desc'] = $catfetch['c_name'];


	array_push($cat,$temp);
	}

	echo json_encode($cat);
}else{
    $result["success"] = "0";
    $result["message"] = "No Category Found";
    echo json_encode($result);
}