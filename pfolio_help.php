<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006-2008 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : pfolio_help.php
 *		projet   : affichage de la codification de la maîtrise des compétences
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 29/10/06
 *		modif    : 
 */
?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/pfolio.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/pfolio.php");
?>

<p><?php print($msg->read($PFOLIO_CODE)); ?></p>

<?php
	// affichage de la codification
	$query  = "select _ident, _texte from pfolio_level ";
	$query .= "where _IDeval = '". @$_GET["IDeval"] ."' ";
	$query .= "AND _lang = '".$_SESSION["lang"]."' ";
	$query .= "order by _IDlevel";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	print("<table cellpadding=\"4\">");
	while ( $row ) {
		print("
			<tr>
			  <td><strong>$row[0]</strong></td>
			  <td>$row[1]</td>
			</tr>");

		$row = remove_magic_quotes(mysql_fetch_row($result));
		}
	print("</table>");
?>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($PFOLIO_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>