<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once($_SERVER["DOCUMENT_ROOT"].'/cardboard/cbLoader.php');
require_once('autoload.php');

try
{
  $requestM = new cbRequestM();
  $linker = new cb\view\fragment\cbLinkVF('index.php');

  $linker->add('/hook=(.*)&amp;op=show&amp;articleBox=(.*)&amp;article=(.*)&amp;articlePage=(.*)/', function($matches)
  {
    if ($matches[1] == 'trip')
    {
      return $matches[2].'/'.$matches[3].','.(int)$matches[4];
    }
  });

  $linker->add('/hook=(.*)&amp;op=(show)&amp;articleBox=(.*)&amp;boxPage=(.*)/', function($matches)
  {
    return $matches[3].'/'.(int)$matches[4];
  });

  $linker->add('/hook=(.*)&amp;op=(show)&amp;articleBox=(.*)/', function($matches)
  {
    return $matches[3].'/0';
  });


  $pc = new d331C($linker, $requestM);
  $cr = new cbRouterHookC($pc, $requestM);
  $cr->run();
}
catch (Exception $e)
{
  die($e->getMessage());
}

?>
