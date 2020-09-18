<?php
$service_shown = $_POST['service_name'];
function print_set_page($result_page){
  require 'DBI/db.php';
  require 'DBI/dbi.php';
  $service_shown = $_POST['service_name'];
?>
<div class="setting-page-screen">
  <div class="suc-box">
    <p><?php echo $result_page; ?></p>
  </div>
  <div class="description-service">
    <h2>Les Pages</h2>
    <p>Les pages servent à générer deux types de fichiers :</p>
    <ul>
      <li>Votre page, placer à la racine du site comme dans un cas classique ,qui fera appel aux seconde fichier template.</li>
      <li>La template est la zone de travail que nous utiliserons pour générer le contenu de nos page.</li>
    </ul>
  </div>
  <form class="creapage-form" action="printboard.php" method="post">
    <h4>Créer page</h4>
    <input type="hidden" name="service_name" value="<?php echo $service_shown; ?>">
    <input type="hidden" name="crea_page" value="created_page">
    <div class="creapage-ligne">
    <div class="lab-crea-page">
      <label for="nomPage">Nom de la page:</label>
      <input class="specput" id="nomPage" type="text" name="page_name">
    </div>
    <div class="sub-crea-page">
      <input class="sb_crea_page subcea" type="submit" name="fc_sub_crea_page" value="Créer">
    </div>
  </div>
  </form>
</div>
<div class="page-list">
  <h4>Page</h4>
<?php
  $query_get_page = $dbh->prepare('SELECT page_name, page_route_temp FROM page');
  $query_get_page->execute();
  $nbr_get_page = $query_get_page->rowCount();
  if ($nbr_get_page != 0) {
    while ($data_get_page = $query_get_page->fetch()) {
      ?>
      <form class="modif-<?php echo $data_get_page['page_name'];?>" action="printboard.php" method="post">
        <input type="hidden" name="delt_page" value="pagedeleted">
        <input type="hidden" name="service_name" value="<?php echo $service_shown; ?>">
        <input type="hidden" name="deltpage_name" value="<?php echo $data_get_page['page_name']; ?>">
        <div class="allpage-desc">
          <h5><?php echo $data_get_page['page_name'];?></h5>
          <p><?php echo $data_get_page['page_route_temp'];?></p>
        </div>
        <div class="del-spec-page">
          <input class="subcea delcea" type="submit" name="sub_delt_<?php echo $data_get_page['page_name'];?>" value="Supprimer">
        </div>
      </form>
      <?php
    }
  }
  ?>
</div>
  <?php
}

if (!empty($_POST['crea_page'])) {
  if ($_POST['crea_page'] == "created_page") {
    $verif_namepage = false;
    $query_verif_namepage = $dbh->prepare('SELECT page_name FROM page');
    $query_verif_namepage->execute();
    $nb_row_page = $query_verif_namepage->rowCount();
    if ($nb_row_page != 0) {
      while ($data_verif_namepage = $query_verif_namepage->fetch()) {
        if ($_POST['page_name'] == $data_verif_namepage['page_name']) {
          $verif_namepage = true;
        }
      }
        if ($verif_namepage != true) {
          $route_template_inject = "templates/template_".$_POST['page_name'].".php";
          $content_template_inject = "<div><p>Hello</p></div>";
          file_put_contents($route_template_inject, $content_template_inject);
          $route_page_init = "../".$_POST['page_name'].".php";
          $content_page_init = "<?php require 'cgi-print/DBI/db.php'; require 'cgi-print/DBI/dbi.php'; require 'cgi-print/cgi-front.php'; require 'cgi-print/templates/services/function_menu.php'; require 'cgi-print/templates/asset/content/head.php'; require 'cgi-print/templates/template_".$_POST['page_name'].".php'; require 'cgi-print/templates/asset/content/footer.php';?>";
          file_put_contents($route_page_init, $content_page_init);

          $na = "NULL";

          $query_init_page = $dbh->prepare('INSERT INTO page (page_name, page_route_temp, page_link, page_script) VALUES (:name, :route, :link, :script)');
          $query_init_page->bindParam(':name', $_POST['page_name']);
          $query_init_page->bindParam(':route', $route_template_inject);
          $query_init_page->bindParam(':link', $na);
          $query_init_page->bindParam(':script', $na);
          $query_init_page->execute();

          $page_created = "Page créée avec succès";
          print_set_page($page_created);
        }else {
          $page_exist = "La page existe déjà";
          print_set_page($page_exist);          // code...
        }
    }else{
     // la bdd est vide creation direct
     $route_template_inject = "templates/template_".$_POST['page_name'].".php";
     $content_template_inject = "<div><p>Hello</p></div>";
     file_put_contents($route_template_inject, $content_template_inject);
     $route_page_init = "../".$_POST['page_name'].".php";
     $content_page_init = "<?php require 'cgi-print/DBI/db.php'; require 'cgi-print/DBI/dbi.php'; require 'cgi-print/templates/services/function_menu.php'; require 'cgi-print/templates/asset/content/head.php'; require 'cgi-print/templates/template_".$_POST['page_name'].".php'; require 'cgi-print/templates/asset/content/footer.php';?>";
     file_put_contents($route_page_init, $content_page_init);

     $na = "NULL";

     $query_init_page = $dbh->prepare('INSERT INTO page (page_name, page_route_temp, page_link, page_script) VALUES (:name, :route, :link, :script)');
     $query_init_page->bindParam(':name', $_POST['page_name']);
     $query_init_page->bindParam(':route', $route_template_inject);
     $query_init_page->bindParam(':link', $na);
     $query_init_page->bindParam(':script', $na);
     $query_init_page->execute();

     $page_created = "Page créée avec succès";
     print_set_page($page_created);
    }
  }
}elseif(!empty($_POST['delt_page'])){
  if ($_POST['delt_page'] == "pagedeleted") {

    $path_deltemp_page = "templates/template_".$_POST['deltpage_name'].".php";
    $path_del_page = "../".$_POST['deltpage_name'].".php";
    unlink($path_del_page);
    unlink($path_deltemp_page);
    $query_del_page = $dbh->prepare('DELETE FROM page WHERE page_name = :npage ');
    $query_del_page->bindValue(':npage', $_POST['deltpage_name']);
    $query_del_page->execute();
    $page_deleted = "Page supprimé";
    print_set_page($page_deleted);
  }
}else {
  ?>
  <div class="setting-page-screen">
    <div class="description-service">
      <h2>Les Pages</h2>
      <p>Les pages servent à générer deux types de fichiers :</p>
      <ul>
        <li>Votre page, placer à la racine du site comme dans un cas classique ,qui fera appel aux seconde fichier template.</li>
        <li>La template est la zone de travail que nous utiliserons pour générer le contenu de nos page.</li>
      </ul>
    </div>
    <form class="creapage-form" action="printboard.php" method="post">
      <h4>Créer page</h4>
      <input type="hidden" name="service_name" value="<?php echo $service_shown; ?>">
      <input type="hidden" name="crea_page" value="created_page">
      <div class="creapage-ligne">
      <div class="lab-crea-page">
        <label for="nomPage">Nom de la page:</label>
        <input class="specput" id="nomPage" type="text" name="page_name">
      </div>
      <div class="sub-crea-page">
        <input class="subcea sb_crea_page" type="submit" name="sub_crea_page" value="Créer">
      </div>
    </div>
    </form>
  </div>
  <div class="page-list">
    <h4>Page</h4>
  <?php
  $query_get_page = $dbh->prepare('SELECT page_name, page_route_temp FROM page');
  $query_get_page->execute();
  $nbr_get_page = $query_get_page->rowCount();
  if ($nbr_get_page != 0) {
    while ($data_get_page = $query_get_page->fetch()) {
      ?>
      <form class="modif-<?php echo $data_get_page['page_name'];?>" action="printboard.php" method="post">
        <input type="hidden" name="delt_page" value="pagedeleted">
        <input type="hidden" name="service_name" value="<?php echo $service_shown; ?>">
        <input type="hidden" name="deltpage_name" value="<?php echo $data_get_page['page_name']; ?>">
        <div class="allpage-desc">
          <h5><?php echo $data_get_page['page_name'];?></h5>
          <p><?php echo $data_get_page['page_route_temp'];?></p>
        </div>
        <div class="del-spec-page">
          <input class="subcea delcea-<?php echo $data_get_page['page_name'];?>" type="submit" name="sub_delt_<?php echo $data_get_page['page_name'];?>" value="Supprimer">
        </div>
      </form>
      <?php
    }
  }
  ?>
  </div>
  <?php
}
 ?>
