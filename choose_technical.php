<?php
include 'conn.php';
session_start();

if (!isset($_SESSION['client'])) {
    header('location:client_login.php');
    exit();
}
$client_id = $_SESSION['client']['id'];
$sql = "SELECT * FROM `client` WHERE id='$client_id'";
$q = $conn->prepare($sql);
$q->execute();
$data_client = $q->fetch();






?>


<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>الفني المتنوع</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="css/css.css">
<!-- Favicon -->
<link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link rel="stylesheet" href="css/style_.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>



<style>
    body {
        background-color: white;
    }

    .tm-paging-link {
        padding: 10px 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        background-color: rgba(9, 30, 62, .7);
        color: black;
        background-color: transparent;
    }

    .tm-paging-link.active,
    .tm-paging-link:hover {
        background-color: #06A3DA;
        color: white;
    }

    .tm-paging-item {
        list-style: none;
        display: inline-block;
        border: 1px solid #06A3DA;
        margin: 7px;
    }

    header.row.tm-welcome-section {
        display: flex;
        margin-right: 300px;
        justify-content: center;
        align-items: center;
        justify-items: center;
    }

    header.row.tm-welcome-section {
        display: contents;
        margin: 30px;
        justify-content: center;
        align-items: center;
        justify-items: center;
    }

    .container {
        background: #091E3E;
        color: while;
    }

    .section-title.text-center.position-relative.pb-3.mb-5.mx-auto {
        margin: 100px;
    }

    a.badge.badge-primary.view_btn {
        color: #15aacf;
        font-size: 20px;
        border: 1px solid #06a3df;

        width: 30%;

    }

    a.badge.badge-primary.view_btn:hover {
        color: black;
        background-color: #15aacf;
    }

    div#data-jason {
        overflow: hidden;
        max-width: 114%;
        font-family: 'Nunito', sans-serif;
    }

    .modal-content {
        position: relative;
        display: flex;
        width: 800px;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.3rem;
        outline: 0;
        justify-content: center;
        align-items: center;
    }

    .tm-paging-links {
        text-align: center;
        margin-bottom: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .tm-gallery-page,
    .tm-section {
        max-width: 1120px;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 800px;
            margin: 1.75rem auto;
        }


    }

    @media (max-width: 919px) {


        .tm-paging-links ul li {
            text-align: center;
            margin-bottom: 40px;
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

        ol,
        ul {
            padding-left: 0rem;
        }

        div#data-jason\ tech_id {
            transform: translate(15%);
        }

        a.btn.btn-primary.py-2.px-4.ms-3 {
            padding: 2px;
        }
    }
</style>

</head>

<body>









    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i><?php echo $_SESSION['client']['email'] ?></small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.facebook.com/profile.php?id=100010510955629"><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.linkedin.com/in/ziad-mohamed-873309217/"><i class="fab fa-linkedin-in fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.instagram.com/ziadmohamed542/"><i class="fab fa-instagram fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.php" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>الفني المتنوع</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">about</a>
                    <a href="choose_technical.php" class="nav-item nav-link active">Technicians</a>

                </div>

                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <!-- <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton> -->
            <a href="logout.php" class="btn btn-primary py-2 px-4 ms-3">logout</a>

    </div>
    </nav>

    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">

                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">

                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    </div>
    <!-- Navbar & Carousel End -->






    <main>
        <header class="row tm-welcome-section">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Technicians</h5>
                <h1 class="mb-0">فنيين محترفين جاهزين لمساعدتك على إنهاء منزلك</h1>
            </div>
        </header>
        <div class="tm-paging-links">
            <nav>
                <ul>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link active">السباكه</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">الكهرباء</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">المحاره</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">سيراميك</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">الجبس</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">رخام</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">نجاره</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">الوميتال</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">نقاشه</a></li>
                    <li class="tm-paging-item"><a href="#" class="tm-paging-link">ديكور</a></li>
                </ul>
            </nav>
        </div>

        <!-- Gallery -->
        <!-- gallery page 1 -->
        <div id="tm-gallery-page-السباكه" class="tm-gallery-page">
            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم السباكه'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo "<div class='card1 tech_id' id='data-jason tech_id' style='width: 18rem;'>
                     <img src='$data_technical[image]' class='card-img-top' alt='...'>
                     <div class='card-body'>
                     <h6 class='card-title'>$data_technical[type_of]</h6>
                     <h5 class='card-title'>$data_technical[firstName]</h5>
                     <p class='card-text'>$data_technical[email]</p>
                     <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                     <button class='btn btn-outline-primary'>$data_technical[status]</button>
                     <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>
                    </div>
                    </div>";

            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery pa ge 1 -->

        <!-- gallery page 2 -->
        <div id="tm-gallery-page-الكهرباء" class="tm-gallery-page hidden">

            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم الكهرباء'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo " <div class='card1' id='data-jason' style='width: 18rem;'>
                                            <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                            <div class='card-body'>
                                            <h6 class='card-title'>$data_technical[type_of]</h6>
                                            <h5 class='card-title'>$data_technical[firstName]</h5>
                                            <p class='card-text'>$data_technical[email]</p>
                                            <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                            <button class='btn btn-outline-primary'>$data_technical[status]</button>
                                            <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>

                                            </div>
                                        </div>";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 2 -->

        <!-- gallery page 3 -->
        <div id="tm-gallery-page-المحاره" class="tm-gallery-page hidden">

            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم المحاره'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                " <div class='card3' style='width: 18rem;'>
                                <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>
                                  <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>

                                </div>
                              </div>";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 3 -->
        <!-- gallery page 4 -->
        <div id="tm-gallery-page-سيراميك" class="tm-gallery-page hidden">
            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم السيراميك'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo " <div class='card' style='width: 18rem;'>
                                <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>
                                  <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>

                                </div>
                              </div>";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 4 -->
        </div>
        <!-- gallery page 5 -->
        <div id="tm-gallery-page-الجبس" class="tm-gallery-page hidden">
            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم الجبس'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo " <div class='card'  style='width: 18rem; display:flex;'>
                                <img src='$data_technical[image]' class='card-img-top' >
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>
                                  <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>

                                </div>
                              </div>";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 5 -->
        <!-- gallery page 6 -->
        <div id="tm-gallery-page-رخام" class="tm-gallery-page hidden">
            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم الرخام'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo " <div class='card' style='width: 18rem; display:flex;'>
                                <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>
                     <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>

                                </div>
                              </div>";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 6 -->
        <!-- gallery page 7 -->
        <div id="tm-gallery-page-نجاره" class="tm-gallery-page hidden">
            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم النجاره'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo "<div class='card' style='width: 18rem;'>
                                <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>
                                  <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>


                                </div>
                              </div>";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 7 -->
        <!-- gallery page 8 -->
        <div id="tm-gallery-page-الوميتال" class="tm-gallery-page hidden">

            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم الوميتال'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo "
                                <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>
                                  <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>
                                
                                  </div>
                              </div>
                             
                              ";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 8 -->
        <!-- gallery page 9 -->
        <div id="tm-gallery-page-نقاشه" class="tm-gallery-page hidden">


            <?php
            $sql = "SELECT * FROM `technical` WHERE type_of='قسم النقاشه'";
            $q = $conn->prepare($sql);
            $q->execute();
            $data = $q->fetchAll();

            foreach ($data as $data_technical) :
                echo " <div class='card' style='width: 18rem;'>
                                <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>
                                  <button data-id='$data_technical[id]' class='btn btn-outline-primary view_btn'>Information</button>


                                </div>
                              </div>";
            endforeach;
            ?>
            </figcaption>
            </figure>
            </article>
        </div>
        <!-- gallery page 9 -->
        <!-- gallery page 10 -->


        <?php
        $sql = "SELECT * FROM `technical` WHERE type_of='قسم الديكور'";
        $q = $conn->prepare($sql);
        $q->execute();
        $data = $q->fetchAll();

        foreach ($data as $data_technical) :
            echo " 
                        <div class='card' style='width: 18rem;'>
                                <img src='$data_technical[image]' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                  <h6 class='card-title'>$data_technical[type_of]</h6>
                                  <h5 class='card-title'>$data_technical[firstName]</h5>
                                  <p class='card-text'>$data_technical[email]</p>
                                  <button class='add btn btn-outline-primary' client_id='$data_client[id]' data-id='$data_technical[id]'>طلب فني</button>
                                  <button class='btn btn-outline-primary'>$data_client[status]</button>
                                  <button class='btn btn-outline-primary'>$data_technical[status]</button>

                                </div>
                              </div>";
        endforeach;
        ?>

        </article>
        </div>
        <!-- gallery page 10 -->

        </div>
        </div>
        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->




    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 footer-about">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                        <a href="index.php" class="navbar-brand">
                            <h1 class="m-0 text-white"><i class="fa fa-user-tie me-2"></i>الفني المتنوع</h1>
                        </a>
                        <p class="mt-3 mb-4" style="color:white;">Lorem diam sit erat dolor elitr et, diam lorem justo amet clita stet eos
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
                                <p class="mb-0" style="color:white;">ميامي</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0" style="color:white;">ziadm57@yahoo.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0" style="color:white;">+01099475854</p>
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
                                <a class="text-light mb-2" href="index.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
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
                        <p class="mb-0" style="color:white;">&copy; <a class="text-white border-bottom" href="#">فني متنوع</a>. حميع الحقوق محفوظة.

                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <a class="text-white border-bottom" href="https://www.facebook.com/profile.php?id=100010510955629">Ziad Mohamed</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <script src="js/jquery.min.js"></script>
    <script src="js/parallax.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle click on paging links
            $('.tm-paging-link').click(function(e) {
                e.preventDefault();

                var page = $(this).text().toLowerCase();
                $('.tm-gallery-page').addClass('hidden');
                $('#tm-gallery-page-' + page).removeClass('hidden');
                $('.tm-paging-link').removeClass('active');
                $(this).addClass("active");
            });
        });


        // send request and Get Response

        // =========View Data Technical======================

        $(document).ready(function() {
            $('.view_btn').click(function(e) {
                e.preventDefault();
                var tech_id = $(this).data('id');
                $.ajax({
                    url: 'data_technical.php',
                    type: 'POST',
                    data: {
                        tech_id: tech_id
                    },
                    success: function(response) {
                        $('.modal-body').html(response);
                        $('#exampleModal').modal('show')

                    }
                })
            })
        })





        // =========View Data Technical======================
    </script>

    <script src="js/order_data.js"></script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

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