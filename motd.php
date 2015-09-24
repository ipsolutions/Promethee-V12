<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
?>

<?php
/*
 *		module   : motd.php
 *		projet   : affichage du message du jour
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 28/01/07
 *		modif    : 
 */


//---------------------------------------------------------------------------
function motd($IDitem = 0)
{
/*
 * fonction :	affichage des messages du jour sur la page
 */

//	global	$mysql_link;

	require "globals.php";

	require_once "include/filext.php";
	require_once "include/smileys.php";
	require_once "include/spip.php";
	require_once "include/calendar_tools.php";

	require "msg/motd.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/motd.php");

	// si l'utilisateur n'et pas identifié : on quitte
	if ( !$_SESSION["CnxID"] )
		return;

	// date et heure du jour
	$date   = date("Y-m-d H:i:s");

	$myID   = $_SESSION["CnxID"];
	$myIP   = $_SESSION["CnxIP"];

	$item   = (int) @$_GET["item"];

	// recherche des messages à afficher
	$Query  = "select _centre from user_id ";
	$Query .= "where _ID = '".$_SESSION["CnxID"]."' ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// attention aux profs qui sont sur plusieurs centres
	$Query  = "select _IDitem, _ID, _IP, _date, _title, _texte, _img, _raw, _persistent ";
	$Query .= "from motd_items ";
	$Query .= "where _lang = '".$_SESSION["lang"]."' ";
	$Query .= "AND (_IDcentre = '0' OR _IDcentre = '".$_SESSION["CnxCentre"]."' OR $myrow[0] & pow(2, _IDcentre - 1)) ";
	$Query .= ( $IDitem ) ? "AND _IDitem = '$IDitem' "  : "AND ('$date' BETWEEN _start AND _end) " ;
	$Query .= "AND _IDgrp & pow(2, ".$_SESSION["CnxGrp"]." - 1) ";
	$Query .= "order by _start desc ";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	while ( $row ) {
		// acquittement de lecture
		if ( !mysql_query("insert into motd_vu values('$row[0]', '$myID', '$myIP', '$date', 'O')", $mysql_link) )
			mysql_query("update motd_vu set _IP = '$myIP', _date = '$date' where _ID = '$myID' AND _IDitem = '$row[0]' limit 1", $mysql_link);
		else
			mysql_query("update motd_items set _hit = _hit + 1 where _IDitem = '$row[0]' limit 1", $mysql_link);

		// fermeture de lecture
		if ( @$_GET["motd_close"] )
			mysql_query("update motd_vu set _visible = 'N' where _ID = '$myID' AND _IDitem = '".$_GET["motd_close"]."' limit 1", $mysql_link);

		// PJ 
		$res   = mysql_query("select _IDpj from motd_pj where _IDitem = '$row[0]' limit 1", $mysql_link);
		$pj    = ( $res ) ? mysql_affected_rows($mysql_link) : 0 ;
		$ispj  = ( $pj )
			? "<img src=\"".$_SESSION["ROOTDIR"]."/images/pj.gif\" title=\"\" alt=\"\" /> <span class=\"x-small\">". $msg->read($MOTD_ATTACHED) ."</span>"
			: "" ;

		$next  = "";

		if ( $ispj ) {
			// lecture des PJ
			$query  = "select _IDpj, _file, _size, _text from motd_pj ";
			$query .= "where _IDitem = '$row[0]' ";

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			while ( $myrow ) {
				$ext   = extension($myrow[1]);
				$link  = "<a href=\"$DOWNLOAD/motd/$myrow[0].$ext\" onclick=\"window.open(this.href, '_blank'); return false;\">$myrow[1]</a>";

				$next .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/mime/$ext.gif\" title=\"$ext\" alt=\"$ext\" /> ";
				$next .= $msg->read($MOTD_BYTE, Array($link, number_format($myrow[2], 0, ",", " "))) ."<br/>";
				$next .= ( $myrow[3] ) ? "<span class=\"x-small\">$myrow[3]</span><br/>" : "" ;

				$myrow = mysql_fetch_row($return);
				}				
			}

		$header = $footer = "";
		$line   = explode("\n", $row[5]);

		for ($i = 0; $i < 2 AND $i < count($line); $i++)
			$header .= "$line[$i]\n" ;
		for ($i = 2; $i < count($line); $i++)
			$footer .= "$line[$i]\n" ;

		if ( count($line) > 3 ) {
			$next .= "<p style=\"border-top: #cccccc solid 1px; margin-top: 5px; width: 30%;\">";
			$next .= "[ <span style=\"cursor: pointer; \" onclick=\"$('motd_$row[0]')._display.toggle(); return false;\">". $msg->read($MOTD_MORE) ."</span> ]";
			$next .= "</p>";
			}

		// si texte brut, on remplace les raccourcis typographiques
		if ( $row[7] == "O" ) {
			$header = replace_smile(find_typo($header, $note));
			$footer = replace_smile(find_typo($footer, $note));
			}

		// annonce persistante
		$close  = $icon = "";
		
		switch ( $row[8] ) {
			case 2 :	// annonce avec acquittement
				$icon  = "<img src=\"".$_SESSION["ROOTDIR"]."/images/document.gif\" title=\"\" alt=\"\" />";
				$close = "[ <a href=\"index.php?item=$item&amp;motd_close=$row[0]\">". $msg->read($MOTD_MYACK) ."</a> ]";
				break;
			case 1 :	// annonce persistante
				$icon  = "<img src=\"".$_SESSION["ROOTDIR"]."/images/document.gif\" title=\"\" alt=\"\" />";
				break;
			default :
				$close = "[ <a href=\"index.php?item=$item&amp;motd_close=$row[0]\">". $msg->read($MOTD_CLOSE) ."</a> ]";
				break;
			}

		// lecture des annonces acquittées
		$query  = "select _visible from motd_vu ";
		$query .= "where _IDitem = '$row[0]' AND _ID = '$myID' ";

		$return = mysql_query($query, $mysql_link);
		$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;

		// affichage du message
		if ( $myrow[0] == "O" OR @$_GET["motd_all"] )
			print("
				<table class=\"width100\">
		              <tr>
					<td colspan=\"3\" style=\"border: #cccccc solid 1px;\">
						<span class=\"x-large\"><strong>$row[4]</strong></span><br/>
						<span class=\"x-small\">". $msg->read($MOTD_BY, Array(getUserName($row[1]), date2longfmt($row[3]), _getHostName($row[2]))) ."</span> $icon
					</td>
		              </tr>

		              <tr>
					<td style=\"width:100px;\" class=\"align-center\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/annonces/$row[6]\" title=\"\" alt=\"\" />
					</td>
					<td colspan=\"2\" style=\"padding-left:20px; border-left-style:dotted;\">
						$header
						<div id=\"motd_$row[0]\" style=\"display:none;\">$footer</div>
						$next
					</td>
		              </tr>

		              <tr>
					<td></td>
					<td>$ispj</td>
					<td class=\"align-right\">$close</td>
		              </tr>
				</table><br/>
				");

		$row = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;
		}
}
//---------------------------------------------------------------------------
?>
