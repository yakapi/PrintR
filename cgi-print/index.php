<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PrintR Connect</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="templates/asset/css/toolbox.css">
    <link rel="stylesheet" href="print-style.css">
  </head>
  <body>
    <div class="connect-screen rltv">
      <h1 class="logo-title-printr ablst">
        <div class="encard-logo-print">
          <?php require 'templates/asset/img/logrint.php'; ?>
        </div>
      </h1>
      <div class="connect-content w-100 h-100 flx-ac rltv">
        <div class="connect-form-container rltv">
          <div class="poincon w-100 flx-ac ablst">
            <div class="encard-poincon">
              <?php require 'templates/asset/img/log-p.php'; ?>
            </div>
          </div>
          <form class="connect_printboard_form" action="printboard.php" method="post">
            <div class="put-ligne">
              <label class="lab-con-print" for="login-print">Login :</label>
              <input id="login-print" class="in_connect_printboard" placeholder="Login :" type="text" name="login_printboard">
            </div>
            <div class="put-ligne">
              <label class="lab-con-print" for="password-print">Password :</label>
              <input id="password-print" class="in_connect_printboard" placeholder="Password :"type="password" name="password_printboard">
            </div>
            <div class="put-ligne">
              <input type="hidden" name="set_cook" value="launchook">
              <input class="connect_printboard curs-p" type="submit" name="connect_printboard" value="connexion">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
