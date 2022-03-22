<?php

$itemName = $_POST[''];
$itemCat = $_POST[''];
$itemQty = $_POST[''];
$itemPrice = $_POST[''];
$itemIng = $_POST[''];
$itemMessage = $_POST[''];
$itemImg = $_POST[''];

$target_dir = "img/items";
$base_url = "https://dineshwayaman.com/final/";

$checkItem = "SELECT * FROM items WHERE i_name='$itemName' AND i_cat='$itemCat'";
$checkItemCon = $conn->prepare($checkItem);
$checkItemCon->execute();
$checkAllRows = $checkItemCon->rowCount();
if ($checkAllRows>0) {
    echo json_encode([
        "Message" => "Item Allready Available Please Update.",
        "Status" => "Error"
    ]);
} else{

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }


    $target_dir = $target_dir ."/". rand() . "_". time() . ".jpeg";
    if (file_put_contents($target_dir, base64_decode($itemImg))) {
            $imgUrl = $base_url.$target_dir;

            $insertItems = "INSERT INTO items(i_name,i_cat,i_qty,i_price,i_ingredients,i_message,i_img) VALUES (?,?,?,?,?,?,?)";
            $insertItemsConn = $conn->prepare($insertItems);
            $insertItemsConn->execute(array($itemName, $itemCat, $itemQty, $itemPrice, $itemIng, $itemMessage, $imgUrl));
            if ($insertItemsConn) {
                echo json_encode([
                    "Message" => "Item Added Success.",
                    "Status" => "OK"
                ]);
            }
    }else{
        echo json_encode([
            "Message" => "Error while uploading Image.",
            "Status" => "Error"
        ]);
    }

}
