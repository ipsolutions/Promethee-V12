<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2013 by IP-Solutions(contact@ip-solutions.fr)

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
 *		module   : getDevoirs.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php
session_start();
include_once("dbconfig.php");
include_once("functions.php");

$IDx = $_GET["IDx"];
$sd = $_GET["sd"];

$db = new DBConnection();
$db->getConnection();

// Verification si quelque chose � faire
$nbdev = 0;
$textdev = "";
//if($generique == "off")
//{
	$sql2 = "select * from ctn_items where _type = 1 and _nosemaine = ".date("W", js2PhpTime($sd))." and _IDcours = ".$IDx;
	$handle2 = mysql_query($sql2);
	while ($row2 = mysql_fetch_object($handle2))
	{
		$nbdev++;
		$textdev = $row2->_texte;
	}
//}

echo $textdev;

?>