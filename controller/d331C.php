<?php

class d331C extends cbPageC
{
  /**
   * init view
   * _________________________________________________________________
   */
  public function initView($uiViewName)
  {
    parent::initView($uiViewName);

    $this->view->articleBox = $this->requestM->getReqVar('articleBox');
    $this->view->article = $this->requestM->getReqVar('article');
  }

  /**
   * sidebar
   * called from JavaScript
   * _________________________________________________________________
   */
  public function teaserImages()
  {
    $this->initView('teaserImagesVP');

    $ras = $this->boxes->getRandomArticles(8, 'exclude', 'pages');
    $this->view->data = $this->boxes->articleObjs2Array($ras);

    $this->view->drawPage();
  }

  /**
   * Index Seite
   * _________________________________________________________________
   */
  public function index()
  {
    $this->initView('indexVP');

    $pageTitle = 'Abflug! - Reiseberichte von Birgit Schulte über Reisen nach Asien, Amerika, Afrika und in Europa';
    $mras['asien'] = $this->boxes->getMostRecentArticles(3, 'include', array('asien'));
    $mras['amerika'] = $this->boxes->getMostRecentArticles(3, 'include', array('amerika'));
    $mras['europa'] = $this->boxes->getMostRecentArticles(3, 'include', array('europa'));
    $mras['afrika'] = $this->boxes->getMostRecentArticles(3, 'include', array('afrika'));

    foreach ($mras as $mraCountry)
    {
      foreach ($mraCountry as $mra)
      {
        $articleBox = $mra->articleBox;
        $boxA = $this->boxes->getBoxByName($articleBox);
        $alias = $boxA['alias'];
        $data[$alias][] = $mra->getArticle();
      }
    }

    $art = new cbArticleM('331days-pages', 'teaser');
    $art->load();

    $this->view->setData('pageTitle', $pageTitle);
    $this->view->setData('metaDescription', $pageTitle);
    $this->view->setData('articles', $data);
    $this->view->setData('teaser', $art->getArticle());

    $this->view->drawPage();
  }

  /**
   * cbBox Hook
   * _________________________________________________________________
   */
  public function listArticles()
  {
    $articleBox = $this->requestM->getReqVar('articleBox');

    $boxA = $this->boxes->getBoxByName($articleBox);
    $ret = null;
    $cbb = null;

    $this->initView('listArticlesVP');

    if ($articleBox != '331days-pages')
    {
      try
      {
        $cbb = new cbBoxC($boxA);
        $cbb->articlesPerPage = 10;
        $ret = $cbb->show();
        $this->view->setData('pageTitle', $ret['meta']['cTitle']);
        $this->view->setData('metaDescription', $ret['meta']['cTeaser']);
        $this->view->articleHook = 'trip';
        $this->view->setData('mainContent', $ret);

        $this->view->drawPage();
      }
      catch (Exception $e)
      {
        $this->view->drawPage($e->getMessage());
      }
    }
    else
    {
      $this->view->setData('pageTitle', 'Fehler');
      $this->view->setData('metaDescription', 'Fehler');
      $this->view->drawPage($articleBox.': Indexanzeige nicht erlaubt!');
    }
  }


  /**
   * trip hook
   * _________________________________________________________________
   */
  public function trip()
  {
    $articleBox = $this->requestM->getReqVar('articleBox');
    $boxA = $this->boxes->getBoxByName($articleBox);
    $articleName = $this->requestM->getReqVar('article');
    $op = $this->requestM->getReqVar('op');
    $ret = null;

    $this->initView('tripVP');

    try
    {
      if (!isAjax())
      {
        $cba = new cbArticleC($boxA, $articleName);
        $ret = $cba->show();
        $this->view->setData('pageTitle', $ret['meta']['cTitle']);
        $this->view->setData('metaDescription', $ret['meta']['cTeaser']);
        $this->view->viewHints = array('backLinkHook' => 'listArticles');
        $this->view->setData('article', $ret);

        $cbc = new cbCommentsC($boxA, $articleName, 'article');
        $ret = $cbc->exec($op);
        $this->view->setData('comments', $ret);

        $this->view->drawPage();
      }
      else
      {
        $cbc = new cbCommentsC($boxA, $articleName, 'article');
        $ret = $cbc->exec($op);
        $this->view->setData('comments', $ret);

        $this->view->drawAjax();
      }
    }
    catch (Exception $e)
    {
      $this->view->drawPage($e->getMessage());
    }
  }

  /**
   * article Hook
   * _________________________________________________________________
   */
  public function article()
  {
    $articleBox = $this->requestM->getReqVar('articleBox');
    $articleName = $this->requestM->getReqVar('article');
    $page = $this->requestM->getReqVar('articlePage');
    $op = $this->requestM->getReqVar('op');
    $boxA = $this->boxes->getBoxByName($articleBox);
    $ret = null;

    $this->initView('articleVP');

    try
    {
      if (!isAjax())
      {
        $cba = new cbArticleC($boxA, $articleName);
        $ret = $cba->show();
        $this->view->setData('pageTitle', $ret['meta']['cTitle']);
        $this->view->setData('metaDescription', $ret['meta']['cTeaser']);
        $this->view->setData('article', $ret);

        if ($articleName == 'gaestebuch')
        {
          $cbc = new cbCommentsC($boxA, $articleName, 'article');
          $ret = $cbc->exec($op);
          $this->view->setData('comments', $ret);
        }

        $this->view->drawPage();
      }
      else
      {
        $cbc = new cbCommentsC($boxA, $articleName, 'article');
        $ret = $cbc->exec($op);
        $this->view->setData('comments', $ret);

        $this->view->drawAjax();
      }
    }
    catch (Exception $e)
    {
      $this->view->drawPage($e->getMessage());
    }
  }

  /**
   * search Hook
   * _________________________________________________________________
   */
  public function search()
  {
    $term = $this->requestM->getReqVar('term');

    $this->initView('searchVP');

    try
    {
      $this->view->hook = 'trip';
      $this->view->setData('pageTitle', 'Suchergebnisse');
      $this->view->setData('metaDesc', 'Suchergebnisse');
      $this->view->setData('results', $this->boxes->search($term, 'exclude', 'pages'));

      $this->view->drawPage();
    }
    catch(Exception $e)
    {
      $this->view->drawPage($e->getMessage());
    }
  }

  /**
   * sitemap
   * ________________________________________________________________
   */
  public function sitemap()
  {
    $this->initView('\cb\view\page\cbSitemapVP');

    $sm = new cbSitemapM($this->linker);
    $sm->addLink('http://wwww.331days.de/');
    $sm->addArticleBox('index.php', 'listArticles', 'trip', '331days-Amerika-Reisen');
    $sm->addArticleBox('index.php', 'listArticles', 'trip', '331days-Asien-Reisen');
    $sm->addArticleBox('index.php', 'listArticles', 'trip', '331days-Europa-Reisen');
    $sm->addArticleBox('index.php', 'listArticles', 'trip', '331days-Afrika-Reisen');
    $sm->addArticle('index.php', 'article', '331days-pages', 'Gaestebuch');
    $sm->addArticle('index.php', 'article', '331days-pages', 'Impressum');
    $links = $sm->create();

    $this->view->replaceDataFromArray($links);
    $this->view->draw();
  }

}

?>
