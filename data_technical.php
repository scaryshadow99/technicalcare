<?php
include('conn.php');
// $sql = "SELECT * FROM `technical` ";
// $q = $conn->prepare($sql);
// $q->execute();
// $data = $q->fetchAll();



// // Sample array
// $data_jason = $data;

// // Convert array to JSON object
// $json = json_encode($data_jason);

// // Output JSON object
// echo $json;
$tech_id = $_POST['tech_id'];
$sql = "SELECT * FROM `technical` WHERE id='$tech_id' ";
$q = $conn->prepare($sql);
$q->execute();
$data = $q->fetch();
$name = $data['firstName'] . $data['lastName'];
$email = $data['email'];
$image = $data['image'];
$typeOf = $data['type_of'];
$status = $data['status'];


$image_src = "<img src='$image' width=100px>";

?>


<!--  -->




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Profile Page</title>
    <link rel="stylesheet" href="css/style_profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- CSS -->
    <style>
        @media (max-width: 919px) {


            .tm-paging-links ul li {
                text-align: center;
                margin-bottom: 30px;
                display: block !important;
                justify-content: center;
                align-items: center;
            }

            .tm-paging-links {
                text-align: center;
                margin-bottom: 30px;
                display: block;
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                position: relative;
                width: 350px;
                pointer-events: auto;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, 0.2);
                border-radius: 0.3rem;
                outline: 0;
                justify-content: center;
                align-items: center;
                margin: 0;
            }

            ul {
                list-style-type: none;
                margin: 0;
                padding: -10;
                display: block !important;
                align-items: center;
            }



        }
    </style>
</head>

<body>
    <div class="header__wrapper">
        <header>
            <h1><?php echo $typeOf ?></h1>
        </header>
        <div class="cols__container">
            <div class="left__col">
                <div class="img__container">
                    <img src='<?php echo $image ?>' alt='<?php echo $name ?>' />
                    <?php
                    if ($status == 'UNAvailable') {
                        echo  " <span style='background-color:red;'></span>";
                        echo "<p>$status</p>";
                    } else {
                        echo " <span></span>";
                        echo "<p>$status</p>";
                    }
                    ?>
                </div>
                <h2><?php echo  $name ?></h2>
                <p><?php echo $typeOf ?></p>
                <p><?php echo $email ?></p>

                <!-- <ul class="about">
                    <li><span>4,073</span>Followers</li>
                    <li><span>322</span>Following</li>
                    <li><span>200,543</span>Attraction</li>
                </ul> -->

                <div class="content">
                    <p>

                    </p>


                </div>
            </div>
            <div class="right__col">
                <nav>
                    <ul>
                        <li><a href="#photos">photos</a></li>
                        <li><a href="">galleries</a></li>
                        <li><a href="">groups</a></li>
                        <li><a href="">about</a></li>
                    </ul>
                </nav>

                <div class="photos">
                    <?php
                    $sql = "SELECT `image` FROM `imagetechnical` WHERE `tech_id`='$tech_id'";
                    $q = $conn->prepare($sql);
                    $q->execute();
                    $data_image = $q->fetchAll();

                    foreach ($data_image as $image) :
                        $name_image = $image['image'];
                        echo " <img src='$name_image' alt='Photo' />";
                    endforeach
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>