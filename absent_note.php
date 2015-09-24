<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007-2008 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : absent_note.php
 *		projet   : page de validation des absences
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 6/02/10
 *		modif    : 
 */


$sid      = @$_GET["sid"];					// session de l'utilisateur
$IDcentre = (int) @$_GET["IDcentre"];			// identifiant du e-groupe
$IDitem   = (int) @$_GET["IDitem"];				// ID de l'absence
$IDsel    = (int) @$_GET["IDsel"];				// ID de la catégorie
$IDuser   = (int) @$_GET["IDuser"];				// ID de l'utilisateur
$year     = (int) @$_GET["year"];
$month    = (int) @$_GET["month"];
$day      = (int) @$_GET["day"];
$display  = @$_GET["display"];
$IDdata   = (int) @$_GET["IDdata"];
$valid    = @$_GET["valid"];
$check    = @$_GET["check"];
$text     = addslashes(trim(@$_POST["text"]));		// note

$submit   = @$_POST["valid_x"];				// bouton de validation
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require_once "include/postit.php";
	require_once "include/calendar_tools.php";

	require "msg/absent.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/absent.php");

	if ( $submit ) {
		// qui suis-je ?
		$query  = "select distinctrow user_id._adm, user_id._IDgrp, user_id._ID, user_id._IP ";
		$query .= "from user_id, user_session ";
		$query .= "where _IDsess = '$sid' " ;
		$query .= "AND user_id._ID = user_session._ID ";
		$query .= "order by _lastaction limit 1";

		$result = mysql_query($query, $mysql_link);
		$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

		//lecture des droits
		$query  = "select _IDmod, _IDgrpwr from absent ";
		$query .= "where _IDcentre = '$IDcentre' AND _IDgrp = '$IDsel' ";
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		if ( $auth[0] == 255 OR $auth[2] == $row[0] OR ($row[1] & pow(2, $auth[1] - 1)) ) {
			$valid = ( $check == "on" ) ? "O" : "N" ;

			$query = "update absent_items set _comment = '$text', _valid = '$valid' where _IDitem = '$IDitem' limit 1";

			if ( mysql_query($query, $mysql_link) ) {
				$query  = "select _date, _start from absent_items ";
				$query .= "where _IDitem = '$IDitem' ";
				$query .= "limit 1";

				$result = mysql_query($query, $mysql_link);
				$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;

				// liste des statuts des demandes
				$status = "";
				$list   = explode(",", $msg->read($ABSENT_STATUSLIST));

				for ($i = 0; $i < count($list); $i++) {
					list($ident, $value) = explode(":", $list[$i]);
					$status = ( $value == $valid ) ? $ident : $status ;
					}

				sendAlertMessage(
					$row[0],
					$msg->read($ABSENT_SUBJECT),
					$msg->read($ABSENT_PENDING, Array(date2longfmt($myrow[0]), date2longfmt($myrow[1]), $status, date2longfmt(date("Y-m-d H:i:s")), $_SESSION["CnxName"], $text)) );
				}
			}

		// retour à la fénêtre appelante
		print("
			<script type=\"text/javascript\">
			window.opener.location=\"index.php?item=".@$_GET["item"]."&cmde=visu&IDcentre=$IDcentre&IDsel=$IDsel&IDdata=$IDdata&IDuser=$IDuser&month=$month&year=$year&valid=$valid\";
			self.close();
			</script>");
		}

	// intialisation
	$query  = "select _comment from absent_items ";
	$query .= "where _IDitem = '$IDitem' " ;
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	$text   = $row[0];
	$title  = ( $check == "on" )
		? $msg->read($ABSENT_GRANTED)
		: $msg->read($ABSENT_REJECTED) ;
?>

<table class="width100" style="border: 1px solid black">
  <tr>
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style="color:#FFFFFF;"><strong><?php print($title); ?></strong></span>
     </td>
  </tr>

  <tr>
     <td>

	<form id="formulaire" action="" method="post">

	<table class="width100">
        <tr>
          <td style="width:30%;" class="align-right valign-top">
		<?php print($msg->read($ABSENT_NOTE)); ?>
	    </td>
	    <td>
		<?php print("<label for=\"text\"><textarea id=\"text\" name=\"text\" rows=\"5\" cols=\"30\">$text</textarea></label>"); ?>
	    </td>
        </tr>

        <tr>
          <td colspan="2"><hr style="width:80%; text-align:center;" /></td>
        </tr>

        <tr>
          <td style="width:10%;" class="valign-middle align-right">
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