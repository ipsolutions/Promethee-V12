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
   along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/
?>

<?php
/*
 *		module   : postit.php
 *		projet   : fonctions de manipulation des post-it
 *
 *		version  : 2.0
 *		auteur   : laporte
 *		creation : 18/10/03
 *		modif    : 22/01/06 - par D. Laporte
 *                     fonction canRead et canPost
 *		           17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


//---------------------------------------------------------------------------
function sendMessage($IDdst, $subject, $texte, $sign = "N", $priority = 0, $AR = "O")
{
/*
 * fonction :	envoie d'un post-it
 * in :		$IDdst, identifiant du destinataire (< 0 si liste de diffusion)
 *			$subject, sujet du message
 *			$texte, texte du message
 *			$sign, signer le message
 *			$AR, avec Accusé de Réception
 * out :		0 si erreur, ID post-it si OK
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	// date de création du message
	$date    = date("Y-m-d H:i:s");

	$subject = addslashes(trim($subject));
	$texte   = addslashes(trim($texte));

	$deldst  = ( $IDdst < 0 ) ? "O" : "N" ;
	$delexp  = ( $AR == "O" ) ? "N" : "O" ;

	$Query   = "insert into postit_items ";
	$Query  .= "values('', '0', '$IDdst', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '1', '$subject', '$texte', '$priority', '$sign', '$date', '$date', '$deldst', '$delexp', '$date')";

	// on interdit de s'écrire à soi même
	return ( $IDdst != $_SESSION["CnxID"] )
		? (mysql_query($Query, $mysql_link)
			? mysql_insert_id()
			: 0)
		: 0 ;
}
//---------------------------------------------------------------------------
function sendBroadcastEgroup($IDgroup, $IDdst, $subject, $texte, $sign, $priority = 0)
{
/*
 * fonction :	envoie d'un post-it aux membres d'un e-groupe
 * in :		$IDgroup, identifiant du e-groupe
 *			$IDdst, identifiant des destinataires
 *			$subject, sujet du message
 *			$texte, texte du message
 *			$sign, signer le message
 * out :		liste des ID des messages envoyés
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	$query  = "select _ID from egroup_user ";
	$query .= "where _IDdata = '$IDgroup' ";
	$query .= ( $IDdst > 0 ) ? "AND _access = '$IDdst'" : "AND _access > '0'" ;

	// sélection des destinataires
	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$IDlist = Array();

	// envoi des messages
	$count  = 0;
	while ( $row ) {
		if ( $insert = sendMessage($row[0], $subject, $texte, $sign, $priority, "N") )
			$IDlist[$count++] = $insert;

		$row = mysql_fetch_row($result);
		}

	// copie du message envoyé à la liste
	if ( $count )
		$IDlist[$count++] = sendMessage(-100000 - $IDgroup, $subject, $texte, $sign, $priority, "O"); 

	return $IDlist;
}
//---------------------------------------------------------------------------
function sendBroadcastCentre($IDcentre, $lidie, $subject, $texte, $sign, $priority = 0)
{
/*
 * fonction :	envoie d'un post-it à une liste de diffusion automatique
 * in :		$IDcentre, identifiant du centre
 *			$lidie, identifiant de la liste de diffusion
 *			$subject, sujet du message
 *			$texte, texte du message
 *			$sign, signer le message
 * out :		liste des ID des messages envoyés
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	if ( $lidie < -10000 ) {
		// liste des matières
		$IDlist = -($lidie + 10000);

		$query  = "select _ID from user_id ";
		$query .= "where _adm AND _sexe != 'A' ";
		$query .= "AND _IDmat like '% $IDlist %' ";
		}
	else
		if ( $lidie < -1000 ) {
			// liste des classes
			$IDlist = -($lidie + 1000);

			$query  = "select user_id._ID from user_id ";
			$query .= "where user_id._adm AND user_id._sexe != 'A' AND _IDgrp = '1' ";
			$query .= "AND user_id._IDclass = '$IDlist' AND user_id._IDcentre = '$IDcentre' ";
			}
		else {
			// liste des groupes
			$IDlist = -$lidie;

			$query  = "select _ID from user_id ";
			$query .= "where _adm AND _sexe != 'A' ";
			$query .= "AND _IDgrp = '$IDlist' AND (_IDcentre = '$IDcentre' OR _centre & pow(2, $IDcentre - 1)) ";
			}

	// sélection des destinataires
	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$IDlist = Array();

	// envoi des messages
	$count  = 0;
	while ( $row ) {
		if ( $insert = sendMessage($row[0], $subject, $texte, $sign, $priority, "N") )
			$IDlist[$count++] = $insert;

		$row = mysql_fetch_row($result);
		}

	// copie du message envoyé à la liste
	if ( $count )
		$IDlist[$count++] = sendMessage($lidie, $subject, $texte, $sign, $priority, "O"); 

	return $IDlist;
}
//---------------------------------------------------------------------------
function sendBroadcast($lidie, $subject, $texte, $sign = "N", $priority = 0)
{
/*
 * fonction :	envoie d'un post-it à une liste de diffusion personnelle
 * in :		$lidie, identifiant de la liste de diffusion
 *			$subject, sujet du message
 *			$texte, texte du message
 *			$sign, signer le message
 * out :		liste des ID des messages envoyés
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	// accusé de réception
	$result = mysql_query("select _AR from postit_lidi where _IDlidi = '$lidie'", $mysql_link);
	$mylist = ( $result ) ? mysql_fetch_row($result) : 0 ;

	// envoi des messages
	$query  = "select _ID from postit_address ";
	$query .= "where _IDlidi = '$lidie'";

	// sélection des destinataires
	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	$IDlist = Array();

	// envoi des messages
	$count  = 0;
	while ( $row ) {
		if ( $insert = sendMessage($row[0], $subject, $texte, $sign, $priority, $mylist[0]) )
			$IDlist[$count++] = $insert;

		$row = mysql_fetch_row($result);
		}

	// copie du message envoyé à la liste
	if ( $count )
		$IDlist[$count++] = sendMessage(-10000 - $lidie, $subject, $texte, $sign, $priority, "O"); 

	return $IDlist;
}
//---------------------------------------------------------------------------
function sendAlertMessage($IDdst, $subject, $texte)
{
/*
 * fonction :	envoie d'un post-it d'alerte
 * in :		$IDdst, identifiant du destinataire
 *			$subject, sujet du message
 *			$texte, texte du message
 * out :		0 si erreur, 1 si OK
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	if ( $IDdst ) {
		// date de création du message
		$date    = date("Y-m-d H:i:s");

		$subject = addslashes(trim($subject));
		$texte   = addslashes(trim($texte));

		$Query   = "insert into postit_items ";
		$Query  .= "values('', '0', '$IDdst', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '0', '$subject', '$texte', '1', 'N', '$date', '$date', 'N', 'O', '$date')";

		return mysql_query($Query, $mysql_link);
		}

	return 0;
}
//---------------------------------------------------------------------------
function sendWarningMessage($subject, $texte)
{
/*
 * fonction :	envoie d'un post-it d'alerte au webmaster
 * in :		$IDdst, identifiant du destinataire
 *			$subject, sujet du message
 *			$texte, texte du message
 * out :		0 si erreur, 1 si OK
 */
	require $_SESSION["ROOTDIR"]."/globals.php";

	// recherche du webmaster
	$result = mysql_query("select _ID from user_id where _adm = '255' order by _ID limit 1", $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	return sendAlertMessage((int) $row[0], $subject, $texte);
}
//---------------------------------------------------------------------------
function canRead($IDdst)
{
/*
 * fonction :	détermine si un utilisateur possède les droits de lecture des post-it
 * in :		$IDdst : ID du destinataire
 * out :		true si droit ok, false sinon
 */

	global	$mysql_link;

	// recherche des droits de lecture du destinataire
	$Query  = "select distinctrow user_id._IDgrp, postit._IDgrprd ";
	$Query .= "from user_id, postit ";
	$Query .= "where user_id._ID = '$IDdst' ";
	$Query .= "AND user_id._IDcentre = postit._IDcentre ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	return (bool) ($row[1] & pow(2, $row[0] - 1));
}
//---------------------------------------------------------------------------
function canPost($IDpost)
{
/*
 * fonction :	détermine si un utilisateur possède les droits d'écriture des post-it
 * in :		$IDpost : ID de l'expéditeur
 * out :		true si droit ok, false sinon
 */

	global	$mysql_link;

	// les anonymes ne peuvent écrire
	if ( $_SESSION["CnxSex"] != "A" ) {
		// recherche des droits d'écriture de l'expéditeur
		$Query  = "select distinctrow user_id._IDgrp, postit._IDgrpwr ";
		$Query .= "from user_id, postit ";
		$Query .= "where user_id._ID = '$IDpost' ";
		$Query .= "AND user_id._IDcentre = postit._IDcentre ";
		$Query .= "limit 1";

		$result = mysql_query($Query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		return (bool) ($row[1] & pow(2, $row[0] - 1));
		}

	return false;
}
//---------------------------------------------------------------------------
function newMail()
{
/*
 * fonction :	affichage des nouveaux postit sur la page
 */

	global	$mysql_link;

	require_once $_SESSION["ROOTDIR"]."/include/calendar_tools.php";

	require $_SESSION["ROOTDIR"]."/msg/postit.php";
	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/postit.php");

	// si l'utiisateur n'et pas identifié : on quitte
	if ( !$_SESSION["CnxID"] )
		return;

	// date et heure du jour
	$date   = date("Y-m-d H:i:s");

	// recherche des post-it à afficher
	$Query  = "select _IDpost, _IDexp, _IP, _date, _titre, _vu from postit_items ";
	$Query .= "where _IDdst = '".@$_SESSION["CnxID"]."' AND _date = _ack ";
	$Query .= "AND (_timer = _date OR _timer <= '$date') ";
	$Query .= "order by _IDpost desc ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$postit = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	if ( $postit ) {
		// acquittement de lecture
		if ( $postit[3] == $postit[5] )
			mysql_query("update postit_items set _vu = '$date' where _IDpost = '$postit[0]'", $mysql_link);

		// lecture Pièce Jointe
		$res = mysql_query("select _IDpj from postit_pj where _IDpost = '$postit[0]'", $mysql_link);
		$pj  = ( mysql_numrows($res) ) ? "<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/pj.gif\" title=\"\" alt=\"*\" />" : "" ;

		// lecture expéditeur
		$res = mysql_query("select _name, _fname, _IDgrp from user_id where _id = '$postit[1]' limit 1", $mysql_link);
		if ( $postit[1] ) {
			$who    = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

			$name   = $who[0] . (($who[1] != "" ) ? ", $who[1]" : "");
			$smiley = "<img src=\"".$_SESSION["ROOTDIR"]."/images/smiley/$who[2].gif\" title=\"\" alt=\"\" />";
			}
		else {
			$name   = $msg->read($POSTIT_MSGSYS);
			$smiley = "<img src=\"".$_SESSION["ROOTDIR"]."/images/ip.gif\" title=\"\" alt=\"\" />";
			}

		print("
			<div style=\"margin-left:15%; margin-bottom:20px;\">
			<table summary=\"\" width=\"80%\" cellspacing=\"1\" cellpadding=\"2\">
			  <tr style=\"background-color:#C0C0C0;\">
				<td align=\"right\" style=\"width:20%;\">
					".$msg->read($POSTIT_EXP)."<br/>
		                  ".$msg->read($POSTIT_POSTED)."
				</td>
				<td align=\"left\" style=\"width:80%;\">
					$name $smiley<br/>".date2longfmt($postit[3])." "._getHostName($postit[2])."
				</td>
			  </tr>

			  <tr>
				<td style=\"border: 1px solid #c0c0c0;\" valign=\"middle\" align=\"center\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/warning.png\" title=\"\" alt=\"\" />
				</td>
				<td style=\"border: 1px solid #c0c0c0;\" valign=\"top\">
					<strong>$postit[4]</strong> $pj

					<p style=\"margin-top:10px;\">
					<img src=\"".$_SESSION["ROOTDIR"]."/images/info.gif\" title=\"\" alt=\"\" />
		                  ".$msg->read($POSTIT_ACK, "index.php?item=4&amp;IDpost=$postit[0]&amp;cmde=visu")."
					</p>
				</td>
			  </tr>
			</table>
			</div>
			");
		}
}
//---------------------------------------------------------------------------
?>
