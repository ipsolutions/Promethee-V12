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
 *		module   : user_connect.php
 *		projet   : liste des utilisateurs connectés
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 30/10/02
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$sid    = @$_GET["sid"];		// session de l'utilisateur
$IP     = @$_GET["IP"];			// IP à mettre en listre brûlée
$IDsess = @$_GET["IDsess"];		// session à déconnecter
$submit = @$_GET["submit"];		// bouton de validation
?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/user.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_GET["lang"]."/user.php");
?>

<script type="text/javascript" src="script/confirm.js"></script>

<?php
	// qui suis-je ?
	// met à jour les variables de sessions
	whoami($sid);

	// traitement des commandes
	switch ( $submit ) {
		case "denied" :
			if ( $_SESSION["CnxAdm"] == 255 )
				setvisibleIP($IP, "N");
			// et on déconnecte...
		case "del" :
			if ( $_SESSION["CnxAdm"] == 255 )
				eraseSessionID($IDsess);
			break;
		case "close" :
			if ( $_SESSION["CnxAdm"] == 255 )
				eraseSessionID();
			break;
		default :
			break;
		}
?>

<table class="width100" style="border: 1px solid black">
  <tr style="background-color:<?php print($_SESSION["CfgColor"]); ?>">       
     <td class="align-center" style="width:20%;">
		<span style=" color:#FFFFFF;"><?php print($msg->read($USER_GROUP)); ?></span>
     </td>
     <td class="align-center" style="width:80%;">
		<span style=" color:#FFFFFF;"><?php print($msg->read($USER_CONNECTED)); ?></span>
		<?php
			print("<a href=\"user_connect.php?sid=$sid&amp;lang=".$_GET["lang"]."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/ip.gif\" title=\"".$msg->read($USER_REFRESH)."\" alt =\"\" /></a> ");

			if ( $_SESSION["CnxAdm"] == 255 )
				print("<a href=\"user_connect.php?sid=$sid&amp;lang=".$_GET["lang"]."&amp;submit=close\"><img src=\"".$_SESSION["ROOTDIR"]."/images/forbidden.gif\" title=\"". $msg->read($USER_DISCONNECT) ."\" alt =\"\" /></a>");
		?>
     </td>
  </tr>

<?php
	// liste des connectés
	$query  = "select distinctrow _ID, _visible, _IDsess, _IP, _lastaction from user_session ";
	$query .= "where _action = 'C' " ;
	$query .= ( $_SESSION["CnxAdm"] == 255 ) ? "" : "AND _visible = 'O' " ;
	$query .= "order by _lastaction desc";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	while ( $row ) {
		$return  = mysql_query("select _IDgrp, _lastcnx, _IDcentre, _lang from user_id where _ID = '$row[0]' limit 1", $mysql_link);
		$who     = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		// lecture du centre
		$return  = mysql_query("select _ident from config_centre where _IDcentre = '$who[2]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		$centre  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		// lecture du groupe
		$return  = mysql_query("select _ident from user_group where _IDgrp = '$who[0]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		$groupe  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		// lecture de la station émettrice
		$station = " " . _getHostName($row[3]);

		$ghost   = ( $row[1] == "N" ) ? "<img src=\"".$_SESSION["ROOTDIR"]."/images/ghost.gif\" title=\"\" alt =\"\" />" : "" ;

		// basculer en liste brûlée
		$req     = $msg->read($USER_BURNOUT, getIP($row[3]));
		$req     = str_replace("'", "\'", $req);			// le script java n'aime pas les '
		$logout  = ( $_SESSION["CnxAdm"] == 255 AND $_SESSION["CnxID"] != $row[0] )
			? "<a href=\"user_connect.php?sid=$sid&amp;lang=".$_GET["lang"]."&amp;IDsess=$row[2]&amp;IP=".getIP($row[3])."&amp;submit=denied\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/logout.png\" title=\"$req\" alt =\"\" /></a>"
			: "" ;

		// déconnexion des sessions
		$req   = $msg->read($USER_LOGOUT, getUserName($row[0], false));
		$req   = str_replace("'", "\'", $req);			// le script java n'aime pas les '
		$user  = ( $_SESSION["CnxAdm"] == 255 AND $_SESSION["CnxID"] != $row[0] )
			? "<a href=\"user_connect.php?sid=$sid&amp;lang=".$_GET["lang"]."&amp;IDsess=$row[2]&amp;submit=del\" onclick=\"return confirmLink(this, '$req');\">".getUserName($row[0], false)."</a>"
			: getUserName($row[0], "E") ;

		// dernier click
		$delai = time() - strtotime($row[4]);
		$min   = (int) ($delai / 60);

		$last  = $msg->read($USER_LASTCLICK). " ";
		$last .= ( $min > 1 )
			? $msg->read($USER_USRTIME1, Array(strval($min), strval($delai % 60)))
			: $msg->read($USER_USRTIME2, strval($delai)) ;

		$actif = ( $min > 3 )
			? "offline.gif"
			: "online.gif" ;

		print("
	           <tr>
	               <td class=\"align-center valign-top\">
				<img src=\"".$_SESSION["ROOTDIR"]."/images/smiley/$who[0].gif\" title=\"\" alt =\"\" /><br/>
				<span class=\"x-small\"><strong>$groupe[0]</strong></span><br/>
				<a href=\"#\" class=\"overlib\">
				<img src=\"".$_SESSION["ROOTDIR"]."/images/stats/$actif\" title=\"\" alt =\"\" />
				<span>$last</span>
				</a>
		         </td>
		         <td class=\"valign-top align-left\">
				<img src=\"".$_SESSION["ROOTDIR"]."/images/lang/ico-$who[3].png\" title=\"$who[3]\" alt=\"$who[3]\" />
				$user $station $ghost $logout<br/>
				<span class=\"x-small\">". $msg->read($USER_CENTER) ." $centre[0]</span><br/>
				<span class=\"x-small\">". $msg->read($USER_LASTCONNECT) ." $who[1]</span>
		         </td>
		     </tr>
			");
      
		$row  = mysql_fetch_row($result);
		}
?>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($USER_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>