<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2009 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : liaison_mvc.php
 *		projet   : mod�le vue controleur d'acc�s aux backoffices du carnet de liaison
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 4/04/09
 *		modif    : 
 */
?>

<?php
	switch ( getAccess() ) {
		case '1' :	// les �l�ves
			$cmde    = "show";
			$page    = "liaison_$cmde.htm";

			// lecture de l'identifiant �l�ve
			$query   = "select _ID from user_id ";
			$query  .= "where _ID = '".$_SESSION["CnxID"]."' AND _IDgrp = '1' ";
			$query  .= "limit 1";

			$result  = mysql_query($query, $mysql_link);
			$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

			$IDeleve = (int) $row[0];
			break;

		case '2' :	// le personnel
			$cmde    = "";
			$page    = "liaison.htm";
			break;

		default :	// les autres
			$cmde    = "";
			$page    = "liaison.htm";
			break;
		} // end switch
?>