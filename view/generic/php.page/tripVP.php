<?php

namespace view\generic\page;

class tripVP extends cbPage331VP
{
  public $viewHints = array();

  /**
   * metadata
   * ________________________________________________________________
   */
  protected function additionalHeadData()
  {
    $pv = new \cb\view\fragment\cbArticleMetadataVF($this->ep, $this->hook, $this->linker);
    $pv->addDataFromArray($this->data['article']['model']);
    $pv->addDataFromArray($this->data['article']['meta']);

    return $pv->render();
  }

  /**
   * sidebar
   * ________________________________________________________________
   */
  protected function sidebar()
  {
    $pv = new \cb\view\fragment\cbArticleNavigationVF($this->ep, $this->hook, $this->linker);
    $pv->data = $this->data['article'];

    return $pv->render();
  }

  /**
   *
   * ________________________________________________________________
   */
  protected function mainContent()
  {
    $pv = new \view\generic\fragment\cbArticleReiseVF($this->ep, $this->hook, $this->linker);
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
    $pv = new \cb\view\fragment\cbCommentsVF($this->ep, $this->hook, $this->linker);

    $this->data['comments']['meta']['pageCount'] = $this->data['article']['meta']['pageCount'];

    $pv = new \view\generic\fragment\cbCommentsReiseVF($this->ep, $this->hook);
    $pv->addDataFromArray($this->data['comments']['model']);
    $pv->addDataFromArray($this->data['comments']['meta']);

    $viewOp = $this->data['comments']['meta']['viewOp'];
    return $this->exec($pv, $viewOp);
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
