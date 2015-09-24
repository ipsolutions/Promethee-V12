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
 *		module   : config_init.php
 *		projet   : la page de configuration intranet
 *
 *		version  : 2.0
 *		auteur   : laporte
 *		creation : 16/01/03
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */

// début de session
session_start();

$step    = ( @$_POST["step"] )					// étape d'installation
	? (int) $_POST["step"]
	: 1 ;

$ident   = addslashes(trim(@$_POST["ident"]));		// nom de l'établissement
$adresse = addslashes(trim(@$_POST["adresse"]));	// adresse de l'établissement
$zip     = addslashes(trim(@$_POST["zip"]));		// code postal de l'établissement
$city    = addslashes(trim(@$_POST["city"]));		// ville de l'établissement
$tel     = addslashes(trim(@$_POST["tel"]));		// téléphone de l'établissement
$fax     = addslashes(trim(@$_POST["fax"]));		// fax de l'établissement
$web     = addslashes(trim(@$_POST["web"]));		// site web de l'établissement
$email   = addslashes(trim(@$_POST["email"]));		// email de l'établissement

$IDtheme = @$_POST["IDtheme"];				// thème de l'interface
?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require_once "include/setup.php";

	require "msg/config.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/config.php");
?>

<div style="margin-top:40px; margin-left:15%; margin-right:15%;">

	<div class="maintitle" style="background-image:url('css/themes/header/streak7.gif'); background-repeat:repeat;">

		<table class="width100">
		  <tr class="align-center">
		    <td style="width:1%;"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/logo.gif" alt="" title="" /></td>
		    <td>
			<span class="xx-large"><strong>PROMETHEE</strong></span><br/>
			<?php print($msg->read($CONFIG_FORMFEED)); ?>
		    </td>
		  </tr>
		</table>

	</div>

	<div class="maincontent">
	<?php
		// l'utilisateur a validé
            if ( $step == 2 ) {
			// controle de la saisie de l'utilisateur
			$isok = (bool) (strlen($ident) AND strlen($adresse) AND strlen($zip) AND strlen($city) AND strlen($tel));

			// si c'est pas bon on reboucle à l'étape 1
			if ( !$isok )
				$step = 1;
			else
				updateconfigfile(
					$SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT,
					$ident, $adresse, $tel, $fax, $email, $web, $zip, $city, $IDtheme);
            	}

            if ( $step == 3 ) {
			mysql_query("update config_centre set _visible = 'N'", $mysql_link);
			mysql_query("update campus_classe set _visible = 'N'", $mysql_link);

			$nbcount = 0;
			$cb      = @$_POST["cb"];		// les cases à cocher des centres constitutifs
			for ($i = 0; $i < count($cb); $i++)
				if ( @$cb[$i] ) {
					if ( mysql_query("update config_centre set _visible = 'O' where _IDcentre = '". $cb[$i] ."' AND _lang = '".$_SESSION["lang"]."' limit 1", $mysql_link) )
						mysql_query("update campus_classe set _visible = 'O' where _IDcentre = '". $cb[$i] ."'", $mysql_link);

					$nbcount++;
					}

			if ( $nbcount ) {
				// tout est correct
				$query  = "select distinctrow config_centre._IDcentre, config_def._text ";
				$query .= "from config_centre, config_def ";
				$query .= "where config_centre._visible = 'O' AND config_centre._lang = '".$_SESSION["lang"]."' ";
				$query .= "AND config_centre._IDcentre = config_def._IDcentre ";
				$query .= "AND config_def._ident = '_STUDENT' AND config_def._lang = '".$_SESSION["lang"]."' ";
				$query .= "order by config_centre._IDcentre limit 1";

				$result = mysql_query($query, $mysql_link);
				$cfg    = ( $result ) ? mysql_fetch_row($result) : 0 ;

				// mise à jour des comptes test de connexion
				if ( $cfg ) {
					mysql_query("update user_id set _IDcentre = '$cfg[0]'", $mysql_link);
					mysql_query("update user_id set _ident = '$cfg[1]', _name = '". ucfirst(strtolower($cfg[1])) ."' where _ID = '3' limit 1", $mysql_link);

					mysql_query("update forum_data set _title = '". ucfirst(strtolower($cfg[1])) ."' where _title = '_STUDENT'", $mysql_link);
					}

				$result = mysql_query("select _ident, _passwd from user_id where _adm = '255'", $mysql_link);
				$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

				print("
					<p style=\"text-align:justify;\">".
					$msg->read($CONFIG_OKSTEP1, Array(
						"<img src=\"".$_SESSION["ROOTDIR"]."/images/dot.gif\" title=\"\" alt=\"*\" />",
						$DATABASE,
						"<img src=\"".$_SESSION["ROOTDIR"]."/images/dot.gif\" title=\"\" alt=\"*\" />",
						$cfg[1],
						$DATABASE,
						$row[0],
						"index.php?item=-1")) ."
					</p>
					");
				}
			// si c'est pas bon on reboucle à l'étape 2
			else
				$step = 2;
            	}

		// saisie de la configuration
		require "config_new.php";
	?>
      </div>

	</div>

</body>
</html>
