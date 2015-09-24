<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2009 by Dominique Laporte(C-E-D@wanadoo.fr)
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
 *		module   : reservation.php
 *		projet   : la page des réservations
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 25/09/04
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDcentre = ( @$_POST["IDcentre"] )		// Identifiant du centre
	? (int) $_POST["IDcentre"]
	: (int) (@$_GET["IDcentre"] ? $_GET["IDcentre"] : $_SESSION["CnxCentre"]) ;

$IDres    = ( @$_POST["IDres"] )		// ID du type de réservation
	? (int) $_POST["IDres"]
	: (int) @$_GET["IDres"] ;
$IDdata   = ( @$_POST["IDdata"] )		// ID de la ressource à réserver
	? (int) $_POST["IDdata"]
	: (int) @$_GET["IDdata"] ;
$IDitem   = ( @$_POST["IDitem"] )		// ID de la réservation
	? (int) $_POST["IDitem"]
	: (int) @$_GET["IDitem"] ;
$weekly   = ( @$_POST["weekly"] )		// affichage hebdo / mensuel
	? (int) $_POST["weekly"]
	: (int) @$_GET["weekly"] ;
$note     =   @$_POST["note"];		// note du modérateur concernant la réservation

$year     = ( @$_POST["year"] )
	? (int) $_POST["year"]
	: (int) (@$_GET["year"] ? $_GET["year"] : date("Y")) ;
$month   = ( strlen(@$_POST["month"]) )
	? (int) $_POST["month"]
	: (int) (strlen(@$_GET["month"]) ? $_GET["month"] : date("m") - 1) ;
$day      = ( @$_POST["day"] )
	? (int) $_POST["day"]
	: (int) @$_GET["day"] ;
$week     = ( @$_POST["week"] )
	? (int) $_POST["week"]
	: (int) @$_GET["week"] ;

$submit   = ( @$_POST["submit"] )		// bouton de validation
	? $_POST["submit"]
	: @$_GET["submit"] ;


//---------------------------------------------------------------------------
function alert($dest, $sujet, $texte, $type)
{
/*
 * fonction :	avertit un utilisateur
 * in :		$dest : ID du destinataire, $sujet : sujet de message, $texte : corps du message, $type : mode d'envoi du message
 */

	require "globals.php";

	switch ( $type ) {
		case "P" :	// post-it
			if ( canRead($dest) )
				sendMessage($dest, $sujet, $texte);
			break;

		case "E" :	// email
			$query  = "select _email from user_id ";
			$query .= "where _ID = '$dest' ";
			$query .= "limit 1";

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;

			if ( $myrow[0] ) {
				require_once "lib/libmail.php";

				$mymail = new Mail(); 				// create the mail

				$mymail->From("noreply@".$_SESSION["CfgEmail"]);
				$mymail->To($myrow[0]);
				$mymail->Subject(stripslashes($sujet));	
				$mymail->Body(stripslashes($texte), $CHARSET);	// set the body

				$mymail->Send();					// send the mail
				}
			break;

		default :	// rien
			break;
		}
}
//---------------------------------------------------------------------------
?>


<?php
	require_once "lib/lib_icalcreactor.php";

	// initialisation
	$IDres   = ( @$_POST["mycentre"] AND @$_POST["mycentre"] != $IDcentre ) ? 0 : $IDres ;

	if ( $IDres >= 1000 ) {
		$IDdata = $IDres - (1000 * (int) ($IDres / 1000));
		$IDres  = (int) ($IDres / 1000);
		}

	// pour l'import/export ical
	$icsfile = "tmp/ical/ical-r$IDcentre$IDres$IDdata.ics";

	// lecture des réservations
	$Query  = "select _IDres, _IDmod, _IDgrpwr, _IDgrprd, _texte, _email, _weekly, _horaire, _IDweek, _maximize from reservation ";
	$Query .= "where _visible = 'O' AND _IDcentre = '$IDcentre' ";
	$Query .= ( $IDres ) ? "AND _IDres = '$IDres' " : "" ;
	$Query .= "AND _lang = '".$_SESSION["lang"]."' ";
	$Query .= "order by _IDres limit 1";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	// vérification des autorisations
	verifySessionAccess($row[1], $row[3]);

	if ( $row )
      	print("<div style=\"background-color:#eeeeee; padding:2px;\">$row[4]</div>");

	//paramètres internes des réservations
      $IDres   = $row[0];
      $idmod   = $row[1];
      $idgrpwr = $row[2];
      $idgrprd = $row[3];
      $display = $row[6];	// affichage (O : hebdo, N : mensuel)
      $time    = $row[7];	// plages horaires (séparateur ,)
      $idweek  = $row[8];	// index des jours de la semaine (1 : Lundi, 2 : Mardi, ...)
      $maxi    = $row[9];	// déployer la liste des réservations

	// commandes utilisateur
	switch ( $submit ) {
		case "clear" :	// suppression de l'année
			if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod ) {
				$Query  = "delete from reservation_items ";
				$Query .= "where _IDdata = '$IDdata' ";
				$Query .= "AND _start >= '$year-01-01 00:00:01' AND _start <= '$year-12-31 23:59:59' ";

				mysql_query($Query, $mysql_link);
				}
			break;
		case "del" :	// suppression de la demande
			$date   = date("Y-m-d H:i:s");

			// lecture de la réservation
			$query  = "select distinctrow ";
			$query .= "reservation_items._ID, reservation_items._start, reservation_data._titre, reservation_items._date, reservation._titre ";
			$query .= "from reservation_items, reservation_data, reservation ";
			$query .= "where reservation_items._IDitem = '$IDitem' ";
			$query .= "AND reservation_items._IDdata = reservation_data._IDdata ";
			$query .= "AND reservation._IDres = reservation_data._IDres ";
			$query .= "AND reservation._lang = '".$_SESSION["lang"]."' ";
			$query .= "limit 1";

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			// suppression
//			$query  = "update reservation_items ";
//			$query .= "set _erase = '$date', _visible = 'N' ";
			$query  = "delete from reservation_items ";
			$query .= "where _IDitem = '$IDitem' ";
			$query .= ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod ) ? "" : "AND _ID = '".$_SESSION["CnxID"]."' " ;
			$query .= "limit 1";

			if ( mysql_query($query, $mysql_link) AND $_SESSION["CnxID"] != $myrow[0]  ) {
				$sujet  = $msg->read($RESERVATION_SUBJECT);
				$texte  = $msg->read(
					$RESERVATION_ERASE,
					Array(date2longfmt($myrow[3]), $myrow[2], $myrow[4], date2longfmt($myrow[1]), date2longfmt($date), $_SESSION["CnxName"])) ;

				// on avertit l'utilisateur
				alert($myrow[0], $sujet, $texte, ($row[5] ? $row[5] : "P"));
				}
			break;
		case "delete" :	// suppression de la ressource
			$query  = "delete from reservation_data ";
			$query .= "where _IDdata = '$IDdata' ";
			$query .= "limit 1";

			if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod )
				mysql_query($query, $mysql_link);
			break;
		case "on" :		// validation de la demande
		case "off" :	// rejet de la demande
			if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod ) {
				$date   = date("Y-m-d H:i:s");
				$valid  = ( $submit == "on" ) ? "O" : "N" ;

				$query  = "update reservation_items ";
				$query .= "set _valid = '$date', _visible = '$valid', _note = '".@$note[$IDitem]."' ";
				$query .= "where _IDitem = '$IDitem' ";
				$query .= "limit 1";

				if ( mysql_query($query, $mysql_link) ) {
					// lecture de la réservation
					$query  = "select distinctrow ";
					$query .= "reservation_items._ID, reservation_items._start, reservation_data._titre ";
					$query .= "from reservation_items, reservation_data ";
					$query .= "where reservation_items._IDitem = '$IDitem' ";
					$query .= "AND reservation_items._IDdata = reservation_data._IDdata ";
					$query .= "limit 1";

					$return = mysql_query($query, $mysql_link);
					$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

					$sujet  = $msg->read($RESERVATION_SUBJECT);
					$texte  = ( $submit == "on" )
						? $msg->read($RESERVATION_ISOK, Array($myrow[2], $myrow[1]))
						: $msg->read($RESERVATION_ISNOTOK, Array($myrow[2], $myrow[1])) ;
					$texte .= "\n" . @$note[$IDitem];

					// on avertit l'utilisateur
					alert($myrow[0], $sujet, $texte, $row[5]);
					}
				}
			break;
		default :
			//---- import calendrier
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

					$Query   = "insert into reservation_items ";
					$Query  .= "values('', '$IDdata', '0', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '$date', '$date', '$date', 'B', '$start', '$end', '$texte', '', '')";

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

	$mois = explode(",", $msg->read($RESERVATION_MONTHFULL));
?>

	<hr style="width:80%;" />

	<form id="formulaire" action="index.php" method="post">
	<?php
		print("
			<p class=\"hidden\"><input type=\"hidden\" name=\"item\"      value=\"$item\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"      value=\"$cmde\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"mycentre\"  value=\"$IDcentre\" /></p>
			");
	?>

		<table  class="width100">
		  <tr>
			<td style="width:50%;" class="align-right">
			    	<?php print($msg->read($RESERVATION_CHOOSECENTER)); ?> 
			</td>
			<td style="width:50%;">
				<label for="IDcentre">
			  	<select id="IDcentre" name="IDcentre" onchange="document.forms.formulaire.submit()">
				<?php
					// lecture des centres constitutifs
					$query  = "select _IDcentre, _ident from config_centre ";
					$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
					$query .= "order by _IDcentre";

					$result = mysql_query($query, $mysql_link);
					$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

					if ( !$IDcentre )
						$IDcentre = $row[0];

					while ( $row ) {
						$select = ( $IDcentre == $row[0] ) ? "selected=\"selected\"" : "" ;

						print("<option value=\"$row[0]\" $select>$row[1]</option>");

						$row = remove_magic_quotes(mysql_fetch_row($result));
						}				
				?>
				</select>
				<?php
					// export ical
		                	print("
						<a href=\"$icsfile\" onclick=\"window.open(this.href, '_blank'); return false;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/ical-export.png\" title=\"".$msg->read($RESERVATION_ICALEXPORT)."\" alt=\"".$msg->read($RESERVATION_ICALEXPORT)."\" />
						</a>");

					// import ical
					if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod OR ($idgrpwr & pow(2, $_SESSION["CnxGrp"] - 1)) )
			                	print("
							<a href=\"".myurlencode("index.php?item=$item&IDdata=$IDdata&year=$year&month=$month&day=$day&weekly=$weekly&submit=import")."\">
							<img src=\"".$_SESSION["ROOTDIR"]."/images/ical-import.png\" title=\"".$msg->read($RESERVATION_ICALIMPORT)."\" alt=\"".$msg->read($RESERVATION_ICALIMPORT)."\" />
							</a>");
				?>
				</label>
			</td>
		  </tr>

		  <tr>
			<td class="align-right">
			    	<?php print($msg->read($RESERVATION_CHOOSEBOOKING)); ?> 
			</td>
			<td>
				<label for="IDres">
			  	<select id="IDres" name="IDres" onchange="document.forms.formulaire.submit()">
				<?php
					$query  = "select _IDres, _IDmod, _IDgrpwr, _IDgrprd, _titre, _texte from reservation ";
					$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
//					$query .= "AND _IDcentre = '$IDcentre' ";
					$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND (_IDgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") " ;
					$query .= "order by _titre";

					$result = mysql_query($query, $mysql_link);
					$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

					while ( $row ) {
						$value  = 1000 * $row[0];
						$select = ( !$IDdata AND $IDres == $row[0] ) ? "selected=\"selected\"" : "" ;

						print("<optgroup label=\"$row[4]\">");
						print("<option value=\"$value\" $select>". $msg->read($RESERVATION_SHOWALL, $row[4]) ."</option>");

						$query  = "select _IDdata, _titre from reservation_data ";
						$query .= "where _IDres = '$row[0]' ";
						$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND _IDcentre like '% $IDcentre %' " ;
						$query .= "order by _titre";

						$return = mysql_query($query, $mysql_link);
						$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

						while ( $myrow ) {
							$valeur = $value + $myrow[0];
							$select = ( $IDdata == $myrow[0] ) ? "selected=\"selected\"" : "" ;

							print("<option value=\"$valeur\" $select>$myrow[1]</option>");

							$myrow  = remove_magic_quotes(mysql_fetch_row($return));
							}

						print("</optgroup>");

						$row = remove_magic_quotes(mysql_fetch_row($result));
						}

				// suppression des ressources
				$req = $msg->read($RESERVATION_DELRESOURCE);
				$del = ( $IDdata AND ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod) )
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&year=$year&month=$month&day=$day&weekly=$weekly&submit=delete")."\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($RESERVATION_DELRESOURCE)."\"  alt=\"".$msg->read($RESERVATION_DELRESOURCE)."\"  /></a>"
					: "" ;

				// modification des ressources
				$maj = ( $IDdata AND ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod) )
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=new&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&year=$year&month=$month&day=$day&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"".$msg->read($RESERVATION_UPDATERESOURCE)."\" alt=\"".$msg->read($RESERVATION_UPDATERESOURCE)."\" /></a>"
					: "" ;

				// ajout d'une nouvelle ressource
				$add = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod )
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=new&IDres=$IDres&IDcentre=$IDcentre&year=$year&month=$month&day=$day&weekly=$weekly")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/ajouter.gif\" title=\"".$msg->read($RESERVATION_ADDRESOURCE)."\" alt=\"".$msg->read($RESERVATION_ADDRESOURCE)."\" /></a>"
					: "<img src=\"".$_SESSION["ROOTDIR"]."/images/annonce.gif\" title=\"\" alt=\"\" />" ;

				?>
				</select> <?php print("$del $maj $add"); ?>
				</label>
			</td>
		  </tr>

		  <tr>
			<td class="align-right">
			<?php
				if ( $submit == "import" )
					print($msg->read($RESERVATION_ICALIMPORT) . " :");
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

		<?php print("<p class=\"hidden\"><input type=\"hidden\" name=\"mycentre\" value=\"$IDcentre\" /></p>"); ?>
	</form>

	<hr style="width:80%;" />

	<!-- liste des demandes sur l'année -->
	<p style="margin:0px; background-color:#C0C0C0;">
		<?php print($msg->read($RESERVATION_REQUEST)); ?>
		<span style="cursor: pointer;" onclick="$('request')._display.toggle(); return false;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/updown.png" title="" alt="" /></span>
	</p>

	<div id="request" style="display:<?php print($maxi == "O" ? "block" : "none"); ?>;">

		<table class="width100">
		  <tr>
		    <td style="width:14%;"></td>
			<?php
				$list = explode(",", $msg->read($RESERVATION_MONTH));

				for ($i=0; $i < count($list); $i++)
		            	print("<td style=\"width:7%;\" class=\"align-right\">$list[$i]</td>");
		      ?>
		  </tr>

		<?php
			// lectures des années
			$query  = "select reservation_items._start, reservation_items._IDdata ";
			$query .= "from reservation_items, reservation_data ";
			$query .= "where reservation_items._IDdata = reservation_data._IDdata ";
			$query .= "AND reservation_data._IDres = '$IDres' AND reservation_data._IDcentre like '% $IDcentre %' ";
			$query .= ( $IDdata ) ? "AND reservation_items._IDdata = '$IDdata' " : "" ;
			$query .= "order by reservation_items._start asc ";
			$query .= "limit 1";

			$res    = mysql_query($query, $mysql_link);
			$start  = ( $res ) ? mysql_fetch_row($res) : 0 ;

			$query  = "select reservation_items._end ";
			$query .= "from reservation_items, reservation_data ";
			$query .= "where reservation_items._IDdata = reservation_data._IDdata ";
			$query .= "AND reservation_data._IDres = '$IDres' AND reservation_data._IDcentre like '% $IDcentre %' ";
			$query .= ( $IDdata ) ? "AND reservation_items._IDdata = '$IDdata' " : "" ;
			$query .= "order by reservation_items._end desc ";
			$query .= "limit 1";

			$res    = mysql_query($query, $mysql_link);
			$end    = ( $res ) ? mysql_fetch_row($res) : 0 ;

			// construction du tableau
			$y_start = (int) substr($start[0], 0, 4);
			$y_end   = (int) substr($end[0], 0, 4);

			for ($i = $y_end; $i AND $i >= $y_start; $i--) {
				print("<tr>");

				// suppression de l'année
				$req  = $msg->read($RESERVATION_DELETE);
				$del  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $idmod )
					? "<a href=\"index.php?item=$item&amp;IDdata=$start[1]&amp;submit=clear\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($RESERVATION_DELETE)."\" alt=\"".$msg->read($RESERVATION_DELETE)."\" /></a>"
					: "" ;

				print("<td style=\"width:14%; white-space:nowrap;\" class=\"align-right\">$i $del</td>");

				for ($m = 1; $m <= 12; $m++) {
					// détermination du nombre des demandes
					$Query  = "select _IDitem from reservation_items, reservation_data ";
					$Query .= "where reservation_items._IDdata = reservation_data._IDdata ";
					$Query .= ( $IDdata ) ? "AND reservation_items._IDdata = '$IDdata' " : "" ;
					$Query .= "AND reservation_data._IDres = '$IDres' AND reservation_data._IDcentre like '% $IDcentre %' ";
					$Query .= "AND ((reservation_items._start >= '$i-$m-01 00:00:01' AND reservation_items._start <= '$i-$m-31 23:59:59') ";
					$Query .= "OR (reservation_items._end >= '$i-$m-01 00:00:01' AND reservation_items._end <= '$i-$m-31 23:59:59')) ";
					$Query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND ($idgrprd & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
					$Query .= "order by reservation_items._IDitem desc";

					$res  = mysql_query($Query, $mysql_link);
					$nb   = ( $res ) ? mysql_affected_rows($mysql_link) : 0 ;

					$j    = $m - 1;
					$link = ( $nb )
						? "<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&year=$i&month=$j&weekly=2")."\">$nb</a>"
						: "" ;

					print("<td class=\"align-center\" style=\"width:7%; white-space:nowrap; background-color:#eeeeee;\">$link</td>");
           				}

				print("</tr>");
				}
		?>

		</table>
	</div>

	<!-- liste des disponibilités -->
	<p style="margin-top:10px; margin-bottom:0px; background-color:#C0C0C0;">
		<?php print($msg->read($RESERVATION_LISTAVAIL, Array(strval($day), $mois[$month], strval($year)))); ?>
		<span style="cursor: pointer;" onclick="$('list')._display.toggle(); return false;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/updown.png" title="" alt="" /></span>
	</p>

	<div id="list" style="display:<?php print($maxi == "O" ? "block" : "none"); ?>;">

		<?php
			// on force (affichage statique)
			$visu = 1;

			switch ( $visu ) {
				case '1' :	// on affiche les disponibilités
					$query  = "select _IDdata, _titre, _ident from reservation_data ";
					$query .= "where _visible = 'O' ";
					$query .= "AND _IDres = '$IDres' AND _IDcentre like '% $IDcentre %' ";
					$query .= ( $IDdata ) ? "AND _IDdata = '$IDdata' " : "" ;
					$query .= "order by _titre";

					$return = mysql_query($query, $mysql_link);
					$row    = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

					$lemois = $month + 1;

					print("<table class=\"width100\">");

					$i = 0;
					while ( $row ) {
						$bgcol  = ( $i++ % 2 ) ? "item" : "menu" ;

						$info   = "<a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/reservation_info.php?IDdata=$row[0]&amp;lang=".$_SESSION["lang"]."', '450', '350'); return false;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/info.gif\" title=\"".$msg->read($RESERVATION_MORINFO)."\" alt=\"".$msg->read($RESERVATION_MORINFO)."\" /></a>";

						$query  = "select _ID, _priority, _start, _visible, _IDitem from reservation_items ";
						$query .= "where _IDdata = '$row[0]' ";
						$query .= "AND _visible <> 'N' ";
						$query .= "AND _start <= '$year-$lemois-$day 23:59:59' ";
						$query .= "AND _end >= '$year-$lemois-$day 00:00:00' ";
						$query .= ( $IDdata ) ? "AND _IDdata = '$IDdata' " : "" ;
						$query .= "order by _start";

						$ret    = mysql_query($query, $mysql_link);
						$who    = ( $ret ) ? mysql_fetch_row($ret) : 0 ;

						// la ressource a été réservée
						if ( mysql_affected_rows($mysql_link) )
							while ( $who ) {
								// qui a réservé et quand
								$post = getUserName($who[0]);

								$name = "<img src=\"".$_SESSION["ROOTDIR"]."/images/$who[1].gif\" title=\"\" alt=\"\" /> ". $msg->read($RESERVATION_BOOKBY, Array($post, date2longfmt($who[2])));

								// statut de la demande (validée ou en attente)
								$isok = ( $who[3] == "O" )
									? "<img src=\"".$_SESSION["ROOTDIR"]."/images/check-ok.gif\" title=\"\" alt=\"\" />"
									: "<img src=\"".$_SESSION["ROOTDIR"]."/images/attente.gif\" title=\"".$msg->read($RESERVATION_WAIT)."\" alt=\"".$msg->read($RESERVATION_WAIT)."\" />" ;

								print("
									<tr class=\"$bgcol\">
									  <td style=\"width:2%;\">$isok</td>
									  <td style=\"width:30%;\">
										$info
										<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDres=$IDres&IDcentre=$IDcentre&IDdata=$row[0]&year=$year&month=$lemois&day=$day&weekly=$weekly")."\">$row[1]</a>
									  </td>
									  <td style=\"width:30%;\">$row[2]</td>
									  <td style=\"width:40%;\">$name</td>
									</tr>
									");

								$who = mysql_fetch_row($ret);
								}
						// la ressource est libre
						else
							print("
								<tr class=\"$bgcol\">
								  <td style=\"width:2%;\"></td>
								  <td style=\"width:30%;\">
									$info
									<a href=\"".myurlencode("index.php?item=$item&cmde=post&IDres=$IDres&IDcentre=$IDcentre&IDdata=$row[0]&year=$year&month=$lemois&day=$day&weekly=$weekly")."\">$row[1]</a>
								  </td>
								  <td style=\"width:30%;\">$row[2]</td>
								  <td style=\"width:40%;\"></td>
								</tr>
								");

						$row = remove_magic_quotes(mysql_fetch_row($return));
						}

					print("</table>");
					break;
				default :	// on affiche rien
					break;
				}
		?>

	</div>

	<!-- détails des demandes -->
	<p style="margin-top:10px; margin-bottom:0px; background-color:#C0C0C0;">
		<?php print($msg->read($RESERVATION_DETAILS)); ?>
		<?php print("[<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&month=$month&year=$year&weekly=1")."\">".$msg->read($RESERVATION_WEEKLY)."</a>]"); ?>
		<?php print("[<a href=\"".myurlencode("index.php?item=$item&IDres=$IDres&IDcentre=$IDcentre&IDdata=$IDdata&month=$month&year=$year&weekly=2")."\">".$msg->read($RESERVATION_MONTHLY)."</a>]"); ?>
		<span style="cursor: pointer;" onclick="$('details')._display.toggle(); return false;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/updown.png" title="" alt="" /></span>
	</p>

	<div id="details" style="display:block;">
	<?php
		$v = new vcalendar();					// create a new calendar instance
		$v->setConfig( 'unique_id', 'icaldomain.com' );	// set Your unique id
		$v->setProperty( 'method', 'PUBLISH' );		// required of some calendar software

		switch ( $weekly ) {
			case "1" :
				require_once "reservation_week.php";
				break;

			case "2" :
				require_once "reservation_month.php";
				break;

			default :
				if ( $display == "O" )
					require_once "reservation_week.php";
				else
					require_once "reservation_month.php";
				break;
			}

		// generate and get output in string
		$fp  = fopen($icsfile, "w");
		fwrite($fp, $v->createCalendar());
		fclose($fp);
	?>
	</div>

<hr style="width:80%;" />

<!-- recherche d'une réservation -->
<span><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/search.gif" title="?" alt="?" />
<?php print($msg->read($RESERVATION_SEARCH, myurlencode("index.php?item=91&cmde=search&IDdata=$IDdata&rub=7"))); ?>
</span>
