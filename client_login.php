<?php
session_start();
include 'conn.php';
include 'validation_client.php';


$f_name = $l_name = $num = $email = $pass = '';
$login_email = $login_pass =  '';

if (isset($_POST['submit_register'], $_POST["g-recaptcha-response"])) {





    $secret = "6LcdxxUlAAAAALzAtKzl0dVAjBnuBAYbiLpX5Fwf";
    $response = $_POST["g-recaptcha-response"];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $response;
    $recaptcha = json_decode(file_get_contents($url));
    if ($recaptcha->success) {


        $f_name = htmlspecialchars(strip_tags($_POST['f_name']));
        $l_name = htmlspecialchars(strip_tags($_POST['l_name']));
        $num = strip_tags($_POST['num']);
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
        $error = [];


        if (empty($f_name)) {
            $error['f_name'] = " The Name Is Required";
        } elseif (empty($l_name)) {
            $error['l_name'] = " The Last Name Is Required";
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $f_name)) {
            $error['f_name'] = "LastName Must Be letters And Spaces only";
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $l_name)) {
            $error['l_name'] = "LastName Must Be letters And Spaces only";
        } else {
            echo $f_name = htmlspecialchars(strip_tags($_POST['f_name']));
        }
        // validation f_Name And l_name
        // validation Number
        if (empty($num)) {
            $error['num'] = " The Number Is Required";
        } elseif (strlen($num) < 11 || strlen($num) > 11) {
            $error['num'] = "Please Enter More Than 11 Char";
        }
        // validation Number



        // validation Email
        if (empty($email)) {
            $error['email'] = " The Email Is Required";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL) == false) {
            $error['email'] = " The Email Is Not Valid";
        }
        // check The Email Is Exist  
        $sql = "SELECT email FROM `client` WHERE `email`= '$email'";
        $q = $conn->prepare($sql);
        $q->execute();
        $data = $q->fetchAll();
        if ($data) {
            $error['email'] = " email exists in database";
        }
        $sql = "SELECT phone FROM `client` WHERE `email`= '$num'";
        $q = $conn->prepare($sql);
        $q->execute();
        $data = $q->fetchAll();
        if ($data) {
            $error['num'] = " Phone exists in database";
        }

        // print_r($data);
        // check The Email Is Exist  
        // validation Email




        if (empty($pass)) {
            $error['pass'] = " The Password Is Required";
        } elseif (strlen($pass) < 10) {
            $error['pass'] = "You must type a more complex password";
        }
        // validation Forms 

        if (empty($error)) {
            $sql = "INSERT INTO `client`( `firstName`, `lastName`, `phone`,`email`,`pass`,`ROLE`) VALUES ('$f_name','$l_name','$num','$email','$pass','USER')";
            $conn->exec($sql);
            $_SESSION['client'] = [
                "f_name" => $f_name,
                "l_name" => $l_name,
                "email" => $email,
                "num" => $num,
                "id" => $id
            ];
            header('location:index.php');
        }
    } else {
        $error["captcha"] = "Please check the captcha";
    }
} //End Of Post Check



?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/remine.css">
    <!-- script Captcha  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- script Captcha  -->

    <title>Client_Login</title>
    <style>
        .errors {
            color: red;
            font-size: 15px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .captcha {
            position: relative;
            bottom: -50px;
            transform: translate(-30px);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="inner-box" id="card">
                <!-- Start LogIn -->

                <div class="card-front">
                    <h2>LogIn For Client</h2>
                    <form action="client_login.php" method="POST">
                        <div class="input_1">
                            <input type="email" name="login_email" placeholder="Ente Your Email" class="input-box">
                            <?php
                            if (isset($error['login_email'])) {

                                echo "<div class='errors'>" . $error['login_email'] . "</div>";
                            };        ?>
                        </div>
                        <div class="input_2">
                            <input type="password" name="login_pass" placeholder="Enter Your password" class="input-box">
                            <?php
                            if (isset($error['login_pass'])) {

                                echo "<div class='errors'>" . $error['login_pass'] . "</div>";
                            };        ?>
                        </div>
                        <button type="submit" name="submit_login" value="Login" class="submit-btn">Submit</button>
                        <input type="checkbox"><span>Remember Me</span>
                        <!-- Important connect with methods -->
                        <div class="icons">

                        </div>
                        <!-- Important connect with methods -->

                    </form>
                    <button type="button" class="btn" onclick="openRegister()">I'm New Here</button>
                    <a href="">Forget Password</a>
                </div>
                <!-- End LogIn -->

                <!-- Start Client Register -->

                <div class="card-back" style=" text-align: center;">




                    <h2>Register For Client</h2>

                    <form action="client_login.php" class="inputs" method="POST">
                        <div id="input_1">
                            <input type="text" name="f_name" id="valid_1" placeholder="Enter Your First Name" class="input-box" value="<?php echo  $f_name ?>">
                            <div class='errors'>
                                <?php
                                if (isset($error['f_name'])) {

                                    echo "<div class='errors'>" . $error['f_name'] . "</div>";
                                };        ?>

                            </div>
                            <div class="input2">
                                <input type="text" name="l_name" placeholder="Enter Your Last Name" class="input-box" value="<?php echo  htmlspecialchars($l_name); ?>">
                                <?php
                                if (isset($error['l_name'])) {

                                    echo "<div class='errors'>" . $error['l_name'] . "</div>";
                                };        ?>
                            </div>
                            <div class="input3">
                                <input type="number" name="num" placeholder="Enter Your Phone" class="input-box" value="<?php echo htmlspecialchars($num); ?>">
                                <?php
                                if (isset($error['num'])) {

                                    echo "<div class='errors'>" . $error['num'] . "</div>";
                                };        ?>
                            </div>
                            <div class="input4">
                                <input type="email" name="email" placeholder="Enter Your Email" class="input-box" value="<?php echo htmlspecialchars($email); ?>">
                                <?php
                                if (isset($error['email'])) {

                                    echo "<div class='errors'>" . $error['email'] . "</div>";
                                };        ?>
                            </div>
                            <div class="input5">
                                <input type="password" name="pass" placeholder="Enter Your password" class="input-box" value="<?php echo  htmlspecialchars($pass); ?>">
                                <?php
                                if (isset($error['pass'])) {

                                    echo "<div class='errors'>" . $error['pass'] . "</div>";
                                };        ?>
                            </div>
                            <button type="submit" name="submit_register" class="submit-btn" id="sub">Submit</button>
                            <div class="captcha">
                                <div class="g-recaptcha" data-sitekey="6LcdxxUlAAAAAL-1xq5cBRq0QeDRnaMOECAdz_db"></div>
                                <?php
                                if (isset($error['captcha'])) {

                                    echo "<div class='errors'>" . $error['captcha'] . "</div>";
                                };        ?>
                                <br />

                            </div>
                            <!-- Important connect with methods -->
                    </form>
                    <button type="button" class="btn" id="btn_error" onclick="openLogin()">I've an account</button>
                </div>


                Start Client Register

            </div>
        </div>

    </div>

    <script src="js/action.js"></script>


</body>

</html>