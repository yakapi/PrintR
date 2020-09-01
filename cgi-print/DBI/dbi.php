<?php
$dbh = new PDO('mysql:host='. $host .';dbname='. $dbname, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 ?>
