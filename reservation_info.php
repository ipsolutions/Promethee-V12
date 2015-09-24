<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

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
 *		module   : reservation_info.php
 *		projet   : informations concernant les ressources du module de réservations
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 25/09/04
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDdata  = (int) @$_GET["IDdata"];		// ID de la ressource
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require_once "include/calendar_tools.php";

	require "msg/reservation.php";
	require_once "include/TMessage.php";

	$_msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/reservation.php");
?>

<table  class="width100" style="border-color:<?php print($_SESSION["CfgColor"]); ?>" cellpadding="5">
  <tr>
<?php
	// recherche de la ressource
	$result = mysql_query("select _titre, _texte, _ident from reservation_data where _IDdata = '$IDdata'", $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	print("
		<td class=\"align-center\" style=\"background-color:".$_SESSION["CfgColor"]."\"><strong><span style=\"color:#FFFFFF;\">$row[0]</span></strong></td>
		");
?>
  </tr>
  <tr>
<?php
	print("
		<td>
			".$_msg->read($RESERVATION_IDENT)."<br/>". nl2br($row[1]) ."<br/><br/>
			".$_msg->read($RESERVATION_LOCATION)."<br/>$row[2]<br/><br/>
			".$_msg->read($RESERVATION_LAST)."<br/>
		");

	$query  = "select _ID, _start, _end from reservation_items ";
	$query .= "where _IDdata = '$IDdata' AND _visible = 'O' ";
	$query .= "AND _start <= '". date("Y") ."-". date("m") ."-". date("d") ." 23:59:59' ";
	$query .= "order by _IDitem desc limit 10";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	while ( $row ) {
		print(
			$_msg->read($RESERVATION_FROMTO, Array(getUserName($row[0], "E"), date2longfmt($row[1]), date2longfmt($row[2])))
			."<br/><br/>");

		$row = mysql_fetch_row($result);
		}

	print("
		</td>
		");
?>
  </tr>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($_msg->read($RESERVATION_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>