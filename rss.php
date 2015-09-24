<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007 by Dominique Laporte(C-E-D@wanadoo.fr)

   This file is part of Prom�th�e.

   Prom�th�e is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prom�th�e is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/


/*
 *		module   : rss.php
 *		projet   : la page de visualisation du flux RSS
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 13/10/07
 *		modif    : 
 */

// signale au navigateur un fichier XML
header("Content-Type: text/xml");

//---------------------------------------------------------------------------
require_once "config.php";
require_once "globals.php";

require_once "include/sqltools.php";
require_once "include/rss.php";
//---------------------------------------------------------------------------
function remove_magic_quotes($array)
{
	/*
	 * fonction :	nettoyage des \ dans une cha�ne
	 * in :		$array : tableau de valeurs
	 */

	// On n'ex�cute la boucle que si n�cessaire
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
//---------------------------------------------------------------------------

//---- choix de la langue ----
if ( !empty($_GET["lang"]) )
	$_SESSION["lang"] = $_GET["lang"];
else
	$_SESSION["lang"] = $LANG;

// connexion � la base de donn�es
$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

if ( $mysql_link ) {
	// lecture des param�tres de configuration g�n�rale
	$query  = "select _title, _web, _webmaster, _ident ";
	$query .= "from config ";
	$query .= "where _visible = 'O' ";
	$query .= "AND config._lang = '".$_SESSION["lang"]."' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	if ( $row ) {
		$_SESSION["CfgTitle"] = $row[0];
		$_SESSION["CfgWeb"]   = $row[1];
		$_SESSION["CfgAdmin"] = $row[2];
		$_SESSION["CfgIdent"] = $row[3];

		// on efface les news trops anciennes
		$query  = "delete from rss_items ";
		$query .= "where _date < '". date("Y-m-d H:i:s", (time() - $TIMERSS)) ."'";

		mysql_query($query, $mysql_link);

		// on s�lectionne le contenu
		$query  = "select distinctrow _IDitem, _author, _title, _text, _url, _date, _category ";
		$query .= "from rss_items ";
		$query .= "where _lang = '".$_SESSION["lang"]."' ";
		$query .= "order by _IDitem desc";
		$result = mysql_query($query, $mysql_link);

		if ( $result ) {
			$rss = new rss("[Prom�th�e] ".$_SESSION["CfgIdent"], $_SESSION["CfgWeb"], $_SESSION["CfgTitle"], $_SESSION["lang"], $_SESSION["CfgAdmin"]);

			$rss->create($result);
			}
		}
	}
?>
