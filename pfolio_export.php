<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2008-2009 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : pfolio_export.php
 *		projet   : la page d'export des compétences du portfolio
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 26/01/08
 *		modif    : 
 */

// signale au navigateur un fichier XML
header("Content-Type: text/xml");

//---------------------------------------------------------------------------
require_once "config.php";
require_once "globals.php";
//---------------------------------------------------------------------------
require_once "include/sqltools.php";
//---------------------------------------------------------------------------
function remove_magic_quotes($array)
{
	/*
	 * fonction :	nettoyage des \ dans une chaîne
	 * in :		$array : tableau de valeurs
	 */

	// On n'exécute la boucle que si nécessaire
	if ( $array AND get_magic_quotes_gpc() == 1 )
		foreach($array as $key => $val) {
			// Si c'est un array, recursion de la fonction, sinon suppression des slashes
			if ( is_array($val) )
				remove_magic_quotes($array[$key]);
			else
				if ( is_string($val) )
					$array[$key] = stripslashes($val);
			}

	return $array;
}
//---------------------------------------------------------------------------

// connexion à la base de données
$mysql_link = connectDatabase($SERVER, $USER, $PASSWD, $DATABASE, $SERVPORT, $PERSISTENT);

if ( $mysql_link ) {
	// lecture des paramètres de configuration générale
	$query  = "select _name, _fname, _born, _adr1, _adr2, _cp, _ville, _tel, _email ";
	$query .= "from user_id ";
	$query .= "where user_id._ID = '".@$_GET["ID"]."' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	if ( $row ) {
		// édition du début du fichier XML
		$xml  = "<?xml version=\"1.0\" encoding=\"$CHARSET\" ?>";

		// édition du début du fichier XML
		$xml .= "<student>";

		// identité de l'apprenant (vcards en rdf)
		$xml .= "<vCard VERSION=\"3.0\">";
		$xml .= "<fn>". htmlspecialchars($row[1]) ." ". htmlspecialchars($row[0]) ."</fn>"; 
		$xml .= "<n><family>". htmlspecialchars($row[0]) ."</family> <given>". htmlspecialchars($row[1]) ."</given></n>"; 
		$xml .= "<bday>". $row[2] ."</bday>"; 
		$xml .= strlen($row[7]) ? "<tel>$row[7]</tel>" : "" ; 
		$xml .= "<adr del.type=\"POSTAL\">";
		$xml .= strlen($row[3]) ? "<street>". htmlspecialchars($row[3]) ."</street>" : "" ;
		$xml .= strlen($row[4]) ? "<street>". htmlspecialchars($row[4]) ."</street>" : "" ;
		$xml .= "<locality>". htmlspecialchars($row[6]) ."</locality>";
		$xml .= "<pcode>$row[5]</pcode> <country>FRANCE</country>";
		$xml .= "</adr>";
		$xml .= strlen($row[8]) ? "<email email.type=\"INTERNET\">$row[8]</email>" : "" ; 
		$xml .= "</vCard>";

		// lecture des paramètres de configuration générale
		$query   = "select _ident, _adresse, _tel, _fax, _web, _email ";
		$query  .= "from config ";
		$query  .= "where _visible = 'O' AND _lang = '".@$_GET["lang"]."' ";
		$query  .= "limit 1";

		$result  = mysql_query($query, $mysql_link);
		$row     = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		// établissements de formation
		$school  = "<school>";
		$school .= "<identity name=\"". htmlspecialchars($row[0]) ."\" address=\"". htmlspecialchars($row[1]) ."\"/>"; 
		$school .= strlen($row[2]) ? "<tel>$row[2]</tel>" : "" ; 
		$school .= strlen($row[3]) ? "<fax>$row[3]</fax>" : "" ; 
		$school .= strlen($row[4]) ? "<web>$row[4]</web>" : "" ; 
		$school .= strlen($row[5]) ? "<email>$row[5]</email>" : "" ; 
		$school .= "</school>";

		// lecture des paramètres de configuration générale
		$query   = "select distinctrow ";
		$query  .= "pfolio_items._IDlevel, pfolio_items._date, pfolio_data._IDskill, pfolio_data._texte, pfolio_data._order ";
		$query  .= "from pfolio_items, pfolio_data ";
		$query  .= "where pfolio_items._ID = '".@$_GET["ID"]."' ";
		$query  .= "AND pfolio_items._IDdata = pfolio_data._IDdata ";
		$query  .= "order by pfolio_items._IDitem";

		$result  = mysql_query($query, $mysql_link);
		$nbrows  = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;
		$row     = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		// initialisation
		$training = $module = $domain = 0;
		$nbtrain  = $nbmod  = $nbdom  = 0;

		while ( $row ) {
			// lecture de la base
			$query  = "select distinctrow ";
			$query .= "pfolio._ident, pfolio_uv._ident, pfolio._IDskill, pfolio_uv._IDuv, pfolio_uv._IDform, pfolio_uv._texte, pfolio._order ";
			$query .= "from pfolio, pfolio_uv ";
			$query .= "where pfolio._IDskill = '$row[2]' ";
			$query .= "AND pfolio._IDuv = pfolio_uv._IDuv ";
			$query .= "limit 1";

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			if ( $training != $myrow[4] ) {
				$training = $myrow[4];
				$module   = 0;
				$nbmod    = 0;
				$nbtrain++;
				}

			if ( $module != $myrow[3] ) {
				$module = $myrow[3];
				$domain = 0;
				$nbdom  = 0;
				$nbmod++;
				}

			if ( $domain != $myrow[2] ) {
				$domain = $myrow[2];
				$nbdom++;
				}

			// formations (ex : attestation B2i)
			if ( $nbtrain % 2 ) {
				if ( $nbtrain > 1 ) {
					$xml .= "</domain>";
					$xml .= "</module>";
					$xml .= "</training>";
					}

				$query  = "select _ident, _texte ";
				$query .= "from pfolio_formation ";
				$query .= "where _IDform = '$myrow[4]' ";
				$query .= "AND _lang = '".@$_GET["lang"]."' ";
				$query .= "limit 1";

				$ret  = mysql_query($query, $mysql_link);
				$sql  = ( $ret ) ? remove_magic_quotes(mysql_fetch_row($ret)) : 0 ;

				$xml .= "<training id=\"". htmlspecialchars($sql[0]) ."\" ident=\"". htmlspecialchars($sql[1]) ."\">";
				$xml .= $school;

				$nbtrain++;
				}

			// modules des formations (ex : B2i niv 1)
			if ( $nbmod % 2 ) {
				if ( $nbmod > 1 ) {
					$xml .= "</domain>";
					$xml .= "</module>";
					}

				$xml .= "<module id=\"". htmlspecialchars($myrow[1]) ."\" ident=\"". htmlspecialchars($myrow[5]) ."\">";

				$nbmod++;
				}

			// domaines de compétence
			if ( $nbdom % 2 ) {
				if ( $nbdom > 1 ) {
					$xml .= "</domain>";
					}

				$xml .= "<domain id=\"$myrow[6]\" ident=\"". htmlspecialchars($myrow[0]) ."\">";

				$nbdom++;
				}

			// compétences
			$return = mysql_query("select _ident from pfolio_level where _IDlevel = '$row[0]' limit 1", $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			$xml .= "<ability id=\"$row[4]\" ident=\"". htmlspecialchars($row[3]) ."\" date=\"". htmlspecialchars($row[1]) ."\" level=\"". htmlspecialchars($myrow[0]) ."\" />";

			$row  = remove_magic_quotes(mysql_fetch_row($result));
			}

		if ( $nbrows ) {
			$xml .= "</domain>";
			$xml .= "</module>";
			$xml .= "</training>";
			}

		// édition de la fin du fichier XML
		$xml .= "</student>";

		echo $xml;
		}
	}
?>
