<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2010 by Dominique Laporte(C-E-D@wanadoo.fr)

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
   along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.ss
 /*-----------------------------------------------------------------------*/


/*
 *		module   : setup.php
 *		projet   : la page de configuration automatique de la base de donn�es
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 30/08/10
 *		modif    : 
 */



// --------------------------------------------------------------------
function stripComment($string)
{
/*
 * fonction :	enl�ve les commentaires d'une requ�te SQL
 * in :		$string, requ�te SQL � traiter
 * out :		requ�te SQL sans commentaire
 */

	if ( $string == "" )
		return "";

	$ret = strpos($string, "#");
	$pos = ( $ret == false AND $string[0] != '#' ) ? -1 : $ret ;
	$p   = $pos - 1;

	if ( $pos > -1 ) {
		if ( $p > 0 ) {
			while ( $pos > -1 AND $string[$p] != "\t" ) {
				$ret = strpos(substr($string, $pos + 1, strlen($string)), "#");
				if ( $ret == false )
					$pos = -1;
				else
					$pos += strpos(substr($string, $pos + 1, strlen($string)), "#") + 1;
				$p   = $pos - 1;
				}

			return ( $p > 0 AND @$string[$p] == "\t" )
				? substr($string, 0, $p)
				: $string ;
			}
		else
			return "";
		}
	else
		return $string;
}
// --------------------------------------------------------------------
function request($database, $isOk, $file)
{
/*
 * fonction :	ex�cution de requ�te SQL
 * in :		$database, nom de la base de donn�es
 *			$isOk, identifiant resource MySQL
 *			$file, nom de fichier MySQL
 * out :		-1 si fichier SQL introuvable, nombre d'erreur de syntaxe SQL sinon
 */

	// ouverture fichiers
	if ( !($in  = @fopen($file, "r")) )
		return -1;

	// initialisation requ�te
	$query  = "";
	$erreur = 0;

	// lecture fichier sql
	$count = 1;

	while ( !feof($in) ) {
		// suppression des blancs et retour charriots
		$line = trim(str_replace("\n", "", fgets($in, 2048)));
		$line = str_replace("##DATABASE##", $database, $line);

		// suppression des commentaires
		$line = stripComment($line);

		// construction de la requ�te
		if ( strlen($line) ) {
			$query .= $line;

			// validation de la requ�te
			if ( strrpos($line, ";") == strlen($line) - 1 ) {
				// Trace
				global	$debug;
				if ( $debug == 2 )
					print("$query<br/>");

				// lancement de la requ�te
				if ( !mysql_query($query, $isOk) ) {
					$errno = mysql_errno($isOk);
					$error = mysql_error($isOk);

					print("<span style=\"color:#FF0000\"><strong>Error $errno</strong></span> : ($file @ $count) $error.</span><br/>");
					$erreur++;
					}

				$query = "";
				}
			}

		$count++;
		}

	//fermeture fichiers
	fclose($in);

	return $erreur;
}
// --------------------------------------------------------------------
function updatedatabase($server, $user, $passwd, $database, $servport, $langlist, $text)
{
	global $VERSION;

	require $_SESSION["ROOTDIR"]."/msg/setup.php";

	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/setup.php");

	// connexion � la dba MySql
	$servname = $server . ($servport ? ":$servport" : "");
	$isOk     = mysql_connect($servname, $user, $passwd);

	if ( !$isOk )
		return -1;

	// initialisation
	$error    = 0;

	// on met � jour la bdd
	list($major, $minor) = preg_split("/[.rc]/", $VERSION);

	$M = (int) $major;
	$m = (int) $minor;

	// l'incr�mentation automatique ne fonctionne qu'� partir de la version 5.0
	if ( (int) $major > 4 ) {
		$query  = "select _version, _retcode from $database.config_database ";
		$query .= "order by _IDconf desc limit 1";

		$result = mysql_query($query, $isOk);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// attention � une table vide
		if ( mysql_affected_rows($isOk) ) {
			list($M, $m) = preg_split("/[.rc]/", $row[0]);

			// si l'installation de la derni�re maj est correcte
			// on passe � la version suivante
			// sauf si mode for�age
			if ( (int) $row[1] == 0 OR $force )
				$m++;
			}
		}

	// on effectue les mises � jour incr�mentales
	for ($i = $M; $i <= $major && $error == 0; $i++) {
		for ($j = $m; $j <= $minor && $error == 0; $j++) {
			// pour l'instant on ne g�re pas les versions correctives
			$version = "$i.$j"."rc1";

			if ( file_exists("Mysql/update/database-$version.sql") ) {
				$error += request($database, $isOk, "Mysql/update/database-$version.sql");

				// lecture des r�pertoires de langues
				for ($k = 0; $k < count($langlist); $k++) {
					$path   = "Mysql/update/".$langlist[$k]."/database-$version.sql";

					if ( file_exists($path) )
						$error += request($database, $isOk, $path);
					}

				// tables dans la base de donn�es
//				$result = mysql_list_tables($database, $isOk);	// d�pr�ci� en PHP5
				$result = mysql_query("show tables from $database");
				$tables = ( $result ) ? mysql_numrows($result) : 0 ;

				// log des mises � jour
				mysql_query("insert into config_database values('', '$version', '". @$_SERVER["REMOTE_ADDR"] ."', '".date("Y-m-d H:i:s")."', '$tables', '$error', '". $_SESSION["lang"] ."')", $isOk);

				$img   = ( $error ) ? "off" : "on" ;

				$text .= $msg->read($MSG_UPDATE, $version) ." ";
				$text .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_$img.png\" title=\"\" alt=\"*\" /><br/>";
				}

			// application des patch
			if ( file_exists("Mysql/update/patch/patch-$version.php") ) {
				require "Mysql/update/patch/patch-$version.php";

				if ( function_exists('patch') )
					patch($isOk);

				$img   = ( !function_exists('patch') ) ? "off" : "on" ;

				$text .= $msg->read($MSG_PATCH, "patch-$version.php") ." ";
				$text .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_$img.png\" title=\"\" alt=\"*\" /><br/>";
				}
			}	// endfor minor

		$m = 0; $minor = 12;
		}	// endfor major

	return $error;
}
// --------------------------------------------------------------------
function createdatabase($server, $user, $passwd, $database, $servport, $langlist, $dba = "")
{
	global $VERSION;

	// connexion � la dba MySql
	$servname = $server . ($servport ? ":$servport" : "");
	$isOk     = mysql_connect($servname, $user, $passwd);

	if ( !$isOk )
		return -1;

	// la cr�ation de la DB peut prendre du temps => on supprime le tps max d'ex�cution des requ�tes
	// attention : safe_mode doit �tre d�sactiv�
	$safe_mode  = ini_get("safe_mode");
	$time_limit = ini_get("max_execution_time");

	if ( $safe_mode != "1" )
		set_time_limit(0);

	// choix de la base de donn�es
	$path = ( $dba )
		? "Mysql/$dba"
		: "Mysql" ;

	if ( ($error = request($database, $isOk, "$path/database.sql")) == -1 )
		return -2;

	// ouverture du r�pertoire des fichiers sql
	$myDir = @opendir($path);

	// lecture des fichiers sql
	while ( $entry = @readdir($myDir) )
		if ( strstr($entry, ".sql") )
			if ( $entry != "database.sql" )
				$error += request($database, $isOk, "$path/$entry");

	// fermeture du r�pertoire
	@closedir($myDir);

	// lecture des r�pertoires sql/langues
	for ($k = 0; $k < count($langlist); $k++) {
		$myDir = @opendir("$path/".$langlist[$k]);

		// lecture des fichiers sql
		while ( $entry = @readdir($myDir) )
			if ( strstr($entry, ".sql") )
				$error += request($database, $isOk, "$path/".$langlist[$k]."/$entry");

		// fermeture du r�pertoire
		@closedir($myDir);
		}

	// tables dans la base de donn�es
//	$result = mysql_list_tables($database, $isOk);	// d�pr�ci� en PHP5
	$result = mysql_query("show tables from $database");
	$tables = ( $result ) ? mysql_numrows($result) : 0 ;

	// log des cr�ations
	mysql_query("insert into config_database values('', '$VERSION', '". @$_SERVER["REMOTE_ADDR"] ."', '".date("Y-m-d H:i:s")."', '$tables', '$error', '". $_SESSION["lang"] ."')", $isOk);

	// r�initialisation du tps max d'ex�cution des requ�tes
	if ( $safe_mode != "1" )
		set_time_limit($time_limit);

	return $error;
}
// --------------------------------------------------------------------
function updateconfigfile(
	$server, $user, $passwd, $database, $servport,
	$ident, $adresse, $tel, $fax, $email, $web, $zip, $city, $IDtheme = 1)
{
	// connexion au serveur MySql
	$servname   = $server . ($servport ? ":$servport" : "");
	$mysql_link = mysql_connect($servname, $user, $passwd);

	if ( !$mysql_link )
		return -1;

	require $_SESSION["ROOTDIR"]."/msg/config.php";
	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg    = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/config.php");

	// recherche de la config de l'�tablissement
	$query  = "select _IDconf from config ";
	$query .= "where _visible = 'O' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);

	// si on a trouv� une valeur => mise � jour
	if ( mysql_numrows($result) ) {
		$query  = "update config ";
		$query .= "set _idtheme = '$IDtheme', _adresse = '$adresse', _cp = '$zip', _ville = '$city', ";
		$query .= "_tel = '$tel', _fax = '$fax', _email = '$email', _web = '$web' ";
		$query .= "where _visible = 'O' ";

		if ( !mysql_query($query, $mysql_link) )
			sql_error_and_die($mysql_link);
           	}
	// sinon cr�ation
	else {
		// toutes les langues
		$query  = "update config ";
		$query .= "set _ident = '$ident', ";
		$query .= "_adresse = '$adresse', _cp = '$zip', _ville = '$city', _tel = '$tel', _fax = '$fax', _email = '$email', _web = '$web', ";
		$query .= "_visible = 'O' ";
		$query .= "where _ident = ''";

		if ( !mysql_query($query, $mysql_link) )
			sql_error_and_die($mysql_link);

		// pour la langue courante
		$title  = addslashes($msg->read($CONFIG_TITLE));
		$texte  = addslashes($msg->read($CONFIG_TEXT));
		$login  = addslashes($msg->read($CONFIG_LOGIN));

		$query  = "update config ";
		$query .= "set _title = '$title', _texte = '$texte', _login = '$login' ";
		$query .= "where _ident = '$ident' AND _lang = '".$_SESSION["lang"]."' ";
		$query .= "limit 1";

		if ( !mysql_query($query, $mysql_link) )
			sql_error_and_die($mysql_link);

		// cr�ation r�pertoire
		$dir   = "download/logos/". stripslashes($ident);
		if ( !is_dir($dir) )
			if ( !mkdir($dir) )
				die($msg->read($CONFIG_NOPERM, $dir));
			else {
				// copie des logos par d�faut
				$dest = "$dir/logo01.jpg";

				// copie du fichier temporaire -> r�pertoire de stockage
				$file = @$_FILES["UploadedFile1"]["tmp_name"];
				if ( $file )
					move_uploaded_file($file, $dest);
				else
					copy("download/logos/default/logo01.jpg", $dest);

				$dest = "$dir/logo02.jpg";

				// copie du fichier temporaire -> r�pertoire de stockage
				$file = @$_FILES["UploadedFile2"]["tmp_name"];
				if ( $file )
					move_uploaded_file($file, $dest);
				else
					copy("download/logos/default/logo02.jpg", $dest);
				}
		}

	return 0;
}
//---------------------------------------------------------------------------
?>