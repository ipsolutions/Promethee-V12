<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2009 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : agenda_mvc.php
 *		projet   : modèle vue controleur d'accès aux backoffices des agendas
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 3/07/09
 *		modif    : 
 */
?>

<?php
	// l'agenda personnalisé supplante l'agenda par défaut
	$query  = "select agenda._IDdata, agenda_user._weekly ";
	$query .= "from agenda, agenda_user ";
	$query .= "where agenda._private = '".$_SESSION["CnxID"]."' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$IDdata = $row[0];
	$weekly = ( $row[1] == "O" ) ? 1 : 2 ;

	$page   = "agenda.htm";
?>