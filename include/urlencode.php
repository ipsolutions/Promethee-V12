<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006-2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : urlencode.php
 *		projet   : formattage des url pour XHTML 1.0 strict
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 14/08/06
 *		modif    :  
 */


//---------------------------------------------------------------------------
function stripaccent($string, $hexa = false)
{
/*
 * fonction :	remplace les caract�res accentu�s dans une ch�ine
 * in :		$string : cha�ne de caract�re accentu�e, $hexa : transformation en code hexa
 * out :		cha�ne de caract�re sans accent
 */

	// les caract�res de remplacement
	$accent = Array('�','�','�','�','�','�','�','�','�','�','�','�','�','�','�');
	$filtre = ( $hexa )
		? Array('%E0','%E4','%E2','%E9','%E8','%EB','%EA','%EF','%EE','%F6','%F4','%F9','%FC','%FB','%E7')
		: Array('a','a','a','e','e','e','e','i','i','o','o','u','u','u','c') ;

	// renvoie de la nouvelle cha�ne
	return str_replace($accent, $filtre, $string);
}
//---------------------------------------------------------------------------
function stripspecialcar($string)
{
/*
 * fonction :	remplace les caract�res sp�ciaux dans une ch�ine
 * in :		$string : cha�ne de caract�re
 * out :		cha�ne de caract�re valide
 */

	// les caract�res de remplacement
	$special = Array('\'','"',' ','?','!','@','>','<');

	// renvoie de la nouvelle cha�ne
	return str_replace($special, "_", $string);
}
//---------------------------------------------------------------------------
function myurlencode($url)
{
	// si le lien est une url externe valide => pas de modification
	return ( strncmp($url, "http://", 7) AND strncmp($url, "https://", 8) )
		? stripaccent( str_replace(Array(' ', '&'), Array('%20', '&amp;'), trim($url)) )
		: str_replace(Array(' ', '&'), Array('%20', '&amp;'), $url) ;
}
//---------------------------------------------------------------------------
function myurldecode($url)
{
	return str_replace(Array('%20', '&amp;'), Array(' ', '&'), $url);
}
//---------------------------------------------------------------------------
?>