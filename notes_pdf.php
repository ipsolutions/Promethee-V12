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
 *		module   : notes_pdf.php
 *		projet   : la page d'impression des bulletins de notes
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/12/09
 *		modif    : 
 */


$IDcentre = (int) @$_GET["IDcentre"];		// Identifiant du centre
$IDclass  = (int) @$_GET["IDclass"];		// Identifiant de la classe
$IDeleve  = (int) @$_GET["IDeleve"];		// Identifiant de l'élève
$year     = (int) @$_GET["year"];			// année
$period   = (int) @$_GET["period"];			// trimestre
error_reporting(0);
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require_once "include/notes.php";

	// qui suis-je ?
	$query  = "select distinctrow user_id._ID, user_id._IDgrp ";
	$query .= "from user_id, user_session ";
	$query .= "where user_session._IDsess = '".@$_GET["sid"]."' ";
	$query .= "AND user_id._ID = user_session._ID ";
	$query .= "order by user_session._lastaction ";
	$query .= "limit 1";

	$return = mysql_query($query, $mysql_link);
	$auth   = ( $return ) ? mysql_fetch_row($return) : 0 ;

	// il faut appartenir au personnel
	if ( getAccess($auth[1]) == 2 )
		exportPDF($IDcentre, $IDclass, $IDeleve, $year, $period);
	else
		exportPDF($IDcentre, $IDclass, $auth[0], $year, $period);
?>

</body>
</html>
