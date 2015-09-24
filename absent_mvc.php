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
 *		module   : absent_mvc.php
 *		projet   : modèle vue controleur d'accès aux backoffices des absences
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 29/10/08
 *		modif    : 
 */
?>

<?php
	switch ( getAccess() ) {
		case '1' :	// les élèves
			$cmde    = "show";

			// lecture de l'identifiant élève
			$query   = "select _ID from user_id ";
			$query  .= "where _ID = '".$_SESSION["CnxID"]."' AND _IDgrp = '1' ";
			$query  .= "limit 1";

			$result  = mysql_query($query, $mysql_link);
			$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

			$IDeleve = (int) $row[0];
			break;

		case '2' :	// le personnel
			$cmde    = "visu";

			$IDsel   = $_SESSION["CnxGrp"];
			$IDuser  = $_SESSION["CnxID"];
			break;

		default :	// les autres
			$cmde    = "show";
			break;
		} // end switch

	$page = "absent_$cmde.htm";
?>