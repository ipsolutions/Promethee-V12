<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2009 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : student_csv.php
 *		projet   : la page d'exportation des élèves
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 8/10/09
 *		modif    : 
 */
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
//---------------------------------------------------------------------------
function getTutor($id)
{
	require $_SESSION["ROOTDIR"]."/globals.php";

	$query  = "select _name, _fname, _sexe, _adr1, _adr2, _cp, _city, _work, _tel, _mobile, _email, _lang from user_id ";
	$query .= "where _ID = '$id' ";
	$query .= "limit 1";

	$return = mysql_query($query, $mysql_link);
	$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

	return ( $myrow )
		? "$myrow[0];$myrow[1];$myrow[2];$myrow[3];$myrow[4];$myrow[5];$myrow[6];$myrow[7];$myrow[8];$myrow[9];$myrow[10];$myrow[11]"
		: ";;;;;;;;;;;" ;
}
//---------------------------------------------------------------------------

	// qui suis-je ?
	$query  = "select distinctrow user_id._adm  ";
	$query .= "from user_id, user_session ";
	$query .= "where user_session._IDsess = '".@$_GET["sid"]."' ";
	$query .= "AND user_id._ID = user_session._ID ";
	$query .= "order by user_session._lastaction ";
	$query .= "limit 1";

	$return = mysql_query($query, $mysql_link);
	$auth   = ( $return ) ? mysql_fetch_row($return) : 0 ;

	// il faut les droits du gestionnaire
	if ( $auth[0] & 8 ) {
		$query  = "select distinctrow ";
		$query .= "config_centre._ident, campus_classe._ident, user_id._name, user_id._fname, user_id._numen, user_id._sexe, user_id._born, ";
		$query .= "user_id._adr1, user_id._adr2, user_id._cp, user_id._city, user_id._tel, user_id._email, ";
		$query .= "user_id._regime, user_id._bourse, user_id._lang, user_id._ident, user_id._passwd, user_id._visible, user_id._ID ";
		$query .= "from user_id, campus_classe, config_centre ";
		$query .= "where user_id._IDclass = campus_classe._IDclass ";
		$query .= "AND campus_classe._IDcentre = config_centre._IDcentre ";
		$query .= "AND config_centre._lang = '".$_SESSION["lang"]."' ";
		$query .= "order by user_id._name, user_id._fname";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		// données CSV
		while ( $row ) {
			$query  = "select _IDtutor from user_tutors ";
			$query .= "where _ID = '$row[19]' ";
			$query .= "order by _index";

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? mysql_fetch_row($return) : 0 ;

			// 1er tuteur
			$tutor1 = getTutor($myrow[0]);

			$myrow  = mysql_fetch_row($return);

			// 2èmetuteur
			$tutor2 = getTutor($myrow[0]);

			$ident  = ( $auth[0] == 255 ) ? $row[16] : "" ;
			$passwd = ( $auth[0] == 255 ) ? $row[17] : "" ;

			print("$row[0];$row[1];$row[2];$row[3];$row[4];$row[5];$row[6];$row[7];$row[8];$row[9];$row[10];$row[11];$row[12];$row[13];$row[14];$row[15];$ident;$passwd;$tutor1;$tutor2;$row[18]<br/>");

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}
		}
?>

</body>
</html>
