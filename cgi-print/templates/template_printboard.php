<?php
if ($_SESSION['login'] == $data['login'] && $_SESSION['password'] == $data['password'] && $data['role'] == 'administrateur') {
  if (!empty($_POST)) {
    if (!empty($_POST['action_creamod'])) {
      if ($_POST['action_creamod'] == "createdmod") {
        if(!empty($_POST['creamod_name']))
        $verif_namemod = false;
        $query_verif_namemod = $dbh->prepare('SELECT module_name from module');
        $query_verif_namemod->execute();
        while ($data_verif_namemod = $query_verif_namemod->fetch()) {
          if ($_POST['creamod_name'] == $data_verif_namemod['module_name']) {
            $verif_namemod = true;
          }
        }
        if ($verif_namemod != true) {
          //Creation fichier module
          $alaligne = "\n";
          $path_folder_mod = "templates/modules/".$_POST['creamod_name'];
          mkdir($path_folder_mod);
          $route_inject = "templates/modules/".$_POST['creamod_name']."/functions_".$_POST['creamod_name'].".php";
          $content_inject = '<?php //$add_javascript_printr = array_push($javascript_printr, "js name")'.$alaligne.' function '.$_POST['creamod_name'].'(){'.$alaligne.'}?>';
          file_put_contents($route_inject, $content_inject);
          $route_inject_setting = "templates/modules/".$_POST['creamod_name']."/settings_".$_POST['creamod_name'].".php";
          $content_inject_setting = '<?php$nom_du_service = $_POST["module_name"]; '.$alaligne.'require "DBI/db.php";'.$alaligne.' require "DBI/dbi.php";?>'.$alaligne.'<div class="'.$_POST['creamod_name'].'-screen"></div>';
          file_put_contents($route_inject_setting, $content_inject_setting);
          $query_new_module = $dbh->prepare('INSERT INTO module (module_name, module_route, module_route_view, module_describe) VALUES (:name, :route, :routeview, :describe)');
          $query_new_module->bindParam(':name', $_POST['creamod_name']);
          $query_new_module->bindParam(':route', $route_inject_setting);
          $query_new_module->bindParam(':routeview', $route_inject);
          $query_new_module->bindParam(':describe', $_POST['describe_namemod']);
          $query_new_module->execute();
        }
      }
    }elseif (!empty($_POST['action_gestmod'])) {
      if ($_POST['action_gestmod'] == "modifymod") {
        //suprimer fichier
        $path_del_dirmod = 'templates/modules/'.$_POST['del_namemod'];
        $path_del_functionsmod = 'templates/modules/'.$_POST['del_namemod'].'/functions_'.$_POST['del_namemod'].'.php';
        $path_del_settingsmod = 'templates/modules/'.$_POST['del_namemod'].'/settings_'.$_POST['del_namemod'].'.php';
        unlink($path_del_settingsmod);
        unlink($path_del_functionsmod);
        rmdir($path_del_dirmod);
        $query_delmod = $dbh->prepare('DELETE FROM module WHERE module_name = :namemod');
        $query_delmod->bindValue(':namemod', $_POST['del_namemod']);
        $query_delmod->execute();
        $query_delmod_js = $dbh->prepare('DELETE FROM javascript WHERE nom_module = :nommod');
        $query_delmod_js->bindValue(':nommod', $_POST['del_namemod']);
        $query_delmod_js->execute();
      }
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="fr" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>PrintR Board</title>
      <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="templates/asset/css/toolbox.css">
      <link rel="stylesheet" href="print-style.css">
      <link rel="stylesheet" href="templates/asset/css/setting-style.css">
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
