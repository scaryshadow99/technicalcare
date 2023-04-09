
<?php
include('conn.php');
$sql = "SELECT * FROM `client` ";
$q = $conn->prepare($sql);
$q->execute();
$data = $q->fetchAll();



// Sample array
$data_jason = $data;

// Convert array to JSON object
$json = json_encode($data_jason);

// Output JSON object
echo $json;


?>