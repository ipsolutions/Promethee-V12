<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2013 by IP-Solutions(contact@ip-solutions.fr)

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
 *		module   : mobile.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php $current_page = "mobile"; ?>
<?php include("mobile_banner.php"); ?>
<?php
if ( @$_SESSION["sessID"] AND !empty($_SESSION["CnxAdm"]) )
{
	// Rien ok
}
else
{
	header("Location: index_mobile.php");
}

require_once "include/calendar_tools.php";
require_once "include/flash.php";
// chargement de la langue
require "msg/absent.php";
require_once "include/TMessage.php";

$msg   = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/absent.php");

// lecture du flash par défaut
$flash = Array();
$IDflash = 0;
$skpage = 1;
$mobile = 1;

if ( !$IDflash ) {
	// on sélectionne les flash info en page d'accueil
	$query  = "select distinctrow flash_default._IDflash ";
	$query .= "from flash_default, flash ";
	$query .= "where flash_default._IDcentre = '".$_SESSION["CnxCentre"]."' ";
	$query .= "AND (flash_default._IDgrp & ".pow(2, $_SESSION["CnxGrp"] - 1).") ";
	$query .= "AND flash_default._lang = '".$_SESSION["lang"]."' ";
	$query .= "AND flash._visible = 'O' ";
	$query .= "AND (flash._IDgrprd & pow(2, ".$_SESSION["CnxGrp"]." - 1)) ";
	$query .= "AND flash._IDflash = flash_default._IDflash ";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$i = 0;
	while ( $row ) {
		$flash[$i++] = $row[0];
		$row         = mysql_fetch_row($result);
		}

	// si aucun flash info, on sélectionne le flash par défaut
	if ( count($flash) == 0 ) {
		$result = mysql_query("select _IDflash from flash where _title = '$FLASH' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
		$flash  = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// si le flash info par défaut n'est pas définit, on affiche la page d'accueil Prométhée
		if ( !$flash ) {
			$result = mysql_query("select _IDflash from flash where _template = 'promethee.htm' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link);
			$flash  = ( $result ) ? mysql_fetch_row($result) : 0 ;
			}
		}
	}
else
	$flash[0] = $IDflash;

// affichage des flash info
@sort($flash);

for ($i = 0; $i < count($flash); $i++) {
	$IDflash = $flash[$i];

	$query   = "select _title, _IDmod, _IDgrprd, _create, _template, _IDgrpwr from flash ";
	$query  .= "where _IDflash = '$IDflash' ";
	$query  .= "AND _lang = '".$_SESSION["lang"]."' ";
	$query  .= "AND _visible = 'O' ";
	$query  .= "limit 1";

	$res     = mysql_query($query, $mysql_link);
	$sql     = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

	switch ( $sql[4] ) {
		case "promethee.htm" :
			require "flash_promethee.htm";
			break;

		default :
			// initialisation
			$IDinfos = 0;

			// si pas d'autorisation => affichage de la page d'accueil Prométhée 
			if ( $_SESSION["CnxAdm"] != 255 AND $_SESSION["CnxID"] != $sql[1] AND ($sql[2] & pow(2, $_SESSION["CnxGrp"] - 1)) == 0 )
				require "flash_promethee.htm";
			else {
				// lecture de la base de données
				$Query  = "select _IDinfos, _date, _modif, _ID from flash_data ";
				$Query .= "where _IDflash = '$IDflash' ";
				$Query .= ( $_SESSION["CnxAdm"] != 255 AND $_SESSION["CnxID"] != $sql[1] )
					? "AND _visible = 'O' "
					: "" ;
				$Query .= ( $sql[3] == "O" )
					? "order by _IDinfos desc"
					: "order by _modif desc" ;

				// détermination du nombre de pages
				$result = mysql_query($Query, $mysql_link);
				$page   = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

				if ( $page ) {
					// initialisation
					$first = $skpage;

					// se positionne sur la page ad hoc
					mysql_data_seek($result, $first - 1);
					$data  = remove_magic_quotes(mysql_fetch_row($result));

					// ID de la 1ère annonce
					$IDinfos = $data[0];

					$modif = ( $data[1] == $data[2] ) ? "" : $msg->read($FLASH_MODIFIED, $data[2]) ;

					// lecture du propriétaire
					$owner = $msg->read($FLASH_CREATED, Array(getUserName($data[3]), $data[1], $modif));

					$show  = ( $page % $MAXSHOW )
						? (int) ($page / $MAXSHOW) + 1
						: (int) ($page / $MAXSHOW) ;

					$lien  = "<a href=\"".myurlencode("index.php?item=20&IDflash=$IDflash&cmde=post&submit=Modifier&IDinfos=$IDinfos")."\" title=\"$sql[0]\" >";
					$lien .= $msg->read($FLASH_MODIF);
					$lien .= "</a>";
					}
				else {
					$owner = "&nbsp;";

					// initialisation
					$show  = $skshow;

					$lien  = "<a href=\"".myurlencode("index.php?item=20&IDflash=$IDflash&cmde=post")."\" title=\"$sql[0]\" >";
					$lien .= $msg->read($FLASH_FLASHCREATE);
					$lien .= "</a>";
					}

				// nouveau flash autorisé pour :
				// le grand chef
				// le propriétaire du flash
				// les modérateurs associés au groupe des rédacteurs
				$link   = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $sql[1] OR ($sql[1] == -1 AND ($sql[5] & pow(2, $_SESSION["CnxGrp"] - 1))) )
					? "[<em>$lien</em>]"
					: "&nbsp;" ;

				print("<div>
					");

				$next = $prev = "";

				if ( $IDinfos ) {
					// visualisation du flash
					require "flash_visu.php";
				}
				print("</div>");
				}	// endif autorisation ok
			break;
		}	// end switch
	}	// end for
?>


<?php include("mobile_menu.php"); ?>


<?php include("mobile_footer.php"); ?>