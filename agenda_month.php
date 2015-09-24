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
 *		module   : agenda_month.php
 *		projet   : la page d'affichage mensuel des agendas
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 29/10/03
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */
?>


<table  class="width100">
  <tr>
     <td style="width:40%;" class="valign-top">

	<form id="date" action="index.php" method="post">
		<p class="hidden"><input type="hidden" name="item"   value="<?php print("$item"); ?>" /></p>
		<p class="hidden"><input type="hidden" name="IDdata" value="<?php print("$IDdata"); ?>" /></p>
		<p class="hidden"><input type="hidden" name="weekly" value="<?php print("$weekly"); ?>" /></p>

        <table class="width100">
          <tr>
            <td class="align-right">
		<?php
			// calcul mois et année précédente
			$prev_month = ( $month ) ? $month - 1 : 11 ;
			$prev_year  = ( $prev_month == 11 ) ? $year - 1 : $year ;

			print("[<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&month=$prev_month&year=$prev_year&weekly=$weekly")."\">«</a>]");

			$mois = explode(",", $msg->read($AGENDA_MONTHFULL));

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
				printf("<option value=\"$i\" %s>$i&nbsp;</option>", $i == $year ? "selected=\"selected\"" : "");

			print("</select>");
			print("</label>");

			// calcul mois et année suivante
			$next_month = ( $month == 11 ) ? 0 : $month + 1 ;
			$next_year  = ( $next_month ) ? $year : $year + 1;

			print("[<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&month=$next_month&year=$next_year&weekly=$weekly")."\">»</a>]");
		?>
            </td>
          </tr>
        </table>

      </form>
      <br/>

      <table class="width100">
        <tr style="background-color:<?php print($_SESSION["CfgColor"]); ?>">
          <td style="width:9%;" class="align-center">&nbsp;</td>
	<?php
		$list = explode(",", $msg->read($AGENDA_DAYS));

		for ($i=0; $i < count($list); $i++)
			print("<td style=\"width:13%;\" class=\"align-center\"><span style=\"color:#FFFFFF;\"><strong>$list[$i]</strong></span></td>");
	?>
        </tr>

	<?php
		require_once "include/smileys.php";
		require_once "include/spip.php";

		// nombre de jours dans le mois
		$nbdays   = getmaxdays($year, $month + 1);

		// n° semaine du mois
		$weekday  = date("W", mktime(1, 1, 1, $month + 1, 1, $year));
		if ( !$weekday OR $weekday > 52 )
		    	$weekday = 1;

		// 1er jour du mois
		$firstday = date("w", mktime(1, 1, 1, $month + 1, 1, $year));
		if ( !$firstday )
		    	$firstday = 7;

		// date du jour
		if ( !$day )
			if ( $year == date("Y") AND $month == date("m") - 1 )
				$day = date("d");
			else
				$day = 1;

		// construction du calendrier
		$j    = 1;
		$jour = 1;
		while ( $jour <= $nbdays ) {
			for ($i = 1; $i <= 7; $i++) {
				if ( $i == 1 ) {
					$wlink = "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&year=$year&month=$month&day=$jour&week=$weekday&weekly=$weekly")."\">". $weekday++ ."</a>";
					print("<tr><td class=\"align-center\" style=\"background-color:#EEEEEE;\"><strong>$wlink</strong></td>");
					}

				// index du jour sélectionné
				if ( $day == $jour )
					$dayidx = $j % 7;

				// date du calendrier
				$lejour = ( $j >= $firstday AND $jour <= $nbdays ) ? $jour : 0 ;
				$lemois = $month + 1;

				$date   = ( $j >= $firstday AND $jour <= $nbdays )
					? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&year=$year&month=$month&day=$jour&weekly=$weekly")."\">". $jour++ ."</a>"
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

				// sélection des évènements par jour (Haute priorité)
				$query  = "select distinctrow _IDitem from agenda_items, agenda ";
				if ( $IDdata == -1 ) {
					$query .= "where (" ;
					$query .= "( ";
					$query .= "agenda_items._IDdata = '$agenda[0]' AND agenda._IDdata = '$agenda[0]' " ;
					$query .= "AND (_private = '0' OR _private = '".$_SESSION["CnxID"]."') ";
					$query .= "AND _start <= '$year-$lemois-$lejour 23:59:59' ";
					$query .= "AND _end >= '$year-$lemois-$lejour 00:00:00' ";
					$query .= ") ";

					for ($k = 1; $k < count($agenda); $k++ ) {
						$query .= "OR (" ;
						$query .= "agenda_items._IDdata = '".$agenda[$k]."' AND agenda._IDdata = '".$agenda[$k]."' " ;
						$query .= "AND (_private = '0' OR _private = '".$_SESSION["CnxID"]."') ";
						$query .= "AND _start <= '$year-$lemois-$lejour 23:59:59' ";
						$query .= "AND _end >= '$year-$lemois-$lejour 00:00:00' ";
						$query .= ") ";
						}
					$query .= ") ";
					}
				else {
					$query .= "where agenda_items._IDdata = '$IDdata' AND agenda._IDdata = '$IDdata' ";
					$query .= "AND (_private = '0' OR _private = '".$_SESSION["CnxID"]."') ";
					$query .= "AND _start <= '$year-$lemois-$lejour 23:59:59' ";
					$query .= "AND _end >= '$year-$lemois-$lejour 00:00:00' ";
					}
				$query .= "AND _priority = 'H' ";

				$result = mysql_query($query, $mysql_link);
				$nbelem = ( $result ) ? mysql_numrows($result) : 0 ;

				$haute  = ( $nbelem AND $date != "&nbsp;" )
					? "<br/><img src=\"".$_SESSION["ROOTDIR"]."/images/H.gif\"  title=\"\" alt=\"\"  /><span class=\"x-small\">x$nbelem</span>"
					: "" ;

				// sélection des évènements par jour (Basse priorité)
				$query  = "select distinctrow _IDitem from agenda_items, agenda ";
				if ( $IDdata == -1 ) {
					$query .= "where (" ;
					$query .= "( ";
					$query .= "agenda_items._IDdata = '$agenda[0]' AND agenda._IDdata = '$agenda[0]' " ;
					$query .= "AND (_private = '0' OR _private = '".$_SESSION["CnxID"]."') ";
					$query .= "AND _start <= '$year-$lemois-$lejour 23:59:59' ";
					$query .= "AND _end >= '$year-$lemois-$lejour 00:00:00' ";
					$query .= ") ";

					for ($k = 1; $k < count($agenda); $k++ ) {
						$query .= "OR (" ;
						$query .= "agenda_items._IDdata = '".$agenda[$k]."' AND agenda._IDdata = '".$agenda[$k]."' " ;
						$query .= "AND (_private = '0' OR _private = '".$_SESSION["CnxID"]."') ";
						$query .= "AND _start <= '$year-$lemois-$lejour 23:59:59' ";
						$query .= "AND _end >= '$year-$lemois-$lejour 00:00:00' ";
						$query .= ") ";
						}
					$query .= ") ";
					}
				else {
					$query .= "where agenda_items._IDdata = '$IDdata' AND agenda._IDdata = '$IDdata' ";
					$query .= "AND (_private = '0' OR _private = '".$_SESSION["CnxID"]."') ";
					$query .= "AND _start <= '$year-$lemois-$lejour 23:59:59' ";
					$query .= "AND _end >= '$year-$lemois-$lejour 00:00:00' ";
					}
				$query .= "AND _priority = 'B' ";

				$result = mysql_query($query, $mysql_link);
				$nbelem = ( $result ) ? mysql_numrows($result) : 0 ;

				$basse  = ( $nbelem AND $date != "&nbsp;" )
					? "<br/><img src=\"".$_SESSION["ROOTDIR"]."/images/B.gif\" title=\"\" alt=\"\" /><span class=\"x-small\">x$nbelem</span>"
					: "" ;

				print("
					<td class=\"valign-top align-center\" style=\"background-color:$color\" onmouseover=\"style.backgroundColor='#FF9900';\" onmouseout=\"style.backgroundColor='$color';\">
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
		$wday   = explode(",", $msg->read($AGENDA_DAYSFULL));
		$isweek = ( $week ) ? $msg->read($AGENDA_WEEK)." " : "" ;

    		print("
    			$isweek<strong>$wday[$dayidx] $day $mois[$month] $year</strong> 
    			[<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&weekly=$weekly&year=".date("Y")."&month=".(date("m") - 1))."\">". $msg->read($AGENDA_TODAY) ."</a>]
    			<br/><br/>
    			");

         	// la saisie des évènements n'est pas rétroactive
		$lemois = $month + 1;

		if ( ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod OR ($idgrpwr & pow(2, $_SESSION["CnxGrp"] - 1)))
//			AND date("Y-m-d") <= "$year-$lemois-$day" )
			AND $IDdata != -1 )
         		print("
	            <table class=\"width100\">
	              <tr>
	                <td style=\"width:10%;\" class=\"valign-middle\">
	                	<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDgroup=$IDgroup&IDdata=$IDdata&year=$year&month=$month&day=$day&time=".date("H:i")."&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/post.gif\" title=\"\" alt=\"\" /></a></td>
	                <td class= \"valign-middle\">". $msg->read($AGENDA_ADDEVENT) ."</td>
	              </tr>
	            </table>
	            ");

         	// lecture des évènements
		$query  = "select distinctrow agenda_items._IDitem, agenda_items._ID, agenda_items._IP, ";
		$query .= "agenda_items._titre, agenda_items._texte, agenda_items._date, agenda_items._update, agenda_items._erase, agenda_items._priority, agenda_items._hit, agenda_items._start, agenda_items._end ";
		$query .= "from agenda_items, agenda ";
//		$query .= "where agenda_items._IDdata = '$IDdata' AND agenda._IDdata = '$IDdata' ";
		$query .= ( $IDdata != -1 ) ? "where agenda_items._IDdata = '$IDdata' " : "where ((agenda_items._IDdata AND agenda._private = '0') OR agenda._private = '".$_SESSION["CnxID"]."') " ;
		$query .= "AND agenda_items._IDdata = agenda._IDdata ";
		$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (agenda._IDgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
//		$query .= "AND (agenda._private = '0' OR agenda._private = '".$_SESSION["CnxID"]."') ";
		$query .= "AND agenda._visible = 'O' ";
		$query .= ( $week )
			? "AND agenda_items._start < '$year-$lemois-$fin 00:00:00' "
			: "AND agenda_items._start <= '$year-$lemois-$day 23:59:59' " ;
		$query .= "AND agenda_items._end >= '$year-$lemois-$day 00:00:00' ";
		$query .= "order by agenda_items._start " . ($chrono == "O" ? "asc" : "desc");

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		while ( $row ) {
			// lecture du nombre de lecteurs
			$res     = mysql_query("select _ID from agenda_vu where _IDitem = '$row[0]'", $mysql_link);
			$nbelem  = ( $res ) ? mysql_numrows($res) : 0 ;

			// pour savoir qui a lu les évènements
			$lien    = ( $nbelem )
				? "(<a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/user_list.php?sid=".$_SESSION["sessID"]."&amp;IDitem=$row[0]&amp;cmde=agenda&amp;lang=".$_SESSION["lang"]."', '450', '200'); return false;\">". $msg->read($AGENDA_HIT, strval($nbelem)) ."</a>)"
				: "" ;

			// envoi d'un postit au rédacteur du message
			$postit  = getUserName($row[1]);

			// date de modification/suppression
			$modif   = ( $row[5] != $row[6] ) ? "<br/>".$msg->read($AGENDA_MODIFIEDON, date2longfmt($row[6]))  : "" ;
			$modif  .= ( $row[5] != $row[7] ) ? "<br/>".$msg->read($AGENDA_DELETEDON, date2longfmt($row[7])) : "" ;

			// les modifications ou suppressions ne sont pas rétroactives
			// si évènement supprimé : plus de modif
			if ( date("Y-m-d") <= "$year-$lemois-$day" AND $row[5] == $row[7] ) {
				// modification des évènements
				$update  = ( $_SESSION["CnxAdm"] == 255 OR ($row[1] == $_SESSION["CnxID"] AND $is_update == "O") )
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDgroup=$IDgroup&IDdata=$IDdata&IDitem=$row[0]&year=$year&month=$month&day=$day&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"".$msg->read($AGENDA_UPDATEVENT)."\" alt=\"\" /></a>"
					: "" ;

				// suppression des évènements
				$req     = $msg->read($AGENDA_DELETEVENT);
				$erase   = ( $_SESSION["CnxAdm"] == 255 OR ($row[1] == $_SESSION["CnxID"] AND $is_erase == "O") )
					? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&IDitem=$row[0]&year=$year&month=$month&day=$day&weekly=$weekly&submit=del")."\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($AGENDA_DELETEVENT)."\"  alt=\"\" /></a>"
					: "" ;
				}
			else
				$update = $erase = "";

			print("
		            <table class=\"width100\">
		              <tr>
		                <td class=\"valign-top align-right\" style=\"width:20%; background-color:#C0C0C0;\">
		                  ".$msg->read($AGENDA_SUBJECT)."<br/>
		                  ".$msg->read($AGENDA_FROM)."<br/>
	      	            ".$msg->read($AGENDA_TO)."<br/>
	            	      ".$msg->read($AGENDA_AUTHOR)."<br/>
	                  	".$msg->read($AGENDA_POSTED)."
		                </td>
		                <td class=\"valign-top align-left\" style=\"width:80%; background-color:#C0C0C0;\">
	      	            $row[3] $lien<br/>
	            	      ". date2longfmt($row[10]) ."<br/>
	                  	". date2longfmt($row[11]) ."<br/>
		                  $postit<br/>
		                  ". date2longfmt($row[5]) ." ". _getHostName($row[2]) ."$modif
	      	          </td>
	            	  </tr>

				  <tr>
				    <td style=\"border: 1px solid #c0c0c0;\" class=\"valign-top align-center\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/$row[8].gif\" alt=\"\" title=\"\" /><br/><br/>$erase $update
				    </td>
				    <td style=\"border: 1px solid #c0c0c0;\" class=\"valign-top\">
					");

	    		// le message
	    		if ( $row[5] == $row[7] )
				print(replace_smile(find_typo($row[4], $note)));
			else
				print("<span style=\"text-decoration: line-through;\">". replace_smile(find_typo($row[4], $note)) ."</span>");

			// ligne de séparation
			print("<hr style=\"width:25%; margin-left:0px;\" />");

			// rappel de l'évènement
			$res     = mysql_query("select _IDpost from postit_items where _titre = '".$msg->read($AGENDA_AUTO, strval($row[0]))."'", $mysql_link);
			$nbelem  = ( $res ) ? mysql_numrows($res) : 0 ;

			$submit  = ( $nbelem ) ? "on" : "off" ;
			$subject = str_replace(" ", "+", $row[3]);

			// on n'envoie pas de post-it système aux connexions anonymes
			if ( $_SESSION["CnxSex"] != "A" )
				print("
					<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&IDitem=$row[0]&year=$year&month=$month&day=$day&subject=$subject&text=$row[4]&weekly=$weekly&submit=$submit")."\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/checkbox_$submit.gif\" title=\"\" alt=\"\" /></a> ".$msg->read($AGENDA_CALLBACK)."
					");

			print("
	      	          </td>
	            	  </tr>
				");

			// recherche des PJ
			$res = mysql_query("select _texte, _ext, _size from agenda_pj where _IDitem = '$row[0]'", $mysql_link);
			$pj  = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

			if ( $pj )
				print("
		            	  <tr>
					    <td style=\"border: 1px solid #c0c0c0;\" class=\"valign-top align-center\">
					    	<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/pj.gif\" title=\"\" alt=\"\" />
					    </td>
					    <td style=\"border: 1px solid #c0c0c0;\" class=\"valign-middle\">
						<a href=\"$DOWNLOAD/agenda/$row[0].$pj[1]\" onclick=\"window.open(this.href, '_blank'); return false;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/mime/$pj[1].gif\" title=\"".$msg->read($AGENDA_BYTE, number_format($pj[2], 0, ",", " "))."\" alt=\"\" /></a>
						".$msg->read($AGENDA_ATTACHED)."
					    </td>
		            	  </tr>
					");

			print("</table>");

			//---- mise à jour des logs de visualisation
			$date = date("Y-m-d H:i:s");
			mysql_query("insert into agenda_vu values('$row[0]', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date')", $mysql_link);

			//---- mise à jour de l'export iCal
			$vevent = new vevent();			// create an event calendar component

			list($date, $time)  = explode(" ", $row[10]);
			list($_y, $_m, $_d) = explode("-", $date);
			list($_h, $_m, $_s) = explode(":", $time);

			$vevent->setProperty( 'dtstart', array( 'year'=>$_y, 'month'=>$_m, 'day'=>$_d, 'hour'=>$_h, 'min'=>$_m,  'sec'=>$_s ));

			list($date, $time)  = explode(" ", $row[11]);
			list($_y, $_m, $_d) = explode("-", $date);
			list($_h, $_m, $_s) = explode(":", $time);

			$vevent->setProperty( 'dtstart', array( 'year'=>$_y, 'month'=>$_m, 'day'=>$_d, 'hour'=>$_h, 'min'=>$_m,  'sec'=>$_s ));

			$vevent->setProperty( 'summary', addslashes($row[3]) );
			$vevent->setProperty( 'description', addslashes($row[4]) );
			$v->setComponent( $vevent );		// add event to calendar

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}
	?>

    </td>
  </tr>
</table>
