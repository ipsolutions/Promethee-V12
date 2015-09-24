<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2008 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : weblog_about.php
 *		projet   : la page d'accès au campus virtuel
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/09/08
 *		modif    : 
 */
?>


<?php
	// recherche du campus
	$query  = "select _ID, _IP, _date, _text from weblog ";
	$query .= "where _IDlog = '$IDlog' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	$photo = ( file_exists("$DOWNLOAD/weblog/img/$IDlog.png") ) 
		? "$DOWNLOAD/weblog/img/$IDlog.png"
		: "" ;

	if ( strlen($photo) )
		print("<img src=\"$photo\" title=\"$photo\" alt=\"$photo\" style=\"float: left; margin: 10px 10px 0 0; padding: 0 10px 0 0; border-right-style:dotted;\" />");

	print("
		<div style=\"padding: 10px 10px 10px 10px; text-align:justify;\">
		<p class=\"x-small\" style=\"margin-top: 0px;\">". $msg->read($WEBLOG_HEADER, Array(getUserName($row[0]), _getHostName($row[1]), date2longfmt($row[2]))) ."</p>
		". replace_smile(find_typo($row[3], $note)) ."
		</div>
		");
?>
