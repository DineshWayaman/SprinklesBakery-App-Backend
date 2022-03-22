<?php

include('config/dbconfig.php');

// ct_id
// i_id
// u_id
// ct_qty
// ct_price
// ct_created_at
// ct_updated_at

// $userID = $_POST[''];
// $itemID = $_POST[''];
// $cartQty = $_POST[''];
// $cartPrice = $_POST[''];


// $userID = $_POST['u_id'];
// $itemID = $_POST['i_id'];
// $cartQty = $_POST['cart_qty'];
// $cartPrice = $_POST['cart_price'];

$userID = '';
$itemID = '';
$cartQty = '';
$cartPrice = '';

$selectAvailableCart = "SELECT * FROM cart WHERE i_id='$userID' AND u_id='$itemID'";
$selectAvailableCartE = $conn->prepare($selectAvailableCart);
$selectAvailableCartE->execute();
$availableRows = $selectAvailableCartE->rowCount();
$fetchRows = $selectAvailableCartE->fetch();
if ($availableRows>0) {
     $qty = $fetchRows['ct_qty'];
     $price = $fetchRows['ct_price'];
     $cartID = $fetchRows['ct_id'];
     $newPrice = $price+$cartPrice;
     $newQty = $qty+$cartQty;

     $updateCart = "UPDATE cart SET ct_qty='$newQty', ct_price='$newPrice' WHERE i_id='$itemID' AND u_id='$userID' AND ct_id='$cartID'";
    $updateQuery = $conn->prepare($updateCart);
    $updateQuery->execute();

    if ($updateQuery) {
        $result["success"] = "1";
	$result["message"] = "Item Added to Cart";
    echo json_encode($result);
    }else{
        $result["success"] = "0";
        $result["message"] = "Failed, an error occurred";
    
        echo json_encode($result);
    }
    

    }else{
        $insertCart = "INSERT INTO cart(i_id, u_id, ct_qty, ct_price) VALUES (?,?,?,?)";

        $insertCQuery = $conn->prepare($insertCart);
        $insertCQuery->execute(array($itemID, $userID, $cartQty, $cartPrice));
        
        if ($insertCQuery) {
            $result["success"] = "1";
            $result["message"] = "Item Added to Cart";
            echo json_encode($result);
        }else{
            $result["success"] = "0";
            $result["message"] = "Failed, an error occurred";
        
            echo json_encode($result);
        }
        
    }

