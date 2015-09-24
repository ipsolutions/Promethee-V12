<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
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
 *		module   : user_list.php
 *		projet   : liste des utilisateurs qui ont accédé à une ressource
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 30/10/02
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require_once "include/calendar_tools.php";

	require "msg/user.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/user.php");
?>

<script type="text/javascript" src="script/confirm.js"></script>


<table class="width100" style="border: 1px solid black">
  <tr>       
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
	<span style=" color:#FFFFFF;"><?php print($msg->read($USER_GROUP)); ?></span>
     </td>
     <td class="align-center" style="width:80%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
	<?php
		switch ( @$_GET["cmde"] ) {
			case "vote" :
				// recherche du sondage
				$result = mysql_query("select _title from sondage_data where _IDpoll = '".$_GET["IDpoll"]."' limit 1", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				print("<span style=\"color:#FFFFFF;\"><strong>$row[0]</strong></span>");
				break;
			case "forum" :
				// recherche du sujet de message
				$result = mysql_query("select _title from forum_items where _IDmsg = '".$_GET["IDmsg"]."' limit 1", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				print("<span style=\"color:#FFFFFF;\">".$msg->read($USER_SUBJECT, $row[0])."</span>");
				break;
			case "agenda" :
				// recherche du sujet de l'annonce
				$result = mysql_query("select _titre from agenda_items where _IDitem = '".$_GET["IDitem"]."' limit 1", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				print("<span style=\"color:#FFFFFF;\">".$msg->read($USER_SUBJECT, $row[0])."</span>");
				break;
			case "dwload" :
				// recherche du fichier téléchargé
				$result = mysql_query("select _file from download_data where _IDdown = '".$_GET["IDdown"]."' limit 1", $mysql_link);
				$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

				print("<span style=\"color:#FFFFFF;\"><strong>$row[0]</strong></span>");
				break;
			case "blog" :
				// recherche du weblog visualisé
				$result = mysql_query("select _title from weblog_items where _IDitem = '".$_GET["IDitem"]."' limit 1", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				print("<span style=\"color:#FFFFFF;\"><strong>$row[0]</strong></span>");
				break;
			case "ctn" :
				// recherche du cahier de texte numérique
				print("<span style=\"color:#FFFFFF;\">".$msg->read($USER_TEXTBOOK)."</span>");
				break;
			case "motd" :
				// recherche du message du jour
				$result = mysql_query("select _title from motd_items where _IDitem = '".$_GET["IDitem"]."' limit 1", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				print("<span style=\"color:#FFFFFF;\"><strong>$row[0]</strong></span>");
				break;
			case "fil" :
				// recherche de l'article
				$result = mysql_query("select _title from flash_fil where _IDfil = '".$_GET["IDfil"]."' limit 1", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				print("<span style=\"color:#FFFFFF;\"><strong>$row[0]</strong></span>");
				break;
			case "cv" :
				// recherche CV ou offre
				$IDitem = (int) $_GET["IDitem"];
				$title  = ( $IDitem > 0 )
					? $msg->read($USER_CV, strval($IDitem))
					: $msg->read($USER_OFFER, strval(abs($IDitem))) ;

				print("<span style=\"color:#FFFFFF;\">$title</span>");
				break;
			case "etp" :
				// recherche de l'ETP
				print("<span style=\"color:#FFFFFF;\"><strong>". getUserName($_GET["IDetp"], false) ."</strong></span>");
				break;
			default :
				break;
			}
	?>
     </td>
  </tr>
              
<?php
	// qui suis-je ?
	// met à jour les variables de sessions
	whoami(@$_GET["sid"]);

	$query = "select distinctrow _ID, _IP, _date ";

	switch ( @$_GET["cmde"] ) {
		case "vote" :
			$query .= "from sondage_vote where _IDpoll = '".$_GET["IDpoll"]."'";
			break;
		case "forum" :
			$query .= "from forum_vu where _IDmsg = '".$_GET["IDmsg"]."'";
			break;
		case "agenda" :
			$query .= "from agenda_vu where _IDitem = '".$_GET["IDitem"]."'";
			break;
		case "blog" :
			$query .= "from weblog_vu where _IDitem = '".$_GET["IDitem"]."'";
			break;
		case "dwload" :
			$query .= "from download where _IDdown = '".$_GET["IDdown"]."'";
			break;
		case "ctn" :
			$query .= "from ctn_vu where _IDitem = '".$_GET["IDitem"]."'";
			break;
		case "motd" :
			$query .= "from motd_vu where _IDitem = '".$_GET["IDitem"]."'";
			break;
		case "fil" :
			$query .= "from flash_filvu where _IDfil = '".$_GET["IDfil"]."'";
			break;
		case "cv" :
			$query .= "from cv_vu where _IDitem = '".$_GET["IDitem"]."'";
			break;
		case "etp" :
			$query .= "from etp_vu where _IDetp = '".$_GET["IDetp"]."'";
			break;
		default :
			break;
		}

	$query .= " order by _date desc";

	// recherche des utilisateurs
	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;
				
	while ( $row ) {
		$return = mysql_query("select _IDgrp, _IDcentre from user_id where _ID = '$row[0]' limit 1", $mysql_link);
		$who    = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		if ( $who ) {
			// lecture du centre
			$return = mysql_query("select _ident from config_centre where _IDcentre = '$who[1]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
			$centre = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			// lecture du groupe
			$return = mysql_query("select _ident from user_group where _IDgrp = '$who[0]' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
			$groupe = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			print("
		           <tr>
		               <td style=\"width:20%\" class=\"valign-top align-center\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/smiley/$who[0].gif\" title=\"\" alt =\"\" /><br/>
					<span class=\"x-small\"><strong>$groupe[0]</strong></span>
			         </td>
			         <td style=\"width:80%\" class=\"valign-top align-left\">
					".getUserName($row[0], "E")." "._getHostName($row[1])."<br/>
					<span class=\"x-small\">".$msg->read($USER_CENTER)." $centre[0]</span><br/>
					<span class=\"x-small\">".$msg->read($USER_LASTACCESS)." ".date2longfmt($row[2])."</span>
			         </td>
			     </tr>
				");
			}
      
		$row  = mysql_fetch_row($result);
		}
?>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($USER_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>