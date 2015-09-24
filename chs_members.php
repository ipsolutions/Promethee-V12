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
 *		module   : chs_members.php
 *		projet   : liste des membres du CHS
 *
 *		version  : 1.1
 *		auteur   : laporte
 *		creation : 1/04/06
 *		modif    : 17/07/06 - par CNERTA - Nordine Zetoutou (nordine.zetoutou@educagri.fr)
 * 		         migration des balises HTML en XHTML 1.0 strict
 */
?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/chs.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/chs.php");
?>

<table class="width100" style="border-color:<?php print($_SESSION["CfgColor"]); ?>; border: 1px solid black">
  <tr>
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style=" color:#FFFFFF;"><?php print($msg->read($CHS_GROUP)); ?></span>
     </td>
     <td class="align-center" style="width:80%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style=" color:#FFFFFF;"><?php print($msg->read($CHS_MEMBERS)); ?></span>
     </td>
  </tr>

<?php
	// liste des membres
	$query  = "select _ID, _IDcentre, _IDgrp, _name, _fname from user_id ";
	$query .= "where _chs = 'O' " ;
	$query .= "order by _name";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	while ( $row ) {
		// lecture du centre
		$return = mysql_query("select _ident from config_centre where _IDcentre = '$row[1]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		$centre = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		// lecture du groupe
		$return = mysql_query("select _ident from user_group where _IDgrp = '$row[2]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		$groupe = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		print("
	           <tr>
	               <td class=\"align-center valign-top\">
				<img src=\"".$_SESSION["ROOTDIR"]."/images/smiley/$row[2].gif\" title=\"\" alt=\"\" /><br/>
				<span class=\"x-small\"><strong>$groupe[0]</strong></span>
		         </td>
		         <td class=\"valign-top align-left\">
				$row[3] $row[4]<br/>
				".$msg->read($CHS_CENTER)." $centre[0]
		         </td>
		     </tr>
			");
      
		$row  = remove_magic_quotes(mysql_fetch_row($result));
		}
?>

</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($CHS_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>