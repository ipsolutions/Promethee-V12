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
 *		module   : user_csv.php
 *		projet   : la page d'exportation des comptes
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
	// qui suis-je ?
	$query  = "select distinctrow user_id._adm  ";
	$query .= "from user_id, user_session ";
	$query .= "where user_session._IDsess = '".@$_GET["sid"]."' ";
	$query .= "AND user_id._ID = user_session._ID ";
	$query .= "order by user_session._lastaction ";
	$query .= "limit 1";

	$return = mysql_query($query, $mysql_link);
	$auth   = ( $return ) ? mysql_fetch_row($return) : 0 ;

	// il faut les droits admin
	if ( $auth[0] == 255 ) {
		$idsel  = (int) @$_GET["IDsel"];

		$query  = "select distinctrow ";
		$query .= "config_centre._ident, ";
		$query .= "user_id._name, user_id._fname, user_id._sexe, user_id._ID, user_id._adm, ";
		$query .= "user_id._born, user_id._adr1,  user_id._adr2,  user_id._cp,  user_id._city, user_id._email, ";
		$query .= "user_id._title, user_id._fonction, user_id._tel, user_id._mobile, user_id._lang, ";
		$query .= "user_group._ident, user_group._IDcat, ";
		$query .= "user_id._IDclass, user_id._visible ";
		$query .= "from user_id, config_centre, user_group ";
		$query .= "where user_id._IDcentre = config_centre._IDcentre ";
		$query .= "AND config_centre._lang = '".$_SESSION["lang"]."' ";
		$query .= ( $idsel ) ? "AND user_id._IDgrp = '$idsel' " : "" ;
		$query .= "AND user_group._IDgrp = user_id._IDgrp ";
		$query .= "AND user_group._lang = '".$_SESSION["lang"]."' ";
		$query .= "order by user_id._IDcentre, user_id._visible, user_id._IDclass, user_id._name, user_id._fname";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		// données CSV
		while ( $row ) {
			$query  = "select _ident from campus_classe ";
			$query .= "where _IDclass = '$row[19]' ";
			$query .= "limit 1";

			$return = mysql_query($query, $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			print("$row[0];$row[20];$myrow[0];$row[1];$row[2];$row[3];$row[17];$row[18];$row[5];$row[6];$row[7];$row[8];$row[9];$row[10];$row[11];$row[12];".str_replace("<br/>", ", ", trim($row[13])).";$row[14];$row[15];$row[16]<br/>");

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}
		}
?>

</body>
</html>
