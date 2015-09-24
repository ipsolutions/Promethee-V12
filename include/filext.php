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
?>

<?php
/*
 *		module   : filext.php
 *		projet   : extraction de l'extension d'un nom de fichier
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 27/10/02
 *		modif    :  
 */


//---------------------------------------------------------------------------
function extension($file, $default = "")
{
/*
 * fonction :	extraction de l'extension du nom de fichier
 * in :		$file : nom de fichier, $default : extension par d�faut
 * out :		extension de fichier
 */

	$pos = strrpos($file, ".");

	$ext = ( $pos )
		? substr($file, $pos + 1, 4)
		: ($default
			? $default
			: "") ;

	// renvoie de l'extension
	return strtolower($ext);
}
//---------------------------------------------------------------------------
function authfile($file, $extension = "")
{
/*
 * fonction :	test si un fichier est autoris� � �tre t�l�charg�
 * in :		nom de fichier
 * out :		true si autoris�, false sinon
 */

	global	$mysql_link;

	$ext = extension($file);

	// v�rification du type de fichier attendu
	if ( $extension AND $extension != $ext )
		return false;

	// lecture de l'icone associ�e � l'extension
	if ( mysql_query("select _ext from config_mime where _ext = '$ext' AND _visible ='O' limit 1", $mysql_link) )
		return mysql_affected_rows($mysql_link) ? true : false ;

	return false;
}
//---------------------------------------------------------------------------
function mymkdir($dir, $chmod)
{
/*
 * fonction :	cr�e un r�pertoire avec les permissions ad hoc
 * in :		$dir : nom du r�pertoire, $chmod : permissions
 * out :		true si cr�ation autoris�e, false sinon
 */

	$oldumask = umask(0);
	$return   = @mkdir($dir, $chmod);
	umask($oldumask);

	return $return;
}
//---------------------------------------------------------------------------
function mychmod($file, $chmod)
{
/*
 * fonction :	attribue les permissions � un fichier
 * in :		$file : nom du fichier, $chmod : permissions
 * out :		true si permission autoris�e, false sinon
 */

	$oldumask = umask(0);
	$return   = chmod($file, $chmod);
	umask($oldumask);

	return $return;
}
//---------------------------------------------------------------------------
?>
