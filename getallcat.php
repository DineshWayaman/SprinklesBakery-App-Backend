<?php
	include('config/dbconfig.php');

    // $que="select * from categories";
	// 	$result = $conn->prepare($que);		// $row=mysqli_num_rows($que);
    //     $result->execute();
    //     $rows=array();
	// 	 while ($row = $result->fetch()) {
	// 		 $rows[]=$row;
	// 		}
	// 		echo json_encode($rows);

$stmt = $pdo->query("SELECT * FROM categories WHERE c_active='0' ORDER BY c_id DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows);
