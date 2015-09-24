<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007-2011 by Dominique Laporte(C-E-D@wanadoo.fr)

   This file is part of Prométhée.

   Prométhée is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prométhée is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/


/*
 *		module   : flash.php
 *		projet   : fonctions de base pour la visualisation des flash-infos
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 27/01/07
 *		modif    : 
 */
?>

<?php
//---------------------------------------------------------------------------
function setArticleOrder($idinfo, $ident, $value)
{
	/*
	 * fonction :	déplacement de l'affichage des articles
	 * in :		$ident : id de l'article, $value : up, down
	 */

	global	$mysql_link;

	$items  = array();

	$query  = "select _IDitem from flash_items ";
	$query .= "where _IDinfos = '$idinfo' ";
	$query .= ( $_SESSION["CnxAdm"] != 255 ) ? "AND _ID = '".$_SESSION["CnxID"]."' " : "" ;
	$query .= "order by _order asc";

	$return = mysql_query($query, $mysql_link);
	$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;
	$nbelem = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

	$i = 1;
	while ( $myrow ) {
		$key = ( $myrow[0] == $ident )
			? ($value == "up"
				? ($i == 1 ? ($nbelem*2) + 5 : ($i*2) - 3)
				: ($i == $nbelem ? -3 : ($i*2) + 3) )
			: $i * 2 ;

		$items += Array($key => $myrow[0]);
		$i++;

		$myrow = mysql_fetch_row($return);
		}

	// tri
	@ksort($items);

	// réécriture
	$i = 0;
	foreach ($items as $clef => $valeur) {
		$i++;
		mysql_query("update flash_items set _order = '$i' where _IDitem = '$valeur' limit 1", $mysql_link);
		}
}
//---------------------------------------------------------------------------
function read_uppermenu($item)
{
/*
 * fonction :	recherche ID du menu de niveau supérieur
 * in :		$item : intitulé du titre de l'article
 * out :		$ID du menu, sinon 0
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	if ( strstr($item, "#menu_item:") ) {
		list($tag, $idmenu) = explode(":", $item);

		// on sélectionne le contenu
		$query  = "select _IDmenu from config_submenu " ;
		$query .= "where _lang = '".$_SESSION["lang"]."' ";
		$query .= "AND _IDsubmenu = '$idmenu' " ;
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		if ( $row )
			return ( $row[0] < 0 ) ? abs($row[0]) : 0 ;
		}

	return 0;
}
//---------------------------------------------------------------------------
function read_menutitle($item)
{
/*
 * fonction :	affichage du titre de l'article ou du menu associé
 * in :		$item : intitulé du titre de l'article
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	if ( strstr($item, "#menu:") OR strstr($item, "#menu_item:") ) {
		list($tag, $idmenu) = explode(":", $item);

		// on sélectionne le contenu
		$query  = strstr($item, "#menu:") ? "select _ident from config_menu " : "select _ident from config_submenu " ;
		$query .= "where _lang = '".$_SESSION["lang"]."' ";
		$query .= strstr($item, "#menu:") ? "AND _IDmenu = '$idmenu' " : "AND _IDsubmenu = '$idmenu' " ;
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		return ( $row ) ? $row[0] : $item ;
		}

	return $item;
}
//---------------------------------------------------------------------------
function read_attachment($article, $line, $href = "index.php?item=0")
{
/*
 * fonction :	affichage de la pièce jointe dans un article
 * in :		$article : données de l'article, $line : lecture de la ligne du fichier template, $href : page de retour
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	require $_SESSION["ROOTDIR"]."/msg/flash.php";
	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/flash.php");

	$pjointe = "";

	@list($tag, $idmenu) = explode(":", $article[0]);

	$Query   = "select _ext, _size, _IDpj, _texte from flash_pj ";
	$Query  .= "where _IDitem = '$article[4]' ";
	$Query  .= "order by _IDpj";

	$return  = mysql_query($Query, $mysql_link);
	$my_pj   = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

	while ( $my_pj ) {
		// description de la PJ
		$desc  = $msg->read($FLASH_FILESIZE, $my_pj[1]) ."<br/>";
		$desc .= $my_pj[3];
		$desc  = str_replace("'", "\'", $desc);			// le script java n'aime pas les '

		// chemin pour compteur des téléchargements
		$path  = $_SESSION["ROOTDIR"]."/$DOWNLOAD/flash/$my_pj[2].$my_pj[0]";

		$res   = mysql_query("select _IDdown, _count from download_data where _file = '$path'", $mysql_link);
		$down  = ( $res ) ? mysql_fetch_row($res) : 0 ;

		$nblnk = ( $down[0] )
			? "<a href=\"#\" onclick=\"popWin('user_list.php?sid=".$_SESSION["sessID"]."&amp;IDdown=$down[0]&amp;cmde=dwload&amp;lang=".$_SESSION["lang"]."', '450', '200'); return false;\">$down[1]</a>"
			: "0" ;

		$msg->isPlural = (bool) ( $nblnk > 1 );

           	// lien sur la PJ
		$target = "onclick=\"window.open(this.href, '_blank'); return false;\"";
		$lien   = myurlencode("index.php?id=".$_SESSION["CnxID"]."&file=$path");

		$pjointe .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/mime/$my_pj[0].gif\" title=\"\" alt=\"\" /> ";
		$pjointe .= $msg->read($FLASH_DOC, Array($lien, $desc, $target)). " ";
		$pjointe .= ( $_SESSION["CnxID"] == $article[5] OR ($_SESSION["CnxAdm"] & 8) )
			? "<a href=\"".myurlencode("$href&IDsubmenu=$idmenu&IDpj=-$my_pj[2]&ext=$my_pj[0]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"\" alt=\"\" /></a> "
			: "" ;
		$pjointe .=	"<span class=\"x-small\">". $msg->read($FLASH_DOWNLOADED, strval($nblnk)) ."</span><br/>";

		$my_pj    = remove_magic_quotes(mysql_fetch_row($return));
		}

	$string = "";
	for ( $token = strtok($line, "\n"); $token != ""; $token = strtok("\n") )
		$string .= ( strstr($token, "##ATTACHED##") )
			? (strlen($pjointe) ? str_replace("##ATTACHED##", $pjointe, $token) : "")
			: $token ; 

	return $string;
}
//---------------------------------------------------------------------------
function read_article($article, $line, $loop = false)
{
/*
 * fonction :	affichage de l'article
 * in :		$article : données de l'article, $line : lecture de la ligne du fichier template, $loop : boucle dans le template
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	$header  = ( $article[9] == "ON" )
		? "<table summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\" style=\"border-color:#FFFFFF; border-style:solid; border-width:1px;\"><tr>"
		: "<table summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr>" ;
	$header .= ( $article[10] == "ON" )
		? "<td style=\"width:100%;\" align=\"center\">"
		: "<td>" ;
	$header .= ( $article[8] == "ON" )
		? "<span style=\"color:#FF0000;\">"
		: "<span style=\"color:#000000;\">" ;

	$footer  = "</span></td></tr></table>";

	$note    = "";

	$new_str = ( $article[12] == "O" )
		? $header . find_typo($article[1], $note) . $footer
		: $article[1] ;

	$string  = ( $loop )
		? str_replace("##TITLE ARTICLE##", $article[0], str_replace("##TEXT ARTICLE##", replace_smile($new_str), $line))
		: str_replace("##TEXT ARTICLE##", replace_smile($new_str), $line) ;

	// notes de bas de page
	if ( strlen($note) )
		$string .= "<hr style=\"width:30%; text-align:left;\" /><p class=\"x-small\" style=\"margin-top: 0px;\">$note</p>";

	return $string;
}
//---------------------------------------------------------------------------
function read_author($article, $line, $href)
{
/*
 * fonction :	affichage de l'auteur + barre d'outils
 * in :		$article : données de l'article, $line : lecture de la ligne du fichier template, $loop : boucle dans le template
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	require $_SESSION["ROOTDIR"]."/msg/flash.php";
	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/flash.php");

	$Query   = "select flash._chrono, flash._poster, flash._IDgrpwr, flash._autoval, flash_items._ID ";
	$Query  .= "from flash, flash_data, flash_items ";
	$Query  .= "where flash_items._IDitem = '$article[4]' AND flash_items._IDinfos = '$article[14]' ";
	$Query  .= "AND flash_items._IDinfos = flash_data._IDinfos ";
	$Query  .= "AND flash_data._IDflash = flash._IDflash ";
	$Query  .= "limit 1";

	$return  = mysql_query($Query, $mysql_link);
	$row     = ( $return ) ? mysql_fetch_row($return) : 0 ;

	$replace = ( $row[1] == "O" )
		? $msg->read($FLASH_CREATED, Array(getUserName($article[5]), date2longfmt($article[7]), ' '._getHostName($article[6])))
		: "" ;

	if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $article[5] OR ($_SESSION["CnxAdm"] & 8) OR ($row[2] & pow(2, $_SESSION["CnxGrp"] - 1)) ) {
		$replace .= " ";

		if ( $row[0] == "S" ) {
			$replace .= "<a href=\"".myurlencode("$href&submit=up&IDitem=$article[4]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/menu/up.png\" title=\"\" alt=\"\" /></a> ";
			$replace .= "<a href=\"".myurlencode("$href&submit=down&IDitem=$article[4]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/menu/down.png\" title=\"\" alt=\"\" /></a> ";
			}
		$replace .= "<a href=\"".myurlencode("$href&cmde=post&IDitem=$article[4]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"\" alt=\"\" /></a> ";
		if ( $_SESSION["CnxAdm"] & 8 OR ($row[3] == "O" AND $_SESSION["CnxID"] == $row[4]) )
			$replace .= ( $article[13] == "O" )
				? "<a href=\"".myurlencode("$href&submit=invisible&IDitem=$article[4]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/visible.gif\" title=\"\" alt=\"\" /></a> "
				: "<a href=\"".myurlencode("$href&submit=visible&IDitem=$article[4]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/invisible.gif\" title=\"\" alt=\"\" /></a> " ;
		$replace .= "<a href=\"".myurlencode("$href&submit=del&IDitem=$article[4]")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"\" alt=\"\" /></a> ";
		}

	return str_replace("##AUTHOR##", $replace, $line);
}
//---------------------------------------------------------------------------
?>
