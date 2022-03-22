<?php

include('config/dbconfig.php');

$itemName = 'Special Birthday';
$itemCat =  'Classic Cupcackes';
$itemQty = '100';
$itemPrice = '1210.00';
$itemIngred = 'Eggs,Powder';
$itemMessage = 'No Message';



$insertItem = "INSERT INTO items(i_name, i_cat, i_qty, i_price, i_ingredients, i_message)  
    VALUES (?,?,?,?,?,?)";
$insertQuery = $conn->prepare($insertItem);
$insertQuery->execute(array($itemName, $itemCat, $itemQty, $itemPrice, $itemIngred, $itemMessage));

if ($insertQuery) {
    $result["success"] = "1";
    $result["message"] = "Item created successfully!";

    echo json_encode($result);
    // echo $result;

} else {
    $result["success"] = "0";
    $result["message"] = "Failed, an error occurred";

    echo json_encode($result);
    // echo $result;
}
