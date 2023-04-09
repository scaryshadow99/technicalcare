

<?php

$dbHost = "localhost";
$dbUser =  "root";
$dbPass = "";
$dbName = "technical_care_project";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass, $options);
    // echo "successful";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (exception $e) {
    echo $e->getMessage();
    exit();
}

if (isset($_GET["id"]) && isset($_GET["client_id"])) {
    $technical_id = $_GET["id"];
    $client_id = $_GET["client_id"];
    $sql = "SELECT * FROM `order` WHERE `technical_id` = '$technical_id'";
    $q = $conn->prepare($sql);
    $q->execute();
    $order = $q->fetch();
    // =======================order===============================
    $total_order = "SELECT * FROM `order`";
    $q = $conn->prepare($sql);
    $q->execute();
    $order_num = $q->fetch();
    // =======================order===============================

    $total_order = "SELECT * FROM `order`WHERE `client_id` client_id='$client_id'";
    $q = $conn->prepare($sql);
    $q->execute();
    $technical_data = $q->fetch();
    //===================================Technical==========================================================
    $sql = "SELECT * FROM `technical` WHERE id = '$technical_id' ";
    $q = $conn->prepare($sql);
    $q->execute();
    $data = $q->fetch();
    //=================================Technical============================================================
    if ($data) {

        if ($data['status'] == 'Available') {
            $request_order = "INSERT INTO `order`( `client_id`, `technical_id`,`status`) VALUES ('$client_id','$technical_id','pending')";

            $conn->exec($request_order);
            $accept_order = "تم طلب الفني";
            echo json_encode(["in_cart" => $accept_order]);
            $update_status = "UPDATE `technical` SET `status`='UNAvailable' WHERE `id` ='$technical_id'";
            $conn->exec($update_status);
        } else {
            $in_cart = " هذا الفني مشغول الأن ";
            echo json_encode(["in_cart" => $in_cart]);
        }
    }
}

?>

