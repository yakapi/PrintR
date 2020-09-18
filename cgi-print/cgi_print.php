<?php
if ($_SESSION['login'] == $data['login'] && $_SESSION['password'] == $data['password'] && $data['role'] == 'administrateur') {
  function get_toolbar(){
    require 'DBI/db.php';
    require 'DBI/dbi.php';
    ?>
    <!-- Container Module -->
    <div class="module-container">
      <!-- Bouton Module Creation -->
      <div class="module-titre-container">
        <form class="form-mod-create" action="printboard.php" method="post">
          <div class="module-titre-block">
            <p>Module</p>
            <p id="more-module" class="curs-p">+</p>
          </div>
          <input type="hidden" name="create_mod" value="creamod">
          <div id="modtitcrea" class="module-titre-create ovh">
            <input id="creat-mod" class="lab-mod-crea w-100" type="submit" name="sub-crea-mod" value="Créer Mod.">
          </div>
        </form>
      </div>
      <!-- Récupération des nom de module-->
      <?php
      $query_name_module = $dbh->prepare('SELECT module_name FROM module');
      $query_name_module_inject = $query_name_module->execute();
      while ($data_name_module = $query_name_module->fetch()) {
        ?>
        <form class="form_<?php echo $data_name_module['module_name'];?>" action="printboard.php" method="post">
          <label for="sub_<?php echo $data_name_module['module_name']; ?>">
            <div class="toolbar_box curs-p">
              <p><?php echo $data_name_module['module_name'];?></p>
            </div>
          </label>
          <input type="hidden" name="module_name" value="<?php echo $data_name_module['module_name'];?>">
          <input id="sub_<?php echo $data_name_module['module_name'];?>" style="display:none;" type="submit" name="sub_<?php echo $data_name_module['module_name'];?>" value="envoie">
        </form>
        <?php
      }
      ?>
    </div>
    <!-- Container Service -->
    <div class="service-container">
      <!-- Bouton Module Creation -->
      <div class="service-titre-container">
        <div class="service-titre-block">
          <p>Service</p>
        </div>
      </div>
      <!-- Récupération des nom de module -->
      <?php
        $query_name_service = $dbh->prepare('SELECT service_name FROM service');
        $query_name_service_inject = $query_name_service->execute();
        while ($data_name_service = $query_name_service->fetch()) {
          ?>
          <form class="form_<?php echo $data_name_service['service_name'];?>" action="printboard.php" method="post">
            <label for="sub_<?php echo $data_name_service['service_name']; ?>">
              <div class="toolbar_box curs-p">
                <p><?php echo $data_name_service['service_name'];?></p>
              </div>
            </label>
            <input type="hidden" name="service_name" value="<?php echo $data_name_service['service_name'];?>">
            <input id="sub_<?php echo $data_name_service['service_name'];?>" style="display:none;" type="submit" name="sub_<?php echo $data_name_service['service_name'];?>" value="envoie">
          </form>
          <?php
        }
       ?>
    </div>
    <?php
  }

  function get_toolscreen(){
    if (!empty($_POST)) {
      if (!empty($_POST['module_name'])) {
        require 'DBI/db.php';
        require 'DBI/dbi.php';
        $query_module_screen = $dbh->prepare("SELECT * FROM module");
        $query_mod_screen_inject = $query_module_screen->execute();
        while ($data_mod_screen = $query_module_screen->fetch()) {
          if ($_POST['module_name'] == $data_mod_screen['module_name']) {
            require $data_mod_screen['module_route'];
          }
        }
      }elseif (!empty($_POST['service_name'])) {
        require 'DBI/db.php';
        require 'DBI/dbi.php';
        $query_service_screen = $dbh->prepare('SELECT * FROM service');
        $query_serv_screen_inject = $query_service_screen->execute();
        while ($data_serv_screen = $query_service_screen->fetch()) {
          if ($_POST['service_name'] == $data_serv_screen['service_name']) {
            require $data_serv_screen['service_route'];
          }
        }
      }elseif (!empty($_POST['create_mod'])) {
        if ($_POST['create_mod'] == "creamod") {
          require 'templates/modules/setting_creamod.php';
        }
      }else {
        require 'templates/asset/content/set_dash.php';
      }
    }else {
      require 'templates/asset/content/set_dash.php';
    }


  }
  // Fonction pour ajouter script js dans la db
  function addJavascript($nom_js, $type_js, $path_js, $nom_module){
    require 'DBI/db.php';
    require 'DBI/dbi.php';
    $test_js_carrousel = true;
    $query_carrousel_test_js = $dbh->prepare('SELECT nom_js FROM javascript');
    if ($query_carrousel_test_js->execute()) {
      while ($test_carrousel_js = $query_carrousel_test_js->fetch()) {
        if ($test_carrousel_js['nom_js'] == $nom_js) {
          $test_js_carrousel = false;
        }
      }
    }

    if ($test_js_carrousel == true) {
      $query_insert_js = $dbh->prepare('INSERT INTO javascript (nom_js, where_js, path_js, nom_module) VALUES (?,?,?,?)');
      $query_insert_js->execute([$nom_js, $type_js, $path_js, $nom_module]);
    }
  }


}else{
  echo "you're not the admin ! get out of here !";
}
