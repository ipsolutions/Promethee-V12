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
/*
 *		module   : absent.php
 *		projet   : page de saisie des absences élèves
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 17/02/07
 *		modif    : 
 */


$sid      = @$_GET["sid"];					// session de l'utilisateur

$IDcentre = (int) @$_GET["IDcentre"];			// Identifiant du centre
$IDitem   = (int) @$_GET["IDitem"];				// ID de l'absence
$name     = @$_GET["name"];					// nom alpha
$year     = (int) $_GET["year"];
$month    = (int) $_GET["month"];
$day      = (int) $_GET["day"];

$IDclass  = ( @$_POST["IDclass"] )				// ID de la classe
	? (int) $_POST["IDclass"]
	: (int) @$_GET["IDclass"] ;
$IDeleve  = (int) @$_POST["IDeleve"];			// ID de l'élève
$IDmotif  = ( @$_POST["IDmotif"] )				// ID du motif de l'absence
	? (int) $_POST["IDmotif"]
	: (int) @$_GET["IDmotif"] ;
$start    = ( @$_POST["start"] )				// date début absence
	? $_POST["start"]
	: date("Y-m-d") ;
$end      = @$_POST["end"];					// date fin absence
$delay    = @$_POST["delay"];					// heure absence
$note     = addslashes(trim(@$_POST["note"]));		// note

$submit   = @$_POST["valid_x"];				// bouton de validation

$_SESSION["CnxCentre"] = $IDcentre;
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require_once "include/calendar_tools.php";

	require "msg/absent.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/absent.php");
	$msg->msg_search  = $keywords_search;
	$msg->msg_replace = $keywords_replace;

	$statut = ( $IDitem ) ? $msg->read($ABSENT_MODIFICATION) : $msg->read($ABSENT_APPEND) ;

	if ( $submit ) {
		// recherche gestion des absences
		$query  = "select _IDmod, _IDgrpwr from absent ";
		$query .= "where _IDcentre = '$IDcentre' AND _IDgrp = '1' ";
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// qui suis-je ?
		$query  = "select distinctrow user_id._adm, user_id._IDgrp, user_session._ID, user_session._IP ";
		$query .= "from user_id, user_session ";
		$query .= "where _IDsess = '$sid' ";
		$query .= "AND user_id._ID = user_session._ID ";
		$query .= "order by _lastaction ";
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

		if ( $auth[0] == 255 OR $auth[2] == $row[0] OR ($row[1] & pow(2, $auth[1] - 1)) ) {
			$mydate = date("Y-m-d H:i:s");
			$end    = ( $end ) ? $end : $start ;

			if ( $IDitem ) {
				$query  = "update absent_items ";
				$query .= "set _IDdata = '$IDmotif', _start = '$start $delay', _end = '$end $delay', _texte = '$note' ";
				$query .= "where _IDitem = '$IDitem' ";
				$query .= "limit 1";
				}
			else {
				if ( $IDmotif == 3 ) {
					$query  = "insert into absent_sick ";
					$query .= "values('', '$IDcentre', '$IDclass', '$IDeleve', '$auth[2]', '$auth[3]', '$mydate', '0', '0', '', '0', '$note')";

					mysql_query($query, $mysql_link);
					}

				$query  = "insert into absent_items ";
				$query .= "values('', '$IDmotif', '-1', '$auth[2]', '$auth[3]', '$mydate', '1', '$IDeleve', '$start $delay', '$end $delay', '$note', '', 'O', 'N', '0', '', '', '0', '', 'N', '', '')";
				}

			if ( $start )
				if ( mysql_query($query, $mysql_link) )
					$statut .= " <img src=\"".$_SESSION["ROOTDIR"]."/images/ok.gif\" title=\"\" alt=\"\" />";
				else
					$statut .= " <img src=\"".$_SESSION["ROOTDIR"]."/images/bad.gif\" title=\"\" alt=\"\" />";
			else
				$statut .= " <img src=\"".$_SESSION["ROOTDIR"]."/images/bad.gif\" title=\"\" alt=\"\" />";
			}

		// maj de la fénêtre appelante
		print("
			<script type=\"text/javascript\">
			window.opener.location=\"index.php?item=".@$_GET["item"]."&cmde=".@$_GET["cmde"]."&IDcentre=$IDcentre&IDclass=$IDclass&name=$name&year=$year&month=$month&day=$day\";
			self.close();
			</script>");
		}

	// initialisation
	$query  = "select _start, _end, _texte, _IDdata, _IDabs from absent_items ";
	$query .= "where _IDitem = '$IDitem' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( mysql_affected_rows($mysql_link) ) {
		$note      = $row[2];
		$IDmotif   = $row[3];
		$IDeleve   = $row[4];
		list($end) = explode(" ", $row[1]);
		list($start, $delay) = explode(" ", $row[0]);
		}
	else
		$delay   = date("H:i");
?>

<table class="width100" style="border: 1px solid black">
  <tr>
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style="color:#FFFFFF;"><?php print($msg->read($ABSENT_UPDATE)); ?></span>
     </td>
  </tr>

  <tr>
     <td>

	<form id="formulaire" action="absent.php?sid=<?php echo $sid; ?>&amp;item=<?php echo $item; ?>&amp;cmde=show&amp;IDcentre=<?php echo $IDcentre; ?>&amp;IDgroup=<?php echo $IDgroup; ?>&amp;name=<?php echo $name; ?>&amp;IDclass=<?php echo $IDclass; ?>&amp;year=<?php echo $year; ?>&amp;month=<?php echo $month; ?>&amp;day=<?php echo $day; ?>&amp;lang=<?php echo $lang; ?>" method="post">

	<table class="width100">
        <tr>
          <td style="width:25%;" class="align-right valign-middle">
		<?php print($msg->read($ABSENT_STATUS)); ?>
	    </td>
	    <td class="valign-middle">
		<?php print($statut); ?>
	    </td>
        </tr>

        <tr>
          <td colspan="2" class="align-center"><hr style="width:80%;" /></td>
        </tr>

        <tr>
          <td class="align-right valign-middle">
		<?php print($msg->read($ABSENT_CLASS)); ?>
	    </td>
	    <td class="valign-middle">
		<label for="IDclass">
	  	<select id="IDclass" name="IDclass" onchange="document.forms.formulaire.submit()">
		<?php
			$query  = "select _IDclass, _ident from campus_classe ";
			$query .= "where _visible = 'O' ";
			$query .= "order by _text";

			$result = mysql_query($query, $mysql_link);
			$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			if ( !$IDclass )
				$IDclass = $row[0];

			while ( $row ) {			
				if ( $IDclass == $row[0] )
					print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
				else
					if ( !$IDitem )
						print("<option value=\"$row[0]\">$row[1]</option>");

				$row = remove_magic_quotes(mysql_fetch_row($result));
				}
		?>
		</select> <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/group.gif" title="" alt="" />
		</label>
	    </td>
        </tr>

        <tr>
          <td class="align-right valign-middle">
		<?php print($msg->read($ABSENT_STUDENT)); ?>
	    </td>
	    <td class="valign-middle">
		<label for="IDeleve">
	  	<select id="IDeleve" name="IDeleve">
			<option value="0"></option>
		<?php
			$query  = "select _ID, _name, _fname from user_id ";
			$query .= "where _IDclass = '$IDclass' ANd _IDgrp = '1' ";
			$query .= "AND _visible = 'O' ";
			$query .= "order by _name, _fname";

			$result = mysql_query($query, $mysql_link);
			$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			while ( $row ) {			
				if ( $IDeleve == $row[0] )
					print("<option selected=\"selected\" value=\"$row[0]\">$row[1] $row[2]</option>");
				else
					if ( !$IDitem )
						print("<option value=\"$row[0]\">$row[1] $row[2]</option>");

				$row = remove_magic_quotes(mysql_fetch_row($result));
				}
		?>
		</select> <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/anonymous.gif" title="" alt="" />
		</label>
	    </td>
        </tr>

        <tr>
          <td class="align-right valign-middle">
		<?php print($msg->read($ABSENT_FROM)); ?>
	    </td>
	    <td class="valign-middle">
		<?php
			print("<label for=\"is_start\"><input type=\"text\" id=\"is_start\" name=\"start\" size=\"10\" value=\"$start\" /></label>");

			// calendrier surgissant
			CalendarPopup("start", "document.formulaire.start");
		?>
	    </td>
        </tr>

        <tr>
          <td class="align-right valign-middle">
		<?php print($msg->read($ABSENT_TO)); ?>
	    </td>
	    <td class="valign-middle">
		<?php
			print("<label for=\"is_end\"><input type=\"text\" id=\"is_end\" name=\"end\" size=\"10\" value=\"$end\" /></label>");

			// calendrier surgissant
			CalendarPopup("end", "document.formulaire.end");
		?>
	    </td>
        </tr>

        <tr>
          <td class="align-right valign-middle">
		<?php print($msg->read($ABSENT_TIME)); ?>
	    </td>
	    <td class="valign-middle">
		<label for="delay"><input type="text" id="delay" name="delay" size="10" value="<?php print($delay); ?>" /></label>
		<img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/horloge.png" title="" alt="" />
	    </td>
        </tr>

        <tr>
          <td class="align-right valign-middle">
		<?php print($msg->read($ABSENT_MOTIF)); ?>
	    </td>
	    <td class="valign-middle">
		<label for="IDmotif">
	  	<select id="IDmotif" name="IDmotif">
		<?php
			// liste des motifs de retard
			$query  = "select _IDdata, _texte from absent_data ";
			$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
			$query .= "order by _texte";

			$result = mysql_query($query, $mysql_link);
			$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			while ( $row ) {			
				if ( $IDmotif == $row[0] )
					print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
				else
					print("<option value=\"$row[0]\">$row[1]</option>");

				$row = remove_magic_quotes(mysql_fetch_row($result));
				}
		?>
		</select> <img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/document.gif" title="" alt="" />
		</label>
	    </td>
        </tr>

        <tr>
          <td class="align-right valign-middle">
		<?php print($msg->read($ABSENT_NOTES)); ?>
	    </td>
	    <td class="valign-middle">
		<label for="note"><textarea id="note" name="note" rows="2" cols="30"><?php print($note); ?></textarea></label>
	    </td>
        </tr>

        <tr>
          <td colspan="2" class="align-center"><hr style="width:80%;" /></td>
        </tr>

        <tr>
          <td class="valign-middle align-right">
           	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($ABSENT_INPUTOK)."\" />"); ?>
          </td>
          <td class="valign-middle"><?php print($msg->read($ABSENT_RECORD)); ?></td>
        </tr>
	</table>

	</form>

     </td>
  </tr>
</table>

<p style="text-align:center;">
	[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($ABSENT_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>