<?php
$nom_du_service = $_POST['service_name'];
if (!empty($_POST['to_creamenu_screen'])) {
  if ($_POST['to_creamenu_screen'] == "creamenu_screen") {
    $nb_onglet = $_POST['crea_onglet_menu'];
    $type_lia = $_POST['crea_liaison_menu'];
    if (empty($_POST['crea_name_menu']) || empty($_POST['crea_onglet_menu']) || empty($_POST['crea_liaison_menu']) ) {
      ?>
      <div class="setting-menu-screen">
        <div class="response-menu">
          <p>veuillez remplir les champs.</p>
        </div>
        <h3>MENU</h3>
        <p>Pour utiliser les menus dans vos templates ils vous suffit d'utiliser la fonction <span class="clrd">print_menu()</span> en indiquant le nom de votre menu dans la fonction.</p>
        <p>exemple: <span class="clrd">print_menu</span>('navigation');</p>
        <div class="crea-menu">
          <h4>créer menu</h4>
          <form class="crea-menu-form" action="printboard.php" method="post">
            <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
            <input type="hidden" name="to_creamenu_screen" value="creamenu_screen">
            <div class="encard-menu-ligne">

              <div class="crea-menu-ligne mall-15">
                <label for="crea-name-menu">Nom du menu :</label>
                <input class="specput" id="crea-name-menu" type="text" name="crea_name_menu">
              </div>
              <div class="crea-menu-ligne">
                <label for="crea-onglet-menu">Nombre d'onglet :</label>
                <input class="specput" id="crea-onglet-menu" type="number" name="crea_onglet_menu">
              </div>
              <div class="crea-menu-ligne">
                <label for="crea-liaison-menu">Type de liaison :</label>
                <select id="crea-liaison-menu" class="specput" name="crea_liaison_menu">
                  <option value="">Select :</option>
                  <option value="menutype_page">Page</option>
                  <option value="menutype_perso">Liens custom</option>
                </select>
              </div>
            </div>
            <input class="subcea mall-15" type="submit" name="sub_crea_menu" value="Créer">
          </form>
        </div>
        <div class="menu-list">
          <?php
          $query_gest_menu = $dbh->prepare('SELECT menu_name, menu_name_value FROM menu');
          $query_gest_menu->execute();
          while ($data_gest_menu = $query_gest_menu->fetch()) {
            ?>
            <form class="del-from form-list-<?php echo $data_gest_menu['menu_name']; ?>" action="printboard.php" method="post">
              <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
              <input type="hidden" name="supp_menu" value="menu_deleted">
              <input type="hidden" name="named_menu" value="<?php echo $data_gest_menu['menu_name'] ?>">
              <div class="lab-delmenu">
                <h5><?php echo $data_gest_menu['menu_name']; ?></h5>
                <p><?php echo $data_gest_menu['menu_name_value']; ?></p>
              </div>
              <input class="subcea" type="submit" name="sub_del_menu_<?php echo $data_gest_menu['menu_name']; ?>" value="supprimer">
            </form>
            <?php
          }
           ?>
        </div>
      </div>
      <?php
    }else {      // code...
      ?>
      <div class="setting-menu-screen">
        <h3>MENU</h3>
        <p>Pour utiliser les menus dans vos templates ils vous suffit d'utiliser la fonction <span class="clrd">print_menu()</span> en indiquant le nom de votre menu dans la fonction.</p>
        <p>exemple: <span class="clrd">print_menu</span>('navigation');</p>
        <div class="complet-crea-menu">
          <h5 class="clrd"><?php echo $_POST['crea_name_menu']; ?></h5>
          <?php
          if ($type_lia == "menutype_page") {
            $name_menu = $_POST['crea_name_menu'];
            ?>
            <h6>Choisissez vos page</h6>
            <form class="form-creamenu-end" action="printboard.php" method="post">
              <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
              <input type="hidden" name="creamenu_lastep" value="finished_menu">
              <input type="hidden" name="numb_onglet" value="<?php echo $nb_onglet; ?>">
              <input type="hidden" name="menu_type" value="page">
              <input type="hidden" name="menu_name_r" value="<?php echo $name_menu; ?>">
              <?php
              for ($i=0; $i <  $nb_onglet; $i++) {
                ?>
                <div class="labend-creamenu">
                  <label for="onglet-name<?php echo $i; ?>">Onglet #<?php echo $i; ?></label>
                  <input id="onglet-name<?php echo $i; ?>" type="text" name="onglet_name_<?php echo $i; ?>">
                  <select class="specput creamenu-select-end" name="select_creamenu_<?php echo $i; ?>">
                    <option value="">Select</option>
                <?php
                $query_select_page = $dbh->prepare('SELECT page_name FROM page');
                $query_select_page->execute();
                while ($data_select_page = $query_select_page->fetch()) {
                  // code...
                  ?>
                  <option value="<?php echo $data_select_page['page_name']; ?>"><?php echo $data_select_page['page_name']; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
                <?php
              }
              ?>
              <input class="subcea" type="submit" name="sub_crea_menuend" value="Enregister">
            </form>
            <?php
          }
          if ($type_lia == "menutype_perso") {
            $name_menu = $_POST['crea_name_menu'];
            ?>
            <h6>Entrez vos liens :</h6>
            <form class="form-creamenu-end" action="printboard.php" method="post">
              <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
              <input type="hidden" name="creamenu_lastep" value="finished_menu">
              <input type="hidden" name="numb_onglet" value="<?php echo $nb_onglet; ?>">
              <input type="hidden" name="menu_type" value="perso">
              <input type="hidden" name="menu_name_r" value="<?php echo $name_menu; ?>">
              <?php
              for ($i=0; $i <  $nb_onglet; $i++) {
                ?>
                <div class="labend-creamenu">
                  <label for="onglet-name<?php echo $i; ?>">Onglet #<?php echo $i; ?></label>
                  <input id="onglet-name<?php echo $i; ?>" type="text" name="onglet_name_<?php echo $i; ?>">
                  <label for="onglet-link<?php echo $i; ?>">Lien #<?php echo $i; ?></label>
                  <input id="onglet-link<?php echo $i; ?>" type="text" name="onglet_link_<?php echo $i; ?>">
            </div>
                <?php
              }
              ?>
              <input class="subcea" type="submit" name="sub_crea_menuend" value="Enregister">
            </form>
            <?php
          }
          ?>
        </div>
        <div class="menu-list">

        </div>
      </div>
      <?php
    }
  }
}else if (!empty($_POST['creamenu_lastep'])) {
  if ($_POST['creamenu_lastep'] == "finished_menu") {
    $numb_onglet = $_POST['numb_onglet'];
    $menu_name_value = "";
    $menu_link_value = "";
    if ($_POST['menu_type'] == "perso") {
        for ($i=0; $i < $numb_onglet; $i++) {
          $menu_name_value .= $_POST['onglet_name_'.$i] . ",";
          $menu_link_value .= $_POST['onglet_link_'.$i] . ",";
        }
        $nameMenu = $_POST['menu_name_r'];
        $query_init_creamenu = $dbh->prepare('INSERT INTO menu (menu_name, menu_name_value, menu_link_value) VALUES (:name, :name_value, :link_value)');
        $query_init_creamenu->bindParam(':name', $nameMenu);
        $query_init_creamenu->bindParam(':name_value', $menu_name_value);
        $query_init_creamenu->bindParam(':link_value', $menu_link_value);
        $query_init_creamenu->execute();

    }
    if ($_POST['menu_type'] == "page") {
      for ($i=0; $i < $numb_onglet; $i++) {
        $menu_name_value .= $_POST['onglet_name_'.$i] . ",";
        $menu_link_value .= $_POST['select_creamenu_'.$i] . ".php,";
      }
      $nameMenu = $_POST['menu_name_r'];
      $query_init_creamenu = $dbh->prepare('INSERT INTO menu (menu_name, menu_name_value, menu_link_value) VALUES (:name, :name_value, :link_value)');
      $query_init_creamenu->bindParam(':name', $nameMenu);
      $query_init_creamenu->bindParam(':name_value', $menu_name_value);
      $query_init_creamenu->bindParam(':link_value', $menu_link_value);
      $query_init_creamenu->execute();
    }
    ?>
    <div class="setting-menu-screen">
      <h3>MENU</h3>
      <p>Pour utiliser les menus dans vos templates ils vous suffit d'utiliser la fonction <span class="clrd">print_menu()</span> en indiquant le nom de votre menu dans la fonction.</p>
      <p>exemple: <span class="clrd">print_menu</span>('navigation');</p>
      <div class="crea-menu">
        <h4>créer menu</h4>
        <form class="crea-menu-form" action="printboard.php" method="post">
          <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
          <input type="hidden" name="to_creamenu_screen" value="creamenu_screen">
          <div class="encard-menu-ligne">

            <div class="crea-menu-ligne mall-15">
              <label for="crea-name-menu">Nom du menu :</label>
              <input class="specput" id="crea-name-menu" type="text" name="crea_name_menu">
            </div>
            <div class="crea-menu-ligne">
              <label for="crea-onglet-menu">Nombre d'onglet :</label>
              <input class="specput" id="crea-onglet-menu" type="number" name="crea_onglet_menu">
            </div>
            <div class="crea-menu-ligne">
              <label for="crea-liaison-menu">Type de liaison :</label>
              <select id="crea-liaison-menu" class="specput" name="crea_liaison_menu">
                <option value="">Select :</option>
                <option value="menutype_page">Page</option>
                <option value="menutype_perso">Liens custom</option>
              </select>
            </div>
          </div>
          <input class="subcea mall-15" type="submit" name="sub_crea_menu" value="Créer">
        </form>
      </div>
      <div class="menu-list">
        <?php
        $query_gest_menu = $dbh->prepare('SELECT menu_name, menu_name_value FROM menu');
        $query_gest_menu->execute();
        while ($data_gest_menu = $query_gest_menu->fetch()) {
          ?>
          <form class="del-from form-list-<?php echo $data_gest_menu['menu_name']; ?>" action="printboard.php" method="post">
            <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
            <input type="hidden" name="supp_menu" value="menu_deleted">
            <input type="hidden" name="named_menu" value="<?php echo $data_gest_menu['menu_name'] ?>">
            <div class="lab-delmenu">
              <h5><?php echo $data_gest_menu['menu_name']; ?></h5>
              <p><?php echo $data_gest_menu['menu_name_value']; ?></p>
            </div>
            <input class="subcea" type="submit" name="sub_del_menu_<?php echo $data_gest_menu['menu_name']; ?>" value="supprimer">
          </form>
          <?php
        }
         ?>
      </div>
    </div>
    <?php
  }
}else if (!empty($_POST['supp_menu'])){
  if ($_POST['supp_menu'] == "menu_deleted") {
    $nom_du_menu = $_POST['named_menu'];
    $query_del_page = $dbh->prepare('DELETE FROM menu WHERE menu_name = :nmenu ');
    $query_del_page->bindValue(':nmenu', $_POST['named_menu']);
    $query_del_page->execute();
    ?>
    <div class="setting-menu-screen">
      <div class="response-menu">
        <p>Menu Suprimmer</p>
      </div>
      <h3>MENU</h3>
      <p>Pour utiliser les menus dans vos templates ils vous suffit d'utiliser la fonction <span class="clrd">print_menu()</span> en indiquant le nom de votre menu dans la fonction.</p>
      <p>exemple: <span class="clrd">print_menu</span>('navigation');</p>
      <div class="crea-menu">
        <h4>créer menu</h4>
        <form class="crea-menu-form" action="printboard.php" method="post">
          <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
          <input type="hidden" name="to_creamenu_screen" value="creamenu_screen">
          <div class="encard-menu-ligne">

            <div class="mall-15 crea-menu-ligne">
              <label for="crea-name-menu">Nom du menu :</label>
              <input class="specput" id="crea-name-menu" type="text" name="crea_name_menu">
            </div>
            <div class="crea-menu-ligne">
              <label for="crea-onglet-menu">Nombre d'onglet :</label>
              <input class="specput" id="crea-onglet-menu" type="number" name="crea_onglet_menu">
            </div>
            <div class="crea-menu-ligne">
              <label for="crea-liaison-menu">Type de liaison :</label>
              <select id="crea-liaison-menu" class="specput" name="crea_liaison_menu">
                <option value="">Select :</option>
                <option value="menutype_page">Page</option>
                <option value="menutype_perso">Liens custom</option>
              </select>
            </div>
          </div>
          <input class="mall-15 subcea" type="submit" name="sub_crea_menu" value="Créer">
        </form>
      </div>
      <div class="menu-list">
        <?php
        $query_gest_menu = $dbh->prepare('SELECT menu_name, menu_name_value FROM menu');
        $query_gest_menu->execute();
        while ($data_gest_menu = $query_gest_menu->fetch()) {
          ?>
          <form class="del-from form-list-<?php echo $data_gest_menu['menu_name']; ?>" action="printboard.php" method="post">
            <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
            <input type="hidden" name="supp_menu" value="menu_deleted">
            <input type="hidden" name="named_menu" value="<?php echo $data_gest_menu['menu_name'] ?>">
            <div class="lab-delmenu">
              <h5><?php echo $data_gest_menu['menu_name']; ?></h5>
              <p><?php echo $data_gest_menu['menu_name_value']; ?></p>
            </div>
            <input class="subcea" type="submit" name="sub_del_menu_<?php echo $data_gest_menu['menu_name']; ?>" value="supprimer">
          </form>
          <?php
        }
         ?>
      </div>
    </div>
    <?php
  }
}else {
  ?>
  <div class="setting-menu-screen">
    <h3>MENU</h3>
    <p>Pour utiliser les menus dans vos templates ils vous suffit d'utiliser la fonction <span class="clrd">print_menu()</span> en indiquant le nom de votre menu dans la fonction.</p>
    <p>exemple: <span class="clrd">print_menu</span>('navigation');</p>
    <div class="crea-menu">
      <h4>créer menu</h4>
      <form class="crea-menu-form" action="printboard.php" method="post">
        <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
        <input type="hidden" name="to_creamenu_screen" value="creamenu_screen">
        <div class="mall-15 encard-menu-ligne">

          <div class="crea-menu-ligne">
            <label for="crea-name-menu">Nom du menu :</label>
            <input class="specput" id="crea-name-menu" type="text" name="crea_name_menu">
          </div>
          <div class="crea-menu-ligne">
            <label for="crea-onglet-menu">Nombre d'onglet :</label>
            <input class="specput" id="crea-onglet-menu" type="number" name="crea_onglet_menu">
          </div>
          <div class="crea-menu-ligne">
            <label for="crea-liaison-menu">Type de liaison :</label>
            <select id="crea-liaison-menu" class="specput" name="crea_liaison_menu">
              <option value="">Select :</option>
              <option value="menutype_page">Page</option>
              <option value="menutype_perso">Liens custom</option>
            </select>
          </div>
        </div>
        <input class="mall-15 subcea" type="submit" name="sub_crea_menu" value="Créer">
      </form>
    </div>
    <div class="menu-list">
      <?php
      $query_gest_menu = $dbh->prepare('SELECT menu_name, menu_name_value FROM menu');
      $query_gest_menu->execute();
      while ($data_gest_menu = $query_gest_menu->fetch()) {
        ?>
        <form class="del-from form-list-<?php echo $data_gest_menu['menu_name']; ?>" action="printboard.php" method="post">
          <input type="hidden" name="service_name" value="<?php echo $nom_du_service; ?>">
          <input type="hidden" name="supp_menu" value="menu_deleted">
          <input type="hidden" name="named_menu" value="<?php echo $data_gest_menu['menu_name'] ?>">
          <div class="lab-delmenu">
            <h5><?php echo $data_gest_menu['menu_name']; ?></h5>
            <p><?php echo $data_gest_menu['menu_name_value']; ?></p>
          </div>
          <input class="subcea" type="submit" name="sub_del_menu_<?php echo $data_gest_menu['menu_name']; ?>" value="supprimer">
        </form>
        <?php
      }
       ?>
    </div>
  </div>
  <?php
}



 ?>
