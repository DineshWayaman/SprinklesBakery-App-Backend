<?php

$userID = $_POST[''];

$getCart = "SELECT * FROM cart WHERE u_id='$userID'";
$getCartE = $conn->prepare($getCart);
$getCartE->execute();
$cartArray = array();
while ($fetchRows = $getCartE->fetch()) {
    $temp = array();
    $itemID = $fetchRows['i_id'];
    
    $getItemData = "SELECT * FROM items WHERE i_id='$itemID'";
    $getItemDataE = $conn->prepare($getItemData);
    $getItemDataE->execute();
    

    while ($fetchItemRows = $getItemDataE->fetch()) {
        $itemName = $fetchItemRows['i_name'];
        $itemImg = $fetchItemRows['i_img'];
    
        $temp['cart_id'] = $fetchRows['ct_id'];
        $temp['cart_qty'] = $fetchRows['ct_qty'];
        $temp['cart_price'] = $fetchRows['ct_price'];
        $temp['item_name'] = $itemName;
        $temp['item_img'] = $itemImg;
    
        array_push($cartArray, $temp);
    }
}
echo json_encode($cartArray);