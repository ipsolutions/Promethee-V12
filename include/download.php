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
 *		module   : download.php
 *		projet   : gestion des logs de t�l�chargements
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 8/12/02
 *		modif    :  
 */
?>


<?php
//---------------------------------------------------------------------------
require_once $_SESSION["CFGDIR"]."/config.php";

require_once $_SESSION["ROOTDIR"]."/include/sqltools.php";
require_once $_SESSION["ROOTDIR"]."/include/logintools.php";
//---------------------------------------------------------------------------
function logDownloadFile($downloaded)
{
	/*
	 * fonction :	enregistre l'historique des fichiers t�l�charg�s
	 * in :		$downloaded : fichier � t�l�charger
	 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// connexion � la base de donn�es
	$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

	if ( $mysql_link ) {
		require_once $_SESSION["ROOTDIR"]."/include/urlencode.php";

		// lecture du poste client
		$id     = $_SESSION["CnxID"];
		$cnxip  = $_SESSION["CnxIP"];

		$file   = addslashes(trim(str_replace(Array("%20", "\'"), Array(" ", "'"), myurlencode($downloaded))));
//		$file   = addslashes(trim(myurlencode($downloaded)));

		// lecture du compteur des t�l�chargements
		$result = mysql_query("select _IDdown from download_data where _file = '$file' limit 1", $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		// date de dernier t�l�chargement
		$date   = date("Y-m-d H:i:s");

		// mise � jour du compteur des t�l�chargements
		if ( $row ) {
			if ( !mysql_query("update download_data set _count = _count + 1, _date = '$date' where _IDdown = '$row[0]'", $mysql_link) )
				sql_error($mysql_link);
			}
		else {
			if ( !mysql_query("insert into download_data values('', '$file', '1', '$date')", $mysql_link) )
				sql_error($mysql_link);

			$row[0] = mysql_insert_id();
			}

		// log des t�l�chargements par utilisateur
		if ( $row )
			if ( !mysql_query("insert into download values('$row[0]', '$id', '$cnxip', '1', '$date')", $mysql_link) )
				if ( !mysql_query("update download set _count = _count + 1, _IP = '$cnxip', _date = '$date' where _IDdown = '$row[0]' AND _ID = '$id'", $mysql_link) )
					sql_error($mysql_link);
		}
}
//---------------------------------------------------------------------------
function logDownloadError($downloaded)
{
	/*
	 * fonction :	enregistre l'historique des fichiers t�l�charg�s
	 * in :		$downloaded : fichier � t�l�charger
	 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// connexion � la base de donn�es
	$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

	if ( $mysql_link ) {
		require_once $_SESSION["ROOTDIR"]."/include/session.php";

		logSessionAccess();
		}
}
//---------------------------------------------------------------------------
function logTmpFile($file)
{
	/*
	 * fonction :	efface les fichiers temporaires
	 * in :		$time : d�lais avant suppression
	 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// connexion � la base de donn�es
	$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

	if ( $mysql_link ) {
		$date = date("Y-m-d H:i:s");

		// log des fichiers temporaires
		if ( !mysql_query("insert into download_tmp values('', '$file', '$date')", $mysql_link) )
			mysql_query("update download_tmp set _date = '$date' where _file = '$file'", $mysql_link);
		}
}
//---------------------------------------------------------------------------
function deleteTmpFile($time)
{
	/*
	 * fonction :	efface les fichiers temporaires
	 * in :		$time : d�lais avant suppression
	 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	// connexion � la base de donn�es
	$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

	if ( $mysql_link ) {
		$date = date("Y-m-d H:i:s", time() - $time);

		// compte utilisateur
		$query  = "select _IDfile, _file from download_tmp ";
		$query .= "where _date < '$date' ";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

		while ( $row ) {	
			if ( @unlink($row[1]) )
				mysql_query("delete from download_tmp where _IDfile = '$row[0]' limit 1", $mysql_link);

			$row = mysql_fetch_row($result);
			}				
		}
}
//---------------------------------------------------------------------------
?>
