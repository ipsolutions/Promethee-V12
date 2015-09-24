<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2008 by Dominique Laporte(C-E-D@wanadoo.fr)
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
   along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.ss
 /*-----------------------------------------------------------------------*/


/*
 *		module   : setup.php
 *		projet   : la page de configuration automatique de Prométhée
 *
 *		version  : 2.4
 *		auteur   : laporte
 *		creation : 29/06/03
 *		modif    : 13/06/05 - D. Laporte
 *                     vérification de la configuration avant installation
 *		modif    : 25/06/05 - D. Laporte
 *                     nom de la base de données paramétrable
 *		modif    : 1/07/05 - D. Laporte
 *                     mise à jour automatique de la base de données
 *		modif    : 4/06/05 - D. Laporte
 *                     migration -> PHP5
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 *		modif    : 11/11/06 - D. Laporte
 * 	                 forçage de l'installation
 *		modif    : 1/01/08 - D. Laporte
 * 	                 encodage des caractères
 */


// début de session
session_start();

// variables d'environnement pour l'hébergement de sites
$_SESSION["CFGDIR"] = ( @$CFGDIR != "" ) ? $CFGDIR : "." ;
$_SESSION["ROOTDIR"] = ( @$ROOTDIR != "" ) ? $ROOTDIR : "." ;

// choix de la langue
if ( !empty($_GET["lang"]) )
	$_SESSION["lang"] = $_GET["lang"];
else
	if ( empty($_SESSION["lang"]) )
		if ( isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ) {
			$list = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
			$lang = strtolower(substr(chop($list[0]), 0, 2));

			$_SESSION["lang"] = ( $lang == "fr" OR $lang == "en" ) ? $lang : "fr" ;
			}
		else
			$_SESSION["lang"] = "fr";

// initialisation
$step    = ( @$_POST["step"] )		// étape d'installation
	? (int) $_POST["step"]
	: 1 ;
$force   = ( @$_POST["force"] )		// forçage de l'installation
	? (int) $_POST["force"]
	: (int) @$_GET["force"] ;
$debug   = ( @$_POST["debug"] )		// mode debug
	? (int) $_POST["debug"]
	: (int) @$_GET["debug"] ;
$charset = ( @$_POST["charset"] )		// encodage
	? $_POST["charset"]
	: (@$_GET["charset"] ? $_GET["charset"] : "iso-8859-1") ;
$dba     = @$_POST["dba"];			// base de données

require "include/TMessage.php";
//---------------------------------------------------------------------------
require "msg/setup.php";
//---------------------------------------------------------------------------
$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/setup.php");
//---------------------------------------------------------------------------
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_SESSION["lang"]; ?>" lang="<?php echo $_SESSION["lang"]; ?>">
<head>
    <title>Prométhée - <?php print($msg->read($MSG_TITLE)); ?></title>

	<!-- début meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<!-- fin meta -->

	<!-- début link -->
	<link href="./css/themes/globals.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/themes/blue/styles/verdana.css" rel="stylesheet" type="text/css" media="screen" />
	<link rel="icon" href="favicon.png" type="image/png" />
	<!-- fin link -->
	<link href="<?php echo $_SESSION["ROOTDIR"]; ?>/css/bootstrap.css" rel="stylesheet">
</head>

<body style="background-color:#FFFFFF; margin:5px;">

<div style="margin-top:40px; margin-left:15%; margin-right:15%;">

	<div class="maintitle">

		<table  summary="" width="100%" cellspacing="0" cellpadding="0" >
		  <tr align="center">
		    <td style="width:8%;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/logo.gif" title="" alt="" /></td>
		    <td style="width:84%;">
			<span class="xx-large"><strong>PROMETHEE</strong></span><br/>
			<?php print($msg->read($MSG_PARAM)); ?><br/>
			<?php $msg->languageBanner("msg", "setup.php") ?>
		    </td>
		    <td style="width:8%;" valign="middle"><span class="xx-large"><strong><?php print("$step"); ?></strong></span></td>
		  </tr>
		</table>

	</div>

	<div class="maincontent">
	<?php
		require "config.ini";
		require "include/setup.php";
		require "include/config.php";

		// initialisation
		$isOk  = 0;
		$help  = $msg->read($MSG_TIPS);

		// mode DEMO par défaut
		$DEMO  = 1;

		// mesure de sécurité : l'utilisateur doit se trouver sur le serveur
		$remote = @$_SERVER["REMOTE_ADDR"];
		$Host   = ( $debug ) ? getHostByAddr($remote) . " ($remote)" : "" ;

		// en cas de problème...
		if ( $debug == 1 )
			print("
				<strong>globals :</strong> ". ini_get("register_globals") ."<br/>
				<strong>step :</strong> $step<br/>
				<strong>Host :</strong> $Host<br/>
				");

		// pour les requêtes SQL (déjà échappées)
//		set_magic_quotes_runtime(0); // déprécié en PHP5

		//==== vérification de la configuration ====
		if ( $step == 1 ) {
			$text  = $msg->read($MSG_STEP1, $VERSION);

			$php    = ( strcmp(phpversion(), "4.3") < 0 )
				? "wrn"
				: "on" ;
			$mysql  = ( function_exists('mysql_connect') )
				? "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" /> ". $msg->read($MSG_SQLON)
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" title=\"\" alt=\"X\" /> ". $msg->read($MSG_SQLOFF) ;
			$config = ( is_writable("config.php") )
				? "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" /> ". $msg->read($MSG_CFGON)
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" title=\"\" alt=\"X\" /> ". $msg->read($MSG_CFGOFF) ;
			$reg    = ( ini_get("register_globals") != "1" )
				? "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" /> ". $msg->read($MSG_REGOFF)
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_wrn.png\" title=\"\" alt=\"X\" /> ". $msg->read($MSG_REGON) ;
			$ldap   = ( function_exists('ldap_connect') )
				? "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" /> ". $msg->read($MSG_LDAPON)
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_wrn.png\" title=\"\" alt=\"X\" /> ". $msg->read($MSG_LDAPOFF) ;
			$imap   = ( function_exists('imap_open') )
				? "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" /> ". $msg->read($MSG_IMAPON)
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_wrn.png\" title=\"\" alt=\"X\" /> ". $msg->read($MSG_IMAPOFF) ;

			// recherche de la version GD
			$version = "";
			$array   = get_loaded_extensions();
			foreach ($array as $key => $value)
				if ( $value == 'gd' ) {
					$ar      = gd_info();
					$version = $ar['GD Version'];
					break;
					}

			$gd     = ( $version )
				? "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" /> ". $msg->read($MSG_GDON, $version)
				: "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_wrn.png\" title=\"\" alt=\"X\" /> ". $msg->read($MSG_GDOFF) ;

			// saisie de la configuration
			print("
				<form id=\"formulaire\" action=\"setup.php\" method=\"post\">
					<p class=\"hidden\"><input type=\"hidden\" name=\"step\"    value=\"2\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"debug\"   value=\"$debug\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"dba\"     value=\"$dba\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"force\"   value=\"$force\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"charset\" value=\"$charset\" /></p>

				<table  summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
				  <tr>
				      <td style=\"background-color:#eeeeee;\" align=\"justify\">$text</td>
				  </tr>
				  <tr>
				    <td align=\"center\">

				<div style=\"width:80%; background: #FFFFFF; border:#cccccc solid 1px;\">

				<table  summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
				  <tr>
				    <td>
				      <img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_$php.png\" title=\"\" alt=\"\" /> ". $msg->read($MSG_PHPVER, phpversion()). "
				    </td>
                		  </tr>
				  <tr>
				    <td>$reg</td>
                		  </tr>
				  <tr>
				    <td>$mysql</td>
                		  </tr>
				  <tr>
				    <td>$config</td>
                		  </tr>
				  <tr>
				    <td>$ldap</td>
                		  </tr>
				  <tr>
				    <td>$imap</td>
                		  </tr>
				  <tr>
				    <td>$gd</td>
                		  </tr>
				</table>

				</div>

				$help

				    </td>
                		  </tr>
				</table>

				<hr style=\"width:80%; text-align:center;\" />
				");

			$next  = ( function_exists('mysql_connect') AND is_writable("config.php") )
				? $msg->read($MSG_INSTALLOK). " <button class=\"btn btn-primary\" type=\"submit\">". $msg->read($MSG_NEXT) ."</button>"
				: "<span style=\"color:#FF0000;\">". $msg->read($MSG_INSTALLFAIL). "</span>" ;

			if ( @$_SERVER["REMOTE_ADDR"] != "127.0.0.1" AND !$DEMO )
				print("
				      <p style=\"margin-top:10px; margin-bottom:0px; text-align:center;\">
					<span style=\"color:#FF0000;\">". $msg->read($MSG_ONSERVER, $Host). "</span>
					</p>
					");
			else
				print("
				      <p style=\"margin-top:10px; margin-bottom:0px; text-align:right;\">
					$next
					</p>
					");

			print("
				</form>
				");
			}

		//==== paramétrage de la connexion internet ====
		if ( $step == 2 ) {
			$text  = $msg->read($MSG_STEP2, $VERSION);

			$server   = "localhost";
			$user     = "root";
			$passwd   = "";
			$database = "epl";
			$servport = "";

			// saisie de la configuration
			print("
				<form id=\"formulaire\" action=\"setup.php\" method=\"post\">
					<p class=\"hidden\"><input type=\"hidden\" name=\"step\"    value=\"3\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"debug\"   value=\"$debug\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"dba\"     value=\"$dba\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"force\"   value=\"$force\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"charset\" value=\"$charset\" /></p>

				<table  summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
				  <tr>
				      <td style=\"background-color:#eeeeee;\" align=\"justify\">$text</td>
				  </tr>
				  <tr>
				    <td align=\"center\">

				<div style=\"width:80%; background: #FFFFFF; border:#cccccc solid 1px;\">

		              <table  summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
				  <tr>
				      <td style=\"width:30%;\" align=\"right\">". $msg->read($MSG_DBA). "</td>
				      <td style=\"width:70%;\">
						<label for=\"database\">
						<input type=\"text\" id=\"database\" name=\"database\" size=\"20\" value=\"$database\" />
						<span style=\"color:#FF0000;\">". $msg->read($MSG_MANDATORY). "</span>
						</label>
					</td>
				  </tr>
				  <tr>
				      <td align=\"right\">". $msg->read($MSG_SERVER). "</td>
				      <td>
						<label for=\"server\">
						<input type=\"text\" id=\"server\" name=\"server\" size=\"20\" value=\"$server\" />
						<span style=\"color:#FF0000;\">". $msg->read($MSG_MANDATORY). "</span>
						</label>
					</td>
				  </tr>
				  <tr>
				      <td align=\"right\">". $msg->read($MSG_USER). "</td>
				      <td>
						<label for=\"user\">
						<input type=\"text\" id=\"user\" name=\"user\" size=\"20\" value=\"$user\" />
						<span style=\"color:#FF0000;\">". $msg->read($MSG_MANDATORY). "</span>
						</label>
					</td>
				  </tr>
				  <tr>
				      <td align=\"right\">". $msg->read($MSG_PASSWD). "</td>
				      <td><label for=\"passwd\"><input type=\"text\" id=\"passwd\" name=\"passwd\" size=\"20\" value=\"$passwd\" /></label></td>
				  </tr>
				  <tr>
				      <td align=\"right\">". $msg->read($MSG_SERVPORT). "</td>
				      <td><label for=\"servport\"><input type=\"text\" id=\"servport\" name=\"servport\" size=\"5\" value=\"$servport\" /></label></td>
				  </tr>
				  </table>

				</div>

				$help

				    </td>
				  </tr>
				</table>

				<hr style=\"width:80%; text-align:center;\" />

			      <p style=\"margin-top:10px; margin-bottom:0px; text-align:right;\">
				". $msg->read($MSG_CLICK). "
				<button class=\"btn btn-primary\" type=\"submit\">". $msg->read($MSG_NEXT) ."</button>
				</p>

				</form>
				");
			}

		//==== création de la base de données ====
            if ( $step == 3 ) {
			if ( @$_SERVER["REMOTE_ADDR"] != "127.0.0.1" AND !$DEMO )
				die("<span style=\"color:#FF0000;\">". $msg->read($MSG_ONSERVER, $Host). "</span>");

			$database = addslashes(trim($_POST["database"]));
			$server   = addslashes(trim($_POST["server"]));
			$user     = addslashes(trim($_POST["user"]));
			$passwd   = addslashes(trim($_POST["passwd"]));
			$servport = (int) $_POST["servport"];

			print("
				<form id=\"formulaire\" action=\"setup.php\" method=\"post\">
					<p class=\"hidden\"><input type=\"hidden\" name=\"server\"   value=\"$server\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"user\"     value=\"$user\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"passwd\"   value=\"$passwd\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"database\" value=\"$database\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"servport\" value=\"$servport\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"debug\"    value=\"$debug\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"dba\"      value=\"$dba\" /></p>
					<p class=\"hidden\"><input type=\"hidden\" name=\"charset\"  value=\"$charset\" /></p>");

			// vérification de la connexion à la dba MySql
			$servname = $server . ($servport ? ":$servport" : "");
			if ( $isOk = @mysql_connect($servname, $user, $passwd) ) {
				print("<p class=\"hidden\"><input type=\"hidden\" name=\"step\"     value=\"4\" /></p>");

				$text  = $msg->read($MSG_STEP3, Array($database, $dba));

				// recopie du fichier de configuration
				print("
					<table summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
					  <tr>
					      <td style=\"background-color:#eeeeee;\" align=\"justify\">$text</td>
					  </tr>

					  <tr>
					    <td>
						<div style=\"padding:4px; margin-left:10%; width:80%; background:#FFFFFF; border:#cccccc solid 1px;\">

						<span style=\"text-align:left;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/dot.gif\" title=\"\" alt=\"*\" /> ". $msg->read($MSG_CONFIG) ." 
						</span>
					");

				switch ( writeconfigfile("config.ini", "config.php", $server, $user, $passwd, $database, $servport, $charset) ) {
					case -1 :
						die("
							<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" title=\"\" alt=\"X\" /><br/>
							<span style=\"color:#FF0000;\">". $msg->read($MSG_INIFAIL) ."</span>");
						break;

					case -2 :
						die("
							<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" title=\"\" alt=\"X\" /><br/>
							<span style=\"color:#FF0000;\">". $msg->read($MSG_PHPFAIL) ."</span>");
						break;

					default :
						break;
					}

				print("<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" />");

				print("
					<p style=\"text-align:justify; margin-bottom:0px;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/dot.gif\" title=\"\" alt=\"*\" /> ". $msg->read($MSG_CREATE, $database) ."
					</p>
					");

				// ouverture du répertoire des fichiers sql
				$myDir = @opendir("Mysql");

				// lecture des répertoires
				$i     = $j = 0;
				$files = Array();

				while ( $entry = @readdir($myDir) )
					if ( strstr($entry, ".sql") ) {
						$files[$i++][$j] = $entry;
						if ( ($i = $i % 2) == 0 ) $j++;
						}

				print("<table summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">");
				print("<tr valign=\"top\">");
				for ($i = 0; $i < 2; $i++) {
					print("<td>");
					print("<ul>");

					for ($j = 0; $j < count($files[$i]); $j++)
						print("<li>".$files[$i][$j]."</li>");

					print("</ul>");
					print("</td>");
					}
				print("</tr>");
				print("</table>");

				// fermeture du répertoire
				@closedir($myDir);

				// avertissement si une base de données a déjà été installée
//				$result = mysql_list_tables($database, $isOk);	// déprécié en PHP5
				$result = mysql_query("show tables from $database");
				$tables = ( $result ) ? mysql_numrows($result) : 0 ;

				print( $tables
					? "<span style=\"color:#FF0000;\">". $msg->read($MSG_DETECT) ."</span><br/>
						<label for=\"cb\"><input type=\"checkbox\" id=\"cb\" name=\"cb\" value=\"ON\" />". $msg->read($MSG_DONTERASE). "</label>"
					: "");

				// vérification de la dernière installation
				$query  = "select _retcode from $database.config_database ";
				$query .= "order by _IDconf desc limit 1";

				$result = mysql_query($query, $isOk);
				$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

				// on force l'installation en cas d'erreur
				$force  = ( $row[0] ) ? 1 : $force ;

				$text   = ( $row[0] )
					? $msg->read($MSG_CONTINUE)
					: $msg->read($MSG_INSTALL) ;

				$errtxt = ( $row[0] )
					? "<p style=\"margin:0px; text-align:center;\"><img src=\"".$_SESSION["ROOTDIR"]."/images/H.gif\" title=\"\" alt=\"!\" /> ". $msg->read($MSG_LASTERROR, $row[0]) ."</p>
					   <hr style=\"width:80%; text-align:center;\" />"
					: "" ;

				print("
						</div>

					    </td>
					  </tr>
					</table>

					<hr style=\"width:80%; text-align:center;\" />$errtxt

				      <p style=\"margin-top:10px; margin-bottom:0px; text-align:right;\">
						$text	<button class=\"btn btn-primary\" type=\"submit\">". $msg->read($MSG_NEXT) ."</button>
					</p>
					");
				}
			else {
				print("<p class=\"hidden\"><input type=\"hidden\" name=\"step\" value=\"2\" /></p>");

				$errno = (int) @mysql_errno($isOk);
				$error = @mysql_error($isOk);

				if ( $errno )
					print("<p><span style=\"color:#FF0000\"><strong>Error($errno)</strong></span> : $error.</p>");

				$text  = "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" title=\"\" alt=\"X\" /> ". $msg->read($MSG_CONNECTFAIL); 

				print("
					<table  summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
					  <tr>
					      <td style=\"background-color:#eeeeee;\" align=\"justify\">$text</td>
					  </tr>
					</table>

					<hr style=\"width:80%; text-align:center;\" />

				      <p style=\"margin-top:10px; margin-bottom:0px; text-align:left;\">
						<button class=\"btn btn-primary\" type=\"submit\">". $msg->read($MSG_NEXT) ."</button>
						". $msg->read($MSG_CLICKHERE) ."
					</p>
					");
				}

			print("<p class=\"hidden\"><input type=\"hidden\" name=\"force\" value=\"$force\" /></p>");
			print("</form>");
            	}	// end step 3

		//==== paramétrage de l'intranet ====
            if ( $step == 4 ) {
			if ( @$_SERVER["REMOTE_ADDR"] != "127.0.0.1" AND !$DEMO )
				die("<span style=\"color:#FF0000;\">". $msg->read($MSG_ONSERVER, $Host). "</span>");

			$database = $_POST["database"];
			$server   = $_POST["server"];
			$user     = $_POST["user"];
			$passwd   = $_POST["passwd"];
			$servport = (int) $_POST["servport"];

			// initialisation
			$text     = "";
			$error    = 0;

			// les langues disponibles
			$langlist = Array();

			// ouverture du répertoire des langues
			$myDir = @opendir("msg");

			// lecture des répertoires
			while ( $entry = @readdir($myDir) )
				if ( is_dir("msg/$entry") AND strlen($entry) == 2 )
					switch ( $entry ) {
						case "." :
						case ".." :
							break;

						default :
							array_push($langlist, $entry);
							break;
						}

			// fermeture du répertoire
			@closedir($myDir);
			// mise à jour de la base de données
			if ( @$_POST["cb"] == "ON" )
				$error = updatedatabase($server, $user, $passwd, $database, $servport, $langlist, $text);
			else
				// création de la base de données
				$error = createdatabase($server, $user, $passwd, $database, $servport, $langlist, $dba);

			$text .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/dot.gif\" title=\"\" alt=\"*\" /> ". $msg->read($MSG_DBATITLE, $database). " ";

			switch ( $error ) {
				case -2 :
					die("<span style=\"color:#FF0000;\">". $msg-read($MSG_FAILED, $file) ."</span>");
					break;
				case -1 :
					print("
						<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" title=\"\" alt=\"X\" /><br/>
						&nbsp;". $msg->read($MSG_CONNECTERROR, $database));
					break;
				case 0 :
					$text .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_on.png\" title=\"\" alt=\"O\" /><br/>";
					$text .= $msg->read($MSG_DBAOK);
					break;
				default :
					$text .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/setup/check_off.png\" title=\"\" alt=\"X\" /><br/>";
					$text .= $msg->read($MSG_DBAFAIL);
					break;
				}

			if ( $error != -1 ) {
				print("
					<table  summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
					  <tr>
					      <td style=\"background-color:#eeeeee;\" align=\"justify\">$text</td>
					  </tr>
					  <tr>
						<td>
							<div style=\"padding:4px; margin-left:10%; width:80%; background: #FFFFFF; border:#cccccc solid 1px;\">
							". $msg->read($MSG_DELETE) ."
							</div>
						</td>
					  </tr>
					</table>

					<hr style=\"width:80%; text-align:center;\" />
					");

				if ( $error ) {
					print("
						<table  summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
						  <tr>
							<td align=\"left\">
								<form id=\"formulaire\" action=\"setup.php\" method=\"post\">
									<p class=\"hidden\"><input type=\"hidden\" name=\"step\"     value=\"3\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"server\"   value=\"$server\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"user\"     value=\"$user\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"passwd\"   value=\"$passwd\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"database\" value=\"$database\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"servport\" value=\"$servport\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"debug\"    value=\"$debug\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"dba\"      value=\"$dba\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"force\"    value=\"$force\" /></p>
									<p class=\"hidden\"><input type=\"hidden\" name=\"charset\"  value=\"$charset\" /></p>

									<button class=\"btn btn-primary\" type=\"submit\">". $msg->read($MSG_NEXT) ."</button>
									". $msg->read($MSG_CLICKHERE) ."
								</form>
							</td>
						");

					if ( @$_POST["cb"] == "ON" )
						print("
							<td align=\"right\">
								<form id=\"formulaire\" action=\"index.php\" method=\"post\">
									". $msg->read($MSG_CONTINUE). "
									<button class=\"btn btn-primary\" type=\"submit\">". $msg->read($MSG_NEXT) ."</button>
								</form>
							</td>
							");

					print("
						  </tr>
						</table>
						");
					}
				else {
					// paramètres du formulaire
					if ( @$_POST["cb"] == "ON" ) {
						// mise à jour
						$action = "index.php";
						$texte  = $msg->read($MSG_CONNECTNOW);
						}
					else {
						//création
						$action = "config_init.php";
						$texte  = $msg->read($MSG_LASTSTEP);
						}

					print("
						<form id=\"formulaire\" action=\"$action\" method=\"post\">
							<p class=\"hidden\"><input type=\"hidden\" name=\"debug\"   value=\"$debug\" /></p>

						      <p style=\"margin:0px; text-align:right;\">
							$texte <button class=\"btn btn-primary\" type=\"submit\">". $msg->read($MSG_NEXT) ."</button>
							</p>
						</form>
						");
					}
				}
			}	// end step 4
	?>
      </div>

</div>

</body>
</html>
