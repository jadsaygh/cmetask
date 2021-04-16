<?php
    include("config/connect.php");

	$name = $_POST['name'];
	$email = $_POST['email'];
	$company_name = $_POST['company_name'];

	$sql = "INSERT INTO `clients`( `name`, `email`) VALUES ('$name','$email');";
	if (mysqli_query($conn, $sql)) {
        $client_id = $conn->insert_id;
        $sql = "INSERT INTO `companies`( `company_name`) VALUES ('$company_name');";
        if (mysqli_query($conn, $sql)) {
            $company_id = $conn->insert_id;
            $sql = "INSERT INTO `companies_clients_r`( `company_id`, `client_id`) VALUES ('$company_id','$client_id');";
            if (mysqli_query($conn, $sql)) { 
		        echo json_encode(array("statusCode" => 200));
            } else {
                echo json_encode(array("statusCode" => 400));
            }
        } else {
            echo json_encode(array("statusCode" => 400));
        }
    } 
	else {
		echo json_encode(array("statusCode" => 400));
	}
	mysqli_close($conn);

?>