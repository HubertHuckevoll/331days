<?php

namespace view\generic\page;

class cbPage331VP extends \cb\view\page\cbPageVP
{
  public $articleBox = '';
  public $article = '';

  public function mainNavigation()
  {
    $sel = '';
    $erg = '';

    $sel  = ($this->articleBox == '') ? ' class="selected"' : '';
    $erg .= '<li'.$sel.'><a class="index" href="./">Abflug!</a></li>';

    $sel  = ($this->articleBox == '331days-Amerika-Reisen') ? ' class="selected"' : '';
    $erg .= '<li'.$sel.'><a class="amerika" href="331days-Amerika-Reisen/">Amerika</a></li>';

    $sel  = ($this->articleBox == '331days-Asien-Reisen') ? ' class="selected"' : '';
    $erg .= '<li'.$sel.'><a class="asien" href="331days-Asien-Reisen/">Asien</a></li>';

    $sel  = ($this->articleBox == '331days-Europa-Reisen') ? ' class="selected"' : '';
    $erg .= '<li'.$sel.'><a class="europa" href="331days-Europa-Reisen/">Europa</a></li>';

    $sel  = ($this->articleBox == '331days-Afrika-Reisen') ? ' class="selected"' : '';
    $erg .= '<li'.$sel.'><a class="afrika" href="331days-Afrika-Reisen/">Afrika</a></li>';

    $sel  = ($this->article == 'gaestebuch') ? ' class="selected"' : '';
    $erg .= '<li'.$sel.'><a class="gaestebuch" href="331days-pages/gaestebuch,0.html">G&auml;stebuch</a></li>';

    return $erg;
  }

  protected function sidebar()
  {
    $html  = '';
    $html .= '<h2>Reisebilder</h2>';
    $html .= '<div id="sidebarImg">';
    $html .= '</div>';

    return $html;
  }

  public function drawPage($errMsg = '')
  {
    $erg .= '<!DOCTYPE html>'.
            '<html lang="de">'.
            '<head>'.
              '<base href="'.PROJECT_ROOT_URL.'">'.
              '<title>'.$this->data['pageTitle'].' - 331days.com</title>'.
              '<link rel="shortcut icon" href="favicon.ico">'.
              '<meta charset="UTF-8">'.
              '<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">'.
              '<meta name="google-site-verification" content="5O4rBb-ITj9rS0DmRlqbqtkDRiVK0CSZbQmkwdlO5ck">'.
              '<meta name="robots" content="index,follow">'.
              '<meta name="revisit-after" content="7 days">'.
              '<meta name="keywords" content="Reisebericht,Indien,Bali,Malaysia,Andalusien,England,USA,Puerto Rico,fliegen,Verreisen,Urlaub,Inspired,Birgit Schulte,331days">'.
              '<meta name="description" content="'.htmlentities($this->data['metaDescription']).'">'.
              '<link rel="preconnect" href="https://fonts.gstatic.com">'.
              '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Slab&display=swap">'.
              '<link rel="stylesheet" type="text/css" href="'.CB_CSS_ROOT.'cbArticleClassicS0.css">'.
              '<link rel="stylesheet" type="text/css" href="'.CB_CSS_ROOT.'cardboardTags.css">'.
              '<link rel="stylesheet" type="text/css" href="'.CB_CSS_ROOT.'cbUserClasses.css">'.
              '<link rel="stylesheet" type="text/css" href="'.CB_CSS_ROOT.'cardboardCSS.css">'.
              '<link rel="stylesheet" type="text/css" href="'.PROJECT_CSS_URL.'desktop.css" title="CSS" media="screen">'.
              '<link rel="stylesheet" type="text/css" href="'.PROJECT_CSS_URL.'cssTags.css">'.
              '<link rel="stylesheet" type="text/css" media="screen and (max-width: 800px)" href="'.PROJECT_CSS_URL.'phone.css">'.
              '<link rel="stylesheet" type="text/css" media="screen and (max-device-width: 480px)" href="'.PROJECT_CSS_URL.'phone.css">'.
              '<script src="'.CB_JS_ROOT.'cbGallery.js"></script>'.
              '<script src="'.CB_JS_ROOT.'cbComments.js"></script>'.
              '<script src="'.PROJECT_JS_URL.'main.js"></script>'.
              $this->additionalHeadData().
            '</head>'.
            '<body>'.
            '<div id="wrapper">'.
              '<header>'.
                '<form method="post" id="searchBox" name="searchBox" action="index.php?hook=search">'.
                  '<input type="text" name="term" size="30" maxlength="255" autocomplete="off"><button type="submit">&#x1F50D;</button>'.
                '</form>'.
                '<h1 id="title"><a href="index.php">331DAYS.DE</a></h1>'.
                '<details id="mobileNavbar">'.
                '<summary>Was erleben!</summary>'.
                '<ul>'.$this->mainNavigation().'</ul>'.
                '</details>'.
                '<div id="navbar">'.
                '<ul>'.$this->mainNavigation().'</ul>'.
                 '<div id="subtitle">Was erleben!</div>'.
                '</div>'.
              '</header>'.
              '<main>';

    $erg .= '<div id="content">';
    if ($errMsg == '')
    {
      $erg .= $this->mainContent();
    }
    else
    {
      $erg .= $errMsg;
    }

    $erg .= '<div>'.$this->additionalContent().'</div>';

    $erg .= '</div>'; // end of content

    $erg .= '<aside id="sidebar">'.
              $this->sidebar().
            '</aside>';

    $erg .= '</main>';

    $erg .='<footer>'.
             '<a id="impressum" href="331days-pages/impressum,0.html">Impressum</a>'.
           '</footer>';

    $erg .= '</div>'; // wrapper

    $erg .= '</body></html>';

    echo $erg;
  }

}

?>
