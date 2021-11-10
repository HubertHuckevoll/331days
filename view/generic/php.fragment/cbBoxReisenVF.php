<?php
namespace view\generic\fragment;

class cbBoxReisenVF extends \cb\view\fragment\cbBoxVF
{
  /* Create the index page
    _________________________________________________________________
  */
	public function render()
	{
	  $articleList = $this->data['articleList'];

	  /* Create the index page
	    _________________________________________________________________
	  */
	  if (is_countable($articleList) && count($articleList) > 0)
	  {
	    $erg .= '<ul class="tripList">';
	    foreach($articleList as $artObj)
	    {
	      $http = $this->linker->cbArticleLink($this->ep, $this->articleHook, $artObj['articleBox'], $artObj['articleName']);
	      $erg .= '<li class="'.$artObj['articleBox'].'"><a href="'.$http.'">'.$artObj['headline'].'</a>&nbsp;('.$this->fDate($artObj['date']).')<br>'.$artObj['aAbstract'].'... <a href="'.$http.'">(mehr)</a></li>';
	    }
	    $erg .= '</ul>';

			$erg .= $this->pageNumbers();
	  }
	  else
	  {
	    $erg = '<ul id="tripList"><li>Diese Reiseberichte werden bald eingestellt.</li></ul>';
	  }

	  $erg .= '<div style="text-align: center;"><a href="index.php">Zur&uuml;ck zur Startseite</a></div>';

	  return $erg;
	}
}

?>