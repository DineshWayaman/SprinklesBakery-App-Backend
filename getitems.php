<?php

include('config/dbconfig.php');

	// if($_SERVER['REQUEST_METHOD'] == 'POST')
	// {
		
    $catName = $_POST['cat_name'];

    if ($catName == 'all') {
        $stmt = $conn->query("SELECT * FROM categories WHERE i_active='1' AND i_qty>0 ORDER BY c_id DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
    }else{
        $stmt = $conn->query("SELECT * FROM categories WHERE i_active='1' AND i_qty>0 AND i_cat='$catName' ORDER BY c_id DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
        
    }

   
    // }