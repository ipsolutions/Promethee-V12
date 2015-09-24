<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2010 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : gallery_ftp.php
 *		projet   : la page de visualisation des galeries d'images déposées par ftp
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 2/11/10
 *		modif    : 
 */
?>


<html>
<div class="maincontent">
<?php
function show_gallery($openup, $maxcol = 5, $maxWidth = 100, $maxHeight = 100)
{
	global	$CHMOD;

	require_once $_SESSION["ROOTDIR"]."/include/filext.php";
	require_once $_SESSION["ROOTDIR"]."/include/gallery.php";

	$dir   = Array();
	$files = Array();
	$text  = Array();

	$myDir = @opendir($openup);

	// lecture des répertoires
	while ( $entry = readdir($myDir) )
		switch ( $entry ) {
			case "." :
			case ".." :
			case "_vignettes" :
				break;

			case "files.txt" :
				$text = explode("\n", file_get_contents("$openup/$entry"));
				break;

			default :
				if ( is_dir("$openup/$entry") )
					array_push($dir, "$openup/$entry");
				else
					array_push($files, "$openup/$entry");
			}

	closedir($myDir);

	@sort($dir);
	@sort($files);

	$nbitem = 0;
	$path   = explode("/", $openup);

	print("<table>");
	print("<tr>");

	if ( count($path) > 3 ) {
		for ($i = 1, $up = $path[0]; $i < count($path) - 1; $i++)
			$up .= "/$path[$i]";

		print("
			<td style=\"width:100px; vertical-align:top;\">
				<a href=\"?dir=$up\"><img src=\"".$_SESSION["ROOTDIR"]."/images/up.png\" title =\"\" alt=\"..\" /></a>
			</td>");

		$nbitem++;
		}

	for ($i = 0; $i < count($dir); $i++) {
		$mydir = basename($dir[$i]);
		
		print("
			<td style=\"width:100px; text-align:center; vertical-align:top;\">
				<a href=\"?dir=$dir[$i]\"><img src=\"".$_SESSION["ROOTDIR"]."/images/dir.png\" title =\"\" alt=\"$dir[$i]\" /></a>
				<br/>$mydir
			</td>");

		if ( ($nbitem++ % $maxcol) == $maxcol - 1 )
			print("</tr><tr>");
		}

	mymkdir($openup."/_vignettes", $CHMOD);

	for ($i = 0; $i < count($files); $i++) {
		$myfile = basename($files[$i]);

		switch ( strtolower(extension($files[$i])) ) {
			case "png" :
			case "gif" :
			case "jpg" :
			case "jpeg" :
				imageSize($files[$i], $srcWidth, $srcHeight);

				if ( !file_exists("$openup/_vignettes/$myfile") )
					vignette($files[$i], "$openup/_vignettes", $myfile, $srcWidth, $srcHeight, $maxWidth, $maxHeight);

				$src   = "$openup/_vignettes/$myfile";
				$title = "$srcWidth x $srcHeight";
				break;

			case "avi" :
			case "mov" :
			case "wmv" :
				$src   = $_SESSION["ROOTDIR"]."/images/vid.png";
				$title = "video";
				break;

			default :
				$src   = "?";
				$title = "?";
				break;
			}

		$label = ( @$text[$i] )	? $text[$i] : $myfile ;

		print("
			<td style=\"width:100px; text-align:center; vertical-align:top;\">
				<a href=\"$openup/$myfile\">
				<img src=\"$src\" title=\"$myfile\" alt=\"$myfile\" />
				</a>
				<br/>$label
				<br/>$title
			</td>");

		if ( ($nbitem++ % $maxcol) == $maxcol - 1 )
			print("</tr><tr>");
		}

	print("</tr>");
	print("</table>");
}

$_SESSION["ROOTDIR"] = ".";
$_SESSION["lang"]    = "fr";
$maxcol      = 5;
$default_dir = "download/galerie/ftp";

	// image : 100 x 100 max
	$maxWidth  = 100;
	$maxHeight = 100;

	show_gallery(@$_GET["dir"] ? $_GET["dir"] : $default_dir, $maxcol, $maxWidth, $maxHeight);
?>
</div>
</html>

