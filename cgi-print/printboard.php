<?php
session_start();
  // error_reporting(E_ALL ^ E_NOTICE);
  require 'DBI/db.php';
  require 'DBI/dbi.php';

if (!empty($_POST)) {
  if (!empty($_POST['set_cook'])) {
    if ($_POST['set_cook'] == "launchook") {
      $login = $_POST['login_printboard'];
      $password = $_POST['password_printboard'];
      $passcrypt = md5($password);

      $_SESSION['login'] = $login;
      $_SESSION['password'] = $passcrypt;
    }
  }
}

  $admin_role = 'administrateur';
  $query = $dbh->prepare('SELECT * from users');
  $inject = $query->execute();
  while ($data = $query->fetch()) {

    if ($_SESSION['login'] == $data['login'] && $_SESSION['password'] == $data['password'] && $data['role'] == 'administrateur') {
      require 'cgi_print.php';
      require 'templates/template_printboard.php';
    }else{
      echo "you're not the admin ! get out of here !";
    }

  }

  // $ifCook = $_POST['set_cook'];
  // if ($ifCook == "launchook") {
  //   $login = $_POST['login_printboard'];
  //   $password = $_POST['password_printboard'];
  //   $passcrypt = md5($password);
  //
  //   setcookie('login-c', $login, time()+36000);
  //   setcookie('pass-c', $passcrypt, time()+36000);
  // }
  //
  // $l_cook = $_COOKIE['login-c'];
  // $p_cook = $_COOKIE['pass-c'];
 ?>
