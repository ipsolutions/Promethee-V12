<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2008 by Dominique Laporte(C-E-D@wanadoo.fr)

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

/*
 *		module   : egroup_mvc.php
 *		projet   : modèle vue controleur d'accès aux backoffices des e-groupes
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 1/03/08
 *		modif    : 
 */
?>

<?php
	// recherche du modérateur du e-groupe
	$query  = "select _IDmod from egroup_data ";
	$query .= "where _IDdata = '".$_SESSION["egroup"]."' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// modérateur du e-groupe
	$IDmod  = (int) @$row[0];

	if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $IDmod ) {
		$item = (int) @$_GET["serv"];
		$cmde = "gestion";

		switch ( @$_GET["serv"] ) {
			case '3' :	// forum
				$page = "forum_$cmde.htm";
				break;
			case '5' :	// galeries
				break;
			case '6' :	// Publications par Internet
				break;
			case '8' :	// agenda
				break;
			case '14' :	// chat
				break;
			case '22' :	// gestion des liens
				break;
			case '31' :	// ressources pédagos & administratives
				break;
			case '34' :	// documents collaboratifs (wiki)
				break;
			case '36' :	// weblogs collaboratifs
				$page = "weblog_$cmde.htm";
				break;
			case '99' :	// sondage
				break;
			default :	// page d'accueil
				break;
			} // end switch ($item)
		}
?>