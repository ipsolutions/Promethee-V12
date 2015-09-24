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
 *		module   : index_mobile.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php include("mobile_banner.php"); ?>

<?php
require "msg/user.php";
require_once "include/TMessage.php";

$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_GET["lang"]."/user.php");
$erreur_mobile = "";
	
if($_POST)
{
	$id       = ( @$_POST["id"] )		// ID utilisateur
		? $_POST["id"]
		: @$id ;

	$pwd      = ( @$_POST["pwd"] )	// mot de passe
		? $_POST["pwd"]
		: @$pwd ;

	$id       = addslashes(trim($id));
	$pwd      = addslashes(trim($pwd));

	// pour éviter les injections SQL
	$pwd = str_replace(" ", "-", trim($pwd));

	// vérification de l'identité
	$query  = "select _ID, _date, _cnx, _persistent, _sexe, _adm, _IDcentre, _name, _IDgrp, _passwd, _signature, _delay, _fname, _IDclass ";
	$query .= "from user_id ";
	// - si un mode d'authentification externe est trouvé
	// - et l'utilisateur authentifié
	if ( isset ($bAuthMode) )
		$query .= ( $bAuthentifie == false )
			// on supprime $id ainsi on lui recharge le formulaire de login
			? "where _ident = '' "
			// le mot de passe n'est plus indispensable	
			: "where _ident = '$id' " ;
	else
		$query .= "where _ident = '$id' AND _passwd = '$pwd' ";
	$query .= "limit 1";

	if ( $DEBUG )
		print($query);

	$result = mysql_query($query, $mysql_link);

	// a-t-on trouvé une valeur ?
	if ( mysql_affected_rows($mysql_link) == 1 ) {
		$row    = remove_magic_quotes(mysql_fetch_row($result));

		// on récupère les informations sur l'utilisateur...
		// attention aux comptes non validés
		if ( $row[5] AND !timeoutSession($row[0]) ) {
			$_SESSION["CnxID"]     = $row[0];						// ID de l'utilisateur
			$_SESSION["CnxPers"]   = $row[3];						// connexion persistante pour l'utilisateur
			$_SESSION["CnxSex"]    = $row[4];						// Sexe de l'utilisateur (A pour une connexion Anonyme)
			$_SESSION["CnxAdm"]    = $row[5];						// Droits de connexion de l'utilisateur
			$_SESSION["CnxCentre"] = $row[6];						// centre de formation
			$_SESSION["CnxName"]   = formatUserName($row[7], $row[12]);		// Nom de connexion de l'utilisateur
			$_SESSION["CnxGrp"]    = $row[8];						// Groupe de connexion de l'utilisateur
			$_SESSION["CnxPasswd"] = $row[9];						// mot de passe (vérification si vide)
			$_SESSION["CnxSign"]   = $row[10];						// signature forum, ...
			$_SESSION["CnxClass"]  = $row[13];						// classe de l'élève
			}

		// ... puis on met à jour la date de dernière connexion
		$date    = date("Y-m-d H:i:s");

		$query   = "update user_id ";
		if ( !timeoutSession($row[0]) ) {
			$query  .= "set _lastcnx = ";
			$query  .= ( $row[2] ) ? "'$row[1]', " : "'$date', " ;
			$query  .= "_date = '$date', ";
			$query  .= "_cnx = _cnx + 1 ";
			$query  .= "where _ID = '".$_SESSION["CnxID"]."' ";
			}
		else {
			$query  .= "set _adm = '0' ";
			$query  .= "where _ID = '$row[0]' ";
			}
		$query  .= "limit 1";

		if ( !mysql_query($query, $mysql_link) )
			sql_error($mysql_link);
		else {
			// vérification du mode maintenance
			if ( $MAINTENANCE AND $row[5] != 255 )
				$erreur_mobile = "<p style=\"color:#FF0000\">". $msg->read($USER_NOPERM) ."</p>";	          
			else {
				// recherche des droits d'accès
				$query  = "select _dstart, _dend, _hstart, _hend from user_denied ";
				$query .= "where _IDcentre = '".$_SESSION["CnxCentre"]."' AND _IDgrp = '".$_SESSION["CnxGrp"]."' ";
				$query .= "limit 1";

				@mysql_query($query, $mysql_link);

				if ( mysql_affected_rows($mysql_link) AND $row[5] != 255 )
					$erreur_mobile = "<p style=\"color:#FF0000;\">". $msg->read($USER_DENIED) ."</p>";
				else
					// vérification du compte
					if ( $_SESSION["CnxAdm"] ) {
						// enregistrement de l'adresse IP de connexion
						$_SESSION["CnxIP"]  = SessionIP();

						if ( !mysql_query("update user_id set _IP = '".$_SESSION["CnxIP"]."' where _ID = '".$_SESSION["CnxID"]."' limit 1", $mysql_link) )
							sql_error($mysql_link);

						// enregistrement de la session de l'utilisateur 
						$_SESSION["sessID"] = updateSessionID(@$_SESSION["sessID"]);

						// enregistrement des logs
						if ( $TIMELOG ) {
							// on efface les logs trops anciens
							$Query  = "DELETE FROM stat_log ";
							$Query .= "WHERE _date < '". date("Y-m-d H:i:s", (time() - $TIMELOG)) ."' ";
					
							if ( !mysql_query($Query, $mysql_link) )
								sql_error($mysql_link);
							}

						if ( !mysql_query("insert into stat_log values('".date("Y-m-d H:i:s")."', '".$_SESSION["CnxID"]."', '', '".@$_SERVER["REMOTE_ADDR"]."', 'C')", $mysql_link) )
							sql_error($mysql_link);

						// accés au menu de l'intranet
						$erreur_mobile = "<script type=\"text/javascript\"> window.location.replace('mobile.php', '_self'); </script>";
						}
					else
						$erreur_mobile = "<p style=\"color:#FF0000;\"><strong>". $msg->read($USER_ACCOUNTCLOSE) ."</strong></p>";
				}
			}
		}    
	// sinon on affiche l'erreur        
	else {
	if ( $HOSTING AND !$idschool )
		$erreur_mobile = "<p style=\"color:#FF0000;\"><strong>". $msg->read($USER_NOTVALIDSCHOOL) ."</strong></p>";
	else {
		$erreur_mobile = "<p style=\"color:#FF0000; text-align: center\"><strong>Erreur Login / Password</strong></p>";

		// on trace...
		mysql_query("insert into stat_log values('".date("Y-m-d H:i:s")."', '".$_SESSION["CnxID"]."', '$id', '".@$_SERVER["REMOTE_ADDR"]."', 'X')", $mysql_link);
		}
	}
}

echo "<div style=\"background-color: white\"><center>$my_logo</center></div>";

?>

<div id="popupLogin" class="ui-corner-all ui-popup ui-body-a ui-overlay-shadow" style="margin: 5%">
	<form id="formulaire" class="form-signin" method="POST" action="index_mobile.php">
		<div style="padding:10px; 20px">
			<h3>Connexion</h3>
			<label class="ui-hidden-accessible ui-input-text" for="un">Username:</label>
			<div class="ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow ui-body-a">
				<input id="ID" class="ui-input-text ui-body-a" type="text" placeholder="Identifiant" value="" name="id">
			</div>
			<label class="ui-hidden-accessible ui-input-text" for="pw">Password:</label>
			<div class="ui-input-text ui-shadow-inset ui-corner-all ui-btn-shadow ui-body-a">
				<input id="PW" class="ui-input-text ui-body-a" type="password" data-theme="a" placeholder="Mot de passe" value="" name="pwd">
			</div>

				<button class="ui-submit ui-btn ui-shadow ui-btn-corner-all ui-btn-icon-left ui-btn-up-b" data-icon="check" data-theme="b" type="submit" style="width:100%; padding: 5%; font-size: 16px">Valider</button>

		</div>
	</form>
</div>

<?php echo $erreur_mobile; ?>

<?php include("mobile_footer.php"); ?>