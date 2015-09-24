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
 *		module   : cours_list.php
 *		projet   : liste des documents qui ont été accédés par un utilisateur
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 17/11/07
 */
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/user.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/user.php");
?>

<script type="text/javascript" src="script/confirm.js"></script>


<table class="width100" style="border: 1px solid black">
  <tr class="align-center" style="background-color:<?php print($_SESSION["CfgColor"]); ?>">
     <td>
	<?php
		print("<span style=\"color:#FFFFFF;\"><strong>". getUserName($_GET["ID"], false) ."</strong></span>");
	?>
     </td>
  </tr>

<?php
	// lecture des documents du cours
	$Query  = "select _file, _size, _IDdata from cours_items ";
	$Query .= "where _IDcours = '".$_GET["IDcours"]."' AND _IDdata = '".$_GET["IDdata"]."' ";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	$files  = Array();

	while ( $row ) {
		$myfile = ( $row[1] )
			? "$DOWNLOAD/e-campus/".stripaccent($_GET["campus"])."/".$_GET["IDcours"]."/$row[2]-".stripaccent($row[0])
			: stripaccent($row[0]) ;

		$files  = array_merge($files, Array($myfile));

		$row    = remove_magic_quotes(mysql_fetch_row($result));
		}

	// recherche des fichiers téléchargés
	$query  = "select distinctrow download._IP, download._date, download_data._file ";
	$query .= "from download, download_data ";
	$query .= "where download._ID = '".$_GET["ID"]."' ";
	$query .= "AND download._IDdown = download_data._IDdown";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	while ( $row ) {
		if ( in_array($row[2], $files) ) {
			$doc = strstr($row[2], "http") ? $row[2] : strrchr($row[2], "/") ;

			print("
		           <tr class=\"menu\">
			         <td class=\"valign-top align-left\">
					<a href=\"$row[2]\" onclick=\"window.open(this.href, '_blank'); return false;\">$doc</a><br/>
					<span class=\"x-small\">".$msg->read($USER_LASTACCESS)." $row[1] "._getHostName($row[0])."</span>
			         </td>
			     </tr>
				");
			}
      
		$row  = remove_magic_quotes(mysql_fetch_row($result));
		}
?>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($USER_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>