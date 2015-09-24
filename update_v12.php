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
require "page_banner.htm";

if(isset($_GET["menu"]))
{
	$menu = $_GET["menu"];
}
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
$step    = ( @$_GET["step"] )		// étape d'installation
	? (int) $_GET["step"]
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

// require "include/TMessage.php";
//---------------------------------------------------------------------------
require "msg/setup.php";
//---------------------------------------------------------------------------
$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/setup.php");
//---------------------------------------------------------------------------
error_reporting(1);
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

		<table class="width100">
		  <tr class="align-center">
		    <td style="width:8%;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/logo.gif" title="" alt="" /></td>
		    <td style="width:84%;">
			<span class="xx-large"><strong>PROMETHEE UPDATE V12</strong></span><br/>
		    </td>
		    <td style="width:8%;" class="valign-middle"><span class="xx-large"><strong><?php print("$step"); ?></strong></span></td>
		  </tr>
		</table>

	</div>

	<div class="maincontent">
	
<?php if($step == 1) { ?>
	<center>
	<h3>Migration des menus</h3>
	
	<div class="well" style="max-width: 500px; margin: 0 auto 10px; text-align: justify">
	<i><i class="icon-bullhorn"></i> La nouvelle version Prométhée intègre un nouveau systeme de menu, la diposition gauche-droite à été remplacé par une disposition gauche-haut. L'utilitaire de mise à jour repositionnera automatiquement les menus</i>
	</div>
	</center>
	<?php
	if ($mysql_link)
	{
		echo "<center><font color='green'>Connexion à la base MySQL réussie. Vous pouvez poursuivre la mise à jour!</font></center>";
	}
	?>
	<div class="well" style="max-width: 500px; margin: 0 auto 10px;">
		<button class="btn btn-large btn-block btn-primary" type="button" onclick="window.location = 'update_v12.php?step=2&menu=new'">Démarrer la mise à jour</button>
	</div>
	
	<br /><br />
	
	</div>
	
<?php } else if($step == 2) 
{
	if($menu == "new")
	{
		// Modification de la structure de la base
		$sql  = "ALTER TABLE `config` ADD `_bandeau` INT( 2 ) NOT NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `campus_data` ADD `_color` INT( 10 ) NOT NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` ADD `_nosemaine` INT( 10 ) NOT NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` ADD `_etat` INT( 10 ) NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		$sql  = "ALTER TABLE `edt_data` ADD `_IDx` INT( 10 ) NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` ADD INDEX ( `_IDx` )";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` CHANGE `_IDdata` `_IDdata` INT( 10 ) UNSIGNED NOT NULL";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` CHANGE `_IDx` `_IDx` INT( 10 ) NULL AUTO_INCREMENT";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` ADD INDEX ( `_IDx` )";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` DROP INDEX `PRIMARY`";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());	
		$sql  = "ALTER TABLE `edt_data` DROP INDEX `_IDx` , ADD PRIMARY KEY ( `_IDx` )";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `edt_data` DROP INDEX `_IDx_2`";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		
		$sql  = "ALTER TABLE `edt_data` ADD `_annee` INT( 10 ) NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `config_centre` ADD `_semaines` TEXT NOT NULL";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `config_centre` ADD `_vacances` TEXT NOT NULL";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `ctn_items` ADD `_type` INT( 11 ) NOT NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `ctn_items` ADD `_IDcours` INT( 11 ) NOT NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = "ALTER TABLE `ctn_items` ADD `_nosemaine` INT( 11 ) NOT NULL DEFAULT '0'";
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = 'update config_centre set _semaines = \'[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]\'';
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		$sql  = 'update config_centre set _vacances = \'{"start":[""],"end":[""]}\'';
		mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		
		// Mettre la fichier config à V12
		$fichier = "config.php";

		//ouverture en lecture et modification
		$text = fopen($fichier, 'r') or die("Fichier manquant");
		$contenu = file_get_contents($fichier);
		$contenuMod = str_replace('"11.1rc1";', '"12.0";', $contenu);
		$contenuMod = str_replace('"11.0rc1";', '"12.0";', $contenuMod);
		$contenuMod = str_replace('static	$MENUSKIN     = 0;', 'static	$MENUSKIN     = 1;', $contenuMod);
		fclose($text);

		//ouverture en écriture
		$text2 = fopen($fichier, 'w+') or die("Fichier manquant");
		fwrite($text2, $contenuMod);
		fclose($text2); 
		
		// Ajout paramètre mode portail/intranet
		$lines = file($fichier);
		$modetheme_exist = false;
		$btnleft_exist = false;
		$modetheme_finphp = 0;
		foreach ($lines as $line_num => $line) {
			if(strpos($line, '$MODETHEME') && !$modetheme_exist){
				$modetheme_exist = true;
			}
			if(strpos($line, '$BTNLEFT') && !$btnleft_exist){
				$btnleft_exist = true;
			}
			if(strpos($line, '?>')){
				$modetheme_finphp = $line_num;
			}
		}
		
		if(!$modetheme_exist && $btnleft_exist)
		{
			$lines[$line_num] = 'static  $MODETHEME	  = "intranet";	// portal ou intranet'.PHP_EOL;
			
		}
		
		if(!$btnleft_exist && $modetheme_exist)
		{
			$lines[$line_num] = 'static  $BTNLEFT	  = 1;	// affichage boutons gauche'.PHP_EOL;
			
		}
		
		if(!$btnleft_exist && !$modetheme_exist)
		{
			$lines[$line_num] = 'static  $MODETHEME	  = "intranet";	// portal ou intranet'.PHP_EOL;
			$lines[$line_num+1] = 'static  $BTNLEFT	  = 1;	// affichage boutons gauche'.PHP_EOL;
		}
		
		if(!$modetheme_exist || !$btnleft_exist)
		{
			$lines[] = "?>";
		}
		
		$txt = "";
		foreach($lines as $cle => $val)
		{
			$txt .= $val;
		}

		file_put_contents('config.php', $txt);
		
		// Disposition des menus
		$query  = "select _IDmenu from config_menu ";
		$query .= "order by _IDmenu";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		while ( $row ) {
			switch ($row[0]) {
				case "1": // MENU
					$Query  = "update config_menu ";
					$Query .= "set _order = '-1', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "2": // INFOS
					$Query  = "update config_menu ";
					$Query .= "set _order = '1', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "3": // DOCUMENTS
					$Query  = "update config_menu ";
					$Query .= "set _order = '-3', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "4": // ENTREPRISES
					$Query  = "update config_menu ";
					$Query .= "set _order = '-5', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "5": // AIDE EN LIGNE
					$Query  = "update config_menu ";
					$Query .= "set _order = '-9', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "6": // LIENS
					$Query  = "update config_menu ";
					$Query .= "set _order = '5', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "7": // SONDAGE
					$Query  = "update config_menu ";
					$Query .= "set _order = '9', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "8": // ADMINISTRATEUR
					$Query  = "update config_menu ";
					$Query .= "set _order = '-2', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "9": // FETE DU JOUR
					$Query  = "update config_menu ";
					$Query .= "set _order = '4', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "10": // RECHERCHER
					$Query  = "update config_menu ";
					$Query .= "set _order = '6', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "11": // _STUDENT
					$Query  = "update config_menu ";
					$Query .= "set _order = '-4', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "12": // QUI EST LA
					$Query  = "update config_menu ";
					$Query .= "set _order = '8', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "13": // STATS
					$Query  = "update config_menu ";
					$Query .= "set _order = '10', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "14": // LOGICIELS LIBRES
					$Query  = "update config_menu ";
					$Query .= "set _order = '15', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "15": // DU NOUVEAU ?
					$Query  = "update config_menu ";
					$Query .= "set _order = '4', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "16": // CALENDRIER
					$Query  = "update config_menu ";
					$Query .= "set _order = '3', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "17": // e-CAMPUS
					$Query  = "update config_menu ";
					$Query .= "set _order = '2', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "18": // BOITE A IDEES
					$Query  = "update config_menu ";
					$Query .= "set _order = '5', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "19": // e-GROUPES
					$Query  = "update config_menu ";
					$Query .= "set _order = '3', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "20": // MON ENT
					$Query  = "update config_menu ";
					$Query .= "set _order = '-2', _activate = 'O' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
				case "21": // DONATION
					$Query  = "update config_menu ";
					$Query .= "set _order = '12', _activate = 'N' ";
					$Query .= "where _IDmenu = '".$row[0]."' ";
					 mysql_query($Query, $mysql_link);
				break;
			}
			
			$row = remove_magic_quotes(mysql_fetch_row($result));
		}
		
		echo "<h1>Mise à jour effectuée</h1>";
	}
	?>	
<?php } ?>	
</div>

</body>
</html>