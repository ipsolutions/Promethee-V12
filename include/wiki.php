<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by FG (persofg@gmail.com)
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

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
?>

<?php
/*
 *		module   : wiki.php
 *		projet   : classe objet wiki
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 29/11/03
 *		modif    : 18/06/05 par FG
 *                     migration -> PHP5
 * 		           17/07/06 - par Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


//---------------------------------------------------------------------------
class wiki_page
{
	var	$idpage = 0;		// ID de la page
	var	$parent = 0;		// ID du répertoire parent
	var	$group  = 0;		// ID du groupe (0 : wiki général)
	var	$owner  = 0;		// ID du propriétaire du répertoire
	var	$grpwr  = 254;		// droits d'écriture dans le répertoire
	var	$grprd  = 254;		// droits de lecture dans le répertoire
	var	$link   = "";		// lien sur retour de formulaire
	var	$title  = "";		// titre de la boite de saisie
	var	$cols   = 60;		// nb de colonnes de la boite de saisie
	var	$rows   = 1;		// nb de ligne de la boite de saisie
	var	$value  = "insert";	// valeur par défaut sur saisie de formulaire

	// édition du texte --------------------------------------------------
	function edit($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		require $_SESSION["ROOTDIR"]."/msg/wiki.php";
		require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/wiki.php");

		// on sélectionne le document à modifier
		$result = mysql_query("select _ident from wiki_page where _IDpage = '$IDpage' limit 1", $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// titre de la boite de saisie
		$title  = ( strlen($this->title) )
			? "<strong>$this->title</strong>"
			: "" ;

		// fenêtre d'édition
		print("
			<div style=\"background-color:#eeeeee; padding:5px; border-style:solid; border-color:#000000; border-width:1px;\">
				<form  id=\"formulaire\" action=\"$this->link\" method=\"post\">
					<p class=\"hidden\"><input type=\"hidden\" name=\"wiki_page_id\"   value=\"$IDpage\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"wiki_page_cmde\" value=\"$this->value\" /></p>

					<p style=\"margin:0px;\">
					$title<br/>
					<label for=\"wiki_page_text\">
					<input type=\"text\" id=\"wiki_page_text\" name=\"wiki_page_text\" size=\"$this->cols\" value=\"$row[0]\" />
					</label>

					<input type=\"submit\" value=\"". $msg->read($WIKI_SAVE) ."\" />
					<input type=\"button\" value=\"". $msg->read($WIKI_CANCEL) ."\" onclick=\"document.location='$this->link';\" />
					</p>
				</form>
			</div>
			");
	}

	// enregistrement du répertoire -------------------------------------
	function insert($texte)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		$texte  = addslashes(trim($texte));

		if ( !strlen($texte) )
			return 0;

		$date   = date("Y-m-d H:i:s");

		// mise à jour de la base de données
		$Query  = "insert into wiki_page ";
		$Query .= "values('', '$this->parent', '$this->group', '$texte', '$date', '$date', '$this->owner', '$this->grpwr', '$this->grprd', 'O', '0', 'O')";

		return mysql_query($Query, $mysql_link);
	}

	// lecture du répertoire --------------------------------------------
	function read($IDpage, $IDgroup = 0)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// lecture de la base de données
		$Query  = "select _IDparent, _ident, _IDmod, _IDgrpwr, _IDgrprd from wiki_page ";
		$Query .= "where _IDpage = '$IDpage' AND _IDgroup = '$IDgroup' ";
		$Query .= "AND _visible = 'O' ";
		$Query .= "limit 1";

		return mysql_query($Query, $mysql_link);
	}

	// modification du répertoire ---------------------------------------
	function update($IDpage, $texte)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		$date   = date("Y-m-d H:i:s");

		// mise à jour de la base de données
		$Query  = "update wiki_page ";
		$Query .= "set _ident = '". addslashes(trim($texte)) ."', _update = '$date' ";
		$Query .= "where _IDpage = '$IDpage' ";
		$Query .= "limit 1";

		return mysql_query($Query, $mysql_link);
	}

	// suppression du répertoire ---------------------------------------
	function delete($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// il faudra écrire une fonction récursive...
		return ( mysql_query("delete from wiki_page where _IDpage = '$IDpage' limit 1", $mysql_link) )
			? mysql_query("delete from wiki where _ver = '$IDpage'", $mysql_link)
			: 0 ;
	}
}
//---------------------------------------------------------------------------
class wiki
{
	var	$tag      = "";			// tag des documents wiki
	var	$page     = 1;			// n° de page
	var	$owner    = false;		// propriétaire du document
	var	$admin    = false;		// droits d'administration du document
	var	$user     = false;		// droits utilisateur du document
	var	$version  = 0;			// version du document
	var	$link     = "";			// lien sur retour de formulaire
	var	$title    = "";			// titre de la boite de siasie
	var	$raw      = "O";			// texte brut (syntaxe wiki)
	var	$cols     = 60;			// nb de colonnes de la boite de saisie
	var	$rows     = 4;			// nb de ligne de la boite de saisie
	var	$value    = "insert";		// valeur par défaut sur saisie de formulaire
	var	$banner   = "";			// texte avant le paragraphe
	var	$footer   = "";			// texte après le paragraphe

	// édition du texte --------------------------------------------------
	function editTag($tag)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		$this->tag = $tag;

		// on sélectionne le document à modifier
		$result = mysql_query("select _IDpage from wiki where _tag = '$tag' AND _current = 'O' limit 1", $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		$this->edit($row[0]);
	}
	// titre du document -------------------------------------------------
	function init($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		require $_SESSION["ROOTDIR"]."/msg/wiki.php";
		require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/wiki.php");

		// on sélectionne le document à modifier
		$result = mysql_query("select _title from wiki where _IDpage = '$IDpage' limit 1", $mysql_link);
		$row    = ( $result ) ? $this->remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		$title  = ( strlen($this->title) )
			? "<strong>$this->title</strong>"
			: "" ;

		// fenêtre d'édition
		print("
			<form id=\"formulaire\" action=\"$this->link\" method=\"post\">
				<p class=\"hidden\"><input type=\"hidden\" name=\"wiki_tag\"    value=\"$this->tag\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"wiki_cmde\"   value=\"$this->value\" /></p>

				<p style=\"margin:0px;\">
				$title<br/>
				<label for=\"wiki_title\">
				<input type=\"text\" id=\"wiki_title\" name=\"wiki_title\" size=\"$this->cols\" value=\"$row[0]\" />
				</label>

				<input type=\"submit\" value=\"". $msg->read($WIKI_SAVE) ."\" />
				<input type=\"button\" value=\"". $msg->read($WIKI_CANCEL) ."\" onclick=\"document.location='$this->link';\" />
				</p>
			</form>
			");
	}
	// édition du texte --------------------------------------------------
	function edit($IDpage, $markup = "")
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		require $_SESSION["ROOTDIR"]."/msg/wiki.php";
		require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/wiki.php");

		// on sélectionne le document à modifier
		$query  = "select wiki._text, wiki_page._PJ ";
		$query .= "from wiki, wiki_page ";
		$query .= "where wiki._IDpage = '$IDpage' ";
//		$query .= "AND wiki._ver = wiki_page._IDpage ";
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? $this->remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		// titre de la boite de saisie
		$title  = ( strlen($this->title) )
			? "<strong>$this->title</strong>
			   <a href=\"#\" onclick=\"popWin('spip_typo.php?lang=".$_SESSION["lang"]."', '450', '350'); return false;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/spip/aide.gif\" title=\"". $msg->read($WIKI_HELP) ."\" alt=\"". $msg->read($WIKI_HELP) ."\" /></a>
			   <a href=\"$this->link&amp;wiki_cmde=edit&amp;wiki_html=1\"><img src=\"".$_SESSION["ROOTDIR"]."/images/modify.gif\" title=\"". $msg->read($WIKI_WYSIWYG) ."\" alt=\"". $msg->read($WIKI_WYSIWYG) ."\" /></a>"
			: "" ;

		// sélection de paragraphe
		if ( $markup != "" ) {
			$find         = strpos($row[0], $markup);
			$this->banner = substr($row[0], 0, $find);

			$textarea     = substr($row[0], $find, strlen($row[0]));
			$separateur   = strstr($markup, "===") ? "===" : "==" ;

			$pos = 0;
			if ( $separateur == "==" ) {
				do	{
					$find = strpos(substr($textarea, $pos, strlen($textarea)), "\n$separateur");
					$pos += ($find + strlen($separateur));
					} while ( $textarea[$pos + 1] == '=' AND $pos < strlen($textarea) );

				// attention au fin de texte
				if ( !$find AND $textarea[$pos + 1] != '=' )
					$pos = 0;
				}
			else
				$pos = strpos($textarea, "\n==") + 1;

			$this->footer = ( $pos > strlen($separateur) ) ? substr($textarea, $pos - 1, strlen($row[0])) : "" ;

			$textarea     = ( $pos > strlen($separateur) ) ? substr($textarea, 0, $pos - 1) : $textarea ;
			}
		else {
			$this->banner = $this->footer = "";
			$textarea     = $row[0];
			}

		// on enregistre les zones avant et après le paragraphe à modifier
		$query  = "update wiki set ";
		$query .= "_banner = '".addslashes($this->banner)."', ";
		$query .= "_footer = '".addslashes($this->footer)."' ";
		$query .= "where _IDpage = '$IDpage'";

		mysql_query($query, $mysql_link);

		// fenêtre d'édition
		print("
			<div style=\"background-color:#eeeeee; padding:5px; border-style:solid; border-color:#000000; border-width:1px;\">
				<form id=\"formulaire\" action=\"$this->link\" method=\"post\" enctype=\"multipart/form-data\">
					<p class=\"hidden\"><input type=\"hidden\" name=\"wiki_tag\"   value=\"$this->tag\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"wiki_cmde\"  value=\"$this->value\" /></p>");

		if ( $this->raw == "O" )
			print("
				<p style=\"margin:0px;\">
				$title
				<label for=\"wiki_text\">
				<textarea id=\"wiki_text\" name=\"wiki_text\" cols=\"$this->cols\" rows=\"$this->rows\">$textarea</textarea>
				</label>
				</p>");
		else {
			$oFCKeditor           = new FCKeditor("wiki_text") ;
			$oFCKeditor->BasePath = "./script/fckeditor/";
			$oFCKeditor->Height   = 500;
			$oFCKeditor->Value    = $textarea;
			$oFCKeditor->Value    = $textarea;
			$oFCKeditor->Create() ;
			}

		// pièces jointes
		if ( $row[1] ) {
				$addpj = ( $row[1] > 1 )
					? "<span style=\"cursor: pointer;\" onclick=\"$('more')._display.toggle(); return false;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/max.gif\" title=\"\" alt=\"+\" /></span>"
					: "" ;

				print("
					<fieldset style=\"width:80%; border:#000000 solid 1px;\">
					<legend>". $msg->read($WIKI_ATTACHMENT) ." 1</legend>
						<p class=\"hidden\"><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$FILESIZE\" /></p>
						<input type=\"file\" name=\"wiki_upload[]\" size=\"50\" style=\"font-size:9px; margin-bottom:5px;\" /> $addpj<br />
						<label for=\"wiki_PJdesc_1\"><input type=\"text\" id=\"wiki_PJdesc_1\" name=\"wiki_PJdesc[]\" size=\"50\" /></label>
						". $msg->read($WIKI_ATTDESCRIPTION) ."
					</fieldset>");

				print("<div id=\"more\" style=\"display:none;\">");

				for ($i = 2; $i <= (int) $row[1]; $i++) {
					print("
						<fieldset style=\"width:80%; border:#000000 solid 1px;\">
						<legend>". $msg->read($WIKI_ATTACHMENT) ." $i</legend>
							<input type=\"file\" name=\"wiki_upload[]\" size=\"50\" style=\"font-size:9px; margin-bottom:5px;\" /><br />
							<label for=\"wiki_PJdesc_$i\"><input type=\"text\" id=\"wiki_PJdesc_$i\" name=\"wiki_PJdesc[]\" size=\"50\" /></label>
							". $msg->read($WIKI_ATTDESCRIPTION) ."
						</fieldset>");
					}

				print("</div>");
			}

		print("
					<p style=\"margin:0px;\">
					<input type=\"submit\" value=\"". $msg->read($WIKI_SAVE) ."\" />
					<input type=\"button\" value=\"". $msg->read($WIKI_CANCEL) ."\" onclick=\"document.location='$this->link';\" />
					</p>
				</form>
			</div>");
	}

	// enregistrement du texte -------------------------------------------
	function insert($title, $texte = "", $author = "")
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		if ( !strlen($title) )
			return 0;

		// on déférence le document courant
		if ( !mysql_query("update wiki set _current = 'N' where _tag = '$this->tag'", $mysql_link) )
			return 0;

		$date   = date("Y-m-d H:i:s");

		// mise à jour de la base de données
		$Query  = "insert into wiki ";
		$Query .= "values('', '$this->tag', '$date', '$this->owner', '$author', '$this->version', '". addslashes(trim($title)) ."', '". addslashes(trim($texte)) ."', '$this->raw', '', '', 'N', 'O')";

		return mysql_query($Query, $mysql_link);
	}

	// enregistrement pièces jointes -------------------------------------
	function attachment()
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// transfert d'une Pièce Jointe
		$file = @$_FILES["wiki_upload"]["tmp_name"];

		for ($j = 0; $j < count($file); $j++)
			if (  @$file[$j] AND authfile(@$_FILES["wiki_upload"]["name"][$j]) ) {
				// description du fichier en PJ
				$pjdesc = addslashes(trim(@$_POST["wiki_PJdesc"][$j]));

				$Query  = "insert into wiki_pj ";
				$Query .= "values('', '$this->tag', '".@$_FILES["wiki_upload"]["name"][$j]."', '".@$_FILES["wiki_upload"]["size"][$j]."', '$pjdesc')";

				if ( mysql_query($Query, $mysql_link) ) {
					// fichier destination
					$dest   = $_SESSION["ROOTDIR"]."/$DOWNLOAD/wiki/". mysql_insert_id() ."-". @$_FILES["wiki_upload"]["name"][$j];

					// copie du fichier temporaire -> répertoire de stockage
					if ( move_uploaded_file($file[$j], $dest) )
						mychmod($dest, $CHMOD);
					}
				}
	}

	// affichage du texte ------------------------------------------------
	function show($npage = 0)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		require_once $_SESSION["ROOTDIR"]."/include/smileys.php";
		require_once $_SESSION["ROOTDIR"]."/include/spip.php";

		require $_SESSION["ROOTDIR"]."/msg/wiki.php";
		require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/wiki.php");

		// on sélectionne les infos du document courant
		$Query  = "select wiki._IDpage, wiki._date, wiki._owner, wiki._author, wiki._text, wiki._title, wiki._raw, wiki_page._IDgrpwr ";
		$Query .= "from wiki, wiki_page ";
		$Query .= "where wiki._tag = '$this->tag' ";
//		$Query .= "AND wiki_page._IDpage = wiki._ver ";
		$Query .= ( $npage ) ? "AND wiki._IDpage = '$npage' " : "AND wiki._current = 'O' ";
		$Query .= "limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? $this->remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		$this->page = $row[0];

		// affichage du titre
		$title = ( strlen($row[5]) )
			? "<p class=\"center\"><span class=\"medium\"><strong>$row[5]</strong></span></p><hr/>"
			: "" ;

		// affichage du texte
		$note  = "";
		if ( $row[6] == "O" ) {
			$texte = replace_smile(find_typo(find_image(stripslashes($row[4])), $note));
			$texte = $this->replace($texte);
			}
		else
			$texte = $row[4];

		if ( !strlen($texte) )
			print( $msg->read($WIKI_EDIT) );

		// lecture des Pièces Jointes
		$result = mysql_query("select _IDpj, _file, _size, _text from wiki_pj where _tag = '$this->tag'", $mysql_link);
		$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;

		$files  = ( $myrow )
			? "<hr style=\"width:10%; margin-left:0px;\" />"
			: "" ;

		while ( $myrow ) {
			$ext    = extension($myrow[1]);
			$link   = $_SESSION["ROOTDIR"]."/$DOWNLOAD/wiki/$myrow[0]-$myrow[1]";

			$del    = ( $row[7] & pow(2, $_SESSION["CnxGrp"] - 1) )
				? "<a href=\"$this->link&amp;wiki_cmde=del_attach&amp;IDpj=$myrow[0]\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"$ext\" alt=\"$ext\" /></a>"
				: "" ;

			$files .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/mime/$ext.gif\" title=\"$ext\" alt=\"$ext\" /> ";
			$files .= ( $myrow[3] == "" )
				? $msg->read($WIKI_DOC, Array($link, "$myrow[2]"))
				: $msg->read($WIKI_FULLDOC, Array($link, $myrow[3], "$myrow[2]")) ;
			$files .= " $del <br />" ;

			$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;
			}

		print("
	            <div style=\"padding:2px; text-align:justify; background-color:#eeeeee;\">
			$title
			<div class=\"small\">$texte</div>
			<div class=\"small\">$files &nbsp;</div>
	            </div>
			");

		// affichage de la barre d'outils wiki
		if ( $this->admin OR $this->user )
			$this->tools($row[1], $row[2], $row[3]);
	}

	// affichage du texte ------------------------------------------------
	function del_attach($idpj)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// lecture des Pièces Jointes
		$result = mysql_query("select _file from wiki_pj where _IDpj = '$idpj' limit 1", $mysql_link);
		$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;

		if ( mysql_query("delete from wiki_pj where _IDpj = '$idpj' limit 1", $mysql_link) )
			return unlink($_SESSION["ROOTDIR"]."/$DOWNLOAD/wiki/$idpj-$myrow[0]");

		return 0;
	}

	// affichage de la barre d'outils ------------------------------------
	function tools($date, $owner, $author)
	{
		require $_SESSION["ROOTDIR"]."/msg/wiki.php";
		require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/wiki.php");

		// initialisation
		$img  = $this->isLocked($this->page) ? "unlock" : "lock" ;
		$text = $this->isLocked($this->page) ? $msg->read($WIKI_UNLOCK) : $msg->read($WIKI_LOCK) ;

		// affichage de la barre d'outils wiki
		$edit = ( !$this->isLocked($this->page) AND $this->isCurrent($this->page) )
			? "<a href=\"$this->link&amp;IDpage=$this->page&amp;wiki_cmde=edit&amp;wiki_tag=$this->tag\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/icon_edit.gif\" title=\"". $msg->read($WIKI_UPDTCOMMENT) ."\" alt=\"\" /></a>"
			: "" ;
		$lock = ( $this->admin )
			? "<a href=\"$this->link&amp;IDpage=$this->page&amp;wiki_cmde=lock\"><img src=\"".$_SESSION["ROOTDIR"]."/images/wiki/$img.gif\" title=\"". $msg->read($WIKI_COMMENT, $text) ."\" alt=\"\" /></a>"
			: "" ;
		$del  = ( $this->admin )
			? "<a href=\"$this->link&amp;IDpage=$this->page&amp;wiki_cmde=del\"><img src=\"".$_SESSION["ROOTDIR"]."/images/wiki/delete.gif\" title=\"". $msg->read($WIKI_DELCOMMENT) ."\" alt=\"\" /></a>"
			: "" ;
		$val  = ( $this->admin )
			? "<a href=\"$this->link&amp;IDpage=$this->page&amp;wiki_cmde=valid\"><img src=\"".$_SESSION["ROOTDIR"]."/images/wiki/ok.gif\" title=\"". $msg->read($WIKI_VALIDATE) ."\"  alt=\"\"  /></a>"
			: "" ;

		$prev = ( $this->admin )
			? "[<a href=\"$this->link&amp;IDpage=$this->page&amp;wiki_cmde=prev\"><<</a>] "
			: "" ;
		$next = ( $this->admin )
			? "[<a href=\"$this->link&amp;IDpage=$this->page&amp;wiki_cmde=next\">>></a>] "
			: "" ;

		// affichage de la barre d'outils wiki
		print("
			<div style=\"background-color:#eeeeee; padding:2px; border-style:solid; border-color:#000000; border-width:1px;\">
				<span class=\"x-small\">
					$edit
					:: $date :: $owner :: $author :: page $this->page $prev$next::
					$lock
					$del
					$val
				</span>
			</div>
			");
	}

	// test du texte courant ---------------------------------------------
	function isCurrent($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// on vérifie si le document est le document courant
		$result = mysql_query("select _current from wiki where _IDpage = '$IDpage'", $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		$nbelem = mysql_affected_rows($mysql_link);

		return (bool) ( $row[0] == "O" OR !$nbelem );
	}

	// test du verroux du texte ------------------------------------------
	function isLocked($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// on vérifie si le document est verrouillé
		$result = mysql_query("select _lock from wiki where _IDpage = '$IDpage'", $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		return (bool) ($row[0] == "O");
	}

	// verrouillage/déverrouillage du texte ------------------------------
	function setLock($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// on verrouille le document s'il ne l'est pas
		$Query  = "update wiki ";
		$Query .= $this->isLocked($IDpage) ? "set _lock = 'N' " : "set _lock = 'O' " ;
		$Query .= "where _IDpage = '$IDpage'" ;

		return mysql_query($Query, $mysql_link);
	}

	// effaçage du texte -------------------------------------------------
	function delete($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		if ( $this->isCurrent($IDpage) ) {
			$query  = "select _IDpage from wiki ";
			$query .= "where _tag = '$this->tag' AND _IDpage < '$IDpage' ";
			$query .= "order by _IDpage desc limit 1";

			$result = mysql_query($query, $mysql_link);
			$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

			if ( $row )
				if ( !mysql_query("update wiki set _current = 'O' where _IDpage = '$row[0]'", $mysql_link) )
					return 0;
			}

		return mysql_query("delete from wiki where _IDpage = '$IDpage'", $mysql_link);
	}

	// effaçage de tous les textes ---------------------------------------
	function erase()
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		$query  = "delete from wiki ";
		$query .= "where _tag = '$this->tag' ";

		return mysql_query($query, $mysql_link);
	}

	// validation du texte -----------------------------------------------
	function validate($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// on efface les autres documents
		if ( !mysql_query("delete from wiki where _tag = '$this->tag' AND _IDpage != '$IDpage'", $mysql_link) )
			return 0;

		return mysql_query("update wiki set _current = 'O' where _IDpage = '$IDpage'", $mysql_link);
	}

	// document suivant --------------------------------------------------
	function nextPage($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// recherche du document suivant
		$Query  = "select _IDpage from wiki ";
		$Query .= "where _IDpage > '$IDpage' ";
		$Query .= "AND _tag = '$this->tag' ";
		$Query .= "order by _IDpage asc limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		return $this->show($row[0] ? $row[0] : $IDpage);
	}

	// document précédent ------------------------------------------------
	function prevPage($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// recherche du document précédent
		$Query  = "select _IDpage from wiki ";
		$Query .= "where _IDpage < '$IDpage' ";
		$Query .= "AND _tag = '$this->tag' ";
		$Query .= "order by _IDpage desc limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		return $this->show($row[0] ? $row[0] : $IDpage);
	}

	// document précédent ------------------------------------------------
	function replace($texte)
	{
		require $_SESSION["ROOTDIR"]."/msg/wiki.php";
		require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/wiki.php");

		// recherche de la balise pour modification de texte
		$markup = "input type=\"hidden\" name=\"wiki_link_modify\" value";

		do 	{			
			$find = strpos($texte, $markup);

			if ( $find ) {
				$token = substr($texte, $find + strlen($markup) + 1, 1024);
				$end   = strpos($token, " />");

				if ( $end ) {
					$value = substr($token, 1, $end - 2);

					if ( $this->isLocked($this->page) )
						$texte = str_replace(
							"<$markup=\"$value\" />", "", $texte);
					else
						$texte = str_replace(
							"<$markup=\"$value\" />", 
							"<span class=\"x-small\">[<a href=\"$this->link&amp;IDpage=$this->page&amp;wiki_cmde=edit&amp;markup=$value\">".$msg->read($WIKI_MODIFY)."</a>]</span>", 
							$texte);
					}	
				}
			} while ( $find );

		// recherche de la balise des liens internes
		$markup = "wiki_link_internal";

		do 	{			
			$find = strpos($texte, $markup);

			if ( $find )
				$texte = str_replace("$markup", "$this->link", $texte);
			} while ( $find );

		return $texte;
	}

	// paragraphe précédent ----------------------------------------------
	function banner($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// recherche du document précédent
		$Query  = "select _banner from wiki ";
		$Query .= "where _IDpage = '$IDpage' ";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? $this->remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		return ( $row ) ? $row[0] : "" ;
	}

	// paragraphe suivant ------------------------------------------------
	function footer($IDpage)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// recherche du document précédent
		$Query  = "select _footer from wiki ";
		$Query .= "where _IDpage = '$IDpage' ";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? $this->remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		return ( $row ) ? $row[0] : "" ;
	}

	// traitement des échappements ---------------------------------------
	function remove_magic_quotes($array)
	{
		/*
		 * fonction :	nettoyage des \ dans une chaîne
		 * in :		$array : tableau de valeurs
		 */

		// On n'exécute la boucle que si nécessaire
		if ( $array AND get_magic_quotes_gpc() == 1 )
			foreach($array as $key => $val) {
				// Si c'est un array, recursion de la fonction, sinon suppression des slashes
				if ( is_array($val) )
					remove_magic_quotes($array[$key]);
				else
					if ( is_string($val) )
						$array[$key] = stripslashes($val);
				}

		return $array;
	}
}
//---------------------------------------------------------------------------
?>
