<?php
include('conn.php');












?>













<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الفني المتنوع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <table class='table'>
        <thead>
            <tr>
                <th scope='col'>رقم الطلب</th>
                <th scope='col'>اسم العميل</th>
                <th scope='col'>ايميل العميل</th>
                <th scope='col'>اسم الفني</th>
                <th scope='col'>ايميل الفني</th>
                <th scope='col'>نوع الفني</th>
                <th scope='col'>تاريخ الطلب</th>

            </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM `order` where 1";
        $q = $conn->prepare($sql);
        $q->execute();
        $data = $q->fetchAll();


        foreach ($data as $arr) :
            $client_id = $arr['client_id'];
            $technical_id = $arr['technical_id'];







            // ======================================Orders technical=======================

            $sql = "SELECT * FROM `technical` where id='$technical_id'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data_technical = $q->fetchAll();

            // ======================================Orders technical=======================
            foreach ($data_technical as $dataTechnical) :
                $name_technical = $dataTechnical['firstName'] . " " . $dataTechnical['lastName'];
                $email_technical = $dataTechnical['email'];
                $typeOf = $dataTechnical['type_of'];
            endforeach;

            for ($i = 0; $i > $data_technical; $i++) {
                echo $data_technical[$i];
            }

            // ======================================Orders Client=======================
            $sql = "SELECT * FROM `client` where id='$client_id '";
            $q = $conn->prepare($sql);
            $q->execute();
            $data_client = $q->fetchAll();

            // ======================================Orders Client=======================
            foreach ($data_client as $dataClient) :

                $f_name = $dataClient['firstName'] . " " . $dataClient['lastName'];

                $email = $dataClient['email'];
                echo  "
    <tbody>
        <tr>
            <th scope='row'>$arr[order_id]</th>
            <td>$f_name</td>
            <td>$email</td>
            <td>$name_technical</td>
            <td>$email_technical</td>
            <td>$typeOf</td>
            <td>$arr[date]</td>
            
            </tr>
    </tbody>";
            endforeach;

        endforeach;

        ?>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>


</html>