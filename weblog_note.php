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
 *		module   : weblog_note.php
 *		projet   : page de saisie des commentaires concernant les weblogs
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/09/08
 *		modif    : 
 */


$sid     = @$_GET["sid"];					// session de l'utilisateur
$IDgroup = (int) @$_GET["IDgroup"];				// identifiant du e-groupe
$IDlog   = (int) @$_GET["IDlog"];				// identifiant du weblog
$IDitem  = (int) @$_GET["IDitem"];				// ID du message
$parent  = (int) @$_GET["parent"];				// ID du message parent
$subject = addslashes(trim(@$_POST["subject"]));	// sujet du commentaire
$text    = addslashes(trim(@$_POST["text"]));		// commentaire

$submit  = @$_POST["valid_x"];				// bouton de validation
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/weblog.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/weblog.php");

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
		$query  = "select _ID, _IDgrpwr from weblog ";
		$query .= "where _IDlog = '$IDlog' " ;
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		if ( $auth[0] == 255 OR $auth[2] == $row[0] OR ($row[1] & pow(2, $auth[1] - 1)) ) {
			$query  = "insert into weblog_note ";
			$query .= "values('', '$IDitem', '$auth[2]', '$auth[3]', '".date("Y-m-d H:i:s")."', '$subject', '$text', '$parent')";

			mysql_query($query, $mysql_link);
			}

		// retour à la fénêtre appelante
		print("
			<script type=\"text/javascript\">
			window.opener.location=\"index.php?item=".@$_GET["item"]."&cmde=visu&IDitem=$IDitem&IDgroup=$IDgroup&IDlog=$IDlog&IDitem=$IDitem&comment=1\";
			self.close();
			</script>");
		}

	// intialisation
	if ( $parent ) {
		$Query  = "select _title from weblog_note ";
		$Query .= "where _IDnote = '$parent' ";
		$Query .= "limit 1";
		}
	else {
		$Query  = "select _title from weblog_items ";
		$Query .= "where _IDitem = '$IDitem' ";
		$Query .= "limit 1";
		}

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;
?>

<table class="width100" style="border: 1px solid black">
  <tr>
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style="color:#FFFFFF;"><strong><?php print($row[0]); ?></strong></span>
     </td>
  </tr>

  <tr>
     <td>

	<form id="formulaire" action="" method="post">

	<table class="width100">
        <tr>
          <td class="align-right">
		<?php
			print($msg->read($WEBLOG_SUBJECT));
		?>
	    </td>
	    <td>
		<?php print("<label for=\"subject\"><input type=\"text\" id=\"subject\" name=\"subject\" size=\"44\" /></label>"); ?>
	    </td>
        </tr>

        <tr>
          <td class="align-right valign-top">
		<?php
			print(
				$msg->read($WEBLOG_MESSAGE) ." <a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/spip_typo.php?lang=".$_SESSION["lang"]."', '450', '350'); return false;\">
				<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/aide.gif\" title=\"".$msg->read($WEBLOG_HELP)."\" alt=\"".$msg->read($WEBLOG_HELP)."\" /></a>");
		?>
	    </td>
	    <td>
		<?php print("<label for=\"text\"><textarea id=\"text\" name=\"text\" rows=\"5\" cols=\"34\"></textarea></label>"); ?>
	    </td>
        </tr>

        <tr>
          <td colspan="2"><hr style="width:80%; text-align:center;" /></td>
        </tr>

        <tr>
          <td style="width:10%;" class="valign-middle align-right">
           	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($WEBLOG_INPUTOK)."\" />"); ?>
          </td>
          <td class="valign-middle"><?php print($msg->read($WEBLOG_UPDATE)); ?></td>
        </tr>
	</table>

	</form>

     </td>
  </tr>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($WEBLOG_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>