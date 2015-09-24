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
 *		module   : mobile_note.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */

 include("mobile_banner.php"); ?>
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

$IDcentre = ( @$_POST["IDcentre"] )			// Identifiant du centre
	? (int) $_POST["IDcentre"]
	: (int) (@$_GET["IDcentre"] ? $_GET["IDcentre"] : $_SESSION["CnxCentre"]) ;

$IDclass  = ( @$_POST["IDclass"] )			// Identifiant de la classe
	? (int) $_POST["IDclass"]
	: (int) @$_GET["IDclass"] ;
$IDmat    = ( @$_POST["IDmat"] )			// Identifiant de la matière
	? (int) $_POST["IDmat"]
	: (int) @$_GET["IDmat"] ;
$year     = ( @$_POST["year"] )			// année
	? (int) $_POST["year"]
	: (int) (@$_GET["year"] ? $_GET["year"] : date("Y")) ;
$period   = ( @$_POST["period"] )			// trimestre
	? (int) $_POST["period"]
	: (int) (@$_GET["period"] ? $_GET["period"] : 1) ;

$setlock  = @$_POST["unlocked_x"];			// verrouillage du trimestre
$unlock   = @$_POST["locked_x"];			// déverrouillage du trimestre
$submit   = @$_POST["valid_x"];				// bouton validation

require "msg/notes.php";
require_once "include/TMessage.php";

$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/notes.php");
$msg->msg_search  = $keywords_search;
$msg->msg_replace = $keywords_replace;
?>


<div class="maincontent">

	<?php
		require_once $_SESSION["ROOTDIR"]."/include/notes.php";
		require_once $_SESSION["ROOTDIR"]."/include/postit.php";

		// lecture des droits
		$Query  = "select _IDgrpwr, _IDgrprd, _period, _IDmod, _decimal, _separator, _email, _max, _text from notes ";
		$Query .= "where _IDcentre = '".$_SESSION["CnxCentre"]."' ";
		$Query .= "limit 1";

		$result = mysql_query($Query, $mysql_link);
		$auth   = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// vérification des autorisations
		verifySessionAccess(0, $auth[1]);

		// initialisation
		$status  = "-";
		$nbcols  = (int) $auth[7];

		// l'utilisateur a validé la saisie
		if ( $submit AND $IDclass AND ($auth[0] & pow(2, $_SESSION["CnxGrp"] - 1)) ) {
			$status = $msg->read($NOTES_MODIFICATION) ." ";
			
			$_type = $_total = $_coef = $_visible = "";
			for ($i = 0; $i < $nbcols; $i++) {
				$_type    .= @$_POST["type_$i"].";";
				$_total   .= trim(@$_POST["total_$i"]).";";
				$_coef    .= str_replace(",", ".", trim(@$_POST["coef_$i"])).";";
				$_visible .= ( @$_POST["visible_$i"] ) ? $_POST["visible_$i"].";" : "O;" ;
				}

			//---- nouveau bulletin élèves
			$Query  = "insert into notes_data ";
			$Query .= "values('', '$year', '$IDclass', '$IDmat', '$period', '$_type', '$_total', '$_coef', '$_visible', 'N', '0', '0', '')";

			if ( !mysql_query($Query, $mysql_link) ) {
				// modification du bulletin
				$Query  = "UPDATE notes_data ";
				$Query .= "SET _type = '$_type', _total = '$_total', _coef = '$_coef', _visible = '$_visible' ";
				$Query .= "where _year = '$year' AND _IDclass = '$IDclass' AND _IDmat = '$IDmat' AND _period = '$period' ";
				$Query .= "limit 1";

				if ( !mysql_query($Query, $mysql_link) ) {
					$status .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/bad.gif\" title=\"\" alt=\"\" />";
					sql_error($mysql_link);
					}
				else
					$status .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/ok.gif\" title=\"\" alt=\"\" />";
				}
			else
				$status .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/ok.gif\" title=\"\" alt=\"\" />";
			}

		// l'utilisateur a supprimé une note
		if ( @$_GET["del"] AND ($auth[0] & pow(2, $_SESSION["CnxGrp"] - 1)) ) {
			$IDeleve = (int) @$_GET["IDeleve"];
				
			$Query   = "delete from notes_items ";
			$Query  .= "where _IDdata = '".$_GET["del"]."' AND _IDeleve = '$IDeleve' ";

			mysql_query($Query, $mysql_link);
			}
					
		// l'utilisateur a verrouillé la saisie
		if ( ($setlock OR $unlock) AND ($auth[0] & pow(2, $_SESSION["CnxGrp"] - 1)) ) {
			$value  = ( $setlock ) ? "O" : "N" ;

			$Query  = "UPDATE notes_data ";
			$Query .= "SET _lock = '$value', _ID = '".$_SESSION["CnxID"]."', _IP = '".$_SESSION["CnxIP"]."', _date = '".date("Y-m-d H:i:s")."' ";
			$Query .= "where _year = '$year' AND _IDclass = '$IDclass' AND _IDmat = '$IDmat' AND _period = '$period' ";
			$Query .= "limit 1";

			mysql_query($Query, $mysql_link);
			}
					
		// l'utilisateur a importé des notes
		if ( @$_POST["import"] == $msg->read($NOTES_IMPORT) )
			import_notes($IDcentre, $IDclass, $IDmat, $year, @$_FILES["UploadFile"]);
	?>

	<form id="formulaire" action="" method="post" enctype="multipart/form-data">
	<?php
		print("
			<input type=\"hidden\" name=\"item\"   value=\"$item\" />
			<input type=\"hidden\" name=\"cmde\"   value=\"$cmde\" />
			");
	?>

	<label for="IDcentre" style="display: none">
	<select id="IDcentre" name="IDcentre" onchange="document.forms.formulaire.submit()">
	<?php
		// lecture des centres constitutifs
		$query  = "select _IDcentre, _ident from config_centre ";
		$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
		$query .= "order by _IDcentre";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		while ( $row ) {			
			printf("<option value=\"$row[0]\" %s>$row[1]</option>", ($IDcentre == $row[0]) ? "selected=\"selected\"" : "");

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}
	?>
	</select>
	</label>

	<label for="IDmat">
	<select id="IDmat" name="IDmat" onchange="document.forms.formulaire.submit()">
	<?php
		// affichage des matières
		$query  = "select _IDmat, _titre from campus_data ";
		$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
		$query .= "order by _titre asc";

		$result = mysql_query($query, $mysql_link);
		$mat    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		if ( !$IDmat )
			$IDmat = $mat[0];

		while ( $mat ) {			
			$select = ( $IDmat == $mat[0] ) ? "selected=\"selected\"" : "" ;

			print("<option value=\"$mat[0]\" $select>$mat[1]</option>");

			$mat = remove_magic_quotes(mysql_fetch_row($result));
			}	// endwhile matières
	?>
	</select>
	</label>


	<?php
		// recherche de l'élève
		$Query  = "select _IDclass from user_id ";
		$Query .= "where _ID = '".$_SESSION["CnxID"]."' ";
		$Query .= "limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		if ( $row[0] ) {
			$IDeleve = $_SESSION["CnxID"];
			$IDclass = $row[0];
			}
		else
			$IDeleve = 0;

			// lecture du bulletin élèves
		$Query  = "select _IDdata, _lock from notes_data ";
		$Query .= "where _year = '$year' AND _IDclass = '$IDclass' AND _IDmat = '$IDmat' AND _period = '$period' ";
		$Query .= "limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		$IDdata = $row[0];
		$lock   = ( $row[1] == "O" ) ? "readonly=\"readonly\"" : "" ;

		$width  = 100 - ($nbcols * 5) - 10;


				// recherche de l'entête du tableau
				$Query  = "select _type, _total, _coef, _visible from notes_data ";
				$Query .= "where _year = '$year' AND _IDclass = '$IDclass' AND _IDmat = '$IDmat' AND _period = '$period' ";
				$Query .= "order by _IDdata";

				$result = mysql_query($Query, $mysql_link);
				$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

				if ( mysql_numrows($result) ) {
					$_type    = explode(";", $row[0]);
					$_total   = explode(";", $row[1]);
					$_coef    = explode(";", $row[2]);
					$_visible = explode(";", $row[3]);
					}
				else {
					$_type    = array_fill(0, $nbcols, "0");
					$_total   = array_fill(0, $nbcols, "$auth[8]");
					$_coef    = array_fill(0, $nbcols, "1");
					$_visible = array_fill(0, $nbcols, "O");
					}

		$disabled = ( $lock == "" AND ($auth[0] & pow(2, $_SESSION["CnxGrp"] - 1)) ) ? ""  : "disabled=\"disabled\"" ;

		$list   = explode (",", $msg->read($NOTES_PERIODLIST));
		$quater = substr($list[$auth[2]], 0, 1);
		$islock = "";

		if ( $IDdata ) {
			$mymsg  = ( $lock == "" ) ? $NOTES_LOCK : $NOTES_UNLOCK ;
			$mylock = ( $lock == "" ) ? "unlocked" : "locked" ;
			$islock = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $auth[3] )
				? "<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/$mylock.gif\" name=\"$mylock\" title=\"".$msg->read($mymsg)."\" alt=\"".$msg->read($mymsg)."\" />"
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/$mylock.gif\" title=\"".$msg->read($mymsg)."\" alt=\"".$msg->read($mymsg)."\" />" ;
			}

		$import = ( $lock == "" AND ($auth[0] & pow(2, $_SESSION["CnxGrp"] - 1)) )
			? "<span style=\"cursor: pointer;\" onclick=\"$('import')._display.toggle(); return false;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/post-in.gif\" title=\"". $msg->read($NOTES_IMPORT) ."\" alt=\"". $msg->read($NOTES_IMPORT) ."\" /></span> "
		    : "" ;
			
		print("
			<table width=\"100%\">
				<tr>
					<td width=\"50%\">
						<label for=\"period\">
						<select id=\"period\" name=\"period\" onchange=\"document.forms.formulaire.submit()\" width=\"100%\">");

						// trimestres, semestres ou années
						switch ( $auth[2] ) {
							case 0 : $j = 3; break;
							case 1 : $j = 2; break;
							default: $j = 1; break;
							}

						for ($i = 1; $i <= $j; $i++)
							printf("<option value=\"$i\" %s>$quater$i</option>", ($i == $period) ? "selected=\"selected\"" : "");

				print("
						</select>
						</label>
					</td>
					<td>
				
						<label for=\"year\">
						<select id=\"year\" name=\"year\" onchange=\"document.forms.formulaire.submit()\" width=\"100%\">");

						// affichage des années
						$Query  = "select distinctrow notes_data._year from notes_data, campus_classe ";
						$Query .= "where campus_classe._IDcentre = '$IDcentre' ";
						$Query .= "AND campus_classe._visible = 'O' ";
						$Query .= "AND campus_classe._IDclass = notes_data._IDclass ";
						$Query .= ( $IDclass ) ? "AND campus_classe._IDclass = '$IDclass' " : "" ;
						$Query .= "order by _year";

						$result = mysql_query($Query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						if ( mysql_numrows($result) == 0 )
							print("<option value=\"$year\">$year</option>");

						while ( $row ) {			
							printf("<option value=\"$row[0]\" %s>$row[0]</option>", ($year == $row[0]) ? "selected=\"selected\"" : "");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}	// endwhile années

				print("
						</select>
						</label>
					
					</td>
				</tr>
			</table>");



		if ( $IDclass AND $IDeleve == 0 ) {
			// recherche enseignant de la matière
			$Query  = "select _ID from notes_items ";
			$Query .= "where _IDdata = '$IDdata' ";
			$Query .= "order by _IDitems ";
			$Query .= "limit 1";

			$return = mysql_query($Query, $mysql_link);
			$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;

			switch ( $auth[6] ) {
				case "P" :
					if ( canPost($_SESSION["CnxID"]) AND canRead($myrow[0]) )
						$email = ( $_SESSION["CnxID"] != $myrow[0] AND $_SESSION["CnxSex"] != "A" )
							? "<a href=\"".myurlencode("index.php?item=4&IDpost=".$_SESSION["CnxID"]."&IDdst=$myrow[0]&cmde=post")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/email.gif\" title=\"". $msg->read($NOTES_EMAIL, getUserName($myrow[0], false)) ."\" alt=\"". $msg->read($NOTES_EMAIL, getUserName($myrow[0], false)) ."\" /></a>"
							: "" ;
					else
						$email = "";
					break;

				case "E" :
					// envoie d'un email
					$email = ( getUserEmail($myrow[0]) != "" )
						? "<a href=\"mailto:".getUserEmail($myrow[0])."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/email.gif\" title=\"". $msg->read($NOTES_EMAIL, getUserName($myrow[0], false)) ."\" alt=\"". $msg->read($NOTES_EMAIL, getUserName($myrow[0], false)) ."\" /></a>"
						: "" ;
					break;

				default :
					$email = "";
					break;
				}
			}
		else
			$print = $export = $email = "";


		  
		print("
			  	<label for=\"IDclass\" style=\"display: none\">
			  	<select id=\"IDclass\" name=\"IDclass\" onchange=\"document.forms.formulaire.submit()\" $disabled >");

				// affichage des classes
				$Query  = "select distinctrow campus_classe._IDclass, campus_classe._ident ";
				$Query .= "from campus_classe, user_id ";
				$Query .= "where campus_classe._IDcentre = '$IDcentre' ";
				$Query .= "AND campus_classe._visible = 'O' ";
				$Query .= ( $IDeleve ) ? "AND campus_classe._IDclass = user_id._IDclass " : "" ;
				$Query .= ( $IDeleve ) ? "AND user_id._ID = '$IDeleve' " : "" ;
				$Query .= "order by campus_classe._ident";

				$result = mysql_query($Query, $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				print("<option value=\"0\">&nbsp;</option>");

				while ( $row ) {			
					printf("<option value=\"$row[0]\" %s>$row[1]</option>", ($IDclass == $row[0]) ? "selected=\"selected\"" : "");

					$row = remove_magic_quotes(mysql_fetch_row($result));
					}	// endwhile classe

		echo "</select></label>";

		// affichage des élèves
		$query  = "select _name, _fname, _ID, _IDclass ";
		$query .= "from user_id ";
		$query .= "where _visible = 'O' ";
		$query .= "AND _IDclass = '$IDclass' AND _IDgrp = '1' ";
//		$query .= ( $IDeleve ) ? "AND _ID = '$IDeleve' " : "" ;
		$query .= "order by _name, _fname";

		$result = mysql_query($query, $mysql_link);
		$row    = remove_magic_quotes(mysql_fetch_row($result));

		// pour statistiques
		$rnum   = $rmin   = $rmax = $rtot = $rmoy = $table = Array();

		// initialisation
		for ($i = 0; $i < $nbcols; $i++) {
			$rmin[$i] = (float) $_total[$i];
			$rnum[$i] = $rmax[$i] = $rtot[$i] = (float) 0;
			}

		$j = 0;
		while ( $row ) {
			$bgcolor = ( $j % 2 ) ? "item" : "menu" ;

			//---- nouvelles notes
			if ( $submit AND $IDdata ) {
				$date    = date("Y-m-d H:i:s");
				$IDeleve = $row[2];

				for ($i = 0; $i < $nbcols; $i++) {
					$value  = str_replace(",", ".", trim(@$_POST["value_".$IDeleve."_$i"]));

					if ( $value < 0 OR $value > $_total[$i] OR !is_numeric($value) )
						$value = "";

					$Query  = "insert into notes_items ";
					$Query .= "values('', '$IDdata', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '$date', '$IDeleve', '$i', '$value')";

					if ( !mysql_query($Query, $mysql_link) ) {
						// modification du bulletin
						$Query  = "UPDATE notes_items ";
						$Query .= "SET _ID = '".$_SESSION["CnxID"]."', _IP = '".$_SESSION["CnxIP"]."', _update = '$date', _value = '$value' ";
						$Query .= "where _IDdata = '$IDdata' AND _IDeleve = '$IDeleve' AND _index = '$i' ";
						$Query .= "limit 1";

						mysql_query($Query, $mysql_link);
						}
					}
				}

			// appréciation
			$href   = "item=$item&cmde=$cmde&IDcentre=$IDcentre&IDeleve=$row[2]&IDclass=$IDclass&IDmat=$IDmat&year=$year&period=$period&lang=".$_SESSION["lang"];
			$click  = "onclick=\"popWin('".$_SESSION["ROOTDIR"]."/notes.php?sid=".myurlencode($_SESSION["sessID"]."&$href")."', '450', '350');\"";

			$icon   = ( $lock == "" AND ($auth[0] & pow(2, $_SESSION["CnxGrp"] - 1)) )
				? "<a href=\"#\" $click><img src=\"".$_SESSION["ROOTDIR"]."/images/files_new.gif\" title=\"". $msg->read($NOTES_COMMENT) ."\" alt=\"". $msg->read($NOTES_COMMENT) ."\" /></a>"
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/files.gif\" title=\"*\" alt=\"*\" />" ;

			$link   = "$row[0] $row[1]";

			$Query  = "select _text from notes_text ";
			$Query .= "where _IDeleve = '$row[2]' AND _IDclass = '$IDclass' AND _IDmat = '$IDmat' AND _year = '$year' AND _period = '$period' ";
			$Query .= "limit 1";

			$return = mysql_query($Query, $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			$over   = ( strlen($myrow[0]) )
				? "<span>". str_replace(Array("\r", "\n"), Array("", "<br/>"), $myrow[0]) ."</span>"
				: "" ;

			$note   = ( $over != "" )
				? "<a href=\"#\" class=\"overlib\"><img src=\"".$_SESSION["ROOTDIR"]."/images/document.gif\" title=\"\" alt=\"". $msg->read($NOTES_COMMENT) ."\" />$over</a>"
				: "" ;

			// suppression
			$href   = "item=$item&cmde=$cmde&del=$IDdata&IDcentre=$IDcentre&IDeleve=$row[2]&IDclass=$IDclass&IDmat=$IDmat&year=$year&period=$period&lang=".$_SESSION["lang"];
			$del    = ( $lock == "" AND ($auth[0] & pow(2, $_SESSION["CnxGrp"] - 1)) )
				? "<a href=\"".htmlspecialchars("./index.php?$href")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"". $msg->read($NOTES_DELETE) ."\" alt=\"". $msg->read($NOTES_DELETE	) ."\" /></a>"
				: "" ;


			
			echo '<ul data-role="listview" data-theme="a">';
			// initialisation
			$totcoef = $totpts = 0;

			for ($i = 0; $i < $nbcols; $i++)
			{
				$Query  = "select _ID, _IP, _create, _update, _value from notes_items ";
				$Query .= "where _IDdata = '$IDdata' AND _IDeleve = '$row[2]' AND _index = '$i' ";

				$return = mysql_query($Query, $mysql_link);
				$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;

				$fmt    = ( $myrow[4] != "" )
					? number_format($myrow[4], $auth[4], $auth[5], ".")
					: "" ;

				if($fmt != "")
				{
					$tabidx = (100 * ($i + 1)) + $j;

					if ( $IDeleve == 0 OR  $IDeleve == $row[2] )
						echo "<li>$fmt / $_total[$i] <span class=\"ui-li-count\" data-theme=\"e\">Coef $_coef[$i]</span></li>";

					if ( $myrow[4] != "" ) {
						// statistiques
						$rnum[$i] += 1;
						$rtot[$i] += (float) $myrow[4];
						if ( $rmin[$i] > $myrow[4] )
							$rmin[$i] = $myrow[4];
						if ( $rmax[$i] < $myrow[4] )
							$rmax[$i] = $myrow[4];

						// moyenne
						$totpts  += (float) ($_coef[$i] * $myrow[4]);
						$totcoef += (float) ($_coef[$i] * $_total[$i]);

						$table[$j][$i] = (float) $myrow[4];
						}
					else
						$table[$j][$i] = -1;
					}

				}
				
				$mean = ( $totcoef )
					? (float) ($auth[8] * $totpts / $totcoef)
					: "" ;
				$fmt  = ( $mean != "" )
					? number_format($mean, $auth[4], $auth[5], ".")
					: "" ;

				// stats sur la moyenne des notes
				$table[$j][$nbcols] = ( $mean != "" ) ? $mean : -1 ;

				if ( $IDeleve == 0 OR  $IDeleve == $row[2] )
					echo "<li data-theme=\"b\">Moyenne<span style=\"float: right\">$fmt / 20</span></li>";

				$j++;
				$row = remove_magic_quotes(mysql_fetch_row($result));
 			}
			
			echo '</ul>';
	?>
			<?php
				$colspan = $nbcols + 3;
			?>

	</form>

</div>
<?php include("mobile_menu.php"); ?>
<?php include("mobile_footer.php"); ?>