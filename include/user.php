<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : user.php
 *		projet   : classe objet pour gestion des ACL
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 29/10/04
 *		modif    : 
 *
 */



//---------------------------------------------------------------------------
class user_acl
{
	var	$ident = "";		// table de la bdd

	// constructeur -------------------------------------------------------
	function user_acl($ident)
	{
		$this->ident = $ident;
	}
	// recherche d'un utilisateur -----------------------------------------
	function isMember($IDident, $ID)
	{
		require $_SESSION["ROOTDIR"]."/globals.php";

		// on cherche l'utilisateur dans la liste
		$query  = "select _IDacl from user_acl ";
		$query .= "where _ident = '$this->ident' AND _IDident = '$IDident' AND _ID = '$ID' ";
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);

		return ( $result) ? mysql_numrows($result) : 0 ;
	}
}
//---------------------------------------------------------------------------
?>