<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

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
 *		module   : session.php
 *		projet   : gestion des identifiants de session
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 17/03/02
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


// remarque : depuis PHP 4, il existe une biblioth�que de gestion de sessions int�gr�e...

//---------------------------------------------------------------------------
function getmicrotime()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float) $usec + (float) $sec);
}
//---------------------------------------------------------------------------
function isSessionVisible($sid)
{
/*
 * fonction :	indique si l'utilisateur est loggu� en fant�me
 * in :		$sid, id de session
 * out :		vrai si session visible, faux sinon
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	// l'identifiant de connexion a �t� mise � jour dans la page login
	$Query  = "select _visible from user_session ";
	$Query .= "where _IDsess = '$sid'";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	return ( $row[0] == "O" ) ? true : false ;
}
//---------------------------------------------------------------------------
function SessionID($length = 10, $Pool = "")
{
/*
 * fonction :	cr�ation d'un identifiant de session
 * in :		$length, longueur de l'identifiant de session
 *			$Pool, cha�ne de caract�res al�atoires
 * out :		identifiant de session
 */
	// D�finition d'un jeu de caract�res possibles
	if ( !strlen($Pool) )
	{
		$Pool  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$Pool .= "abcdefghijklmnopqrstuvwxyz";
	}

	// tirage al�atoire
	$sid = "";
	for($index = 0; $index < $length; $index++)
            $sid .= substr($Pool, rand() % strlen($Pool), 1);

	// renvoie de l'identifiant
	return $sid;
}
//---------------------------------------------------------------------------
function eraseSessionID($sessID = "")
{
/*
 * fonction :	efface la session
 * in :		$sessID, identifiant de session
 * out :		identifiant actuel si �chec, nul sinon
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// connexion � la base de donn�es
	$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

	if ( !$mysql_link )
		return $sessID;

	// d�connexion de la session
	$Query  = "UPDATE user_session ";
	$Query .= "SET _action = 'D' ";
	$Query .= ( $sessID ) ? "WHERE _IDsess = '$sessID'" : "" ;

	if ( $DEBUG )
		print("$Query<br/>");

	if ( !mysql_query($Query, $mysql_link) )
	{
		sql_error($mysql_link);
		return $sessID;
	}

	return "";
}
//---------------------------------------------------------------------------
function createSessionID($visible = "O")
{
/*
 * fonction :	cr�ation de session
 * in :		$sessID, identifiant de session
 *			$visible, utilisateur visible dans la liste des connect�s
 * out :		identifiant de session
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	// on �vite les doublons sur une connexion/d�connexion
	// sauf en mode DEMO
	// ou pour les utilisateurs anonymes qui peuvent se logguer � plusieurs sous le m�me identifiant
	if ( !$DEMO )
		if ( $_SESSION["CnxSex"] != "A" )
			mysql_query("delete from user_session where _ID = '".$_SESSION["CnxID"]."'", $mysql_link);

	// cr�ation de la session
	$sessID  = SessionID();

	// mise � jour de la date de session
	$lastupd = date("Y-m-d H:i:s");

	// les anonymes
	$anonyme = ( $_SESSION["CnxSex"] == "A" ) ? "O" : "N" ;

	// insertion d'une session dans la base de donn�es
	// l'identifiant de connexion CnxID a �t� mise � jour dans la page user_login
	$Query   = "INSERT INTO user_session ";
	$Query  .= "VALUES('$sessID', '$lastupd', '".$_SESSION["CnxID"]."', '$visible', '$anonyme', 'C', '".$_SESSION["CnxIP"]."')";

	if ( $DEBUG )
		print("New session : $Query<br/>");

	if ( !mysql_query($Query, $mysql_link) )
	{
		sql_error($mysql_link);
     	     	$sessID = "";
	}

	return $sessID;
}
//---------------------------------------------------------------------------
function timeoutSession($id)
{
/*
 * fonction :	indique si un compte � d�pass� sa dur�e d'inscription
 * in :		$id : ID de connexion de l'utilisateur
 * out :		true si timeout, false sinon
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// suppression des comptes inactifs
	if ( $AUTODEL ) {
		$date = date("Y-m-d H:i:s", time() - ($AUTODEL * 3600));

		// compte utilisateur
		$query  = "delete from user_id ";
		$query .= "where _lastcnx = '0000-00-00 00:00:00' ";
		$query .= "AND _create < '$date' ";

		mysql_query($query, $mysql_link);
		}

	$date   = date("Y-m-d H:i:s");

	// compte utilisateur
	$query  = "select _delay, _IDgrp from user_id ";
	$query .= "where _ID = '$id' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $row[0] != "0000-00-00 00:00:00" )
		if ( $row[0] < $date )
			return true;

	// groupe utilisateur
	$query  = "select _delay from user_group ";
	$query .= "where _IDgrp = '$row[1]' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $row[0] != "0000-00-00 00:00:00" )
		if ( $row[0] < $date )
			return true;

	return false;
}
//---------------------------------------------------------------------------
function updateSessionID($sessID, $ghost = "")
{
/*
 * fonction :	mise � jour de session
 * in :		$sessID, identifiant de session
 *			$ghost, utilisateur visible dans la liste des connect�s
 * out :		identifiant de session
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	require $_SESSION["ROOTDIR"]."/msg/user.php";
	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/user.php");

	// connexion � la base de donn�es
	$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

	if ( !$mysql_link )
		return "";

	// initialisation
	$visible = ( $ghost ) ? "N" : "O" ;

	// suppression de toutes les anciennes sessions ( < 30 minutes )
	$Query  = "DELETE FROM user_session ";
	$Query .= "WHERE _lastaction < '". date("Y-m-d H:i:s", (time() - $TIMELIMIT)) ."' ";

	if ( $DEBUG )
		print("$Query<br/>");

	if ( !mysql_query($Query, $mysql_link) )
	{
		sql_error($mysql_link);
		return "";
	}

	// Si la session est vide, il faut la cr�er
	if ( !strlen($sessID) )
	{
		// cr�ation de la session
		$sessID = createSessionID($visible);
	}
	// sinon v�rification de la session existante
	else
	{
		// on v�rifie si la session est en timeout
		if ( timeoutSession($_SESSION["CnxID"]) )
			return "";

		// si la session existe, il faut l'examiner
		$Query  = "SELECT _action ";
		$Query .= "FROM user_session ";
		$Query .= "WHERE _IDsess = '$sessID' ";
		$Query .= "limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// la session a �t� trouv�e
		if ( $row )
		{
			if ( $DEBUG )
				print($msg->read($USER_SESSION, $Query) ."<br/>");

			// si l'utilisateur a �t� d�connect�, on l'�jecte
			if ( $row[0] == "D" )
			{
				$Query  = "DELETE FROM user_session ";
				$Query .= "WHERE _IDsess = '$sessID' ";
				$Query .= "limit 1";

				print("<p style=\"color:#FF0000; text-align: center\">". $msg->read($USER_DISCONNECTED) ."</p>");
	     	      	$sessID = "";
			}
			// sinon on met � jour la derni�re action
			else
			{
				$anonyme = ( $_SESSION["CnxSex"] == "A" ) ? "O" : "N" ;

				$Query   = "UPDATE user_session ";
				$Query  .= "SET _lastaction = '". date("Y-m-d H:i:s"). "', ";
				$Query  .= "_IP = '".$_SESSION["CnxIP"]."', ";
				$Query  .= "_ID = '".$_SESSION["CnxID"]."', ";
				$Query  .= "_anonyme = '$anonyme' ";
				$Query  .= ( isset($ghost) ) ? ", _visible = '$visible' " : "" ;
				$Query  .= "WHERE _IDsess = '$sessID' ";
				$Query  .= "limit 1";
			}

			if ( $DEBUG )
				print("$Query<br/>CnxID ".$_SESSION["CnxID"].".<br/>");

			if ( !mysql_query($Query, $mysql_link) )
				sql_error($mysql_link);
		}
		//la session est en timeout
		else
		{
			// Si la session n'est pas limit�e dans le temps
			if ( @$_SESSION["CnxPers"] == 'O' )
			{
				// cr�ation de la session pour le mode autologin
				$sessID = createSessionID($visible);
			}
			else
			{
				mysql_query("insert into stat_log values('".date("Y-m-d H:i:s")."', '".$_SESSION["CnxID"]."', '', '".@$_SERVER["REMOTE_ADDR"]."', 'E')", $mysql_link);

	           		// mauvaise session : on doit demander une identification car le d�lai a expir�
				print("<p style=\"color:#FF0000; text-align: center\">". $msg->read($USER_TIMEOUT) ."Bad Session ID ($sessID)!</p>");
	     	      	$sessID = "";
			}
		}
	}

	return $sessID;
}
//---------------------------------------------------------------------------
function sizeofSessionID($visible = "", $anonyme = "")
{
/*
 * fonction :	d�termine le nombre de sessions ouvertes
 * in :		$visible, utilisateur fant�me
 * out :		nombre de session
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// connexion � la base de donn�es
	$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

	if ( $mysql_link ) {
		$Query  = "SELECT _ID ";
		$Query .= "FROM user_session ";
		$Query .= "where _action = 'C' ";
		$Query .= ( $visible ) ? "AND _visible = '$visible' " : "" ;
		$Query .= ( $anonyme ) ? "AND _anonyme = '$anonyme' " : "" ;

		$result = mysql_query($Query, $mysql_link);

		return ( $result ) ? mysql_numrows($result) : 0 ;
		}

	return 0;
}
//---------------------------------------------------------------------------
function admSessionAccess($adm = 0)
{
/*
 * fonction :	v�rification des droits d'acc�s admin � un module
 * in :		$adm : niveau d'autorisation
 */

	if ( $_SESSION["CnxAdm"] == 255 )
		return true;

	if ( $adm )
		if ( $_SESSION["CnxAdm"] & $adm )
			return true;

	logSessionAccess();
}
//---------------------------------------------------------------------------
function verifySessionAccess($idmod, $grprd = 0, $grpwr = 0)
{
/*
 * fonction :	v�rification des droits en lecture � un module
 * in :		$idmod : ID du mod�rateur, $grprd : groupe des lecteurs
 */

	if ( $_SESSION["CnxAdm"] == 255 )
		return true;

	if ( $idmod )
		if ( $_SESSION["CnxID"] == $idmod )
			return true;

	if ( $grprd )
		if ( $grprd & pow(2, $_SESSION["CnxGrp"] - 1) )
			return true;

	if ( $grpwr )
		if ( $grpwr & pow(2, $_SESSION["CnxGrp"] - 1) )
			return true;

	logSessionAccess();
}
//---------------------------------------------------------------------------
function logSessionAccess()
{
/*
 * fonction :	enregistrement des erreurs d'autorisation sur les modules
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	$item = ( @$_GET["item"] )		// item des menus
		? (int) $_GET["item"]
		: (int) @$_POST["item"] ;

	$cmde = ( @$_POST["cmde"] )		// option sur les items du menu
		? $_POST["cmde"]
		: @$_GET["cmde"] ;

	// l'identifiant de connexion a �t� mise � jour dans la page login
	$Query  = "insert into ip_logerr ";
	$Query .= "values('', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '".date("Y-m-d H:i:s")."', '".$_SESSION["CnxAdm"]."', '".$_SESSION["CnxName"]."', '$item', '$cmde')";

	mysql_query($Query, $mysql_link);

	print("Access error... ".$_SESSION["CnxName"]." [".$_SESSION["CnxAdm"]."] @ ".@$_SERVER["REMOTE_ADDR"]." (".gethostbyaddr(@$_SERVER["REMOTE_ADDR"]).") - ".date("Y-m-d H:i:s"));

	exit;
}
//---------------------------------------------------------------------------
?>