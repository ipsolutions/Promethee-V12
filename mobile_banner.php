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
 *		module   : mobile_banner.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php
session_start();
header('Content-Type: text/html;charset=ISO-8859-1');
require_once "page_session.php";
require "msg/edt.php";
require_once "include/TMessage.php";

require_once "include/gallery.php";

// initialisation
$my_logo = $height = "";

// taille du logo par défaut
imageSize("images/download/".$_SESSION["CfgIdent"]."/logo01.jpg", $srcWidth, $srcHeight);

// images défilantes ou logo fixe
$result  = mysql_query("select _IDlogo from config_logo where _visible = 'O'", $mysql_link);

if ( $_SESSION["CfgLogo1"] == "O" ) {
	$height = "height:".$srcHeight."px;";

	if ( mysql_numrows($result) )	{
		$my_logo = "";
		}
	else {
		$file = $_SESSION["ROOTDIR"]."/download/logos/".$_SESSION["CfgIdent"]."/logo01.jpg";

		if ( file_exists($file) )
			$my_logo = "
				<a href=\"mobile.php\">
					<img src=\"".$_SESSION["ROOTDIR"]."/download/logos/". rawurlencode($_SESSION["CfgIdent"]) ."/logo01.jpg\" title=\"\" alt=\"$file\" style=\"margin-bottom: 5px\" width=\"250\" />
				</a>";
		}
	}
?>

<html class="ui-mobile">
<head>
	<title>Mobile</title>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0; maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="css/jquery.mobile-1.3.2.min.css" />
	<script src="script/jquery-1.9.1.min.js"></script>
	<script src="script/jquery.mobile-1.3.2.min.js"></script>
	<link href="images/logo-iphone.ico" rel="apple-touch-icon">
</head>
<body>

<div data-role="page">
<div style="background-color: white">
<?php
if(isset($current_page) && $current_page == "mobile")
{
	echo $my_logo;
	?>
	<div style="float: right; display: inline-block; height: 50px; margin-top: 10px">
		<a href="index.php?item=-1" data-role="button" data-icon="delete" data-iconpos="notext" data-inline="true" data-theme="b">Delete</a>
	</div>
	<?php
}
?>
</div>