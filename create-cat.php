<?php

include('config/dbconfig.php');

// if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
   

// }

// $userEmail= $_POST['userEmail'];
// $userName= $_POST['userName'];
// $userPassword= $_POST['userPassword'];
// $userTelephone= $_POST['userTel'];


$catName= 'Classic Cupcackes';
$catDesc=  'Classic cupcackes category';


    $insertCat = "INSERT INTO categories(c_name, c_desc)  
    VALUES (?,?)";
    $insertQuery = $conn->prepare($insertCat);
    $insertQuery->execute(array($catName, $catDesc));

    if ($insertQuery) {
        $result["success"] = "1";
		$result["message"] = "Category created successfully!";

		echo json_encode($result);
		// echo $result;

    }else{
        $result["success"] = "0";
		$result["message"] = "Failed, an error occurred";

		echo json_encode($result);
		// echo $result;
    }
