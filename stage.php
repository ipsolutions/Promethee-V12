<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by FG (persofg@gmail.com)
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
 *		module   : stage.php
 *		projet   : liste des période de stages dans une entreprise
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 18/02/03
 *		modif    : 20/06/05 par FG
 *                     migration -> PHP5
 * 		           17/07/06 par Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDlieu= ( @$_POST["IDlieu"] )
	? (int) $_POST["IDlieu"]
	: (int) @$_GET["IDlieu"];
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/stage.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/stage.php");
?>

<table class="width100" style="border: 1px solid <?php echo @$_SESSION["CfgColor"]; ?>">
  <tr>       
     <td class="align-center" style="width:100%; color:#ffffff; background-color:<?php echo @$_SESSION["CfgColor"]; ?>">
	<?php
		// recherche de l'entreprise
		$result = mysql_query("select _societe from stage_lieu where _IDlieu = '$IDlieu'", $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		print("<strong>$row[0]</strong>");
	?>
     </td>
  </tr>
              
  <tr>       
     <td>
<?php
	// recherche des stages dans l'entreprise
	$Query  = "select _IDstage, _IDeleve, _IDclasse from stage ";
	$Query .= "where _IDlieu = '$IDlieu' ";
	$Query .= "order by _IDstage desc ";
	$Query .= "limit 10";

	$result = mysql_query($Query, $mysql_link);
	$stage  = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $stage) {
		print("<ul>");

		while ( $stage ) {
			// recherche des élèves en stage dans l'entreprise
			$Query  = "select _name, _fname from user_id ";
			$Query .= "where _ID = '$stage[1]'";

			$res    = mysql_query($Query, $mysql_link);
			$who    = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

			$res    = mysql_query("select _ident from campus_classe where _IDclass = '$stage[2]'", $mysql_link);
			$classe = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

			// recherche des stages dans l'entreprise
			$Query  = "select _debut, _fin from stage_periode ";
			$Query .= "where _IDstage = '$stage[0]' ";
			$Query .= "order by _IDperiode desc";

			$res    = mysql_query($Query, $mysql_link);
			$row    = ( $res ) ? mysql_fetch_row($res) : 0 ;

			print("<li>". $msg->read($STAGE_FROMTO, Array($row[0], $row[1])) ."<br/>$who[0] $who[1] ($classe[0])</li>");

			$stage  = mysql_fetch_row($result);
			}

		print("</ul>");
		}
?>
     </td>
  </tr>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($STAGE_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>
