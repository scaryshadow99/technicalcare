<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/remine.css">
    <title>Technical Care</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>




    <div class="wrapper">
        <!-- Start Left Side Customer -->

        <div class="side left">

            <div class="image customer"></div>
            <div class="caption">
                <h1>Client</h1>
                <a href="client_login.php">
                    <span>Client Log In</span>
                    <div class="liquid"></div>

                </a>
            </div>
        </div>
        <!-- End Left Side Customer  -->
        <!-- Start right Side Technician -->
        <div class="side right">

            <div class="image technician"></div>
            <div class="caption">
                <h1>Technician</h1>
                <a href="technical_login.php">
                    <span>Technician Log In</span>
                    <div class="liquid"></div>

                </a>
            </div>

        </div>
        <!-- End right Side Technician -->
        <script src="js/action.js"></script>

    </div>














</body>

</html>