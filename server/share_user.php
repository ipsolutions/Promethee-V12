<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2009 by Dominique Laporte(C-E-D@wanadoo.fr)

   This file is part of Prom�th�e.

   Prom�th�e is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prom�th�e is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/
/*
 *		module   : share_user.php
 *		projet   : page de mutualisation des annuaires
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 15/02/09
 *		modif    : 
 */


$key      = @$_POST["key"];
$name     = @$_POST["name"];
$fname    = @$_POST["fname"];
$sex      = @$_POST["sex"];
$title    = @$_POST["title"];
$function = @$_POST["function"];
$email    = @$_POST["email"];
$tel      = @$_POST["tel"];
$adr      = @$_POST["adr"];
$cp       = @$_POST["cp"];
$city     = @$_POST["city"];
$mylang   = @$_POST["mylang"];
$group    = @$_POST["group"];
$center   = @$_POST["center"];

$IDlang   = @$_POST["IDlang"]			// langue
	? $_POST["IDlang"]
	: @$_GET["IDlang"] ;
$IDres    = @$_POST["IDres"]			// �tablissement
	? $_POST["IDres"]
	: @$_GET["IDres"] ;
$IDcat    = @$_POST["IDcat"]			// groupe
	? $_POST["IDcat"]
	: @$_GET["IDcat"] ;
$IDfmt    = @$_POST["IDfmt"]			// fonction
	? $_POST["IDfmt"]
	: @$_GET["IDfmt"] ;
$IDcnt    = @$_POST["IDcnt"]			// centre
	? $_POST["IDcnt"]
	: @$_GET["IDcnt"] ;
$IDname   = @$_POST["IDname"]			// nom
	? $_POST["IDname"]
	: @$_GET["IDname"] ;
$sort     = @$_POST["sort"]
	? $_POST["sort"]
	: @$_GET["sort"] ;

$skpage   = ( @$_GET["skpage"] )		// n� de la page affich�e
	? (int) $_GET["skpage"]
	: 1 ;
$skshow   = ( @$_GET["skshow"] )		// n� du flash info
	? (int) $_GET["skshow"]
	: 1 ;
?>


<body style="background-color:#FFFFFF; margin-top:5px; margin-left:10%; width:80%;">

<?php
	require "msg/server.php";
	require_once "include/TMessage.php";

	$msg = new TMessage("msg/".$_SESSION["lang"]."/server.php");
?>


<div style="text-align: center;"><img src="download/logos/<?php echo rawurlencode($_SESSION["CfgIdent"]) ?>/logo01.jpg" title="" alt="" /></div>

<div class="maintitle" style="background-image: url('<?php echo $_SESSION["CfgHeader"]; ?>'); background-repeat: repeat;">
	<div style="text-align: center;">
		<?php print($msg->read($SERVER_P2P, $WEBSITE)); ?>
	</div>
</div>

<div class="maincontent">

	<form id="formulaire" action="" method="post">
<?php
	require_once "include/urlencode.php";

	//--- mise � jour
	$result = mysql_query("select _IDdata from p2p_data where _key = '$key' AND _visible = 'O' limit 1", $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	if ( $row ) {
		// insertion
		$date = date("Y-m-d H:i:s");

		for ($i = 0; $i < count($name); $i++) {
			$Query  = "insert into p2p_directory ";
			$Query .= "values(
				'', 
				'$row[0]',
				'".addslashes($center[$i])."',
				'".addslashes($group[$i])."',
				'".addslashes($name[$i])."',
				'".addslashes($fname[$i])."',
				'$sex[$i]',
				'".addslashes($title[$i])."',
				'".addslashes($function[$i])."',
				'$email[$i]',
				'$tel[$i]',
				'".addslashes($adr[$i])."',
				'$cp[$i]',
				'".addslashes($city[$i])."',
				'$mylang[$i]',
				'$date')";

			mysql_query($Query, $mysql_link);
			}
		}

	// total des utilisateurs
	mysql_query("select _IDitem from p2p_directory", $mysql_link);

	$nbuser = mysql_affected_rows($mysql_link);

	// total des �tablissements
	mysql_query("select distinctrow _IDdata from p2p_directory", $mysql_link);

	$school = mysql_affected_rows($mysql_link);

	$msg->isPlural = (bool) ( $school > 1 );

	print("<p style=\"text-align:justify;\">
		". $msg->read($SERVER_USERS, Array(strval($nbuser), strval($school))) ."
		</p>");

	// choix de la langue
	$result  = mysql_query("select distinctrow _lang from p2p_directory", $mysql_link);
	$row     = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$IDlang  = ( $IDlang == "" ) ? $_SESSION["lang"] : $IDlang ;

	$langID  = "<label for=\"IDlang\">";
	$langID .= "<select id=\"IDlang\" name=\"IDlang\" onchange=\"document.forms.formulaire.submit()\" style=\"font-size:9px;\">";
	while ( $row ) {
		$check   = ( $IDlang == $row[0] ) ? "selected=\"selected\"" : "" ;
		$langID .= "<option value=\"$row[0]\" $check>$row[0]</option>";

		$row     = mysql_fetch_row($result);
		}
	$langID .= "</select>";
	$langID .= "</label>";

	// choix �tablissement
	$query  = "select distinctrow p2p_directory._IDdata, p2p_data._ident ";
	$query .= "from p2p_directory, p2p_data ";
	$query .= "where p2p_directory._lang = '$IDlang' ";
	$query .= "AND p2p_directory._IDdata = p2p_data._IDdata ";
	$query .= "order by p2p_data._ident";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$resID  = "<label for=\"IDres\">";
	$resID .= "<select id=\"IDres\" name=\"IDres\" onchange=\"document.forms.formulaire.submit()\" style=\"font-size:9px;\">";
	$resID .= "<option value=\"\">&nbsp;</option>";
	while ( $row ) {
		$query  = "select _IDitem from p2p_directory ";
		$query .= "where _IDdata = '".addslashes($row[0])."' ";
		$query .= "AND _lang = '$IDlang'";

		$return = mysql_query($query, $mysql_link);
		$count  = ( $return ) ? mysql_numrows($return) : 0 ;

		$check  = ( $IDres == $row[0] ) ? "selected=\"selected\"" : "" ;
		$resID .= "<option value=\"$row[0]\" $check>$row[1] ($count)</option>";

		$row    = mysql_fetch_row($result);
		}
	$resID .= "</select>";
	$resID .= "</label>";

	// choix du nom
	$alpha  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	$namID  = "<label for=\"IDname\">";
	$namID .= "<select id=\"IDname\" name=\"IDname\" onchange=\"document.forms.formulaire.submit()\" style=\"font-size:9px;\">";
	$namID .= "<option value=\"\">&nbsp;</option>";

	for ($i = 0; $i < 26; $i++) {
		$select = ( $alpha[$i] == $IDname ) ? "selected=\"selected\"" : "" ;
		$namID .= "<option value=\"".$alpha[$i]."\" $select>".$alpha[$i]."</option>";
		}

	$namID .= "</select>";
	$namID .= "</label>";

	// choix du centre
	$query  = "select distinctrow _center from p2p_directory ";
	$query .= "where _lang = '$IDlang' ";
	$query .= ( $IDres != "" ) ? "AND _IDdata = '$IDres' " : "" ;
	$query .= ( $IDname != "" ) ? "AND _name like '$IDname%'" : "" ;

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$cntID  = "<label for=\"IDcnt\">";
	$cntID .= "<select id=\"IDcnt\" name=\"IDcnt\" onchange=\"document.forms.formulaire.submit()\" style=\"font-size:9px;\">";
	$cntID .= "<option value=\"\">&nbsp;</option>";
	while ( $row ) {
		$query  = "select _IDitem from p2p_directory ";
		$query .= "where _center = '".addslashes($row[0])."' ";
		$query .= "AND _lang = '$IDlang' ";
		$query .= ( $IDres != "" ) ? "AND _IDdata = '$IDres' " : "" ;
		$query .= ( $IDname != "" ) ? "AND _name like '$IDname%'" : "" ;

		$return = mysql_query($query, $mysql_link);
		$count  = ( $return ) ? mysql_numrows($return) : 0 ;

		$check  = ( $IDfmt == $row[0] ) ? "selected=\"selected\"" : "" ;
		$cntID .= "<option value=\"$row[0]\" $check>$row[0] ($count)</option>";

		$row    = mysql_fetch_row($result);
		}
	$cntID .= "</select>";
	$cntID .= "</label>";

	// groupes utilisateurs
	$query  = "select distinctrow _group from p2p_directory ";
	$query .= "where _lang = '$IDlang' ";
	$query .= ( $IDres ) ? "AND _IDdata = '$IDres' " : "" ;
	$query .= ( $IDname != "" ) ? "AND _name like '$IDname%' " : "" ;
	$query .= ( $IDcnt != "" ) ? "AND _center = '$IDcnt'" : "" ;

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$catID  = "<label for=\"IDcat\">";
	$catID .= "<select id=\"IDcat\" name=\"IDcat\" onchange=\"document.forms.formulaire.submit()\" style=\"font-size:9px;\">";
	$catID .= "<option value=\"\">&nbsp;</option>";
	while ( $row ) {
		$query  = "select _IDitem from p2p_directory ";
		$query .= "where _group = '".addslashes($row[0])."' ";
		$query .= "AND _lang = '$IDlang' ";
		$query .= ( $IDres ) ? "AND _IDdata = '$IDres' " : "" ;
		$query .= ( $IDname != "" ) ? "AND _name like '$IDname%' " : "" ;
		$query .= ( $IDcnt != "" ) ? "AND _center = '$IDcnt'" : "" ;

		$return = mysql_query($query, $mysql_link);
		$count  = ( $return ) ? mysql_numrows($return) : 0 ;

		$check  = ( $IDcat == $row[0] ) ? "selected=\"selected\"" : "" ;
		$catID  .= "<option value=\"$row[0]\" $check>$row[0] ($count)</option>";

		$row    = mysql_fetch_row($result);
		}
	$catID  .= "</select>";
	$catID  .= "</label>";

	// choix titre
	$query  = "select distinctrow _title from p2p_directory ";
	$query .= "where _lang = '$IDlang' ";
	$query .= ( $IDres ) ? "AND _IDdata = '$IDres' " : "" ;
	$query .= ( $IDname != "" ) ? "AND _name like '$IDname%' " : "" ;
	$query .= ( $IDcnt != "" ) ? "AND _center = '$IDcnt' " : "" ;
	$query .= ( $IDcat != "" ) ? "AND _group = '$IDcat'" : "" ;

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$fmt    = "<label for=\"IDfmt\">";
	$fmt   .= "<select id=\"IDfmt\" name=\"IDfmt\" onchange=\"document.forms.formulaire.submit()\" style=\"font-size:9px;\">";
	$fmt   .= "<option value=\"\">&nbsp;</option>";
	while ( $row ) {
		$query  = "select _IDitem from p2p_directory ";
		$query .= "where _title = '".addslashes($row[0])."' ";
		$query .= "AND _lang = '$IDlang' ";
		$query .= ( $IDres ) ? "AND _IDdata = '$IDres' " : "" ;
		$query .= ( $IDname != "" ) ? "AND _name like '$IDname%' " : "" ;
		$query .= ( $IDcnt != "" ) ? "AND _center = '$IDcnt' " : "" ;
		$query .= ( $IDcat != "" ) ? "AND _group = '$IDcat'" : "" ;

		$return = mysql_query($query, $mysql_link);
		$count  = ( $return ) ? mysql_numrows($return) : 0 ;

		$check  = ( $IDfmt == $row[0] ) ? "selected=\"selected\"" : "" ;
		$fmt   .= "<option value=\"$row[0]\" $check>$row[0] ($count)</option>";

		$row    = mysql_fetch_row($result);
		}
	$fmt   .= "</select>";
	$fmt   .= "</label>";

	print("
		<table summary=\"\" width=\"100%\" cellspacing=\"1\" cellpadding=\"2\">
		  <tr style=\"background-color:#c0c0c0;\">
                <td style=\"width:1%;\" align=\"center\" >$langID</td>
                <td style=\"width:20%;\">$resID</td>
                <td style=\"width:20%;\">$namID | $cntID</td>
                <td style=\"width:9%;\" align=\"center\" >$catID</td>
                <td style=\"width:20%;\">$fmt</td>
                <td style=\"width:30%;\">".$msg->read($SERVER_DETAILS)."</td>
		  </tr>
		");

	//--- lecture
	$query  = "select distinctrow ";
	$query .= "p2p_data._ident, p2p_data._url, ";
	$query .= "p2p_directory._lang, p2p_directory._name, p2p_directory._fname, p2p_directory._sex, p2p_directory._email, p2p_directory._center, p2p_directory._group, p2p_directory._function, p2p_directory._title, p2p_directory._tel, p2p_directory._adr, p2p_directory._cp, p2p_directory._city ";
	$query .= "from p2p_directory, p2p_data ";
	$query .= "where p2p_directory._lang = '$IDlang' ";
	$query .= ( $IDres ) ? "AND p2p_directory._IDdata = '$IDres' " : "" ;
	$query .= ( $IDname != "" ) ? "AND p2p_directory._name like '$IDname%' " : "" ;
	$query .= ( $IDcnt != "" ) ? "AND p2p_directory._center = '$IDcnt' " : "" ;
	$query .= ( $IDcat != "" ) ? "AND p2p_directory._group = '$IDcat'" : "" ;
	$query .= ( $IDfmt != "" ) ? "AND p2p_directory._function = '$IDfmt' " : "" ;
	$query .= "order by p2p_directory._name, p2p_directory._fname asc";

	// d�termination du nombre de pages
	$result = mysql_query($query, $mysql_link);
	$nbelem = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

	$page   = $nbelem;
	$show   = 1;

	if ( $nbelem ) {
		$page  = ( $page % $MAXPAGE )
			? (int) ($page / $MAXPAGE) + 1
			: (int) ($page / $MAXPAGE) ;

		$show  = ( $page % $MAXSHOW )
			? (int) ($page / $MAXSHOW) + 1
			: (int) ($page / $MAXSHOW) ;

		// initialisation
		$i     = 1;
		$first = 1 + (($skpage - 1) * $MAXPAGE);

		// se positionne sur la page ad hoc
		mysql_data_seek($result, $first - 1);
		$row   = remove_magic_quotes(mysql_fetch_row($result));

		while ( $row AND $i <= $MAXPAGE ) {
			$bgcol  = ( $i++ % 2 ) ? "item" : "menu" ;

			$target = "onclick=\"window.open(this.href, '_blank'); return false;\"";
	      	$sex    = ( $row[5] == "H" ) ? "male" : "female" ;
	      	$email  = ( $row[6] == "" ) ? "" : "<a href=\"mailto:$row[6]\"><img src=\"images/email.gif\" title=\"\" alt=\"$row[6]\" /></a>" ;

			print("
				<tr class=\"$bgcol\">
		                <td align=\"center\"><img src=\"images/lang/ico-$row[2].png\" title=\"$row[2]\" alt=\"$row[2]\" /></td>
		                <td><a href=\"$row[1]\" $target>$row[0]</a></td>
		                <td>
					$row[3] $row[4] <img src=\"images/$sex.gif\" title=\"\" alt=\"\" /> $email<br/>
					<span class=\"x-small\">".$msg->read($SERVER_IDENT)." $row[7]</span>
		                </td>
		                <td align=\"center\">$row[8]</td>
		                <td class=\"x-small\">
					<strong>$row[10]</strong><br/>
					$row[9]
		                </td>
		                <td class=\"x-small\">
					<strong>$row[11]</strong><br/>
					$row[12] $row[13] $row[14]
		                </td>
				  </tr>
				");

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}
		}	// endif nbelem

	print("</table>");

	// bouton pr�c�dent
	$where = $skshow - 1;

	if ( $skshow == 1 )
		$prev = "";
	else {
		$skpg = 1 + (($skshow - 2) * $MAXSHOW);
		$prev = "[<a href=\"".myurlencode("server.php?cmde=share&IDlang=$IDlang&IDres=$IDres&IDcat=$IDcat&IDfmt=$IDfmt&IDcnt=$IDcnt&skpage=$skpg&skshow=$where")."\">". $msg->read($SERVER_PREV) ."</a>]";
		}

	// liens directs sur n� de page
	$start = 1 + (($skshow - 1) * $MAXSHOW);
	$end   = $skshow * $MAXSHOW;

	$choix = ( $skpage == $start )
		? "<img src=\"images/nav_left.gif\" title=\"\" alt=\"\" /><b>$start</b><img src=\"images/nav_right.gif\" title=\"\" alt=\"\" />"
		: "<a href=\"".myurlencode("server.php?cmde=share&IDlang=$IDlang&IDres=$IDres&IDcat=$IDcat&IDfmt=$IDfmt&IDcnt=$IDcnt&skpage=$start&skshow=$skshow")."\">$start</a>" ;

	for ($j = $start + 1; $j <= $end AND $j <= $page; $j++)
		$choix .= ( $skpage == $j )
			? "|<img src=\"images/nav_left.gif\" title=\"\" alt=\"\" /><b>$j</b><img src=\"images/nav_right.gif\" title=\"\" alt=\"\" />"
			: "|<a href=\"".myurlencode("server.php?cmde=share&IDlang=$IDlang&IDres=$IDres&IDcat=$IDcat&IDfmt=$IDfmt&IDcnt=$IDcnt&skpage=$j&skshow=$skshow")."\">$j</a>" ;

	// bouton suivant
	$where = $skshow + 1;
	$next  = ( $skshow == $show )
		? ""
		: "[<a href=\"".myurlencode("server.php?cmde=share&IDlang=$IDlang&IDres=$IDres&IDcat=$IDcat&IDfmt=$IDfmt&IDcnt=$IDcnt&skpage=$j&skshow=$where")."\">". $msg->read($SERVER_NEXT) ."</a>]" ;
?>

	<hr/>
		<?php if ( $nbelem ) print("<div style=\"text-align:center;\">$prev $choix $next</div>"); ?>
	<hr/>

	</form>

</div>
</body>
