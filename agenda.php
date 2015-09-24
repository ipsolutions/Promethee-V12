<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2009 by Dominique Laporte(C-E-D@wanadoo.fr)
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
 *		module   : agenda.php
 *		projet   : la page des agendas
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 29/10/03
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$year    = ( @$_POST["year"] )
	? (int) $_POST["year"]
	: (int) (@$_GET["year"] ? $_GET["year"] : date("Y")) ;
$month   = ( strlen(@$_POST["month"]) )
	? (int) $_POST["month"]
	: (int) (strlen(@$_GET["month"]) ? $_GET["month"] : date("m") - 1) ;
$day     = ( @$_POST["day"] )
	? (int) $_POST["day"]
	: (int) @$_GET["day"] ;
$week    = ( @$_POST["week"] )
	? (int) $_POST["week"]
	: (int) @$_GET["week"] ;
$weekly  = ( @$_POST["weekly"] )		// affichage hebdo / mensuel
	? (int) $_POST["weekly"]
	: (int) (strlen(@$_GET["weekly"]) ? $_GET["weekly"] : @$weekly) ;

$IDitem  = (int) @$_GET["IDitem"];
$subject = addslashes(trim(@$_GET["subject"]));
$text    = addslashes(trim(@$_GET["text"]));

$submit  = @$_GET["submit"];
?>


<?php
	require_once "lib/lib_icalcreactor.php";

	// lecture de l'agenda
	$Query  = "select _texte, _update, _erase, _private, _IDgrpwr, _IDgrprd, _IDmod, _chrono from agenda ";
	$Query .= "where _IDdata = '$IDdata' AND _IDgroup = '$IDgroup' ";
	$Query .= "AND (_private = '0' OR _private = '".$_SESSION["CnxID"]."') ";
	$Query .= "AND _lang = '".$_SESSION["lang"]."' ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	// vérification des autorisations
	verifySessionAccess($row[6], $row[5]);

	if ( $row[0] )
		print("<div style=\"background-color:#eeeeee\">$row[0]</div>");

	//paramètres internes de l'agenda
	$is_update = $row[1];
	$is_erase  = $row[2];
	$is_priv   = $row[3];
	$idgrpwr   = (int) $row[4];
	$idgrprd   = (int) $row[5];
	$idmod     = (int) $row[6];
	$chrono    = $row[7];

	// attention aux agendas personnels
	$Query  = "select _start, _end, _delta, _IDgrpwr, _IDgrprd, _IDmod from agenda_user ";
	$Query .= "where _IDdata = '".$_SESSION["CnxID"]."' ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// on supplante les paramètres généraux
	if ( $auth ) {
		$start   = $auth[0];
		$end     = $auth[1];
		$delta   = $auth[2];
		$idgrpwr = (int) $auth[3];
		$idgrprd = (int) $auth[4];
		$idmod   = (int) $auth[5];
		}
	else {
		$start   = 8;
		$end     = 20;
		$delta   = 0;
		}

	// construction de la table des horaires
	$time   = "$start:00";
	for ($i = $start; $i <= $end; ) {
		switch ( $delta ) {
			case 0:
				break;
			case 1:
				$time .= ",$i:30";
				break;
			default:
				$time .= ",$i:15,$i:30,$i:45";
				break;
			}

		$i++;
		$time .= ",$i:00";
		}

	// pour l'import/export ical
	$icsfile = "tmp/ical/ical-".$_SESSION["CnxID"].".ics";

	// commandes utilisateur
	switch ( $submit ) {
		case "clear" :	// suppression de l'année
			if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod ) {
				$Query  = "delete from agenda_items ";
				$Query .= "where _IDdata = '$IDdata' ";
				$Query .= "AND _start >= '$year-01-01' AND _start <= '$year-12-31' ";

				mysql_query($Query, $mysql_link);

				// suppression des éventuelles Pièces Jointes
//				mysql_query("delete from agenda_pj where _IDitem = '$IDitem'", $mysql_link);

				// et suppresson des fichiers associés...
				}
			break;
		case "del" :	// suppression de l'évènement
			// lecture du propriétaire du message
			$result = mysql_query("select _ID from agenda_items where _IDitem = '$IDitem'", $mysql_link);
			$who    = ( $result ) ? mysql_fetch_row($result ) : 0 ;

			if ( $_SESSION["CnxAdm"] == 255 OR ($who[0] == $_SESSION["CnxID"] AND $is_erase == "O") ) {
				if ( $is_priv )
					mysql_query("delete from agenda_items where _IDitem = '$IDitem'", $mysql_link);
				else {
					$date = date("Y-m-d H:i:s");
					mysql_query("update agenda_items set _erase = '$date' where _IDitem = '$IDitem'", $mysql_link);
					}

				// suppression des éventuelles Pièces Jointes
				mysql_query("delete from agenda_pj where _IDitem = '$IDitem'", $mysql_link);

				// et suppresson des fichiers associés...
				}
			break;
		case "on" :	// suppression du rappel auto
			mysql_query("delete from postit_items where _titre = '".$msg->read($AGENDA_AUTO, strval($IDitem))."'", $mysql_link);
			break;
		case "off" :	// création du rappel auto
			$date   = date("Y-m-d H:i:s");
			$sujet  = $msg->read($AGENDA_AUTO, strval($IDitem));
			$body   = $msg->read($AGENDA_SUBJECT). "<br/>" . $text;
			$lemois = $month + 1;

			$Query  = "insert into postit_items ";
			$Query .= "values('', '0', '".$_SESSION["CnxID"]."', '0', '".$_SESSION["CnxIP"]."', '$date', '0', '$sujet', '$body', '0', 'N', '$date', '$date', 'N', 'O', '$year-$lemois-$day 00:00:00')";

			mysql_query($Query, $mysql_link);
			break;
		default :
			//---- transfert d'une Pièce Jointe (item)
			$file = @$_FILES["UploadFile"]["tmp_name"];
			$date = date("Y-m-d H:i:s");

			if ( $file AND authfile(@$_FILES["UploadFile"]["name"]) ) {
				// fichier destination
				move_uploaded_file($file, $icsfile);

				$v = new vcalendar();							// create a new calendar instance
				$v->setConfig( 'filename', $icsfile );				// identify file name
				$v->parse();

				// read events, one by one
				while( $vevent = $v->getComponent( 'vevent' ) ) {
					$dtstart = $vevent->getProperty( 'dtstart' );		// required, one occurence
					$dtend   = $vevent->getProperty( 'dtend' );		// required, one occurence
					$subject = $vevent->getProperty( 'summary' );
					$texte   = $vevent->getProperty( 'description' );	// optional, one occurence

					$start   = $dtstart['year']."-".$dtstart['month']."-".$dtstart['day']." ".$dtstart['hour'].":".$dtstart['min'].":".$dtstart['sec'];
					$end     = $dtend['year']."-".$dtend['month']."-".$dtend['day']." ".$dtend['hour'].":".$dtend['min'].":".$dtend['sec'];

					$Query   = "insert into agenda_items ";
					$Query  .= "values('', '$IDdata', '0', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '$date', '$date', 'B', '$start', '$end', '$subject', '$texte', '0', 'N')";

					mysql_query($Query, $mysql_link);
					}
				}
			break;
		}

	// initialisation jour, mois et année
	if ( !$day )
		if ( $year == date("Y") AND $month == date("m") - 1 )
    			$day = date("d");
		else
			$day = 1;

	$mois = explode(",", $msg->read($AGENDA_MONTHFULL));
?>

	<hr style="width:80%;" />

	<form id="formulaire" action="index.php" method="post" enctype="multipart/form-data">
	<?php
		print("
			<p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"IDdata\"  value=\"$IDdata\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"year\"    value=\"$year\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"month\"   value=\"$month\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"day\"     value=\"$day\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"weekly\"  value=\"$weekly\" /></p>
			");
	?>

		<table class="width100">
		  <tr>
			<td style="width:50%;" class="align-right valign-middle">
			    	<?php print($msg->read($AGENDA_CHOOSE)); ?>
			</td>
			<td style="width:50%;">
				<label for="IDdata">
			  	<select id="IDdata" name="IDdata" onchange="document.forms.formulaire.submit()">
				<?php
					// affichage des agendas publics
					$query  = "select _IDdata, _titre, _private from agenda ";
					$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
					$query .= "AND _private = '0' AND _IDgroup = '$IDgroup' ";
					$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (_IDgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") " ;
					$query .= ( $_SESSION["CampusName"] == "" )
						? "OR _private = '".$_SESSION["CnxID"]."' "
						: "AND _titre = '".$_SESSION["CampusName"]."' " ;
					$Query .= "AND _lang = '".$_SESSION["lang"]."' ";
					$query .= "order by _titre";

					$result = mysql_query($query, $mysql_link);
					$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

					$mylist = "(";
					$agenda = Array();
					$count  = 0;
					$ispriv = $found = false;

					while ( $row ) {			
						$select = ( $IDdata == $row[0] ) ? "selected=\"selected\"" : "" ;

						if ( strlen($select) ) {
							$found  = true;
							$ispriv = (bool) ($IDdata == $row[0] AND $_SESSION["CnxID"] == $row[2]);
							}

						print("<option value=\"$row[0]\" $select>$row[1]</option>");

						$agenda[$count++] = $row[0];
						$mylist .= ( $count == 1 )
							? "_IDdata = '$row[0]' "
							: "OR _IDdata = '$row[0]' " ;

						$row = remove_magic_quotes(mysql_fetch_row($result));
						}	// endwhile agendas

					$mylist .= ")";

					$icon    = ( $ispriv )
						? "<a href=\"".myurlencode("index.php?item=$item&cmde=tuning&IDdata=$IDdata&year=$year&month=$month&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/tools.gif\" title=\"".$msg->read($AGENDA_CONFIGURE)."\" alt=\"".$msg->read($AGENDA_CONFIGURE)."\" /></a>"
						: "" ;
					$select  = ( $IDdata == -1 ) ? "selected=\"selected\"" : "" ;

					print("<option value=\"-1\" $select>". $msg->read($AGENDA_MERGE) ."</option>");

					if ( !$found AND $select == "" )
						$IDdata = $agenda[0];
				?>
				</select>
				<?php
					// export ical
		                	print("
						<a href=\"$icsfile\" onclick=\"window.open(this.href, '_blank'); return false;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/ical-export.png\" title=\"".$msg->read($AGENDA_ICALEXPORT)."\" alt=\"".$msg->read($AGENDA_ICALEXPORT)."\" />
						</a>");

					// import ical
					if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod OR ($idgrpwr & pow(2, $_SESSION["CnxGrp"] - 1)) )
			                	print("
							<a href=\"".myurlencode("index.php?item=$item&IDdata=$IDdata&year=$year&month=$month&day=$day&weekly=$weekly&submit=import")."\">
							<img src=\"".$_SESSION["ROOTDIR"]."/images/ical-import.png\" title=\"".$msg->read($AGENDA_ICALIMPORT)."\" alt=\"".$msg->read($AGENDA_ICALIMPORT)."\" />
							</a>");

					print("$icon");
				?>
				</label>
			</td>
		  </tr>

		  <tr>
			<td class="align-right">
			<?php
				if ( $submit == "import" )
					print($msg->read($AGENDA_ICALIMPORT) . " :");
			?>
			</td>
			<td>
			<?php
				if ( $submit == "import" )
					print("
						<input type=\"file\" name=\"UploadFile\" size=\"40\" style=\"font-size:9px;\" />
						<input type=\"submit\" style=\"font-size:9px;\" value=\"Ok\" />
						<p class=\"hidden\"><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$FILESIZE\" /></p>
						");
			?>
			</td>
		  </tr>
		</table>

	</form>

		<hr style="width:80%;" />

		<!-- liste des évènements sur l'année -->
		<p style="margin:0px; background-color:#C0C0C0;">
			<?php print($msg->read($AGENDA_LISTEVENTS)); ?>
			<span style="cursor: pointer;" onclick="$('request')._display.toggle(); return false;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/updown.png" title="" alt="" /></span>
		</p>

		<div id="request" style="display:none;">

			<table class="width100">
			  <tr>
				<td style="width:14%;"></td>
				<?php
					$list = explode(",", $msg->read($AGENDA_MONTH));

					for ($i=0; $i < count($list); $i++)
						print("<td style=\"width:7%;\" class=\"align-center\">$list[$i]</td>");
				?>
			  </tr>

		<?php
			// lectures des années
			$query  = "select _start from agenda_items ";
			$query .= ( $IDdata == -1 ) ? "where $mylist " : "where _IDdata = '$IDdata' " ;
			$query .= "order by _start asc limit 1";

			$res    = mysql_query($query, $mysql_link);
			$start  = ( $res ) ? mysql_fetch_row($res) : 0 ;

			$query  = "select _end from agenda_items ";
			$query .= ( $IDdata == -1 ) ? "where $mylist " : "where _IDdata = '$IDdata' " ;
			$query .= "order by _end desc limit 1";

			$res    = mysql_query($query, $mysql_link);
			$end    = ( $res ) ? mysql_fetch_row($res) : 0 ;

			// construction du tableau
			$y_start = (int) substr($start[0], 0, 4);
			$y_end   = (int) substr($end[0], 0, 4);

			for ($i = $y_end; $i AND $i >= $y_start; $i--) {
				print("<tr>");

				// suppression de l'année
				$req  = $msg->read($AGENDA_DELETE);
				$del  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod )
					? ($IDdata != -1
						? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&year=$i&weekly=$weekly&submit=clear")."\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"". $msg->read($AGENDA_ERASE) ."\"  alt=\"\"  /></a>"
						: "")
					: "" ;

				print("<td style=\"width:14%;\" class=\"align-right\">$i $del</td>");

				for ($m = 1; $m <= 12; $m++) {
					// détermination du nombre des évènements
					$Query  = "select _IDitem from agenda_items ";

					if ( $IDdata == -1 ) {
						$Query .= "where (" ;
						$Query .= "_IDdata = '$agenda[0]' " ;
						$Query .= "AND ((_start >= '$i-$m-01 00:00:01' AND _start <= '$i-$m-31 23:59:59') ";
						$Query .= "OR (_end >= '$i-$m-01 00:00:01' AND _end <= '$i-$m-31 23:59:59')) ";
						$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND ($idgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).")";
						$Query .= ") ";

						for ($j = 1; $j < count($agenda); $j++ ) {
							$Query .= "OR (" ;
							$Query .= "_IDdata = '".$agenda[$j]."' " ;
							$Query .= "AND ((_start >= '$i-$m-01 00:00:01' AND _start <= '$i-$m-31 23:59:59') ";
							$Query .= "OR (_end >= '$i-$m-01 00:00:01' AND _end <= '$i-$m-31 23:59:59')) ";
							$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND ($idgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).")";
							$Query .= ") ";
							}
						}
					else {
						$Query .= "where _IDdata = '$IDdata' ";
						$Query .= "AND ((_start >= '$i-$m-01 00:00:01' AND _start <= '$i-$m-31 23:59:59') ";
						$Query .= "OR (_end >= '$i-$m-01 00:00:01' AND _end <= '$i-$m-31 23:59:59')) ";
						$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND ($idgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
						}

					$Query .= "order by _IDitem desc";

					$res  = mysql_query($Query, $mysql_link);
					$nb   = ( $res ) ? mysql_affected_rows($mysql_link) : 0 ;

					$lemois = $m - 1;
					$link = ( $nb )
						? "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDdata=$IDdata&month=$lemois&year=$i&weekly=$weekly")."\">$nb</a>"
						: "" ;

					print("<td class=\"align-center\" style=\"width:7%;background-color:#eeeeee;\">$link</td>");
           				}

				print("</tr>");
				}
		?>

			</table>
		  </div>

	<!-- détails des évènements -->
	<p style="margin-top:10px; margin-bottom:0px; background-color:#C0C0C0;">
		<?php print($msg->read($AGENDA_DETAILS)); ?>
		<?php print("[<a href=\"".myurlencode("index.php?item=$item&IDdata=$IDdata&month=$month&year=$year&weekly=1")."\">".$msg->read($AGENDA_WEEKLY)."</a>]"); ?>
		<?php print("[<a href=\"".myurlencode("index.php?item=$item&IDdata=$IDdata&month=$month&year=$year&weekly=2")."\">".$msg->read($AGENDA_MONTHLY)."</a>]"); ?>
		<span style="cursor: pointer;" onclick="$('details')._display.toggle(); return false;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/updown.png" title="" alt="" /></span>
	</p>

	<div id="details" style="display:block;">
	<?php
		$v = new vcalendar();					// create a new calendar instance
		$v->setConfig( 'unique_id', 'icaldomain.com' );	// set Your unique id
		$v->setProperty( 'method', 'PUBLISH' );		// required of some calendar software

		switch ( $weekly ) {
			case "1" :
				require_once "agenda_week.php";
				break;

			case "2" :
				require_once "agenda_month.php";
				break;

			default :
				if ( $display = "O" )
					require_once "agenda_week.php";
				else
					require_once "agenda_month.php";
				break;
			}

		// generate and get output in string
		$fp  = fopen($icsfile, "w");
		fwrite($fp, $v->createCalendar());
		fclose($fp);
	?>
	</div>

<hr style="width:80%;" />

<!-- recherche d'une annnonce dans les agendas -->
<span><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/search.gif" title="?" alt="?" />
<?php print($msg->read($AGENDA_SEARCH, myurlencode("index.php?item=91&cmde=search&IDdata=$IDdata&rub=8"))); ?>
</span>
