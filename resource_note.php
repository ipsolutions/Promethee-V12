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
 *		module   : resource_note.php
 *		projet   : page de saisie des notes concernant les ressources ftp
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 27/06/07
 *		modif    : 
 */


$sid     = @$_GET["sid"];					// session de l'utilisateur
$IDgroup = (int) @$_GET["IDgroup"];				// identifiant du e-groupe
$IDres   = (int) @$_GET["IDres"];				// identifiant de la ressource
$IDmat   = (int) @$_GET["IDmat"];				// identifiant de la matière/formation
$IDcat   = (int) @$_GET["IDcat"];				// identifiant de la catégorie
$IDsel   = (int) @$_GET["IDsel"];				// identifiant de la classe
$IDroot  = (int) @$_GET["IDroot"];				// ID répertoire racine
$IDitem  = (int) @$_GET["IDitem"];				// ID du fichier
$sort    = (int) @$_GET["sort"];				// sélecteur de tri
$text    = addslashes(trim(@$_POST["text"]));		// note

$submit  = @$_POST["valid_x"];				// bouton de validation
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/resource.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/resource.php");

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
		$query  = "select _IDmod, _IDgrpwr from resource_data ";
		$query .= "where _IDcat = '$IDcat' " ;
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		if ( $auth[0] == 255 OR $auth[2] == $row[0] OR ($row[1] & pow(2, $auth[1] - 1)) ) {
			$query = "update resource_items set _note = '$text' where _IDitem = '$IDitem' limit 1";

			mysql_query($query, $mysql_link);
			}

		// retour à la fénêtre appelante
		print("
			<script type=\"text/javascript\">
			window.opener.location=\"index.php?item=".@$_GET["item"]."&IDitem=$IDitem&IDgroup=$IDgroup&IDres=$IDres&IDmat=$IDmat&IDcat=$IDcat&IDsel=$IDsel&IDroot=$IDroot&sort=$sort\";
			self.close();
			</script>");
		}

	// intialisation
	$query  = "select _title, _note from resource_items ";
	$query .= "where _IDitem = '$IDitem' " ;
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	$text   = $row[1];
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
          <td style="width:30%;" class="align-right valign-top">
		<?php print($msg->read($RESOURCE_NOTE)); ?>
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
           	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($RESOURCE_INPUTOK)."\" />"); ?>
          </td>
          <td class="valign-middle"><?php print($msg->read($RESOURCE_VALIDATE)); ?></td>
        </tr>
	</table>

	</form>

     </td>
  </tr>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($RESOURCE_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>