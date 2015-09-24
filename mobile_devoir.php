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
 *		module   : mobile_devoir.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

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
?>
<?php

$IDcentre = ( @$_POST["IDcentre"] )				// Identifiant du centre
	? (int) $_POST["IDcentre"]
	: (int) (@$_GET["IDcentre"] ? $_GET["IDcentre"] : $_SESSION["CnxCentre"]) ;
$IDclass  = ( strlen(@$_POST["IDclass"]) )		// sélection de la classe
	? (int) $_POST["IDclass"]
	: (int) (@$_GET["IDclass"] ? $_GET["IDclass"] : $_SESSION["CnxClass"]) ;
$IDgroup  = ( @$_POST["IDgroup"] )				// sélection du e-groupe
	? (int) $_POST["IDgroup"]
	: (int) @$_GET["IDgroup"] ;
$IDmat    = ( @$_POST["IDmat"] )				// ID de la matière
	? (int) $_POST["IDmat"]
	: (int) @$_GET["IDmat"] ;
$IDitem   = (int) @$_GET["IDitem"];				// ID de l'item du CTN
$year     = (int) @$_POST["year"];
$skpage   = ( @$_GET["skpage"] )				// n° de la page affichée
	? (int) $_GET["skpage"]
	: 1 ;
$skshow   = ( @$_GET["skshow"] )				// n° du flash info
	? (int) $_GET["skshow"]
	: 1 ;

$submit    = ( @$_POST["submit"] )				// bouton de validation
	? $_POST["submit"]
	: @$_GET["submit"] ;

// réinitialisation
if ( @$_GET["salon"] == "" )
	$_SESSION["CampusName"] = "";
	
require "msg/ctn.php";
require_once "include/TMessage.php";
require_once "include/calendar_tools.php";

$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/ctn.php");
$msg->msg_search  = $keywords_search;
$msg->msg_replace = $keywords_replace;

if(!isset($_GET["year"]))
{
	$year = date("Y", time());
}
else
{
	$year = $_GET["year"];
}

if(!isset($_GET["month"]))
{
	$month = date("m", time());
}
else
{
	$month = $_GET["month"];
}

if(!isset($_GET["day"]))
{
	$day = date("d", time());
}
else
{
	$day = $_GET["day"];
}

if(isset($_GET["change"]))
{
	if($_GET["change"] == "next")
	{
		$datetmp = mktime(0, 0, 0, $month, $day, $year) + 24*3600;
		$day = date("d", $datetmp);
		$month = date("m", $datetmp);
		$year = date("Y", $datetmp);
	}
	else if($_GET["change"] == "prev")
	{
		$datetmp = mktime(0, 0, 0, $month, $day, $year) - 24*3600;
		$day = date("d", $datetmp);
		$month = date("m", $datetmp);
		$year = date("Y", $datetmp);
	}
}
?>


<?php
	require_once $_SESSION["ROOTDIR"]."/include/ctn.php";

	// vérification des droits
	$query  = "select _IDmod, _IDgrpwr, _IDgrprd, _month, _limited, _IDctn, _common, _rss, _sndmail from ctn ";
	$query .= "where _IDclass = '$IDclass' AND _IDgroup = '$IDgroup' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// vérification des autorisations
	if ( $IDclass )
		verifySessionAccess($auth[0], $auth[2]);

	// l'utilisateur a cliqué sur un lien
	switch ( $submit ) {
		case "del" :
			$Query  = "DELETE from ctn_items ";
			$Query .= "where _IDitem = '$IDitem' ";
			$Query .= ( $_SESSION["CnxAdm"] == 255 OR ($auth[6] == "O" AND ($auth[1] AND pow(2, $_SESSION["CnxGrp"] - 1))) )
				? ""
				: "AND _ID = '".$_SESSION["CnxID"]."' " ;
			$Query .= "limit 1";

			if ( !mysql_query($Query, $mysql_link) )
				sql_error($mysql_link);
			else {
				$Query  = "DELETE from ctn_data ";
				$Query .= "where _IDitem = '$IDitem' ";

				mysql_query($Query, $mysql_link);

				$Query  = "SELECT _IDpj, _ext from ctn_pj ";
				$Query .= "where _IDitem = '$IDitem' ";

				$result = mysql_query($Query, $mysql_link);
				$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

				while ( $row ) {
					$Query  = "DELETE from ctn_pj ";
					$Query .= "where _IDpj = '$row[0]' ";
					$Query .= "limit 1";

					if ( mysql_query($Query, $mysql_link) )
						@unlink("$DOWNLOAD/ctn/$row[0].$row[1]");

					$row = mysql_fetch_row($result);
					}
				}
			break;

		case "visible" :
		case "invisible" :
			$Query  = "update ctn_items ";
			$Query .= ( $submit == "visible" ) ? "set _visible = 'O' " : "set _visible = 'N' " ;
			$Query .= "where _IDitem = '$IDitem' ";
			$Query .= ( $_SESSION["CnxAdm"] == 255 OR ($auth[6] == "O" AND ($auth[1] AND pow(2, $_SESSION["CnxGrp"] - 1))) )
				? ""
				: "AND _ID = '".$_SESSION["CnxID"]."' " ;

			if ( !mysql_query($Query, $mysql_link) )
				sql_error($mysql_link);
			break;

		default :
			if ( @$_POST["import"] == $msg->read($CTN_IMPORT) )
				import_ctn($IDcentre, @$_FILES["UploadFile"]);

			// affichage automatique
			$Query  = "update ctn_items ";
			$Query .= "set _visible = 'O' ";
			$Query .= "where _date <= '".date("Y-m-d H:i:s")."' ";

			@mysql_query($Query, $mysql_link);

			// lecture des droits
			$Query  = "select _IDmod, _IDgrpwr from campus_data ";
			$Query .= "where _titre = '".$_SESSION["CampusName"]."' ";

			$result = mysql_query($Query, $mysql_link);
			$who    = ( $result ) ? mysql_fetch_row($result) : 0 ;
			break;
		}
?>

<div class="maincontent">

	<form id="formulairenote" action="mobile_devoir.php" method="get" enctype="multipart/form-data">
		<input type="hidden" name="year" value="<?php echo $year; ?>" />
		<input type="hidden" name="month" value="<?php echo $month; ?>" />
		<input type="hidden" name="day" value="<?php echo $day; ?>" />
		<input type="hidden" name="change" id="change" value="" />

	<label for="IDcentre" style="display: none">
	<select id="IDcentre" name="IDcentre" onchange="document.forms.formulairenote.submit()">
	<?php
		// lecture des centres constitutifs
		$query  = "select _IDcentre, _ident from config_centre ";
		$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
		$query .= "order by _IDcentre";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		while ( $row ) {
			printf("<option value=\"$row[0]\" %s>$row[1]</option>", $IDcentre == $row[0] ? "selected=\"selected\"" : "");

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}
	?>
	</select>
	</label>

	<input type="hidden" id="IDclass" name="IDclass" value="<?php echo $_SESSION["CnxClass"]; ?>">


		<?php
			// affichage bouton "ajouter"
			$add_button = ( $IDclass AND ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $auth[0] OR $auth[1] & pow(2, $_SESSION["CnxGrp"] - 1)) )
				? "<a href=\"".myurlencode("index.php?item=$item&IDcentre=$IDcentre&IDmat=$IDmat&IDgroup=$IDgroup&IDclass=$IDclass&cmde=post")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/post.gif\" title=\"\" alt=\"\" /></a>"
				: "" ;
			$add_text   = ( $IDclass AND ($_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $auth[0] OR $auth[1] & pow(2, $_SESSION["CnxGrp"] - 1)) )
				? $msg->read($CTN_VALIDATE)
				: "" ;

			// les années scolaires
			$query  = "select min(_date), max(_date) from ctn_items ";
			$query .= "where _IDctn = '$auth[5]' ";
			$query .= ( $IDmat ) ? "AND _IDmat = '$IDmat' " : "" ;

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? mysql_fetch_row($return ) : 0 ;

			if ( $myrow ) {
				$min     = strval(substr($myrow[0], 0, 4));
				$max     = strval(substr($myrow[1], 0, 4));

				// initialisation
				if ( !$year )
					$year = $max;

				$select  = "<label for=\"year\">";
				$select .= "<select id=\"year\" name=\"year\" onchange=\"document.forms.formulairenote.submit()\" style=\"font-size:9px;\">";

				for ($k = $max; $k >= $min; $k--)
					if ( $year == $k )
						$select .= "<option value=\"$k\" selected=\"selected\">$k</option>";
					else
						$select .= "<option value=\"$k\">$k</option>";

				$select .= "</select>";
				$select .= "</label>";
				}
			else
				$select  = "&nbsp;";
		?>
		
		<table width="95%" border="0" class="align-center">
			<tr>
				<td class="align-left" width="50%">
					<a href="#" data-role="button" data-icon="arrow-l" data-iconpos="left" data-theme="c" data-inline="true" onclick="document.getElementById('change').value='prev';document.forms.formulairenote.submit()" style="width: 95%">Avant</a>
				</td>
				<td class="align-right" width="right">
					<a href="#" data-role="button" data-icon="arrow-r" data-iconpos="right" data-theme="c" data-inline="true" onclick="document.getElementById('change').value='next';document.forms.formulairenote.submit()" style="width: 95%">Après</a>
				</td>
			</tr>
		</table>
	</form>
	
	<ul data-role="listview">
		<li data-theme="a">
			<center><?php echo "$day/$month/$year"; ?></center>
		</li>
	</ul>
	
	<ul data-role="listview" data-inset="false">
		<?php
		require_once("php/datafeed.db.mobile.devoir.php");
		$tab_cours = listCalendar($month."/".$day."/".$year, "day");

		foreach($tab_cours["events"] as $val)
		{
			$ligne_cours = "<li data-theme=\"b\">$val[1] : De ".substr($val[2], strpos($val[2], " "))." à ".substr($val[3], strpos($val[3], " "))."</li>";
			
			$query  = "select distinctrow ctn_items._texte ";
			$query .= "from ctn_items ctn_items, edt_data edt_data ";
			$query .= "where ctn_items._IDcours = '$val[0]' ";
			$query .= "and edt_data._nosemaine = ctn_items._nosemaine ";
			$query .= "and edt_data._annee = $year ";

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;
			
			while ( $myrow )
			{
				echo $ligne_cours;
				echo "<li><div>".$myrow[0]."</div></li>";
				$myrow = remove_magic_quotes(mysql_fetch_row($return));
			}
		}	
		?>
	</ul>
	
</div>

<?php include("mobile_menu.php"); ?>
<?php include("mobile_footer.php"); ?>