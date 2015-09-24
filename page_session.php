<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2013 by IP-Solutions(contact@ip-solutions.fr)

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
 *		module   : page_session.php
 *		projet   : connexion serveur et lecture du fichier de configuration
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/07/10
 *		modif    : 
 */


// variables d'environnement pour l'h�bergement de sites
$_SESSION["CFGDIR"] = ( @$CFGDIR != "" ) ? $CFGDIR : "." ;
$_SESSION["ROOTDIR"] = ( @$ROOTDIR != "" ) ? $ROOTDIR : "." ;
$_SESSION["CfgPuce"]    = $_SESSION["ROOTDIR"]."/css/themes/puce/dash.gif";

//---------------------------------------------------------------------------
require_once $_SESSION["CFGDIR"]."/config.php";
//---------------------------------------------------------------------------
require_once "include/TMessage.php";
require_once "include/sqltools.php";
require_once "include/menutools.php";
require_once "include/logintools.php";
require_once "include/urlencode.php";
require_once "include/session.php";
require_once "include/filext.php";
require_once "include/config.php";
require_once "include/nl2br.php";
//---------------------------------------------------------------------------
require_once "script/fckeditor/fckeditor.php";
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
require_once "msg/page.php";

//---- choix de la langue ----
if ( !empty($_GET["lang"]) )
	$_SESSION["lang"] = $_GET["lang"];
else
	if ( empty($_SESSION["lang"]) )
		if ( isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ) {
			$list = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
			$lang = strtolower(substr(chop($list[0]), 0, 2));

			// pays de langue fran�aise
			$fr   = Array('fr', 'be', 'bf', 'bj', 'cd', 'cf', 'cg', 'ch', 'ci', 'cm', 'dz', 'ga', 'gf', 'gq', 'lc', 'lu', 'ma', 'mg', 'mq', 'mu', 'ne', 'pf', 'pm', 're', 'sc', 'sn', 'td', 'tn', 'wf', 'yt');

			// pays de langue espagnole
			$es   = Array('es', 'ar', 'bo', 'cl', 'co', 'cr', 'cu', 'do', 'ec', 'mx', 'pr', 'gt', 'gw', 'hn', 'ni', 'pa', 'pe', 'py', 'sv', 'uy', 've');

			if ( in_array($lang, $fr) )
				$_SESSION["lang"] = ( is_dir("msg/fr") ) ? "fr" : $LANG ;
			else
				if ( in_array($lang, $es) )
					$_SESSION["lang"] = ( is_dir("msg/es") ) ? "es" : $LANG ;
				else
					$_SESSION["lang"] = ( is_dir("msg/en") ) ? "en" : $LANG ;
			}
		else
			$_SESSION["lang"] = $LANG;

$message = new TMessage("msg/".$_SESSION["lang"]."/page.php", $_SESSION["ROOTDIR"]);
//---- choix de la langue ----

// pour les requ�tes SQL
//set_magic_quotes_runtime(0);	// d�pr�ci� en PHP5

// D�finit le d�calage horaire par d�faut de toutes les fonctions date/heure (PHP 5 >= 5.1.0)
if ( function_exists('date_default_timezone_set') )
	date_default_timezone_set($TIMEZONE);

// initialisation du g�n�rateur
srand(time());

// connexion � la base de donn�es
$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

if ( !$mysql_link OR isvisibleIP($_SERVER["REMOTE_ADDR"]) == "N" ) {
	print("<script type=\"text/javascript\"> window.location.replace('forbidden.php?lang=".$_SESSION["lang"]."', '_self'); </script>");
	exit;
	}

// lecture du fichier de configuration
$query  = "select _ident from config ";
$query .= "where _visible = 'O' ";
$query .= "AND _lang = '".$_SESSION["lang"]."' ";
$query .= "limit 1";

$result = mysql_query($query, $mysql_link);
$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

$_SESSION["CfgIdent"] = mysql_numrows($result) ? $row[0] : "default" ;

// on test si la configuration pour la langue s�lectionn�e a �t� activ�e
$query  = "select _IDtheme from config ";
$query .= "where _ident = '". addslashes($_SESSION["CfgIdent"]) ."' ";
$query .= "AND config._lang = '".$_SESSION["lang"]."' ";
$query .= "limit 1";

$result = mysql_query($query, $mysql_link);

// lecture des param�tres de configuration g�n�rale
$query  = "select _IDtheme, _title, _texte, _login, _adresse, _tel, _fax, _web, _email, _IDconf, _puce, ";
$query .= "_bgcolor, _fond, _header, _tdcolor, _logo1, _logo2, _align, _page, _webmaster, _crawler, _cp, _ville, _bandeau ";
$query .= "from config ";
$query .= "where _ident = '". addslashes($_SESSION["CfgIdent"]) ."' ";
$query .= "AND config._lang = '".$_SESSION["lang"]."' ";
$query .= "limit 1";

$result = mysql_query($query, $mysql_link);
$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

if ( $row ) {
	$_SESSION["CfgTitle"]   = $row[1];
	$_SESSION["CfgText"]    = $row[2];
	$_SESSION["CfgLogin"]   = $row[3];
	$_SESSION["CfgAdr"]     = "$row[4], $row[21] $row[22]";
	$_SESSION["CfgTel"]     = $row[5];
	$_SESSION["CfgFax"]     = $row[6];
	$_SESSION["CfgWeb"]     = $row[7];
	$_SESSION["CfgEmail"]   = $row[8];
	$_SESSION["CfgID"]      = $row[9];
	$_SESSION["CfgFond"]    = $_SESSION["ROOTDIR"]."/css/themes/fond/$row[12]";
	$_SESSION["CfgTdcolor"] = $row[14];
	$_SESSION["CfgLogo1"]   = $row[15];
	$_SESSION["CfgLogo2"]   = $row[16];
	$_SESSION["CfgAlign"]   = $row[17];
	$_SESSION["CfgPage"]    = $row[18];
	$_SESSION["CfgAdmin"]   = $row[19];
	$_SESSION["CfgZip"]     = $row[21];
	$_SESSION["CfgCity"]    = $row[22];
	$_SESSION["CfgBandeau"]    = $row[23];

	// lecture du th�me
	$query  = "select _theme, _color, _bgcolor from config_theme ";
	$query .= "where _IDtheme = '$row[0]' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$theme  = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $theme ) {
		$_SESSION["CfgTheme"]   = $theme[0];
		$_SESSION["CfgColor"]   = $theme[1];
		$_SESSION["CfgBgcolor"] = ( $row[11] == "O" ) ? $theme[2] : "#FFFFFF";
		}

	}


// lecture des param�tres de configuration des mot-clefs
$keywords_search  = Array();
$keywords_replace = Array();

$query  = "select _ident, _text from config_def ";
$query .= "where _IDcentre = '".@$_SESSION["CnxCentre"]."' AND _lang = '".$_SESSION["lang"]."' ";

$result = mysql_query($query, $mysql_link);
$myrow  = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

while ( $myrow ) {
	array_push($keywords_search,  $myrow[0]);
	array_push($keywords_replace, $myrow[1]);

	$myrow = remove_magic_quotes(mysql_fetch_row($result));
	}
?>