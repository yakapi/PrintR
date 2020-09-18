<?php
if (!empty($_POST)) {
  require 'DBI/db.php';
  require 'DBI/dbi.php';
  if (!empty($_POST['action_creamod'])) {
    if ($_POST['action_creamod'] == "createdmod") {
      if (!empty($_POST['creamod_name'])) {
        // $verif_namemod = false;
        // $query_verif_namemod = $dbh->prepare('SELECT module_name from module');
        // $query_verif_namemod->execute();
        // while ($data_verif_namemod = $query_verif_namemod->fetch()) {
        //   if ($_POST['creamod_name'] == $data_verif_namemod['module_name']) {
        //     $verif_namemod = true;
        //   }
        // }
        if ($verif_namemod != true) {
          // $path_folder_mod = "templates/modules/".$_POST['creamod_name'];
          // mkdir($path_folder_mod);
          // $route_inject = "templates/modules/".$_POST['creamod_name']."/functions_".$_POST['creamod_name'].".php";
          // $content_inject = 'function my_function(){}';
          // file_put_contents($route_inject, $content_inject);
          // $route_inject_setting = "templates/modules/".$_POST['creamod_name']."/settings_".$_POST['creamod_name'].".php";
          // $content_inject_setting = '<div class="'.$_POST['creamod_name'].'-screen"></div>';
          // file_put_contents($route_inject_setting, $content_inject_setting);
          // $query_new_module = $dbh->prepare('INSERT INTO module (module_name, module_route, module_route_view, module_describe) VALUES (:name, :route, :routeview, :describe)');
          // $query_new_module->bindParam(':name', $_POST['creamod_name']);
          // $query_new_module->bindParam(':route', $route_inject_setting);
          // $query_new_module->bindParam(':routeview', $route_inject);
          // $query_new_module->bindParam(':describe', $_POST['describe_namemod']);
          // $query_new_module->execute();
          ?>
          <div class="setting-creamod">
            <div class="result-box">
              <p class="clrd">Module créer avec succès !</p>
            </div>
            <h3>Générer un Module</h3>
            <p>Une fois le module créer, un fichier au nom de votre module sera créer dans le dossier module du CGI et ainsi vous pourrer commencez à développer votre module qui s'affichera ensuite dans la barre des module du printboard.</p>

            <div class="ceamod-box">
              <h4>créer module</h4>
              <form class="cea-form" action="printboard.php" method="post">
                <input type="hidden" name="create_mod" value="creamod">
                <input type="hidden" name="action_creamod" value="createdmod">
                <div class="encard-label-ceamod">
                  <label for="creamod-name">Nom du module:</label>
                  <input class="specput" id="creamod-name" type="text" name="creamod_name">
                </div>
                <div class="encard-label-ceamod">
                  <label for="describe_namemod">Bref description :</label>
                  <textarea class="specput" id="describe_namemod" name="describe_namemod" rows="1" cols="20"></textarea>
                </div>
                <input type="submit"class="subcea" name="sub_creamod" value="créer">
              </form>
            </div>
            <div class="allmod-box">
              <h4>gestion modules</h4>
              <?php
              $query_getset_allmod = $dbh->prepare('SELECT module_name, module_describe FROM module');
              $query_getset_allmod->execute();
              while ($data_getsetmod = $query_getset_allmod->fetch()) {
                ?>
                <form class="" action="printboard.php" method="post">
                  <input type="hidden" name="create_mod" value="creamod">
                  <input type="hidden" name="action_gestmod" value="modifymod">
                  <input type="hidden" name="del_namemod" value="<?php echo $data_getsetmod['module_name'];?>">
                  <div class="label-delmod">
                    <p class="gestmodtit"><?php echo $data_getsetmod['module_name'];?></p>
                    <p><?php echo $data_getsetmod['module_describe'];?></p>
                  </div>
                  <input class="subcea" type="submit" name="del-<?php echo $data_getsetmod['module_name'] ?>" value="supprimer">
                </form>
                <?php
              }
               ?>
            </div>
          </div>

          <?php
        }else {
            // le module existe déja
            ?>
            <div class="setting-creamod">
              <div class="result-box">
                <p class="clrd">Le module existe déja.</p>
              </div>
              <h3>Générer un Module</h3>
              <p>Une fois le module créer, un fichier au nom de votre module sera créer dans le dossier module du CGI et ainsi vous pourrer commencez à développer votre module qui s'affichera ensuite dans la barre des module du printboard.</p>

              <div class="ceamod-box">
                <h4>créer module</h4>
                <form class="cea-form" action="printboard.php" method="post">
                  <input type="hidden" name="create_mod" value="creamod">
                  <input type="hidden" name="action_creamod" value="createdmod">
                  <div class="encard-label-ceamod">
                    <label for="creamod-name">Nom du module:</label>
                    <input class="specput" id="creamod-name" type="text" name="creamod_name">
                  </div>
                  <div class="encard-label-ceamod">
                    <label for="describe_namemod">Bref description :</label>
                    <textarea class="specput" id="describe_namemod" name="describe_namemod" rows="1" cols="20"></textarea>
                  </div>
                  <input type="submit"class="subcea" name="sub_creamod" value="créer">
                </form>
              </div>
              <div class="allmod-box">
                <h4>gestion modules</h4>
                <?php
                $query_getset_allmod = $dbh->prepare('SELECT module_name, module_describe FROM module');
                $query_getset_allmod->execute();
                while ($data_getsetmod = $query_getset_allmod->fetch()) {
                  ?>
                  <form class="" action="printboard.php" method="post">
                    <input type="hidden" name="create_mod" value="creamod">
                    <input type="hidden" name="action_gestmod" value="modifymod">
                    <input type="hidden" name="del_namemod" value="<?php echo $data_getsetmod['module_name'];?>">
                    <div class="label-delmod">
                      <p class="gestmodtit"><?php echo $data_getsetmod['module_name'];?></p>
                      <p><?php echo $data_getsetmod['module_describe'];?></p>
                    </div>
                    <input class="subcea" type="submit" name="del-<?php echo $data_getsetmod['module_name'] ?>" value="supprimer">
                  </form>
                  <?php
                }
                 ?>
              </div>
            </div>
            <?php
        }
      }else {
        // vous n'avez pas entrer de nom pour votre module
        ?>
        <div class="setting-creamod">
          <div class="result-box">
            <p class="clrd">vous n'avez pas entrer de nom pour votre module</p>
          </div>
          <h3>Générer un Module</h3>
          <p>Une fois le module créer, un fichier au nom de votre module sera créer dans le dossier module du CGI et ainsi vous pourrer commencez à développer votre module qui s'affichera ensuite dans la barre des module du printboard.</p>

          <div class="ceamod-box">
            <h4>créer module</h4>
            <form class="cea-form" action="printboard.php" method="post">
              <input type="hidden" name="create_mod" value="creamod">
              <input type="hidden" name="action_creamod" value="createdmod">
              <div class="encard-label-ceamod">
                <label for="creamod-name">Nom du module:</label>
                <input class="specput" id="creamod-name" type="text" name="creamod_name">
              </div>
              <div class="encard-label-ceamod">
                <label for="describe_namemod">Bref description :</label>
                <textarea class="specput" id="describe_namemod" name="describe_namemod" rows="1" cols="20"></textarea>
              </div>
              <input type="submit"class="subcea" name="sub_creamod" value="créer">
            </form>
          </div>
          <div class="allmod-box">
            <h4>gestion modules</h4>
            <?php
            $query_getset_allmod = $dbh->prepare('SELECT module_name, module_describe FROM module');
            $query_getset_allmod->execute();
            while ($data_getsetmod = $query_getset_allmod->fetch()) {
              ?>
              <form class="" action="printboard.php" method="post">
                <input type="hidden" name="create_mod" value="creamod">
                <input type="hidden" name="action_gestmod" value="modifymod">
                <input type="hidden" name="del_namemod" value="<?php echo $data_getsetmod['module_name'];?>">
                <div class="label-delmod">
                  <p class="gestmodtit"><?php echo $data_getsetmod['module_name'];?></p>
                  <p><?php echo $data_getsetmod['module_describe'];?></p>
                </div>
                <input class="subcea" type="submit" name="del-<?php echo $data_getsetmod['module_name'] ?>" value="supprimer">
              </form>
              <?php
            }
             ?>
          </div>
        </div>
        <?php
      }
    }
  }elseif (!empty($_POST['action_gestmod'])){
    if ($_POST['action_gestmod'] == "modifymod") {


      // $path_del_dirmod = 'templates/modules/'.$_POST['del_namemod'];
      // $path_del_functionsmod = 'templates/modules/'.$_POST['del_namemod'].'/functions_'.$_POST['del_namemod'].'.php';
      // $path_del_settingsmod = 'templates/modules/'.$_POST['del_namemod'].'/settings_'.$_POST['del_namemod'].'.php';
      // unlink($path_del_settingsmod);
      // unlink($path_del_functionsmod);
      // rmdir($path_del_dirmod);
      // $query_delmod = $dbh->prepare('DELETE FROM module WHERE module_name = :namemod');
      // $query_delmod->bindValue(':namemod', $_POST['del_namemod']);
      // $query_delmod->execute();

      ?>
      <div class="setting-creamod">
        <div class="result-box">
          <p class="clrd">Le module a été supprimer</p>
        </div>
        <h3>Générer un Module</h3>
        <p>Une fois le module créer, un fichier au nom de votre module sera créer dans le dossier module du CGI et ainsi vous pourrer commencez à développer votre module qui s'affichera ensuite dans la barre des module du printboard.</p>

        <div class="ceamod-box">
          <h4>créer module</h4>
          <form class="cea-form" action="printboard.php" method="post">
            <input type="hidden" name="create_mod" value="creamod">
            <input type="hidden" name="action_creamod" value="createdmod">
            <div class="encard-label-ceamod">
              <label for="creamod-name">Nom du module:</label>
              <input class="specput" id="creamod-name" type="text" name="creamod_name">
            </div>
            <div class="encard-label-ceamod">
              <label for="describe_namemod">Bref description :</label>
              <textarea class="specput" id="describe_namemod" name="describe_namemod" rows="1" cols="20"></textarea>
            </div>
            <input type="submit"class="subcea" name="sub_creamod" value="créer">
          </form>
        </div>
        <div class="allmod-box">
          <h4>gestion modules</h4>
          <?php
          $query_getset_allmod = $dbh->prepare('SELECT module_name, module_describe FROM module');
          $query_getset_allmod->execute();
          while ($data_getsetmod = $query_getset_allmod->fetch()) {
            ?>
            <form class="" action="printboard.php" method="post">
              <input type="hidden" name="create_mod" value="creamod">
              <input type="hidden" name="action_gestmod" value="modifymod">
              <input type="hidden" name="del_namemod" value="<?php echo $data_getsetmod['module_name'];?>">
              <div class="label-delmod">
                <p class="gestmodtit"><?php echo $data_getsetmod['module_name'];?></p>
                <p><?php echo $data_getsetmod['module_describe'];?></p>
              </div>
              <input class="subcea" type="submit" name="del-<?php echo $data_getsetmod['module_name'] ?>" value="supprimer">
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
    <div class="setting-creamod">
      <h3>Générer un Module</h3>
      <p>Une fois le module créer, un fichier au nom de votre module sera créer dans le dossier module du CGI et ainsi vous pourrer commencez à développer votre module qui s'affichera ensuite dans la barre des module du printboard.</p>

      <div class="ceamod-box">
        <h4>créer module</h4>
        <form class="cea-form" action="printboard.php" method="post">
          <input type="hidden" name="create_mod" value="creamod">
          <input type="hidden" name="action_creamod" value="createdmod">
          <div class="encard-label-ceamod">
            <label for="creamod-name">Nom du module:</label>
            <input class="specput" id="creamod-name" type="text" name="creamod_name">
          </div>
          <div class="encard-label-ceamod">
            <label for="describe_namemod">Bref description :</label>
            <textarea class="specput" id="describe_namemod" name="describe_namemod" rows="1" cols="20"></textarea>
          </div>
          <input type="submit"class="subcea" name="sub_creamod" value="créer">
        </form>
      </div>
      <div class="allmod-box">
        <h4>gestion modules</h4>
        <?php
        $query_getset_allmod = $dbh->prepare('SELECT module_name, module_describe FROM module');
        $query_getset_allmod->execute();
        while ($data_getsetmod = $query_getset_allmod->fetch()) {
          ?>
          <form class="" action="printboard.php" method="post">
            <input type="hidden" name="create_mod" value="creamod">
            <input type="hidden" name="action_gestmod" value="modifymod">
            <input type="hidden" name="del_namemod" value="<?php echo $data_getsetmod['module_name'];?>">
            <div class="label-delmod">
              <p class="gestmodtit"><?php echo $data_getsetmod['module_name'];?></p>
              <p><?php echo $data_getsetmod['module_describe'];?></p>
            </div>
            <input class="subcea" type="submit" name="del-<?php echo $data_getsetmod['module_name'] ?>" value="supprimer">
          </form>
          <?php
        }
         ?>
      </div>
    </div>
    <?php
  }
}

 ?>
