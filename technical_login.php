<?php
session_start();
include 'conn.php';
include 'validation_technical.php';
$f_name = $l_name = $num = $email = $pass = $typeof = '';

if (isset($_POST['submit'], $_POST["g-recaptcha-response"])) {
    // Captcha Secure
    $secret = "6LcdxxUlAAAAALzAtKzl0dVAjBnuBAYbiLpX5Fwf";
    $response = $_POST["g-recaptcha-response"];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $response;
    $recaptcha = json_decode(file_get_contents($url));
    // Captcha Secure
    if ($recaptcha->success) {

        $f_name = htmlspecialchars(strip_tags($_POST['f_name']));
        $l_name = htmlspecialchars(strip_tags($_POST['l_name']));
        $num = $_POST['num'];
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);
        $typeof = $_POST['typeof'];
        $error = [];

        // validation first and last Name

        if (empty($f_name)) {
            $error['f_name'] = " The Name Is Required";
        } elseif (empty($l_name)) {
            $error['l_name'] = " The Last Name Is Required";
        } else {
            $f_name = htmlspecialchars(strip_tags($_POST['f_name']));
        }
        // validation first and last Name


        // validation Number
        if (empty($num)) {
            $error['num'] = " The Number Is Required";
        } elseif (strlen($num) < 11 || strlen($num) > 11) {
            $error['num'] = "Please Enter More Than 11 Char";
        }
        // validation Number
        // validation email

        if (empty($email)) {
            $error['email'] = " The Email Is Required";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL) == false) {
            $error['email'] = " The Email Is Not Valid";
        }
        // check The Email Is Exist  
        $sql = "SELECT email FROM `technical` WHERE `email`= '$email'";
        $q = $conn->prepare($sql);
        $q->execute();
        $data = $q->fetchAll();
        if ($data) {
            $error['email'] = " email exists in database";
        }
        // validation email
        // validation Password
        if (empty($pass)) {
            $error['pass'] = " The Password Is Required";
        } elseif (strlen($pass) < 10) {
            $error['pass'] = "You must type a more complex password";
        }
        // validation password
        // Upload Images
        $fileName = $_FILES["upload"]["name"];
        $tempName = $_FILES["upload"]["tmp_name"];
        $image_error = $_FILES["upload"]["error"];
        $folder = "image/" . $fileName;
        echo "<img src='$folder' width ='100px' height='100px'>";
        move_uploaded_file($tempName, $folder);

        // Validation  Upload Images
        if ($image_error[0] == 4) {
            $error['image'] = "No File Uploaded";
        }
        // Validation  Upload Images


        // Upload Images

        if (empty($error)) {
            $sql = "INSERT INTO `technical`( `firstName`, `lastName`, `email`, `pass`,  `type_of`,`phone`,`image`,`status`) VALUES ('$f_name','$l_name','$email','$pass','$typeof','$num','$folder','Available')";
            $conn->exec($sql);;

            $_SESSION['technical'] = [
                "f_name" =>  $data['firstName'],
                "l_name" =>  $data['lastName'],
                "email" =>  $data['email'],
                "phone" =>  $data['phone'],
                "type_of" =>  $data['type_of'],
                "id" =>  $data['id'],
            ];
            header('location:home.php');
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
    <link rel="stylesheet" href="css/all.css">
    <!-- script Captcha  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- script Captcha  -->
    <title>Technical_Login</title>


    <style>
        .selected_work {
            display: flex;
            justify-content: center;
            position: relative;
            min-width: 250px;
            height: 40px;
            margin-top: 5px;
        }

        .select-box {
            border: none;
            appearance: none;
            padding: 0 30px 0 15px;
            width: 100%;
            color: white;
            background-color: #001e5747;
            text-align: center;
            font-size: 20px;
            font-family: fantasy;
            font-weight: 600;
        }

        .selected_work .icon-container {
            width: 50px;
            height: 100%;
            position: absolute;
            right: -35px;
        }

        .errors {
            color: red;
            text-align: center;
            font-size: 15px;
            margin: 0px;
        }

        .captcha {
            position: relative;
            margin: -25px;
            bottom: -30px;
            transform: translate(0px);
        }
    </style>

</head>

<body>


    <div class="container">
        <div class="card">
            <div class="inner-box" id="card">
                <!-- Start LogIn -->

                <div class="card-front">
                    <h2>LogIn For Technical</h2>
                    <form action="technical_login.php" method="POST">

                        <div class="input_1">
                            <input type="email" name="login_email" placeholder="Enter Your Email" class="input-box" required>

                            <?php
                            if (isset($error['login_email'])) {

                                echo "<div class='errors'>" . $error['login_email'] . "</div>";
                            };        ?>
                        </div>
                        <div class="input_2">
                            <input type="password" name="login_pass" placeholder="Enter Your password" class="input-box" required>
                            <?php
                            if (isset($error['login_pass'])) {

                                echo "<div class='errors'>" . $error['login_pass'] . "</div>";
                            };        ?>
                        </div>
                        <button type="submit" name="submit_login" class="submit-btn">Submit</button>

                        <!-- Important connect with methods -->

                        <!-- Important connect with methods -->

                    </form>
                    <button type="button" class="btn" onclick="openRegister()">I'm New Here</button>
                    <a href="">Forget Password</a>
                </div>
                <!-- End LogIn -->

                <!-- Start Client Register -->
                <div class="card-back">

                    <h2>Register For Technical</h2>
                    <form action="technical_login.php" method="POST" enctype="multipart/form-data">
                        <div class="input_1">
                            <input type="text" name="f_name" placeholder="Enter Your Name" class="input-box">
                            <?php
                            if (isset($error['f_name'])) {

                                echo "<div class='errors'>" . $error['f_name'] . "</div>";
                            };        ?>
                        </div>

                        <div class="input_2">
                            <input type="text" name="l_name" placeholder="Enter Your Last Name" class="input-box">
                            <?php
                            if (isset($error['l_name'])) {

                                echo "<div class='errors'>" . $error['l_name'] . "</div>";
                            };        ?>
                        </div>

                        <div class="input_3">
                            <input type="email" name="email" placeholder="Enter Your Email" class="input-box">
                            <?php
                            if (isset($error['email'])) {

                                echo "<div class='errors'>" . $error['email'] . "</div>";
                            };        ?>
                        </div>

                        <div class="input_4">
                            <input type="number" name="num" placeholder="Enter Your Number" class="input-box">
                            <?php
                            if (isset($error['num'])) {

                                echo "<div class='errors'>" . $error['num'] . "</div>";
                            };        ?>
                        </div>

                        <div class="input_5">
                            <input type="password" name="pass" placeholder="Enter Your password" class="input-box">
                        </div>
                        <div class="input_5">
                            <input type="file" name="upload" placeholder="" class="">
                            <?php
                            if (isset($error['image'])) {

                                echo "<div class='errors'>" . $error['image'] . "</div>";
                            };        ?>
                        </div>



                        <div class="selected_work" id="select">
                            <select name="typeof" class="select-box">
                                <option value="قسم النقاشه">قسم النقاشه</option>
                                <option value="قسم النجاره"> قسم النجاره</option>
                                <option value="قسم الديكور"> قسم الديكور</option>
                                <option value="قسم الوميتال"> قسم الوميتال</option>
                                <option value="قسم المحاره"> قسم المحاره</option>
                                <option value="قسم الكهرباء"> قسم الكهرباء </option>
                                <option value="قسم السيراميك"> قسم السيراميك</option>
                                <option value="قسم السباكه">قسم السباكه</option>
                                <option value="قسم الرخام">قسم الرخام</option>
                                <option value="قسم الجبس">قسم الجبس</option>
                            </select>
                            <div class="icon-container" id="btn">
                                <i class="fa-solid fa-circle-chevron-down"></i>
                            </div>
                        </div>




                        <button type="submit" name="submit" class="submit-btn">Submit</button>

                        <div class="captcha">
                            <div class="g-recaptcha" data-sitekey="6LcdxxUlAAAAAL-1xq5cBRq0QeDRnaMOECAdz_db"></div>
                            <?php
                            if (isset($error['captcha'])) {

                                echo "<div class='errors'>" . $error['captcha'] . "</div>";
                            };        ?>
                            <br />

                        </div>
                    </form>
                    <button type="button" class="btn" onclick="openLogin()">I've an account</button>
                    <a href="">Forget Password</a>

                </div>
                <!-- Start Client Register -->

            </div>
        </div>

    </div>


    <script src="js/action.js"></script>























</body>


</html>