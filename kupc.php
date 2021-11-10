<?php

error_reporting(E_ALL ^ E_NOTICE);
require_once($_SERVER["DOCUMENT_ROOT"].'/cardboard/cbLoader.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/cardboard.kupc/autoload.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/'.CB_KUPC_ROOT.'kupcR.php');

try
{
  $k = new kupcR(null, null, './view/generic/css/cssTags.css', 'kupc.php');
  $k->run();
}
catch(Exception $e)
{
  die($e->getMessage());
}

?>
