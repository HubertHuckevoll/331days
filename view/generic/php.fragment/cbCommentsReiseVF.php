<?php
namespace view\generic\fragment;

class cbCommentsReiseVF extends \cb\view\fragment\cbCommentsVF
{
  /* redirect for comments on last page
    ___________________________________________________________________
  */
  public function renderComments()
  {
    $erg = '';
    $page = $this->data['articlePage'];
    $lastPage = $this->data['pageCount'];

    if (($page + 1) == $lastPage)
    {
      $erg = parent::renderComments();
    }
    else
    {
      $url = $this->linker->cbArticleLink($this->ep, $this->hook, $this->data['articleBox'], $this->data['articleName'], ($lastPage-1));
      $erg = '<div class="comment">Fragen, Anmerkungen, Lobhudeleien? Auf der <a href="'.$url.'">letzten Seite</a> finden sich die Kommentare...</div>';
    }

    return $erg;
  }
}

?>