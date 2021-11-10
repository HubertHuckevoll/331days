<?php

namespace view\generic\page;

class articleVP extends cbPage331VP
{
  public $viewHints = array();

  /**
   *
   * ________________________________________________________________
   */
  protected function mainContent()
  {
    $pv = new \cb\view\fragment\cbArticleClassicStyle1VF($this->ep, $this->hook, $this->linker);

    $pv->viewHints = $this->viewHints;
    $pv->addDataFromArray($this->data['article']['model']);
    $pv->addDataFromArray($this->data['article']['meta']);

    return $pv->render();
  }

  /**
   *
   * ________________________________________________________________
   */
  protected function additionalContent()
  {
    if (isset($this->data['comments']))
    {
      $pv = new \cb\view\fragment\cbCommentsV($this->ep, $this->hook, $this->linker);

      $this->data['comments']['meta']['pageCount'] = $this->data['article']['meta']['pageCount'];

      $pv = new \cb\view\cbCommentsV($this->hook, $this->ep);
      $pv->addDataFromArray($this->data['comments']['model']);
      $pv->addDataFromArray($this->data['comments']['meta']);

      $viewOp = $this->data['comments']['meta']['viewOp'];
      return $this->exec($pv, $viewOp);
    }
    else
    {
      return '';
    }
  }

  /**
   *
   * ________________________________________________________________
   */
  public function drawAjax()
  {
    echo $this->additionalContent();
  }
}

?>
