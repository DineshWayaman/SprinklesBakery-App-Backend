<?php

	include('config/dbconfig.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
	

    $userName = $_POST['useremail'];
    $userPassword = $_POST['password'];

    // $userName = 'dineshwayaman@gmail.com';
    // $userPassword = '123';

    $checkUser = "SELECT * FROM `users` WHERE `u_email`=? AND `u_password`=?";
    $getUser = $conn->prepare($checkUser);
    $getUser->execute(array($userName,$userPassword));
    $userrow = $getUser->rowCount();
    $userfetch = $getUser->fetch();
    if ($userfetch['u_active']=='0') {
        $result["success"] = "2";
		$result["message"] = "You Have Blocked By Admin";
        echo json_encode($result);
    }
    elseif ($userrow>0) {
        $result["userName"] = $userfetch['u_name'];
        $result["userID"] = $userfetch['u_id'];
        $result["userTel"] = $userfetch['u_telephone'];
        $result["success"] = "1";
		$result["message"] = "Successfully Login";
        // echo json_encode([$result]);
        echo json_encode($result);

    }else{
        $result["success"] = "0";
		$result["message"] = "Incorrect email or password";
        echo json_encode($result);
    }

}

?>
