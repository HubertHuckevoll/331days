<?php
namespace view\generic\page;

class listArticlesVP extends cbPage331VP
{
  public $articleHook = '';

  public function mainContent()
  {
		$pv = new \view\generic\fragment\cbBoxReisenVF($this->ep, $this->hook, $this->articleHook, $this->linker);
		$pv->addDataFromArray($this->data['mainContent']['model']);
		$pv->addDataFromArray($this->data['mainContent']['meta']);

		return $pv->render();
  }

}

?>
