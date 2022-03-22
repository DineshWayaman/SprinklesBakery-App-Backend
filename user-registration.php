<?php

include('config/dbconfig.php');

// if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
   

// }

// $userEmail= $_POST['userEmail'];
// $userName= $_POST['userName'];
// $userPassword= $_POST['userPassword'];
// $userTelephone= $_POST['userTel'];


$userEmail= 'dimuthu@gmail.com';
$userName=  'Dimuthu';
$userPassword= '321';
$userTelephone= '0774392447';

$checkUser = "SELECT * FROM `users` WHERE `u_email`=?";
$getUser = $conn->prepare($checkUser);
$getUser->execute(array($userEmail));
$userrow = $getUser->rowCount();
$userfetch = $getUser->fetch();
if ($userrow>0) {
    $result["success"] = "0";
	  $result["message"] = "Account already exits!";
    echo json_encode($result);
}
else{
    $insertUser = "INSERT INTO users(u_email, u_name, u_password, u_telephone)  
    VALUES (?,?,?,?)";
    $insertQuery = $conn->prepare($insertUser);
    $insertQuery->execute(array($userEmail, $userName, $userPassword, $userTelephone));

    if ($insertQuery) {
        $result["success"] = "1";
		$result["message"] = "Account created successfully!";

		echo json_encode($result);
		// echo $result;

    }else{
        $result["success"] = "0";
		$result["message"] = "Registration failed, an error occurred";

		echo json_encode($result);
		// echo $result;
    }
}
