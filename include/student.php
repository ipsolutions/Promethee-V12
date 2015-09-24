<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : student.php
 *		projet   : gestion des identifiants �l�ves
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/12/09
 *		modif    : 
 */


//---------------------------------------------------------------------------
function getStudentRegime($regime)
{
/*
 * fonction :	mise � jour de session
 * in :		$sessID, identifiant de session
 *			$ghost, utilisateur visible dans la liste des connect�s
 * out :		identifiant de session
 */

	require $_SESSION["ROOTDIR"]."/msg/student.php";
	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/student.php");

	$reg[0] = Array('E', 'I', 'D', 'C');
	$reg[1] = explode(",",  $msg->read($STUDENT_STUDENTSTATUS));

	for ($j = 0; $j < count($reg[0]); $j++)
		if ( $regime == $reg[0][$j] )
			return $reg[1][$j];

	return "??";
}
//---------------------------------------------------------------------------
function getStudentOffence($IDeleve, $IDclass, $iddata = 1, $from = "", $to = "")
{
/*
 * fonction :	d�termine le nombre de retards, d'absences, ... d'un �l�ve
 * in :		$IDeleve : identifiant �l�ve, $IDclass : identifiant classe, $iddata : identifiant cause, $from : date de d�but, $to : date de fin
 * out :		nombre de retards, d'absences, ...
 */

	include $_SESSION["ROOTDIR"]."/globals.php";

	$query  = "select absent_items._IDabs ";
	$query .= "from user_id, absent_items, absent_data, campus_classe ";
	$query .= "where absent_data._IDdata = '$iddata' ";
	$query .= "AND user_id._IDgrp = '1' ";
	$query .= "AND user_id._ID = '$IDeleve' ";
	$query .= "AND user_id._IDclass = '$IDclass' ";
	$query .= ( $from != "" AND $to != "" ) ? "where (absent_items._start >= '$from' AND absent_items._end <= '$to') " : "" ;
	$query .= "AND user_id._ID = absent_items._IDabs ";
	$query .= "AND absent_items._IDctn ";
	$query .= "AND absent_data._IDdata = absent_items._IDdata ";
	$query .= "AND user_id._IDclass = campus_classe._IDclass ";
	$query .= "AND absent_data._lang = '".$_SESSION["lang"]."' ";

	$return = mysql_query($query, $mysql_link);
	$nbrow  = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

	return $nbrow;
}
//---------------------------------------------------------------------------
?>