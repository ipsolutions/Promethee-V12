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
 *		module   : menutools.php
 *		projet   : utilitaires pour la gestion des menus
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 17/03/02
 *		modif    : 
 */

//---------------------------------------------------------------------------
function getMenuName($id)
{
	/*
	 * fonction :	d�termine l'intitul� du menu
	 * in :		$id : ID du menu
	 * out :		nom du menu
	 */

	global	$mysql_link;

	$query  = "select _ident from config_menu ";
	$query .= "where _IDmenu = '$id' AND _lang = '".$_SESSION["lang"]."' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	return ( $row ) ? "$row[0]" : "??" ;
}
//---------------------------------------------------------------------------
function isMenuVisible($id)
{
	/*
	 * fonction :	d�termine si un menu est affichable
	 * in :		$id : id du menu
	 * out :		visible si menu affichable, invisible sinon
	 */

	global	$mysql_link;

	$query  = "select _visible from config_menu ";
	$query .= "where _IDmenu = '$id' AND _lang = '".$_SESSION["lang"]."' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	return ( $row[0]  == "N" ) ? "invisible" : "visible" ;
}
//---------------------------------------------------------------------------
function setMenuVisible($id, $value)
{
	/*
	 * fonction :	rend un menu visible ou invisible
	 * in :		$id : id du menu, $value : visible ou invisible
	 * out :		r�sultat de la requ�te SQL
	 */

	global	$mysql_link;

	$visible = ( $value == "visible" ) ? "N" : "O" ;

	$query   = "update config_menu ";
	$query  .= "set _visible = '$visible' ";
	$query  .= "where _IDmenu = '$id' AND _lang = '".$_SESSION["lang"]."' ";
	$query  .= "limit 1";

	return ( $_SESSION["CnxAdm"] == 255 OR ($_SESSION["CnxAdm"] & 8) )
		? mysql_query($query, $mysql_link)
		: 0 ;
}
//---------------------------------------------------------------------------
function setSubmenuVisible($id, $value)
{
	/*
	 * fonction :	rend un sous-menu visible ou invisible
	 * in :		$id : id du sous-menu, $value : visible ou invisible
	 * out :		r�sultat de la requ�te SQL
	 */

	global	$mysql_link;

	$visible = ( $value == "visible" ) ? "N" : "O" ;

	$query   = "update config_submenu ";
	$query  .= "set _visible = '$visible' ";
	$query  .= "where _IDsubmenu = '$id' AND _lang = '".$_SESSION["lang"]."' ";
	$query  .= "limit 1";

	return ( $_SESSION["CnxAdm"] == 255 OR ($_SESSION["CnxAdm"] & 8) )
		? mysql_query($query, $mysql_link)
		: 0 ;
}
//---------------------------------------------------------------------------
function setUserItemOrder($ident, $value)
{
	/*
	 * fonction :	d�placement des items de menu
	 * in :		$ident : id du menu, $value : up, down
	 */

	global	$mysql_link;

	$items  = array();

	$query  = "select _IDmenu from config_submenu ";
	$query .= "where _IDsubmenu = '$ident' AND _lang = '".$_SESSION["lang"]."' ";
	$query .= "limit 1";

	$return = mysql_query($query, $mysql_link);
	$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;

	$query  = "select _IDsubmenu from config_submenu ";
	$query .= "where _IDmenu = '$myrow[0]' AND _lang = '".$_SESSION["lang"]."' ";
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

	// r��criture
	$i = 0;
	foreach ($items as $clef => $valeur) {
		$i++;
		mysql_query("update config_submenu set _order = '$i' where _IDsubmenu = '$valeur' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		}
}
//---------------------------------------------------------------------------
function setUserMenuOrder($ident, $value)
{
	/*
	 * fonction :	d�placement des blocs de menu
	 * in :		$ident : id du menu, $value : up, down, rigth ou left
	 */

	global	$mysql_link;

	$left   = array();
	$right  = array();

	//==== menu gauche
	$query  = "select _IDmenu from config_menu ";
	$query .= "where _order > 0 AND _lang = '".$_SESSION["lang"]."' ";
	$query .= "AND _activate = 'O' ";
	$query .= "order by _order asc";

	$return = mysql_query($query, $mysql_link);
	$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;
	$nbelem = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

	$i = 1;
	while ( $myrow ) {
		if ( $myrow[0] != $ident OR $value != "right" ) {
			$key = ( $myrow[0] == $ident AND ($value == "up" OR $value == "down") )
				? ($value == "up"
					? ($i == 1 ? ($nbelem*2) + 5 : ($i*2) - 3)
					: ($i == $nbelem ? -3 : ($i*2) + 3) )
				: $i * 2 ;

			$left += Array($key => $myrow[0]);
			$i++;
			}

		$myrow = mysql_fetch_row($return);
		}

	// un item est pass� � gauche
	if ( $value == "left" )
		$left = array_merge($left, Array($i*2 => $ident));

	//==== menu droit
	$query  = "select _IDmenu from config_menu ";
	$query .= "where _order < 0 AND _lang = '".$_SESSION["lang"]."' ";
	$query .= "AND _activate = 'O' ";
	$query .= "order by _order desc";

	$return = mysql_query($query, $mysql_link);
	$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;
	$nbelem = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

	$i = 1;
	while ( $myrow ) {
		if ( $myrow[0] != $ident OR $value != "left" ) {
			$key = ( $myrow[0] == $ident AND ($value == "up" OR $value == "down") )
				? ($value == "up"
					? ($i == 1 ? ($nbelem*2) + 5 : ($i*2) - 3)
					: ($i == $nbelem ? -3 : ($i*2) + 3) )
				: $i * 2 ;

			$right += Array($key => $myrow[0]);
			$i++;
			}

		$myrow = mysql_fetch_row($return);
		}

	// un item est pass� � droite
	if ( $value == "right" )
		$right = array_merge($right, Array($i*2 => $ident));

	// tri
	@ksort($left);
	@ksort($right);

	// r��criture
	$i = 0;
	foreach ($left as $clef => $valeur) {
		$i++;
		mysql_query("update config_menu set _order = '$i' where _IDmenu = '$valeur' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		}

	$i = 0;
	foreach ($right as $clef => $valeur) {
		$i++;
		mysql_query("update config_menu set _order = '-$i' where _IDmenu = '$valeur' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		}
}
//---------------------------------------------------------------------------
function isUserMenuVisible($id)
{
	/*
	 * fonction :	d�termine si un menu est d�roul�
	 * in :		$id : id du menu
	 * out :		open pour d�rouler, close pour fermer
	 */

	global	$mysql_link;

	$query  = "select _visible from user_menu ";
	$query .= "where _ID = '".$_SESSION["CnxID"]."' AND _IDmenu = '$id' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	return ( @$row[0]  == "N" ) ? "open" : "close" ;
}
//---------------------------------------------------------------------------
function setUserMenu($id, $value)
{
	/*
	 * fonction :	d�roule ou ferme un menu
	 * in :		$id : id du menu, $value : N ou O
	 */

	global	$mysql_link;

	$visible = ( $value == "close" ) ? "N" : "O" ;

	$query   = "update user_menu ";
	$query  .= "set _visible = '$visible' ";
	$query  .= "where _ID = '".$_SESSION["CnxID"]."' AND _IDmenu = '$id' " ;
	$query  .= "limit 1";

	mysql_query($query, $mysql_link);

	if ( mysql_affected_rows($mysql_link) == 0 ) {
		$query   = "insert into user_menu ";
		$query  .= "values('".$_SESSION["CnxID"]."', '$id', '$visible')" ;

		mysql_query($query, $mysql_link);
		}
}
//---------------------------------------------------------------------------
?>