<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : config.php
 *		projet   : recherche et mise � jour d'une variable de param�trage
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 16/05/03
 *		modif    : 
 */

?>


<?php
//---------------------------------------------------------------------------
function getService(&$item)
{
	/*
	 * fonction :	recherche le service
	 * in :		$item : index du service
	 * out :		page web � afficher
	 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// page par d�faut
	$page = strlen($FLASH)
		? "flash_visu.htm"
		: "download/spip/templates/".$_SESSION["lang"]."/custom.htm" ;

	if ( strlen($SERVICE) ) {
		@list($lbl1, $item, $lbl2, $cmde) = preg_split("/[=&]/", $SERVICE);

		$service = Array(
			1 => "user",
			3 => "forum",
			4 => "postit",
			5 => "gallery",
			6 => "spip",
			8 => "agenda",
			10 => "reservation",
			13 => "ctn",
			15 => "fil",
			17 => "egroup",
			18 => "motd",
			19 => "cms",
			31 => "resource",
			40 => "cv",
			45 => "etp",
			63 => "absent",
			64 => "edt"
			);

		if ( $lbl1 == "item" ) {
			$mod = $service[$item];
			$cmd = ( $lbl2 == "cmde" ) ? "_$cmde" : "" ;

			if ( strlen($mod) )
				$page = $mod.$cmd.".htm";
			}
		}

	return $page;
}
// --------------------------------------------------------------------
function writeconfigfile($input, $output,
	$server, $user, $passwd, $database, $servport, $charset,
	$download = "download", $persist = 0, $filtre = 0, $debug = 0, $demo = 1, $userpwd = 0, $delay = 1800, $size = 1024000, $hdquotas = 1024000,
	$log = 5184000, $stat = 2678400, $data = 20, $page = 9, $recent = 5, $link = 172800, $flash = "Prom�th�e", $authuser = "1:0",
	$tblspacing = 10, $menuskin = 0, $acountime = "0000-00-00 00:00:00", $post = 3628800, $sms = "", $smspwd = "",
	$timezone = "Europe/Paris", $archbit = 32)
{
	// ouverture des fichiers
	if ( !file_exists($input) )
		return -1;

	if ( !($out = @fopen($output, "w")) )
		return -2;

	// modification fichier de configuration
	fputs($out, 
		str_replace(
			Array(
				"##SERVER##",
				"##USER##",
				"##PASSWD##",
				"##DATABASE##",
				"\"##SERVPORT##\"",
				"##CHARSET##",
				"##DOWNLOAD##",
				"##LANG##",
				"\"##PERSIST##\"",
				"\"##FILTRE##\"",
				"\"##DEBUG##\"",
				"\"##DEMO##\"",
				"\"##USERPWD##\"",
				"\"##DELAY##\"",
				"\"##SIZE##\"",
				"\"##HDQUOTAS##\"",
				"\"##LOG##\"",
				"\"##STATS##\"",
				"\"##DATA##\"",
				"\"##PAGE##\"",
				"\"##RECENT##\"",
				"\"##LINK##\"",
				"##FLASH##",
				"##AUTHUSER##",
				"\"##TBLSPACING##\"",
				"\"##MENUSKIN##\"",
				"##ACOUNTIME##",
				"\"##POST##\"",
				"##SMS##",
				"##SMSPWD##",
				"##TIMEZONE##",
				"\"##ARCHBIT##\""
				),
			Array(
				str_replace(Array('$', '"'), Array('\$', '\"'), $server),
				str_replace(Array('$', '"'), Array('\$', '\"'), $user),
				str_replace(Array('', '"'),  Array('\$', '\"'), $passwd),
				str_replace(Array('$', '"'), Array('\$', '\"'), $database),
				strval($servport),
				$charset,
				$download,
				$_SESSION["lang"],
				$persist,
				$filtre,
				$debug,
				$demo,
				$userpwd,
				$delay,
				$size,
				$hdquotas,
				$log,
				$stat,
				$data,
				$page,
				$recent,
				$link,
				$flash,
				$authuser,
				$tblspacing,
				$menuskin,
				$acountime,
				$post,
				str_replace(Array('$', '"'), Array('\$', '\"'), $sms),
				str_replace(Array('$', '"'), Array('\$', '\"'), $smspwd),
				$timezone,
				$archbit
				),
			file_get_contents($input))
		);

	//fermeture fichiers
	fclose($out);

	return 0;
}
//---------------------------------------------------------------------------
function setConfig($key, $value)
{
	/*
	 * fonction :	met � jour le fichier config.php
	 * in :		$key : nom de la variable � modifier, $value : nouvelle valeur
	 * out :		true si pas d'erreur, false sinon
	 */

	// ouverture des fichiers
	if ( !($in  = @fopen($_SESSION["CFGDIR"]."/config.php", "r")) )
		return false;

	if ( !($out = @fopen($_SESSION["CFGDIR"]."/tmp/config.php", "w")) )
		return false;

	// copie configuration
	while ( !feof($in) ) {
		$line = fgets($in, 255);

		if ( strstr($line, $key) ) {
			mb_eregi("= (.*);", $line, $regs);	// on isole la valeur
//			eregi("= (.*);", $line, $regs);	// d�pr�ci�e depuis PHP 5
			$line = str_replace("= ". strval($regs[1]) .";", "= $value;", $line);

			// mise � jour de la variable
			$var  = "$key";
			$$var = "$value";
			}

		fputs($out, $line);
		}

	//fermeture fichiers
	fclose($out);
	fclose($in);

	return @unlink($_SESSION["CFGDIR"]."/config.php") ? @rename($_SESSION["CFGDIR"]."/tmp/config.php", $_SESSION["CFGDIR"]."/config.php") : false ;
}
//---------------------------------------------------------------------------
?>