<?php
include('conn.php');
session_start();

if (!isset($_SESSION['technical'])) {
    header('location:technical_login.php');
    exit();
}
$tech_id = $_SESSION['technical']['id'];

$sql = "SELECT * FROM `technical` WHERE  `id`='$tech_id'";
$q = $conn->prepare($sql);
$q->execute();
$data = $q->fetch();

$name = $data['firstName'] . ' ' . $data['lastName'];
$email = $data['email'];
$image = $data['image'];
$typeOf = $data['type_of'];
$status = $data['status'];



if (isset($_POST["submit"])) {
    $erorr_image = '';
    $img_exe = pathinfo($_FILES['upload_image']['name'], PATHINFO_FILENAME);
    $img_valid_exe = array("png", "jpg", "jpeg");
    $fileDimension = @getimagesize($_FILES['upload_image']['tmp_name']);
    @$image_width = $fileDimension[0];
    @$image_hight = $fileDimension[1];

    if (!file_exists($_FILES['upload_image']['tmp_name'])) {
        $erorr_image = 'choose Your File';
    } elseif (in_array($img_exe, $img_valid_exe)) {
        $erorr_image = ' PNG , JPG & JPEG يجب تنزيل صور فقط من النوع ';
    } elseif ($_FILES['upload_image']['size'] > 2000000) {
        $erorr_image = '2m يجب اختيار صورة مساحتها ';
    } else {
        $target = "imag_tech/" . basename($_FILES['upload_image']['name']);

        if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $target)) {
            $sql = "INSERT INTO `imagetechnical`( `tech_id`, `name`, `email`, `image`) VALUES ('$tech_id','$name','$email','$target')";
            $conn->exec($sql);
            header('location:profile.php');
        } else {
            $erorr_image = 'مشكلة في تنزيل الصورة';
        }
    }
}
// fetch the order id 
$sql = "SELECT * FROM `order` WHERE `technical_id`='$tech_id'  And `status`='pending'";
$q = $conn->prepare($sql);
$q->execute();
$orders = $q->fetchAll();


// fetch the order id 

// fetch data client with order id


// fetch data client with order id


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>الفني المتنوع</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style_.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>
<style>
    .header__wrapper header {
        width: 100%;
        background: url(../img/bg.jpeg) no-repeat 50% 20% / cover;
        min-height: calc(100px + 15vw);
        background-color: #022848;
        display: flex;
        justify-content: center;
        justify-items: center;
        align-items: center;
    }

    .header__wrapper header h1 {
        color: white;
        font-weight: 600;
        font-size: 65px;
    }

    .right__col form input[type="file"] {
        display: none;
    }


    .right__col form label {
        color: #022848;
        height: 50px;
        width: 200px;
        background-color: #06A3DA;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: 0.5s all;
        pointer-events: all;
        cursor: pointer;

    }

    .right__col form label:hover {
        color: white;
        box-shadow: 0 5px 5px black;


    }

    .photo {
        position: relative;
    }

    .photo i {
        position: absolute;
        transform: translate(30px, -37px);
        font-size: 20px;
        color: white;
    }

    .photo input[type="submit"] {
        padding: .5em 1em;
        background-color: #06A3DA;
        border: none;
        margin-top: 10px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.6s;


    }

    .photo input[type="submit"]:hover {
        background-color: white;
        color: #06A3DA;
        text-decoration: underline;
        box-shadow: 0 10px 15px #0000001c;

    }

    .right__col nav ul li {
        font-size: 30px;
        text-decoration: underline;
    }

    .container_image {
        position: relative;
    }

    button#delete {
        position: absolute;
        top: 50px;
        transform: translate(60%);
        display: none;
    }

    .container h1 {
        text-align: center;
    }





    @media (max-width:890px) {
        .table thead tr th {
            display: block;
        }


        .table tbody td,
        .table tbody tr th,
        .table thead tr th {
            display: block;
        }


    }

    @media (max-width:890px) {
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 250%;
        }


    }


    .data {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px;

    }

    .data button {
        text-align: center;
    }


    .active {
        display: block;
    }

    .hidden {
        display: none;
    }

    #count_order {
        margin: 5px;
        padding: 5px;
        background: #0593c4;
        border: 1px solid #0593c4;
        color: white;
    }
</style>

<body>



    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.html" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>الفني المتنوع</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="./home.php" class="nav-item nav-link ">Home</a>
                    <a href="./technical/about.php" class="nav-item nav-link">About</a>
                    <a href="./technical/contact.php" class="nav-item nav-link">Contact</a>
                    <a href="./profile.php" class="nav-item nav-link active">Profile</a>


                    <div class="nav-item dropdown">
                    </div>
                </div>
                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                <a href="client_technical.php" class="btn btn-primary py-2 px-4 ms-3">LogOut</a>
            </div>
        </nav>


    </div>
    <!-- Navbar End -->

    <!-- Profile -->
    <div class="header__wrapper">
        <header>
            <h1><?php echo $typeOf ?></h1>
        </header>
        <div class="cols__container">
            <div class="left__col">
                <div class="img__container">
                    <img src=<?php echo $image ?> alt=<?php echo $name ?> />

                </div>
                <br>
                <br>
                <br>
                <h3><?php echo $name ?></h3>
                <h3><?php echo $typeOf ?></h3>
                <h3><?php echo $email ?></h3>
                <h5>
                    <?php
                    if ($status == 'Available') {
                        echo "<p><a href='./technical/active.php?id=" . $tech_id . "&status=UNAvailable' class='btn btn-success'>Available</a></p>";
                    } else {
                        echo "<p><a href='./technical/active.php?id=" . $tech_id . "&status=Available' class='btn btn-danger'>UNAvailable</a></p>";
                    }
                    ?>
                </h5>

                <!-- <ul class="about">
                    <li><span>4,073</span>Followers</li>
                    <li><span>322</span>Following</li>
                    <li><span>200,543</span>Attraction</li>
                </ul> -->

                <div class="content">
                    <!-- <p>
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam
                        erat volutpat. Morbi imperdiet, mauris ac auctor dictum, nisl
                        ligula egestas nulla.
                    </p> -->


                </div>
            </div>
            <div class="right__col">
                <nav>
                    <ul>
                        <li><a href="">الصور</a></li>

                    </ul>
                    <div class="photo">
                        <form action="profile.php" method="post" enctype="multipart/form-data">
                            <label for="uploadPhoto">اضف صور لأعمالك</label>
                            <input type="file" name="upload_image" id="uploadPhoto" value="">
                            <i class="fa-solid fa-file-image"></i>
                            <input type="submit" name="submit" value="Upload Your Photo">
                            <span style="color:red; font-family: cursive;">
                                <?php if (isset($erorr_image))
                                    echo $erorr_image;
                                ?>
                            </span>
                        </form>
                    </div>
                </nav>

                <div class="photos">
                    <?php
                    $sql = "SELECT `image` FROM `imagetechnical` WHERE `tech_id`='$tech_id'";
                    $q = $conn->prepare($sql);
                    $q->execute();
                    $data_image = $q->fetchAll();

                    foreach ($data_image as $image) :
                        $name_image = $image['image'];
                        echo "
                <div class='container_image'>
                <img class='delete_img' src='$name_image' alt='Photo' />  <button type='button' id='delete' class='btn btn-outline-danger'>Danger</button>
                
                </div>";

                    endforeach

                    ?>
                </div>
                <button type='button' id="delete" class='btn btn-outline-danger'>Danger</button>

            </div>
        </div>
    </div>

    <div class="container Requests" id="Requests">

        <br><br><br><br>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                        <span id="count_order"><?php echo  count($orders)  ?></span>
                        طلبات العملاء
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope='col'>Order</th>
                                    <th scope='col'>LastName</th>
                                    <th scope='col'>FirstName</th>
                                    <th scope='col'>Email</th>
                                    <th scope='col'>Date</th>
                                    <th scope='col'>قبول الطلب</th>
                                    <th scope='col'>رفض الطلب</th>
                                </tr>
                            </thead>
                            <?php
                            foreach ($orders as $order) :
                                $client_id = $order['client_id'];
                                $sql = "SELECT * FROM `client` WHERE `id`='$client_id'";
                                $q = $conn->prepare($sql);
                                $q->execute();
                                $data_client = $q->fetchAll();
                                @$counter =  $counter +  0;
                                @$counter++;
                                foreach ($data_client as $client) :



                                    $firsName = $client['firstName'];
                                    $lastName = $client['lastName'];
                                    $email = $client['email'];
                                    $phone = $client['phone'];
                                    $client_id = $client['id'];
                                    $client_date = $client['date'];
                                    echo "<tbody>
                            <tr>
                                <th scope='row'>$counter</th>
                                <td>$firsName</td>
                                <td>$lastName</td>
                                <td>$email</td>
                                <td>$client_date</td>
                                <td><a href='./technical/request_tech.php?id=" . $tech_id . "&client_id=" . $client_id . "&status=Accepted' class='btn btn-success'>ACCEPTED</a></td>
                                <td><a href='./technical/request_tech.php?id=" . $tech_id . "&client_id=" . $client_id . "&status=Reject' class='btn btn-danger'>Reject</a></td>

                            </tr>

                        </tbody>";
                                endforeach;
                            endforeach;

                            ?>

                        </table>

                    </div>
                </div>
            </div>
            <?php

            $sql = "SELECT * FROM `order` WHERE `technical_id`='$tech_id'  And `status`='Accepted'";
            $q = $conn->prepare($sql);
            $q->execute();
            $orders_accepted = $q->fetchAll();
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span id="count_order"><?php echo  count($orders_accepted)  ?></span>

                        طلبات العملاء التي تم قبولها

                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <!-- // This Table ACCEPTED Client -->

                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope='col'>Order</th>
                                    <th scope='col'>LastName</th>
                                    <th scope='col'>FirstName</th>
                                    <th scope='col'>Email</th>
                                    <th scope='col'>phone</th>
                                    <th scope='col'>Status Order </th>

                                </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM `order` WHERE `technical_id`='$tech_id'  And `status`='Accepted'";
                            $q = $conn->prepare($sql);
                            $q->execute();
                            $orders_accepted = $q->fetchAll();

                            foreach ($orders_accepted as $order) :
                                $client_id = $order['client_id'];
                                $sql = "SELECT * FROM `client` WHERE `id`='$client_id'";
                                $q = $conn->prepare($sql);
                                $q->execute();
                                $data_client = $q->fetchAll();
                                @$counter_orders =    $counter_orders + 0;
                                @$counter_orders++;
                                foreach ($data_client as $client) :



                                    $firsName = $client['firstName'];
                                    $lastName = $client['lastName'];
                                    $email = $client['email'];
                                    $phone = $client['phone'];
                                    $client_id = $client['id'];

                                    echo "<tbody>
                            <tr>
                                <th scope='row'>$counter_orders</th>
                                <td>$firsName</td>
                                <td>$lastName</td>
                                <td>$email</td>
                                <td>$phone</td>
                                <td><a href='./technical/request_tech.php?id=" . $tech_id . "&client_id=" . $client_id . "&status=Completed' class='btn btn-success'>تم الأنتهاء</a></td>

                            </tr>

                        </tbody>";
                                endforeach;
                            endforeach;

                            ?>

                        </table>
                        <!-- // This Table ACCEPTED Client -->
                    </div>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM `order` WHERE `technical_id`='$tech_id'  And `status`='Completed'";
            $q = $conn->prepare($sql);
            $q->execute();
            $orders_completed = $q->fetchAll();


            ?>
            <div class="accordion-item-">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span id="count_order"><?php echo  count($orders_completed)  ?></span>

                        الطلبات التي تم الأنتهاء منها
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <!-- orders Completed -->

                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope='col'>Order</th>
                                    <th scope='col'>LastName</th>
                                    <th scope='col'>FirstName</th>
                                    <th scope='col'>Email</th>
                                    <th scope='col'>phone</th>
                                    <th scope='col'>DELETE</th>

                                </tr>
                            </thead>
                            <?php

                            foreach ($orders_completed as $order) :
                                $client_id = $order['client_id'];
                                $sql = "SELECT * FROM `client` WHERE `id`='$client_id'";
                                $q = $conn->prepare($sql);
                                $q->execute();
                                $data_client = $q->fetchAll();
                                @$counter_orders =    $counter_orders + 0;
                                @$counter_orders++;
                                foreach ($data_client as $client) :



                                    $firsName = $client['firstName'];
                                    $lastName = $client['lastName'];
                                    $email = $client['email'];
                                    $phone = $client['phone'];
                                    $client_id = $client['id'];

                                    echo "<tbody>
                            <tr>
                                <th scope='row'>$counter_orders</th>
                                <td>$firsName</td>
                                <td>$lastName</td>
                                <td>$email</td>
                                <td>$phone</td>
                                <td><a href='./technical/request_tech.php?id=" . $tech_id . "&client_id=" . $client_id . "&status=Deleted' class='btn btn-DELETE'>DELETE</a></td>

                            </tr>

                        </tbody>";
                                endforeach;
                            endforeach;

                            ?>

                        </table>
                        <!-- orders Completed -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Profile -->
    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 footer-about">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                        <a href="index.php" class="navbar-brand">
                            <h1 class="m-0 text-white"><i class="fa fa-user-tie me-2"></i>الفني المتنوع</h1>
                        </a>
                        <p class="mt-3 mb-4">Lorem diam sit erat dolor elitr et, diam lorem justo amet clita stet eos
                            sit. Elitr dolor duo lorem, elitr clita ipsum sea. Diam amet erat lorem stet eos. Diam amet
                            et kasd eos duo.</p>
                        <form action="">

                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">ابقى على تواصل</h3>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0">ميامي</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">ziadm57@yahoo.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">+01099475854</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-primary btn-square me-2" href="https://www.facebook.com/profile.php?id=100010510955629"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="https://www.linkedin.com/in/ziad-mohamed-873309217/"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square" href="https://www.instagram.com/ziadmohamed542/"><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">روابط سريعة</h3>
                            </div>
                            <div class="link-animated d-flex flex-column justify-content-start">
                                <a class="text-light mb-2" href="home.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-light mb-2" href="about.php"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                                <a class="text-light" href="contact.php"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-end">
                <div class="col-lg-8 col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                        <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">فني متنوع</a>. حميع الحقوق محفوظة.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <a class="text-white border-bottom" href="https://www.facebook.com/profile.php?id=100010510955629">Ziad Mohamed</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <script>

    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>