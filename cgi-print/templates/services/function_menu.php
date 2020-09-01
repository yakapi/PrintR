<?php

function print_menu($element){
  require 'cgi-print/DBI/db.php';
  require 'cgi-print/DBI/dbi.php';
  $query_get_menu_screen = $dbh->prepare('SELECT * FROM menu WHERE :menuName = menu_name');
  $query_get_menu_screen->bindValue(':menuName', $element);
  $query_get_menu_screen->execute();
  while ($data_menu_print = $query_get_menu_screen->fetch()) {
    $nameOf_menu = $data_menu_print['menu_name_value'];
    $linkOf_menu = $data_menu_print['menu_link_value'];
    $new_nameOf = explode(',', $nameOf_menu);
    $new_linkOf = explode(',', $linkOf_menu);
    $count_nameOf = count($new_nameOf);
    ?>
    <div class="printer-menu menu-<?php echo $data_menu_print['menu_name']; ?>">
      <ul>
    <?php
    for ($i=0; $i < $count_nameOf-1 ; $i++) {
      ?>
          <li><a href="<?php echo $new_linkOf[$i]; ?>"><p><?php echo $new_nameOf[$i];?></p></a></li>
      <?php
    }
    ?>
  </ul>
</div>
    <?php
  }
}

 ?>
