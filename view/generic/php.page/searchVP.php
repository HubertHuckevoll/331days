<?php

namespace view\generic\page;

class searchVP extends cbPage331VP
{
  /**
   * Search
   * ________________________________________________________________
   */
  protected function mainContent()
  {
    $pv = new \cb\view\fragment\cbSearchVF($this->ep, $this->hook, $this->linker);
    $pv->data = $this->data['results'];

    return $pv->render();
  }
}

?>
