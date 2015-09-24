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
 *		module   : reservation_month.php
 *		projet   : la page d'affichage mensuel des réservations
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 19/10/08
 *		modif    : 
 */
?>


<table class="width100">
  <tr>
     <td style="width:40%;" class="valign-top">
    
	<form id="date" action="index.php?item=10&amp;IDres=<?php echo $IDres; ?>&amp;IDcentre=<?php echo $IDcentre; ?>&amp;IDdata=<?php echo $IDdata; ?>&amp;month=<?php echo $month; ?>&amp;year=<?php echo $year; ?>&amp;weekly=<?php echo $weekly; ?>" method="post">
		<p class="hidden"><input type="hidden" name="item"   value="<?php print("$item"); ?>" /></p>
		<p class="hidden"><input type="hidden" name="IDdata" value="<?php print("$IDdata"); ?>" /></p>

        <table class="width100">
          <tr>
            <td class="align-right">
		<?php
			// calcul mois et année précédente
			$prev_month = ( $month ) ? $month - 1 : 11 ;
			$prev_year  = ( $prev_month == 11 ) ? $year - 1 : $year ;

			print("[<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&month=$prev_month&year=$prev_year&weekly=$weekly")."\">«</a>]");

			print("<label for=\"month\">");
			print("<select id=\"month\" name=\"month\" onchange=\"document.forms.date.submit()\">");

           		for ($i = 0; $i < 12; $i++)
				printf("<option value=\"$i\" %s>$mois[$i]</option>", ($i == $month) ? "selected=\"selected\"" : "");

			print("</select>");
			print("</label>");
		?>
            </td>

            <td class="align-left">
		<?php
			$start = 2002;
           		$end   = $year + 2;

			print("<label for=\"year\">");
			print("<select id=\"year\" name=\"year\" onchange=\"document.forms.date.submit()\">");

           		for ($i = $start; $i <= $end; $i++)
           			if ( $i == $year )
            			print("<option selected=\"selected\" value=\"$i\">$i</option>");
            		else
            			print("<option value=\"$i\">$i</option>");

			print("</select>");
			print("</label>");

			// calcul mois et année suivante
			$next_month = ( $month == 11 ) ? 0 : $month + 1 ;
			$next_year  = ( $next_month ) ? $year : $year + 1;

			print("[<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&month=$next_month&year=$next_year&weekly=$weekly")."\">»</a>]");
            	?>
            </td>
          </tr>
        </table>

      </form>
	<br/>

      <table class="width100" style="border: 1px solid black">
        <tr style="background-color:<?php print($_SESSION["CfgColor"]); ?>">
          <td style="width:10%;"></td>
	<?php
		$list = explode(",", $msg->read($RESERVATION_DAYS));

		for ($i=0; $i < count($list); $i++)
			print("<td style=\"width:13%;\" class=\"align-center\"><span style=\"color:#FFFFFF;\"><strong>$list[$i]</strong></span></td>");
	?>
        </tr>

	<?php
		require_once "include/spip.php";
		require_once "include/smileys.php";

		// nombre de jours dans le mois
		$nbdays = getmaxdays($year, $month + 1);

		// n° semaine du mois
		$weekday  = date("W", mktime(1, 1, 1, $month + 1, 1, $year));
		if ( !$weekday )
		    	$weekday = 1;

		// 1er jour du mois
		$firstday = date("w", mktime(1, 1, 1, $month + 1, 1, $year));
		if ( !$firstday )
		    	$firstday = 7;

		// construction du calendrier
		$j    = 1;
		$jour = 1;
		while ( $jour <= $nbdays ) {
			for ($i = 1; $i <= 7; $i++) {
				if ( $i == 1 ) {
					$wlink = "<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&year=$year&month=$month&day=$jour&week=$weekday&weekly=$weekly")."\">". $weekday++ ."</a>";
					print("<tr><td class=\"align-center\"  style=\"background-color:#EEEEEE;\"><strong>$wlink</strong></td>");
					}

				// index du jour sélectionné
				if ( $day == $jour )
					$dayidx = $j % 7;

				// date du calendrier
				$lejour = ( $j >= $firstday AND $jour <= $nbdays ) ? $jour : 0 ;
				$lemois = $month + 1;

				$date   = ( $j >= $firstday AND $jour <= $nbdays )
					? "<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&year=$year&month=$month&day=$jour&weekly=$weekly")."\">". $jour++ ."</a>"
					: "&nbsp;" ;
				$j++;

				// choix des couleurs
				if ( $date == "&nbsp;" )
				$color = "#EEEEEE";
				else
					if ( $year < date("Y") )
						$color = "#C0C0C0";
					else
						if ( $year > date("Y") )
							$color = "#FFFFFF";
						else
							if ( $month < date("m") - 1 )
								$color = "#C0C0C0";
							else
								if ( $month > date("m") - 1 )
									$color = "#FFFFFF";
								else
									if ( $jour <= date("d") )
										$color = "#C0C0C0";
									else
										if ( $jour > date("d") + 1 )
											$color ="#FFFFFF";
										else
											$color = "#FFCC66";

				// sélection des demandes par jour (Haute priorité)
				$query  = "select _IDitem from reservation_items, reservation_data ";
				$query .= "where reservation_items._IDdata = reservation_data._IDdata ";
				$query .= "AND reservation_data._IDres = '$IDres' AND reservation_data._IDcentre like '% $IDcentre %' ";
				$query .= "AND reservation_data._start <= '$year-$lemois-$lejour 23:59:59' ";
				$query .= "AND reservation_data._end >= '$year-$lemois-$lejour 00:00:00' ";
				$query .= ( $IDdata ) ? "AND reservation_items._IDdata = '$IDdata' " : "" ;
				$query .= "AND _priority = 'H' ";

				$result = mysql_query($query, $mysql_link);
				$nbelem = ( $result ) ? mysql_numrows($result) : 0 ;

				$haute  = ( $nbelem AND $date != "&nbsp;" )
					? "<br/><img src=\"".$_SESSION["ROOTDIR"]."/images/H.gif\" title=\"\" alt=\"\" /><span class=\"x-small\">x$nbelem</span>"
					: "" ;

				// sélection des demandes par jour (Basse priorité)
				$query  = "select _IDitem from reservation_items, reservation_data ";
				$query .= "where reservation_items._IDdata = reservation_data._IDdata ";
				$query .= "AND reservation_data._IDres = '$IDres' AND reservation_data._IDcentre like '% $IDcentre %' ";
				$query .= "AND reservation_data._start <= '$year-$lemois-$lejour 23:59:59' ";
				$query .= "AND reservation_data._end >= '$year-$lemois-$lejour 00:00:00' ";
				$query .= ( $IDdata ) ? "AND reservation_items._IDdata = '$IDdata' " : "" ;
				$query .= "AND _priority = 'B' ";

				$result = mysql_query($query, $mysql_link);
				$nbelem = ( $result ) ? mysql_numrows($result) : 0 ;

				$basse  = ( $nbelem AND $date != "&nbsp;" )
					? "<br/><img src=\"".$_SESSION["ROOTDIR"]."/images/B.gif\" title=\"\" alt=\"\" /><span class=\"x-small\">x$nbelem</span>"
					: "" ;

				print("
					<td class=\"valign-top align-center\" style=\"background-color:$color;width:14%\" onmouseover=\"style.backgroundColor='#FF9900';\" onmouseout=\"style.backgroundColor='$color';\">
						$date$haute$basse
					</td>
					");

				if ( $i == 7 )
					print("</tr>");
				}

			if ( $week == $weekday - 1 )
				$fin = $jour;
			}
	?>
      </table>
    </td>

    <td style="width:60%;" class="valign-top">
	<?php
    		//affichage de la date sélectionnée
		$wday   = explode(",", $msg->read($RESERVATION_DAYSFULL));
		$isweek = ( $week ) ? $msg->read($RESERVATION_WEEK)." " : "" ;

    		print("
    			$isweek<strong>$wday[$dayidx] $day $mois[$month] $year</strong> 
    			[<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&year=". date("Y") ."&month=". (date("m") - 1) ."&weekly=$weekly")."\">". $msg->read($RESERVATION_TODAY) ."</a>]
    			<br/><br/>
    			");

         	// la saisie des demandes n'est pas rétroactive
		$lemois = $month + 1;

		if ( ($_SESSION["CnxAdm"] == 255 OR ($idgrpwr & pow(2, $_SESSION["CnxGrp"] - 1)))
			AND date("Y-m-d") <= "$year-$lemois-$day" )
         		print("
	            <table class=\"width100\">
	              <tr>
	                <td style=\"width:10%\" class=\"valign-middle\">
	                	<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDres=$IDres&IDdata=$IDdata&IDcentre=$IDcentre&year=$year&month=$lemois&day=$day&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/post.gif\" title=\"\" alt=\"\" /></a>
	                </td>
	                <td class= \"valign-middle\">". $msg->read($RESERVATION_DOREQUEST) ."</td>
	              </tr>
	            </table>
	            ");

         	// lecture des demandes
		$query  = "select distinctrow _IDitem, _ID, _IP, _comment, _date, _update, _erase, _priority, _start, _end, _valid, _note, ";
		$query .= "reservation_items._IDdata, reservation_items._visible ";
		$query .= "from reservation_items, reservation_data, reservation ";
		$query .= "where reservation_items._IDdata = reservation_data._IDdata ";
		$query .= "AND reservation_data._IDres = '$IDres' AND reservation_data._IDcentre like '% $IDcentre %' ";
		$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (reservation._IDgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
		$query .= ( $week )
			? "AND reservation_data._start < '$year-$lemois-$fin 00:00:00' "
			: "AND reservation_data._start <= '$year-$lemois-$day 23:59:59' " ;
		$query .= "AND reservation_data._end >= '$year-$lemois-$day 00:00:00' ";
		$query .= ( $IDdata ) ? "AND reservation_items._IDdata = '$IDdata' " : "" ;
		$query .= "order by _start asc ";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		while ( $row ) {
			// lecture de la ressource réservée
			$res     = mysql_query("select _titre from reservation_data where _IDdata = '$row[12]'", $mysql_link);
			$article = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

			// lecture de l'expéditeur ou du destinataire du message
			$postit  = getUserName($row[1]);

			// date de modification/suppression
			$modif   = ( $row[4] != $row[5] ) ? "<br/>".$msg->read($RESERVATION_MODIFYBY, $row[5]) : "" ;
			$modif  .= ( $row[4] != $row[6] ) ? "<br/>".$msg->read($RESERVATION_DELETEBY, $row[6]) : "" ;

			// les modifications ou suppressions ne sont pas rétroactives
			if ( date("Y-m-d") <= "$year-$lemois-$day" ) {
				// modification des demandes
				$update = ( $_SESSION["CnxAdm"] == 255 OR $row[1] == $_SESSION["CnxID"] )
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDres=$IDres&IDcentre=$IDcentre&IDdata=$row[12]&IDitem=$row[0]&year=$year&month=$month&day=$day&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"".$msg->read($RESERVATION_MODIFYREQUEST)."\" alt=\"".$msg->read($RESERVATION_MODIFYREQUEST)."\" /></a>"
					: "" ;

				// suppression des demandes
				$req    = $msg->read($RESERVATION_DELREQUEST);
				$erase  = ( $_SESSION["CnxAdm"] == 255 OR $row[1] == $_SESSION["CnxID"] )
					? "<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDitem=$row[0]&year=$year&month=$month&day=$day&weekly=$weekly&submit=del")."\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($RESERVATION_DELREQUEST)."\" alt=\"".$msg->read($RESERVATION_DELREQUEST)."\" /></a>"
					: "" ;
				}
			else
				$update = $erase = "";

			print("
		            <table class=\"width100\">
		              <tr style=\"background-color:#C0C0C0;\">
		                <td class=\"valign-top align-right\" style=\"width:20%;\">
		                  ".$msg->read($RESERVATION_ARTICLE)."<br/>
		                  ".$msg->read($RESERVATION_FROM)."<br/>
		                  ".$msg->read($RESERVATION_TO)."<br/>
		                  ".$msg->read($RESERVATION_BY)."<br/>
		                  ".$msg->read($RESERVATION_POSTED)."
		                </td>
		                <td class=\"valign-top align-left\" style=\"width:80%;\">
		                  $article[0]<br/>
		                  ". date2longfmt($row[8]) ."<br/>
		                  ". date2longfmt($row[9]) ."<br/>
		                  $postit<br/>
		                  ". date2longfmt($row[4]) ." ". _getHostName($row[2]) ."$modif
		                </td>
		              </tr>

				  <tr>
				    <td style=\"border: 1px solid #c0c0c0;\" class=\"valign-top align-center\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/$row[7].gif\" title=\"\" alt=\"\" /><br/><br/>$erase $update
				    </td>
				    <td style=\"border: 1px solid #c0c0c0;\" class=\"valign-top\">
					");

		    	// le message
		    	if ( $row[4] == $row[6]  )
				print("". replace_smile(find_typo($row[3], $note)) ."&nbsp;");
			else
				print("<span style=\"text-decoration: line-through;\">". replace_smile(find_typo($row[3], $note)) ."</span>");

			// ligne de séparation
			print("<hr style=\"width:25%; margin-left:0px;\" />");

			print("
				<form id=\"form_$row[0]\" action=\"index.php\" method=\"post\">
					<p class=\"hidden\"><input type=\"hidden\" name=\"item\"     value=\"$item\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"IDres\"    value=\"$IDres\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"IDcentre\" value=\"$IDcentre\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"IDdata\"   value=\"$IDdata\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"IDitem\"   value=\"$row[0]\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"year\"     value=\"$year\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"month\"    value=\"$month\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"day\"      value=\"$day\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"weekly\"   value=\"$weekly\" /></p>");

			// validation de la demande
			$valid  = "";
			$rdonly = "readonly=\"readonly\"";

			switch ( $row[13] ) {
				case "O" :
					$check  = "check-ok";
					$texte  = $msg->read($RESERVATION_ACCEPT,  $row[10]);
					break;
				case "N" :
					$check  = "check";
					$texte  = $msg->read($RESERVATION_REJECT, $row[10]);
					break;
				default :
					$check  = "lock";
					$texte  = $msg->read($RESERVATION_WAITING);
					$rdonly = "";

					if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod ) {
						$req    = $msg->read($RESERVATION_VALIDREQUEST);
		              		$valid  = "<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" name=\"submit\" value=\"on\" title=\"$req\" alt=\"$req\" onclick=\"return confirmLink(this, '$req');\" />";

						$valid .= " ";

						$req    = $msg->read($RESERVATION_INVALIDREQUEST);
		              		$valid .= "<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" name=\"submit\" value=\"off\" title=\"$req\" alt=\"$req\" onclick=\"return confirmLink(this, '$req');\" />";
						}
					break;
				}

			print("
				<div>
					<img src=\"".$_SESSION["ROOTDIR"]."/images/$check.gif\" title=\"\" alt=\"\" /> $texte. $valid
					<span style=\"cursor: pointer;\" onclick=\"$('text_$row[0]')._display.toggle(); return false;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/updown.png\" title=\"+\" alt=\"+\" /></span>
				</div>

				<div id=\"text_$row[0]\" style=\"display:none;\">
		        		<label for=\"note_$row[0]\"><textarea id=\"note_$row[0]\" name=\"note[$row[0]]\" rows=\"4\" cols=\"35\" $rdonly >$row[11]</textarea></label>
				</div>");

			print("</form>");

			print("
				    </td>
				  </tr>
		            </table>
				");

			//---- mise à jour de l'export iCal
			$vevent = new vevent();			// create an event calendar component

			list($date, $time)        = explode(" ", $row[8]);
			list($year, $month, $day) = explode("-", $date);
			list($hour, $min,   $sec) = explode(":", $time);

			$vevent->setProperty( 'dtstart', array( 'year'=>$year, 'month'=>$month, 'day'=>$day, 'hour'=>$hour, 'min'=>$min,  'sec'=>$sec ));

			list($date, $time)        = explode(" ", $row[9]);
			list($year, $month, $day) = explode("-", $date);
			list($hour, $min,   $sec) = explode(":", $time);

			$vevent->setProperty( 'dtend', array( 'year'=>$year, 'month'=>$month, 'day'=>$day, 'hour'=>$hour, 'min'=>$min,  'sec'=>$sec ));

			$vevent->setProperty( 'summary', addslashes($article[0]) );
			$vevent->setProperty( 'description', addslashes($row[3]) );
			$v->setComponent( $vevent );		// add event to calendar

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}
	?>
    </td>
  </tr>
</table>
