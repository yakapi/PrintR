<?php

  $query_get_script = $dbh->prepare('SELECT * FROM javascript WHERE where_js = "front"');
  $query_get_script->execute();
  while ($get_script = $query_get_script->fetch()) {
    $lenght_javascript = count($javascript_printr);
    for ($i=0; $i < $lenght_javascript ; $i++) {
      if ($javascript_printr[$i] == $get_script['nom_js']) {
          ?>
          <script type="text/javascript" src="<?php echo $get_script['path_js'] ?>"></script>
          <?php
      }
    }
  }
 ?>
</body>
</html>
