<?php
  $add_javascript_printr = array_push($javascript_printr, 'carrousel_print');
  function Carrousel($name){
    require 'cgi-print/DBI/db.php';
    require 'cgi-print/DBI/dbi.php';
    $query_get_carrousel = $dbh->prepare('SELECT * FROM carrousel WHERE name_carrousel = :name');
    $query_get_carrousel->bindValue(':name', $name);
    $query_get_carrousel->execute();
    while ($get_carrousel = $query_get_carrousel->fetch()) {
      $get_all_img_carrousel = $get_carrousel['name_image'];
      $array_all_img_carrousel = explode(';', $get_all_img_carrousel);
      $lenght_all_img_carrousel = count($array_all_img_carrousel);
      $largeur_value = "";
      $hauteur_value = "";
      if ($get_carrousel['valeur_largeur'] == 'percent') {
        $largeur_value = "%";
      }else {
        $largeur_value = "px";
      }
      if ($get_carrousel['valeur_hauteur'] == 'percent') {
        $hauteur_value = "%";
      }else {
        $hauteur_value = "px";
      }
    ?>
    <div class="encard-carrousel">
        <div class="carrousel_print carrousel-<?php echo $get_carrousel['name_carrousel'] ?>" style="min-width: <?php echo $get_carrousel['largeur_carrouseul'].$largeur_value; ?>; min-height: <?php  echo $get_carrousel['hauteur_carrousel'].$hauteur_value?>;position: relative; overflow: hidden;">
          <?php
            for ($i=0; $i < $lenght_all_img_carrousel - 1; $i++) {
              ?>
              <div class="encard-image-carrousel" style="position: absolute; transition: all 1.2s ease-in-out; width: <?php echo $get_carrousel['largeur_carrouseul'].$largeur_value; ?>; height: <?php echo $get_carrousel['hauteur_carrousel'].$hauteur_value ?>">
                <img style="width: 100%; height: 100%; object-fit: cover" src="cgi-print/templates/modules/Carrousel/images/<?php echo $get_carrousel['name_carrousel'] ?>/<?php echo $array_all_img_carrousel[$i] ?>" alt="<?php echo $array_all_img_carrousel[$i] ?>">
              </div>
              <?php
            }
           ?>
        </div>
    </div>
    <?php
  }

}

?>
