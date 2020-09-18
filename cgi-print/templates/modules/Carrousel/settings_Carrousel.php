<?php
$nom_du_service = $_POST['module_name'];
require 'DBI/db.php';
require 'DBI/dbi.php';
$pdo = $dbh;
$table = "Carrousel";
function tableExists($pdo, $table) {
  try {
    $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
  } catch (Exception $e) {
    return FALSE;
  }
  return $result !== FALSE;
}

$test = tableExists($pdo, $table);
if ($test == false) {
  echo "pas de db";
  $create = $pdo->prepare("CREATE TABLE carrousel (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name_carrousel VARCHAR(30) NOT NULL,
hauteur_carrousel VARCHAR(30) NOT NULL,
valeur_hauteur VARCHAR(50),
largeur_carrouseul VARCHAR(30) NOT NULL,
valeur_largeur VARCHAR(50),
nb_image VARCHAR(50),
name_image VARCHAR(255),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");
$create->execute();
}
$nom_js = 'carrousel_print';
$type_js = 'front';
$path_js = 'cgi-print/templates/modules/Carrousel/js/carrousel_print.js';
addJavascript($nom_js, $type_js, $path_js, $nom_du_service);

function  affiche_setting_carrousel($service_name){
  ?>
  <h3>Générer des Carrousels</h3>
  <p class="carrousel-info">Pour utiliser les menus dans vos templates ils vous suffit d'utiliser la fonction <span class="spancol">Carrousel()</span> en indiquant le nom de votre carrousel dans la fonction.</p>
  <div class="crea_carrousel">
    <h4>créér carrousel</h4>
    <form class="crea_carrouself" action="printboard.php" method="post">
      <label for="nom_carrousel">Nom du carrousel:</label>
      <input class="specput" id="nom_carrousel" type="text" name="nom_carrousel" value="">
      <label for="nb_image_carrousel">Nombre d'images:</label>
      <input class="specput" id="nb_image_carrousel" type="number" name="nb_image_carrousel" value="">
      <input type="hidden" name="module_name" value="<?php echo $service_name ?>">
      <input class="subcea" type="submit" name="crea_carousel" value="créer">
    </form>
  </div>
  <div class="gest_carrousel">
    <h4>gestion carrousels</h4>
    <div class="encard-gest-carrousel">
      <?php
      require 'DBI/db.php';
      require 'DBI/dbi.php';
        $query_info_carrousel = $dbh->prepare('SELECT * FROM carrousel');
        if ($query_info_carrousel->execute()) {
          while ($get_info = $query_info_carrousel->fetch()) {
            $all_image = $get_info['name_image'];
            $array_image = explode(';', $all_image);
            $lenght_array_image = count($array_image);
            ?>
            <div class="gestion-box">
              <div class="info-gestion">
                <h5><?php echo $get_info['name_carrousel'] ?></h5>
                <p>Hauteur: <?php echo $get_info['hauteur_carrousel']; echo $get_info['valeur_hauteur']; ?></p>
                <p>Largeur: <?php echo $get_info['largeur_carrouseul']; echo $get_info['valeur_largeur']; ?></p>
              </div>
              <div class="image-view">
                <?php for ($i=0; $i < $lenght_array_image - 1 ; $i++) {
                    ?>
                    <div class="encard-image-gest">
                      <img src="templates/modules/Carrousel/images/<?php echo $get_info['name_carrousel'] ?>/<?php echo $array_image[$i]  ?>" alt="<?php echo $array_image[i] ?>">
                    </div>
                    <?php
                } ?>
              </div>
              <form class="form-gestion-carrousel" action="printboard.php" method="post">
                <input type="hidden" name="module_name" value="<?php echo $service_name ?>">
                <input type="hidden" name="del_carrousel" value="delete_carrousel">
                <input type="hidden" name="all_image" value="<?php echo $all_image ?>">
                <input type="hidden" name="name_folder" value="<?php echo $get_info['name_carrousel'] ?>">
                <input class="subcea" type="submit" name="<?php echo $get_info['name_carrousel'] ?>" value="supprimer">
              </form>
            </div>
            <?php
          }
        }else {
          echo 'requete fail';
        }
       ?>
    </div>
  </div>
  <?php
}
function affiche_creation_carrousel($service_name){
  ?>
  <h3>Configuration du carrousel</h3>
  <form class="config_carrousel" action="printboard.php" method="post" enctype="multipart/form-data">
    <div class="ligne_config">
      <label for="hauteur_carrousel">Hauteur:</label>
      <input type="text" name="hauteur_carrousel" value="">
      <select class="select-config" name="select_hauteur">
        <option value="none">Choisir option</option>
        <option value="px">px</option>
        <option value="percent">%</option>
      </select>
    </div>
    <div class="ligne_config">
      <label for="largeur_carrousel">Largeur:</label>
      <input type="text" name="largeur_carrousel" value="">
      <select class="select-config" name="select_largeur">
        <option value="none">Choisir option</option>
        <option value="px">px</option>
        <option value="percent">%</option>
      </select>
    </div>
    <div class="image-ligne">
    <?php
      if (!empty($_POST['nb_image_carrousel'])) {
        for ($i=0; $i < $_POST['nb_image_carrousel']; $i++) {
          ?>
            <div class="zone-image">
              <label for="image-carrousel<?php echo $i ?>">Image <?php echo $i ?></label>
              <input id="image-carrousel<?php echo $i ?>" type="file" name="image<?php echo $i?>" value="">
            </div>
          <?php
        }
      }
     ?>
   </div>
    <input type="hidden" name="module_name" value="<?php echo $service_name ?>">
    <input type="hidden" name="carrousel_created" value="created">
    <input type="hidden" name="name_carrousel" value="<?php echo $_POST['nom_carrousel'] ?>">
    <input type="hidden" name="nb_image_carrousel" value="<?php echo $_POST['nb_image_carrousel'] ?>">
    <input class="subcea" type="submit" name="conf_carousel" value="créer">
  </form>
  <?php
}
?>
<div class="Carrousel-screen">
<?php
if (isset($_POST['nom_carrousel'])) {//si Carrousel créer
  if (!empty($_POST['nom_carrousel'])) {
    $query_exist_carrousel = $dbh->prepare('SELECT name_carrousel FROM carrousel');
    if ($query_exist_carrousel->execute()) {
      $test_exist_carrousel = true;
      while ($if_exist_carrousel = $query_exist_carrousel->fetch()) {
        if ($if_exist_carrousel['name_carrousel'] == $_POST['nom_carrousel']) {
          $test_exist_carrousel = false;
        }
      }
      if ($test_exist_carrousel == true) {
        affiche_creation_carrousel($nom_du_service);// si tous est bon affiche config carrousel
      }else {
        echo 'nom déjà pris';
        affiche_setting_carrousel($nom_du_service);
      }
    }
  }else {
    echo 'vide';//si le champ nom n'est pas rempli
    affiche_setting_carrousel($nom_du_service);
  }
}elseif (isset($_POST['carrousel_created'])) {// Si on affiche les configs
    $test_image = false;
    $test_select_hauteur = false;
    $test_select_largeur = false;
    for ($i=0; $i < $_POST['nb_image_carrousel'] ; $i++) {
      $img = "image".$i;
      if (empty($_FILES[$img])) {
        $test_image = false;
      }else {
        $test_image = true;
      }
    }
    if ($_POST['select_hauteur'] == "px" || $_POST['select_hauteur'] == "percent") {
      $test_select_hauteur= true;
    }
    if ($_POST['select_largeur'] == "px" || $_POST['select_largeur'] == "percent") {
      $test_select_largeur= true;
    }

    // Si Configuration remplit
    if ($test_image == true && !empty($_POST['hauteur_carrousel']) && $test_select_hauteur == true && !empty($_POST['largeur_carrousel']) && $test_select_largeur == true) {
      //creation du dossier des images du carrousel
      $dir_folder = 'templates/modules/Carrousel/images/'.$_POST['name_carrousel'];
      if (!mkdir($dir_folder, 0777, true)) {
        echo('Echec lors de la création des répertoires...');
      }
      //Récupération des informations des images envoyer
      $result_upload = false;
      $img_name_db = '';
      for ($i=0; $i < $_POST['nb_image_carrousel'] ; $i++) {
        $img_file = "image".$i;
        // Si les images existe
        if (isset($_FILES[$img_file])) {
          $extensions = array('.png', '.gif', '.jpg', '.jpeg');
          $extension = strrchr($_FILES[$img_file]['name'], '.');
          if (!in_array($extension, $extensions)) {
            echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
            affiche_setting_carrousel($nom_du_service);
          }else {
            $dir_upload = 'templates/modules/Carrousel/images/'.$_POST['name_carrousel'].'/';
            $fichier = basename($_FILES[$img_file]['name']);
            // Si'lupload a fonctionner
            if(move_uploaded_file($_FILES[$img_file]['tmp_name'], $dir_upload . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
              $img_name_db .= $_FILES[$img_file]['name'].';';
              $result_upload = true;
            }else {//Sinon l'upload a echouer.
              $result_upload = false;
            }
          }
        }
      }
      if ($result_upload == true) {
        $query_carrousel_upload = $dbh->prepare('INSERT INTO carrousel (name_carrousel, hauteur_carrousel, valeur_hauteur, largeur_carrouseul, valeur_largeur, nb_image, name_image) VALUES (?,?,?,?,?,?,?)');
        if ($query_carrousel_upload->execute([$_POST['name_carrousel'],$_POST['hauteur_carrousel'],$_POST['select_hauteur'],$_POST['largeur_carrousel'],$_POST['select_largeur'],$_POST['nb_image_carrousel'],$img_name_db])) {
          echo 'Carrousel Créer !';
          affiche_setting_carrousel($nom_du_service);
        }else{
          echo 'Echec database';
          affiche_setting_carrousel($nom_du_service);
        }
      }else{
        echo "Upload Echoué";
        affiche_setting_carrousel($nom_du_service);
      }
    }else {// Erreur dans la configuration

      echo "parametre non renseigne";
      affiche_creation_carrousel($nom_du_service);
    }
}elseif (isset($_POST['del_carrousel'])) {
    if ($_POST['del_carrousel'] == "delete_carrousel") {
      $path_del_carrousel = 'templates/modules/Carrousel/images/'. $_POST['name_folder'];
      $del_all_image = $_POST['all_image'];
      $array_del_image = explode(';', $del_all_image);
      $lenght_del_image = count($array_del_image);
      for ($i=0; $i < $lenght_del_image - 1 ; $i++) {
        $path_del_fichier = 'templates/modules/Carrousel/images/'. $_POST['name_folder'] .'/'. $array_del_image[$i];
        unlink($path_del_fichier);
      }
      if (rmdir($path_del_carrousel)) {
        $query_del_carrousel = $dbh->prepare('DELETE FROM carrousel WHERE name_carrousel = :name_carrousel');
        $query_del_carrousel->bindValue(':name_carrousel', $_POST['name_folder']);
        if ($query_del_carrousel->execute()) {
          echo 'Carrousel supprimer';
        }else {
          echo 'erreur suppression db';
        }
      }else {
        echo 'erreur suppression';
      }
      affiche_setting_carrousel($nom_du_service);
    }
}else {//sinon affiche normal setting
  affiche_setting_carrousel($nom_du_service);
}
 ?>

</div>
