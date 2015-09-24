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
 *		module   : agenda_week.php
 *		projet   : la page d'affichage hebdomadaire des agendas
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 3/07/09
 *		modif    : 
 */
?>



<?php
	// 1er jour de la semaine
	$fstday = date("w", mktime(1, 1, 1, $month + 1, $day, $year));
	$fstday = ( $fstday == 0 ) ? $day - 6 : $day - $fstday + 1 ;

	if ( $fstday < 1 ) {
		$month  = ( $month ) ? $month - 1 : 0 ;
		$fstday = $fstday + getmaxdays($month ? $year : ($year - 1), $month + 1);
		}

	// nombre de jours dans le mois
	$nbdays = getmaxdays($year, $month + 1);

	// semaine suivante
	if ( $fstday + 7 > $nbdays ) {
		$next_month = $month + 1;
		$next_days  = $fstday + 7 - $nbdays;
		}
	else {
		$next_month = $month;
		$next_days  = $fstday + 7;
		}
	$next_year  = ( $next_month > 11 ) ? $year + 1 : $year ;
	$next_month = $next_month % 12;

	// semaine précédente
	if ( $fstday - 7 < 1 ) {
		$prev_month = $month - 1;
		$prev_days  = $fstday - 7 + getmaxdays($month ? $year : ($year - 1), $month + 1);
		}
	else {
		$prev_month = $month;
		$prev_days  = $fstday - 7;
		}
	$prev_year  = ( $prev_month < 0 ) ? $year - 1 : $year ;
	$prev_month = ( $prev_month < 0 ) ? 11 : $prev_month ;
?>

     <table class="width100">
       <tr style="background-color:<?php print($_SESSION["CfgColor"]); ?>">
         <td class="align-center" style="width:1%;">
		<a href="<?php print(myurlencode("index.php?item=$item&IDdata=$IDdata&year=$prev_year&month=$prev_month&day=$prev_days&weekly=$weekly")); ?>"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/nav_right.gif" title="" alt="«" /></a>
         </td>
		<?php
			$days = explode(",", $msg->read($AGENDA_DAYS));

			for ($i = 0, $jour = $fstday; $i < count($days); $i++, $jour++) {
				$j = ( $jour <= $nbdays ) ? $jour : $jour % $nbdays ;
				$k = ( $jour <= $nbdays ) ? $month : ($month + 1) % 12 ;

//				if ( $idweek & pow(2, $i) )
					print("
						<td style=\"width:14%; color:#FFFFFF;\" class=\"align-center\">
							<strong>$days[$i] $j ".substr($mois[$k], 0, 4)."</strong>
						</td>");
				}
		?>
         <td class="align-center" style="width:1%;">
		<a href="<?php print(myurlencode("index.php?item=$item&IDdata=$IDdata&year=$next_year&month=$next_month&day=$next_days&weekly=$weekly")); ?>"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/nav_left.gif" title="" alt="»" /></a>
         </td>
       </tr>

	<?php
		$rowspan = Array();
		$modify  = $delete = "";
		$horaire = explode(",", $time);

		// initialisation
		for ($i = 0; $i < count($horaire); $i++)
			for ($j = 0, $jour = $fstday; $j < count($days); $j++, $jour++)
//				if ( $idweek & pow(2, $j) ) {
{
					$d = ( $jour <= $nbdays ) ? $jour : $jour % $nbdays ;
					$m = ( $jour <= $nbdays ) ? $month : ($month + 1) % 12 ;
					$y = ( $month < 12 ) ? $year : $year + 1 ;
					$k = $i + 1;

					list($h1, $m1) = explode(":", $horaire[$i]);
					list($h2, $m2) = ( $k != count($horaire) ) ? explode(":", $horaire[$k]) : explode(":", $horaire[$i]) ;

					$start = sprintf("%d-%02d-%02d %02d:%02d", $y, $m+1, $d, $h1, $m1);
					$end   = ( $k == count($horaire) )
						? sprintf("%d-%02d-%02d 23:59", $y, $m+1, $d)
						: sprintf("%d-%02d-%02d %02d:%02d", $y, $m+1, $d, $h2, $m2) ;

		      	   	// lecture des évènements
					$query  = "select distinctrow agenda_items._IDitem, agenda_items._titre, agenda_items._texte, agenda_items._start, agenda_items._end ";
					$query .= "from agenda_items, agenda ";
					$query .= ( $IDdata != -1 ) ? "where agenda_items._IDdata = '$IDdata' " : "where ((agenda_items._IDdata AND agenda._private = '0') OR agenda._private = '".$_SESSION["CnxID"]."') " ;
					$query .= "AND agenda_items._IDdata = agenda._IDdata ";
					$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (agenda._IDgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
//					$query .= "AND ((agenda_items._start between '$start' AND '$end') " ;
					$query .= "AND ((agenda_items._start >= '$start' AND agenda_items._start < '$end') " ;
					$query .= "OR ('$end' between agenda_items._start AND agenda_items._end) " ;
					$query .= "OR (agenda_items._end between '$start' AND '$end')) " ;
					$query .= "AND agenda_items._end != '$start' " ;
					$query .= "AND agenda_items._erase = agenda_items._date " ;

					$result = mysql_query($query, $mysql_link);
					$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

					$rowspan[$i][$j] = ( $row ) ? $row[0] : 0 ;
					}

		// construction du tableau
		for ($i = 0; $i < count($horaire); $i++) {
			print("<tr>");

			print("
				<td class=\"valign-top align-center\" style=\"background-color:#c0c0c0;\">
					$horaire[$i]
				</td>
				");

			for ($j = 0, $jour = $fstday; $j < count($days); $j++, $jour++)
//				if ( $idweek & pow(2, $j) )
					if ( $IDdata ) {
						$rspan = 1;
						if ( $rowspan[$i][$j] ) {
							if ( $i ) {
								$k = $i - 1;
								if ( $rowspan[$i][$j] == $rowspan[$k][$j] )
									$rspan = 0;
								}

							if ( $rspan )
								for ($k = $i + 1; $k < count($horaire) && $rowspan[$i][$j] == $rowspan[$k][$j]; $k++)
									$rspan++;
							}

						if ( $rspan ) {
				      	   	// lecture des évènements
							$query  = "select _IDitem, _ID, _IP, _titre, _date, _erase, _priority, _start, _end, _texte, _IDdata ";
							$query .= "from agenda_items ";
							$query .= "where _IDitem = '".$rowspan[$i][$j]."' " ;
							$query .= "limit 1";

							$result = mysql_query($query, $mysql_link);
							$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

							// on vérifie si la ressource n'a pas déjà été réservée
							$Query  = "select _IDitem from agenda_items ";
							$Query .= "where _IDdata = '$row[10]' ";
							$Query .= "AND ((_start < '$row[7]' AND _end > '$row[7]') OR (_start < '$row[8]' AND _end > '$row[8]')) ";	
							$Query .= "AND _IDitem != '$row[0]' ";
							$Query .= "limit 1";

							$value  = mysql_query($Query, $mysql_link);
							$found  = ( $value ) ? mysql_numrows($value) : 0 ;

							// description de l'évènement
			            	      $desc   = $msg->read($AGENDA_FROM)." ".date2longfmt($row[7])."<br/>";
		      	            	$desc  .= $msg->read($AGENDA_TO)." ".date2longfmt($row[8])."<br/>";
			            	      $desc  .= $msg->read($AGENDA_POSTED)." ".date2longfmt($row[4])."<br/>";
				            	$desc  .= $msg->read($AGENDA_AUTHOR)." ".getUserName($row[2], false);

							$desc   = str_replace(Array("\n", "\r"), Array("<br/>", ""), $desc);

							if ( $row ) {
								$text  = "<a href=\"#\" class=\"overlib\">";
								$text .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/$row[6].gif\" title=\"\" alt=\"\" /><span>$desc</span>";
								$text .= "</a> <strong>$row[3]</strong> ";
								$text .= "<span style=\"cursor: pointer;\" onclick=\"$('event_$row[0]')._display.toggle(); return false;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/max.gif\" title=\"\" alt=\"\" /></span>";
								$text .= "<div id=\"event_$row[0]\" style=\"display:none;\">$row[9]</div>";
								}
							else
								$text  = "";

							$color  = ( $text != "" ) ? "#eeeeee" : "#ffffff" ;
							$color  = ( $found ) ? "#e29cd1" : $color ;

							$d      = ( $jour <= $nbdays ) ? $jour : $jour % $nbdays ;
							$m      = ( $jour <= $nbdays ) ? $month : ($month + 1) % 12 ;
							$y      = ( $month < 12 ) ? $year : $year + 1 ;

							list($hour, $min) = explode(":", $horaire[$i]);
							$limit  = sprintf("%d-%02d-%02d %02d:%02d", $y, $m+1, $d, $hour, $min);

							$perms  = (bool) ( ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod OR ($idgrpwr & pow(2, $_SESSION["CnxGrp"] - 1))) 
								AND ($limit >= date("Y-m-d H:m")) );

							$add    = ( $perms AND $text == "" )
								? "<span class=\"x-small\">[<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDdata=$IDdata&year=$y&month=$m&day=$d&time=$horaire[$i]&weekly=$weekly")."\">".$msg->read($AGENDA_ADDACTION)."</a>]</span>"
								: $text ;

							// les modifications ou suppressions ne sont pas rétroactives
							if ( $limit >= date("Y-m-d H:m") ) {
								// modification des évènements
								$update = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod OR $_SESSION["CnxID"] == $row[1] )
									? "<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDdata=$IDdata&IDitem=$row[0]&year=$y&month=$m&day=$d&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"".$msg->read($AGENDA_UPDATEVENT)."\" alt=\"".$msg->read($AGENDA_UPDATEVENT)."\"/></a>"
									: "" ;

								// suppression des évènements
								$req    = $msg->read($AGENDA_DELETEVENT);
								$erase  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod OR $_SESSION["CnxID"] == $row[1] )
									? "<a href=\"".myurlencode("index.php?item=$item&IDdata=$IDdata&IDitem=$row[0]&year=$y&month=$m&day=$d&weekly=$weekly&submit=del")."\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($AGENDA_DELETEVENT)."\" alt=\"".$msg->read($AGENDA_DELETEVENT)."\" /></a>"
									: "" ;
								}
							else
								$update = $erase = "";

							if ( $text != "" AND $update != "" )
								$add = "$add<br/>$update $erase";

							print("
								<td rowspan=\"$rspan\" class=\"valign-top align-center\" style=\"background-color:$color;\" onmouseover=\"style.backgroundColor='#FF9900';\" onmouseout=\"style.backgroundColor='$color';\">
									$add
								</td>
								");

							//---- mise à jour de l'export iCal
							if ( $row ) {
								$vevent = new vevent();			// create an event calendar component

								list($date, $time) = explode(" ", $row[7]);
								list($y, $M, $d)   = explode("-", $date);
								list($h, $m, $s)   = explode(":", $time);

								$vevent->setProperty( 'dtstart', array( 'year'=>$y, 'month'=>$M, 'day'=>$d, 'hour'=>$h, 'min'=>$m, 'sec'=>$s ));

								list($date, $time) = explode(" ", $row[8]);
								list($y, $M, $d)   = explode("-", $date);
								list($h, $m, $s)   = explode(":", $time);

								$vevent->setProperty( 'dtend', array( 'year'=>$y, 'month'=>$M, 'day'=>$d, 'hour'=>$h, 'min'=>$m, 'sec'=>$s ));

								$vevent->setProperty( 'summary', $row[3] );
								$vevent->setProperty( 'description', $row[9] );
								$v->setComponent( $vevent );		// add event to calendar
								}
							}	// endif rspan
						}	// endif IDdata
					else {
						$d = ( $jour <= $nbdays ) ? $jour : $jour % $nbdays ;
						$m = ( $jour <= $nbdays ) ? $month : ($month + 1) % 12 ;
						$y = ( $month < 12 ) ? $year : $year + 1 ;
						$k = $i + 1;

						list($h1, $m1) = explode(":", $horaire[$i]);
						list($h2, $m2) = ( $k != count($horaire) ) ? explode(":", $horaire[$k]) : explode(":", $horaire[$i]) ;

						$start = sprintf("%d-%02d-%02d %02d:%02d", $y, $m+1, $d, $h1, $m1);
						$end   = ( $k == count($horaire) )
							? sprintf("%d-%02d-%02d 23:59", $y, $m+1, $d)
							: sprintf("%d-%02d-%02d %02d:%02d", $y, $m+1, $d, $h2, $m2) ;

		      		   	// lecture des demandes
						$query  = "select distinctrow agenda_items._priority, agenda_items._date, agenda_items._ID, agenda_items._IP, agenda_items._start, agenda_items._end, agenda_data._titre ";
						$query .= "from agenda_items, agenda ";
						$query .= "where agenda_items._IDdata = agenda_data._IDdata ";
						$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (agenda._IDgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
						$query .= "AND agenda_items._start != '$end' ";
//						$query .= "AND ((agenda_items._start between '$start' AND '$end') ";
						$query .= "AND ((agenda_items._start >= '$start' AND agenda_items._start < '$end') " ;
						$query .= "OR ('$end' between agenda_items._start AND agenda_items._end) ";
						$query .= "OR (agenda_items._end between '$start' AND '$end')) ";
						$query .= "AND agenda_items._end != '$start' ";
						$query .= "AND agenda_items._erase = agenda_items._date ";
						$query .= "order by agenda_items._priority";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						$texte  = "";
						while ( $row ) {
							// description de la réservation
				            	$desc   = $msg->read($AGENDA_BY)." ".getUserName($row[2], false)."<br/>";
				            	$desc  .= $msg->read($AGENDA_FROM)." ".date2longfmt($row[4])."<br/>";
			      	            $desc  .= $msg->read($AGENDA_TO)." ".date2longfmt($row[5])."<br/>";
				            	$desc  .= $msg->read($AGENDA_POSTED)." ".date2longfmt($row[1])." "._getHostName($row[3], false);

							$desc   = str_replace(Array("\n", "\r"), Array("<br/>", ""), $desc);

							$texte .= "<a href=\"#\" class=\"overlib\"><span>$desc</span></a>";
							$texte .= "<span class=\"x-small\"> $row[6]</span><br/>";

							$row    = remove_magic_quotes(mysql_fetch_row($result));
							}

						$color  = ( $texte != "" ) ? "#eeeeee" : "#ffffff" ;

						print("
							<td class=\"valign-top align-center\" style=\"background-color:$color;\" onmouseover=\"style.backgroundColor='#FF9900';\" onmouseout=\"style.backgroundColor='$color';\">
								$texte
							</td>
							");
						}

			print("
				<td class=\"valign-top align-center\" style=\"background-color:#c0c0c0;\">
					$horaire[$i]
				</td>
				");

			print("</tr>");
			}
	?>
     </table>
