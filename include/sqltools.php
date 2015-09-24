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
 *		module   : sqltools.php
 *		projet   : utilitaires pour les appels sql
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 17/03/02
 *		modif    : 
 */

//---------------------------------------------------------------------------
function sql_error_value($link)
{
	/*
	 * fonction :	retourne les erreurs survenues lors d'une requ�te SQL
	 * in :		lien de connexion au serveur mysql
	 * out :		rien
	 */

	$errno = mysql_errno($link);
	$error = mysql_error($link);

	return "<span class=\"small\"><span style=\"color:#FF0000\"><strong>Error $errno</strong></span> : $error.</span><br/>";
}
//---------------------------------------------------------------------------
function sql_error($link)
{
	/*
	 * fonction :	affiche les erreurs survenues lors d'une requ�te SQL
	 * in :		lien de connexion au serveur mysql
	 * out :		rien
	 */

	print( sql_error_value($link) );
}
//---------------------------------------------------------------------------
function sql_error_and_die($link)
{
	/*
	 * fonction :	affiche les erreurs survenues lors d'une requ�te SQL et termine le programme
	 * in :		lien de connexion au serveur mysql
	 * out :		rien
	 */

	exit( sql_error($link) );
}
//---------------------------------------------------------------------------
function sql_getunique($table)
{
	/*
	 * fonction :	retourne le n� d'index du 1er �l�ment
	 * in :		nom de la table
	 * out :		n� index si trouv�, -1 si erreur
	 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	$result = mysql_query("select * from $table", $mysql_link);
	$field  = ( $result ) ? mysql_field_name($result, 0) : "" ;

	$Query  = "select $field from $table ";
	$Query .= "where _lang = '".$_SESSION["lang"]."' ";
	$Query .= "order by $field desc ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	return ( $result ) ? (int) ($row[0] + 1) : -1 ;
}
//---------------------------------------------------------------------------
function connectDatabase($server, $user, $passwd, $database, $servport = 0, $persistent = 0)
{
	/*
	 * fonction :	connexion � la base de donn�es
	 * in :		$server, nom du serveur MySQL
	 * 			$user, nom utilisateur
	 * 			$passwd, mot de passe de l'utilisateur
	 * 			$database, nom de la base de donn�es
	 * 			$servport, n� du port
	 * 			$persistent, connexion persistente
	 * out :		lien de connexion au serveur mysql
	 */

	global	$mysql_link;

	if ( $mysql_link )
		return $mysql_link;

	// connexion au serveur MySql
	$servname   = $server . ($servport ? ":$servport" : "");

	$mysql_link = ( $persistent )
		? @mysql_connect($servname, $user, $passwd)
		: @mysql_connect($servname, $user, $passwd) ;

	if ( !$mysql_link )
		sql_error($mysql_link);
	else
		// s�lection de la base de donn�es
		if ( !mysql_select_db($database, $mysql_link) )
			sql_error($mysql_link);
//print("$servname, $user, $passwd, $database");

	return $mysql_link;
}
//---------------------------------------------------------------------------
?>