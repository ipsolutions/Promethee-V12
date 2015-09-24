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
 *		module   : forum_list.php
 *		projet   : liste des utilisateurs abonnés à un forum
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/05/07
 *		modif    : 
 */
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/forum.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_GET["lang"]."/forum.php");
?>

<table class="width100">
  <tr>       
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style="color:#FFFFFF;"><?php print($msg->read($FORUM_GROUP)); ?></span>
     </td>
     <td class="align-center" style="width:80%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style="color:#FFFFFF;"><strong><?php print($msg->read($FORUM_REGUSERS)); ?></strong></span>
     </td>
  </tr>

<?php
	// liste des abonnés
	$query  = "select _ID from forum_list ";
	$query .= "where _IDforum = '".@$_GET["IDforum"]."' " ;
	$query .= "AND _visible = 'O' " ;

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	while ( $row ) {
		$return = mysql_query("select _IDgrp, _name, _lastcnx, _IDcentre, _lang, _fname from user_id where _ID = '$row[0]' limit 1", $mysql_link);
		$who    = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		// lecture du centre
		$return = mysql_query("select _ident from config_centre where _IDcentre = '$who[3]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		$centre = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		// lecture du groupe
		$return = mysql_query("select _ident from user_group where _IDgrp = '$who[0]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		$groupe = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		if ( $who )
			print("
		           <tr>
		               <td style=\"width:20%\" class=\"valign-top align-center\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/smiley/$who[0].gif\" title=\"\" alt =\"\" /><br/>
					<span class=\"x-small\"><strong>$groupe[0]</strong></span>
			         </td>
			         <td style=\"width:80%\" class=\"valign-top align-left\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/lang/ico-$who[4].png\" title=\"$who[4]\" alt=\"\" /> $who[1] $who[5]<br/>
					<span class=\"x-small\">". $msg->read($FORUM_CENTER) ." $centre[0]</span>
			         </td>
			     </tr>
				");
		else
			mysql_query("delete from forum_list where _ID = '$row[0]' limit 1", $mysql_link);
      
		$row  = mysql_fetch_row($result);
		}
?>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($FORUM_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>