<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
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
 *		module   : calendar.php
 *		projet   : génération d'un calendrier
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 29/12/03
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


function mkcalendar($year, $month, $bgcolor="#EEEEEE")
{
	/*
	 * fonction :	affichage d'un calendrier
	 * in :		année et mois
	 */

	require "globals.php";
	require "msg/calendar.php";

	require_once "include/TMessage.php";
	require_once "include/calendar_tools.php";

	require_once "msg/".$_SESSION["lang"]."/ephemeride.php";

	// initalisation
	global	$item;

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/calendar.php");

	$mois = explode(",", $msg->read($CALENDAR_MONTHFULL));
	$days = explode(",", $msg->read($CALENDAR_DAYS));

	if ( !strlen($year) )
		$year  = (int) date("Y");
	if ( !strlen($month) )
		$month = (int) date("m") - 1;

	// nombre de jours dans le mois
	$nbdays   = getmaxdays($year, $month + 1);

	// 1er jour du mois
	$firstday = date("w", mktime(1, 1, 1, $month + 1, 1, $year));
	if ( !$firstday )
		$firstday = 7;

	// en-tête du formulaire
	$mytext  = "
			<form id=\"calendar\" action=\"index.php\" method=\"post\" style=\"background-color:$bgcolor;\">
				<p class=\"hidden\"><input type=\"hidden\" name=\"item\" value=\"$item\" /></p>";

	$prev_m  = $month - 1;

	// sélection mois/année
	$mytext .= "
	      <table class=\"width100\">
	        <tr>
			<td class=\"align-right\">
				<a href =\"index.php?mycal_month=$prev_m&amp;mycal_year=$year\">«</a>
				<label for=\"mycal_month\">
				<select id=\"mycal_month\" name=\"mycal_month\" style=\"font-size:11px;\" onchange=\"document.forms.calendar.submit()\" >";

	for ($i = 0; $i < 12; $i++)
		$mytext .= ($i == $month
			? "<option value=\"$i\" selected=\"selected\">$mois[$i]</option>"
			: "<option value=\"$i\">$mois[$i]</option>");

	$mytext .= "
				</select>
				</label>
			</td>
			<td class=\"align-left\">



				<label for=\"mycal_year\">
				<select id=\"mycal_year\" name=\"mycal_year\" style=\"font-size:11px;\" onchange=\"document.forms.calendar.submit()\" >";

	for ($i = $year - 4; $i < $year + 4; $i++)
		$mytext .= ($i == $year
			? "<option value=\"$i\" selected=\"selected\">$i</option>"
			: "<option value=\"$i\">$i</option>");

	$next_m  = $month + 1;

	$mytext .= "
				</select>
				</label>
				<a href =\"index.php?mycal_month=$next_m&amp;mycal_year=$year\">»</a>
			</td>
	        </tr>
	      </table>";

	// en-tête du calendrier
	$mytext .= "
	      <table class=\"width100\">
	        <tr style=\"padding:0px;\">";

	for ($i=0; $i < count($days); $i++)
		$mytext .= "<td style=\"width:14%;\" class=\"x-small align-center\"><strong>$days[$i]</strong></td>";

	$mytext .= "
	        </tr>
	        <tr style=\"padding:0px;\">
			<td colspan=\"7\"><hr/></td>
	        </tr>";

	// construction du calendrier
	$j      = 1;
	$jour   = 1;
	$lemois = $month + 1;
	while ( $jour <= $nbdays )
		for ($i = 1; $i <= 7; $i++) {
			if ( $i == 1 )
				$mytext .= "<tr style=\"padding:0px;\">";

			$query  = "select _IDfil from flash_fil ";
			$query .= "where _IDflash = '0' AND _date = '$year-$lemois-$jour 00:00:00' ";
			$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (_IDgrp & ".pow(2, $_SESSION["CnxGrp"] -1).")";

			$result = mysql_query($query, $mysql_link);

			// a-t-on trouvé une valeur ?
			$color  = ( mysql_affected_rows($mysql_link) ) ? "#FFCC66" : "$bgcolor" ;

			// les évènements de l'éphéméride
			$saint  = strtok(ephemeride($jour, $lemois), "|");
			$event  = strtok("|");

			if ( $event ) {
				$event = trim(addslashes($event));
				$over  = "<span>$event</span>";
				}
			else
				$over = "";

			$link   = ( mysql_affected_rows($mysql_link) )
				? "<a href=\"".myurlencode("index.php?item=15&cmde=visu&year=$year&month=$lemois&day=$jour")."\" class=\"overlib\">$jour$over</a>"
				: ($over
					? "<a href=\"#\" class=\"overlib\">$jour$over</a>"
					: $jour) ;

			$date   = ( $j >= $firstday AND $jour <= $nbdays )
				? (($year == date("Y") AND $month == date("m") - 1 AND $jour == date("d"))
					? "<span style=\"color:#FF0000\"><strong>$link</strong></span>"
					: $link
				  )
				: "&nbsp;" ;

			$hover  = ( mysql_affected_rows($mysql_link) AND $date != "&nbsp;" )
				? " style=\"background-color:$color;\" onmouseover=\"style.backgroundColor='#FF9900';\" onmouseout=\"style.backgroundColor='$color';\" "
				: "" ;

			$mytext .= "<td class=\"x-small align-center valign-middle\" $hover>$date</td>";

			if ( $i == 7 )
				$mytext .= "</tr>";

			if ( $j >= $firstday )
				$jour++;
			$j++;
			}

	$mytext .= "</table>";

	// date d'aujourd'hui
	list($year, $month, $day) = explode("-", date("Y-m-d"));

	$mytext .= "
		<div class=\"x-small\" style=\"text-align: center;\">
			[<a href=\"".myurlencode("index.php?item=15&cmde=visu&year=$year&month=$month&day=$day")."\">". $msg->read($CALENDAR_TODAY) ."</a>]
		</div>";
	$mytext .= "</form>";

	return $mytext;
}
//---------------------------------------------------------------------------
?>
