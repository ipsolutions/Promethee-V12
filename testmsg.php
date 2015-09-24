<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : testmsg.php
 *		projet   : liste le nombre de messages par langues et par fichiers
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 25/08/07
 *		modif    : 
 */
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
	<title>Prométhée</title>
</head>
<body style="background-color:#FFFFFF; margin:5px;">

<?php
	//-------------------------------------------------------------------------
	function getMessages($file)
	{
		$count = 0;

		if ( ($in = fopen($file, "r")) ) {

			while ( !feof($in) ) {
				$line = fgets($in, 255);

				if ( strstr($line, "static	$") )
					$count++;
				}

			fclose($in);
			}	// end fopen

		return $count;
	}
	//-------------------------------------------------------------------------
	function getMsgInFile($file)
	{
		$count = 0;

		if ( ($in = @fopen($file, "r")) ) {

			while ( !feof($in) ) {
				$line = fgets($in, 255);

				if ( strstr(strrev(trim($line)), ',"') )
					$count++;
				}

			$count++;

			fclose($in);
			}	// end fopen

		return $count;
	}
	//-------------------------------------------------------------------------

	$basedir = "msg";

	$dir   = array();
	$file  = array();

	// ouverture du répertoire des langues
	$myDir = opendir($basedir);

	// lecture des répertoires
	while ( $entry = readdir($myDir) ) {
		if ( is_dir("$basedir/$entry") AND strlen($entry) == 2 )
			switch ( $entry ) {
				case "." :
				case ".." :
					break;

				default :
					array_push($dir, $entry);
					break;
				}

		if ( is_file("$basedir/$entry") AND strstr($entry, ".php") )
			array_push($file, $entry);
		}

	// fermeture du répertoire
	closedir($myDir);

	@sort($dir);
	@sort($file);

	$table  = "<table border=\"1\">";

	$table .= "<tr class=\"align-center\">";
	$table .= "<td></td><td>#</td>";
	for ($i = 0; $i < count($dir); $i++)
		$table .= "<td>$dir[$i]</td>";
	$table .= "</tr>";

	for ($i = 0; $i < count($file); $i++) {
		$table .= "<tr>";
		$table .= "<td>$file[$i]</td><td class=\"align-right\">".getMessages("$basedir/$file[$i]")."</td>";
		for ($j = 0; $j < count($dir); $j++)
			$table .= "<td class=\"align-right\">".getMsgInFile("$basedir/$dir[$j]/$file[$i]")."</td>";
		$table .= "</tr>";
		}

	$table .= "</table>";

	print($table);
?>

</body>
</html>
