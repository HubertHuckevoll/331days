<?php
namespace view\generic\fragment;

class cbArticleReiseVF extends \cb\view\fragment\cbArticleGDocsStyle0VF
{
  /* add ui from "rastlos"
    ___________________________________________________________________
  */
	protected function socialButtons()
	{
		$erg .= parent::socialButtons();

	  $aLink = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

		$erg .= '<div id="rastlos_com" style="font:normal 1px Arial, Verdana;background-color:transparent;"><a href="http://www.rastlos.com" alt="Reiseberichte, Backpacker - Stories, Reise Tipps" title="Rastlos Reiseberichte, Backpacker - Stories, Reise Tipps">Reisen, Urlaub, Ferien</a> Bewertung wird geladen...</div>'.
					  '<script type="text/javascript" src="http://www.rastlos.com/banner/rastlos_ranking.js"></script>'.
					  '<script type="text/javascript">'.
							'var rankingtype="travelogues";var websiteurl="'.$aLink.'";'.
							'var buttontype= "33";var customcss_bg="transparent";var customcss_textcolor="#5774EE"; var customcss_ratingcolor="#979696";'.
							'showandsave(rankingtype,websiteurl,"load", buttontype, customcss_bg, customcss_textcolor, customcss_ratingcolor, "","","");'.
						'</script>';

	  return $erg;
	}

}

?>