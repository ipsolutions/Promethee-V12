<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
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
 *		module   : user_waiting.php
 *		projet   : liste des utilisateurs en attente de validation
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 26/03/06
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */

?>


<?php
function userWaiting()
{
/*
 * fonction :	vérifie les utilisateurs en atente
 * out :		nbr d'utilisateurs en attente
 */
	require "globals.php";

	require "msg/user.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/user.php");

	$query  = "select _ID from user_id ";
	$query .= "where _create = '0000-00-00 00:00:00'";

	$result = mysql_query($query, $mysql_link);
	$return = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

	$msg->isPlural = (bool) ( $return > 1 );

	if ( $_SESSION["CnxAdm"] == 255 AND $return ) {
		echo '<div class="popover" style="display: block; position: relative; max-width: 330px; width: 330px; margin-bottom: 15px">
				<ul class="nav nav-list">
					<li class="nav-header" style="padding-top: 0px;">
						<h3 class="popover-title">'. $msg->read($USER_WARNING) .'</h3>
					</li>';


		print("<li>
		      <div style=\"text-align:center; padding:2px; background-color:".$_SESSION["CfgBgcolor"]."\">
				". $msg->read($USER_WAITVALIDATION, Array(strval($return), "index.php?item=1&amp;authuser=1")) ."<br/>
				<img src=\"".$_SESSION["ROOTDIR"]."/images/warning.png\" title=\"\" alt =\"\" />
		      </div>
			</li>");
			
		echo '</ul>
		</div>';
		
		print("<p style=\"margin-top: 0px; margin-bottom: $TBLSPACING px;\"></p>");
		}

	return $return;
}
?>
