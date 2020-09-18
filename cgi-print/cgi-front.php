<?php
//Fonction appel module
function require_module($nom_module){
  require 'cgi-print/templates/modules/'.$nom_module.'/functions_'.$nom_module.'.php';
}
 ?>
