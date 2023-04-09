

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
    $sql = "SELECT * FROM `client`WHERE  `email`='$login_email'";
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
        if ($data['ROLE'] == "USER") {
          $_SESSION['client'] = [
            "f_name" => $data['firstName'],
            "l_name" => $data['lastName'],
            "email" => $data['email'],
            "id" => $data['id'],
          ];

          header('location:index.php');
        } elseif ($data['ROLE'] == "ADMIN") {
          $_SESSION['admin'] = [
            "f_name" => $data['firstName'],
            "l_name" => $data['lastName'],
            "email" => $data['email'],
            "id" => $data['id'],
          ];

          header('location:admin/index.php');
        }
      }
    }
  }
}
// validation  Login Password

// Validation Login 









?>

