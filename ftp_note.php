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
 *		module   : ftp_note.php
 *		projet   : page de saisie des notes concernant les ressources ftp
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 27/06/07
 *		modif    : 
 */


$sid     = @$_GET["sid"];					// session de l'utilisateur
$IDftp   = (int) @$_GET["IDftp"];				// ID du serveur ftp
$IDnote  = (int) @$_GET["IDnote"];				// ID de la note
$path    = @$_GET["path"];					// chemin du fichier
$text    = addslashes(trim(@$_POST["text"]));		// note
$lock    = (int) @$_POST["lock"];

$submit  = @$_POST["valid_x"];				// bouton de validation
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/ftp.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/ftp.php");

	if ( $submit ) {
		// recherche ftp
		$query   = "select _IDmod, _IDgrpwr from ftp ";
		$query  .= "where _IDftp = '$IDftp' " ;
		$query  .= "limit 1";

		$result  = mysql_query($query, $mysql_link);
		$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// qui suis-je ?
		$query  = "select distinctrow user_id._adm, user_id._IDgrp, user_id._ID, user_id._IP ";
		$query .= "from user_id, user_session ";
		$query .= "where _IDsess = '$sid' " ;
		$query .= "AND user_id._ID = user_session._ID ";
		$query .= "order by _lastaction limit 1";

		$result = mysql_query($query, $mysql_link);
		$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// date de création du message
		$date    = date("Y-m-d H:i:s", time());

		if ( $auth[0] == 255 OR $auth[0] == $row[0] OR ($row[1] & pow(2, $auth[1] - 1)) ) {
			$query = ( $IDnote )
				? "update ftp_note set _ID = '$auth[2]', _IP = '$auth[3]', _modify = '$date', _text = '$text', _lock = '$lock' where _IDnote = '$IDnote' limit 1"
				: "insert into ftp_note values('', '$auth[2]', '$auth[3]', '$date', '$date', '$path', '$text', '$lock')" ;

			mysql_query($query, $mysql_link);
			}

		// retour à la fénêtre appelante
		$currdir = substr($path, 0, strrpos($path, "/"));
		print("
			<script type=\"text/javascript\">
			window.opener.location=\"index.php?item=".@$_GET["item"]."&IDftp=$IDftp&currdir=$currdir\";
			self.close();
			</script>");
		}

	// intialisation
	$query  = "select _text, _lock from ftp_note ";
	$query .= "where _path = '$path' " ;
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	$text   = $row[0];
	$lock   = $row[1];
?>

<table class="width100" style="border: 1px solid black">
  <tr>
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style="color:#FFFFFF;"><strong><?php print($path); ?></strong></span>
     </td>
  </tr>

  <tr>
     <td>

	<form id="formulaire" action="" method="post">

	<table class="width100">
        <tr>
          <td style="width:30%;" class="align-right valign-top">
		<?php print($msg->read($FTP_NOTE)); ?>
	    </td>
	    <td>
		<?php print("<label for=\"text\"><textarea id=\"text\" name=\"text\" rows=\"5\" cols=\"30\">$text</textarea></label>"); ?>
	    </td>
        </tr>

        <tr>
          <td class="align-right">
		<?php print($msg->read($FTP_AUTHORIZATION)); ?>
	    </td>
          <td class="align-left">
		<?php
			$check = ( $lock == -1 ) ? "checked=\"checked\"" : "" ;

			print("<label for=\"lock\"><input type=\"checkbox\" id=\"lock\" name=\"lock\" value=\"-1\" $check />". $msg->read($FTP_COLLABORATIVE) ."</label>");
		?>
	    </td>
        </tr>

        <tr>
          <td colspan="2"><hr style="width:80%; text-align:center;" /></td>
        </tr>

        <tr>
          <td style="width:10%;" class="valign-middle align-right">
           	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($FTP_INPUTOK)."\" />"); ?>
          </td>
          <td class="valign-middle"><?php print($msg->read($FTP_VALIDATE)); ?></td>
        </tr>
	</table>

	</form>

     </td>
  </tr>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($FTP_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>