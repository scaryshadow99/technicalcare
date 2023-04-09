

<?php
include 'conn.php';


// Validation Login
// validation Login Email
if (isset($_POST['submit_login'])) {
    $login_email = $_POST['login_email'];
    $login_pass = md5($_POST['login_pass']);
    if (empty($login_email)) {
        $error['login_email'] = " The Email Is Required";
    }
    // validation Login Email

    // validation Login Password
    if (empty($login_pass)) {
        $error['login_pass'] = " The Password Is Required";
    }

    if (empty($error)) {
        $sql = "SELECT * FROM `technical`WHERE  `email`='$login_email'";
        $q = $conn->prepare($sql);
        $q->execute();
        $data = $q->fetch();

        if (!$data) {
            $error['login_email'] = "The email is wrong";
        } else {
            $password_hash = $data['pass'];
            if ($login_pass !==   $password_hash) {
                $error['login_pass'] = "The Password is wrong";
            } else {

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
        }
    }
}
// validation  Login Password

// Validation Login 









?>

