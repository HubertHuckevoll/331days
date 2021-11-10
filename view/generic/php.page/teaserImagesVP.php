<?php
namespace view\generic\page;
class teaserImagesVP extends \cb\view\page\cbPageVP
{
  /**
   * render teaserImagesV
   * _________________________________________________________________
   */
  public function drawPage($errMsg = '')
  {
    $pv = new \cb\view\fragment\cbArticleTeasersVF($this->ep, 'trip', $this->linker);
    $pv->data = $this->data;

    echo $pv->render();
  }

}

?>
