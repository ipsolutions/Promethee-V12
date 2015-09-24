<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2013 by IP-Solutions(contact@ip-solutions.fr)

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
 *		module   : mobile_edt.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php include("mobile_banner.php"); ?>
<?php
	require "msg/edt.php";
	require_once "include/TMessage.php";

	// qui suis-je ?
	$query  = "select distinctrow _adm, _IDgrp from user_id, user_session ";
	$query .= "where _IDsess = '$sid' " ;
	$query .= "AND user_id._ID = user_session._ID ";
	$query .= "order by _lastaction ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// vérification des droits
	$query   = "select _IDmod, _IDgrpwr from edt ";
	$query  .= "where _IDedt = '$IDedt' " ;
	$query  .= "limit 1";

	$result  = mysql_query($query, $mysql_link);
	$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $auth[0] != 255 AND $auth[0] != $row[0] AND !($row[1] & pow(2, $auth[1] - 1)) )
		exit;

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/edt.php");
	$msg->msg_search  = $keywords_search;
	$msg->msg_replace = $keywords_replace;
	
	// traitement commande
	if ( $submit ) {
		$query = ( $IDdata )
			? "update edt_data set _IDmat = '$IDmat', _IDclass = '$IDclass', _IDitem = '$IDitem', _ID = '$IDuser', _semaine = '$idweek', _group = '$idgroup', _delais = '$delay' where _IDdata = '$IDdata'"
			: "insert into edt_data values('', '$IDedt', '$IDcentre', '$IDmat', '$IDclass', '$IDitem', '$IDuser', '$idweek', '$idgroup', '$j', '$h', '$delay', 'O')" ;

		mysql_query($query, $mysql_link);

		// retour à la fénêtre appelante
		print("
			<script type=\"text/javascript\">
			window.opener.location=\"index.php?item=".@$_GET["item"]."&IDedt=$IDedt&IDcentre=$IDcentre&IDitem=$IDitem&IDuser=$IDuser&IDclass=$IDclass\";
			self.close();
			</script>");
		}

	if ( $IDdata ) {
		$query   = "select _IDmat, _IDclass, _delais, _semaine, _IDitem, _group, _ID from edt_data ";
		$query  .= "where _IDdata = '$IDdata' " ;
		$query  .= "limit 1";

		$result  = mysql_query($query, $mysql_link);
		$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

		$IDmat   = (int) $row[0];
		$IDclass = (int) $row[1];
		$delay   = $row[2];
		$idweek  = (int) $row[3];
		$IDitem  = (int) $row[4];
		$idgroup = (int) $row[5];
		$IDuser  = (int) $row[6];
		}
?>

<?php include("edt_mobile.htm"); ?>

<?php include("mobile_menu.php"); ?>
<?php include("mobile_footer.php"); ?>