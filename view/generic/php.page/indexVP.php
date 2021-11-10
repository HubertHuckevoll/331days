<?php
namespace view\generic\page;

class indexVP extends cbPage331VP
{
  public $teaserArt = array();

  public function mainContent()
  {
    $pv = new \cb\view\fragment\cbArticleClassicStyle1VF($this->ep, 'index');
    $pv->data = $this->data['teaser'];
    $erg = '<div class="block">'.$pv->renderArticleBody().'</div>';

    foreach($this->data['articles'] as $articleBoxAlias => $mrasOfBox)
    {
      $articleBoxName = $mrasOfBox[0]['articleBox'];
      $erg .= '<h2>'.$articleBoxName.'</h2>';
      $erg .= '<ul class="tripList">';

      foreach($mrasOfBox as $mra)
      {
        if ($mra['aAbstract'] != '')
        {
          $erg .= '<li class="'.$mra['articleBox'].'">'.
                    '<a href="'.$this->linker->cbArticleLink('index.php', 'trip', $mra['articleBox'], $mra['articleName']).'">'.$mra['headline'].'</a>&nbsp;('.$this->fDate($mra['date']).')<br>'.
                     $mra['aAbstract'].'...&nbsp;'.
                    '<a href="'.$this->linker->cbArticleLink('index.php', 'trip', $mra['articleBox'], $mra['articleName']).'">(mehr)</a>'.
                  '</li>';
        }
      }

      $erg .= '</ul>';
      $erg .= '<a class="moreBoxContentLink" href="'.$this->linker->cbBoxLink('index.php', 'listArticles', $articleBoxName).'">...mehr aus <span>"'.$articleBoxAlias.'"</span></a>';
    }

    return $erg;
  }

}

?>
