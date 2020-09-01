<?php
if ($_SESSION['login'] == $data['login'] && $_SESSION['password'] == $data['password'] && $data['role'] == 'administrateur') {
  ?>

  <!DOCTYPE html>
  <html lang="fr" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>PrintR Board</title>
      <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="templates/asset/css/toolbox.css">
      <link rel="stylesheet" href="print-style.css">
    </head>
    <body>
      <div class="printboard-screen rltv">
        <!-- TopBar -->
        <div class="top-bar-printboard w-100">
          <div class="encard-logo-top-bar">
            <?php require 'templates/asset/img/logrint.php'; ?>
          </div>
          <div class="top-bar-menu">
            <a class="btn-print2 m-bar" href="../index.php">Website</a>
          </div>
        </div>
        <!-- LeftBar -->
        <div class="left-bar-printboard">
          <?php get_toolbar(); ?>
        </div>
        <!-- Setting Screen -->
        <div class="setting-block w-100 h-100">
        <div class="setting-screen pall-15">
            <?php get_toolscreen(); ?>

        </div>
        <div class="copyright-lab">
          <p class="clw fw-b">All right reserved to PrintR.Co / Copyright <?php echo date('Y'); ?></p>
          <div class="encard-copyright">
            <?php require 'templates/asset/img/logrint.php'; ?>
          </div>
        </div>
      </div>
    </div>
      <script type="text/javascript" src="dash.js"></script>
    </body>
  </html>

  <?php
}else{
  echo "you're not the admin ! get out of here !";
}

 ?>
