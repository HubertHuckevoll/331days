<?php

/**
 * Auto loader
 * ________________________________________________________________
 */
spl_autoload_register(function($className)
{
  $fname = null;
  $ct = substr($className, -1);

  switch($ct)
  {
    case 'F':
    case 'P':
      $parts = explode("\\", $className);
      if ($parts[0] != 'cb')
      {
        $comp = $parts[0];
        $ui = $parts[1];
        $type = $parts[2];
        $class = $parts[3];

        $fname = '.'.DIRECTORY_SEPARATOR.$comp.DIRECTORY_SEPARATOR.$ui.DIRECTORY_SEPARATOR.'php.'.$type.DIRECTORY_SEPARATOR.$class.'.php';
      }
    break;

    case 'C':
      $fname = '.'.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.$className.'.php';
    break;
  }

  if (file_exists($fname))
  {
    require_once($fname);
  }

});

?>