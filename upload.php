<?php

$target_dir = "img/items";
$image = $_POST["image"];

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_dir = $target_dir ."/". rand() . "_". time() . ".jpeg";
if (file_put_contents($target_dir, base64_decode($image))) {
    echo json_encode([
        "Message" => "File has been uploaded.",
        "Status" => "OK"
    ]);
}else{
    echo json_encode([
        "Message" => "Error while uploading.",
        "Status" => "Error"
    ]);
}