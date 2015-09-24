<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2008 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

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
?>

<?php
/*
 *		module   : galery.php
 *		projet   : fonctions de manipulation d'images
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/09/03
 *		modif    : 17/07/06 - par Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict 
 */


//---------------------------------------------------------------------------
function imageSize($file, &$srcWidth, &$srcHeight)
{
/*
 * fonction :	d�termine la taille d'une image
 * in :		$file : path de l'image source
 *                $srcWidth : largeur vignette, $srcHeight : hauteur vignette
 */

	require_once $_SESSION["ROOTDIR"]."/include/filext.php";

	// recherche de la librairie GD
	$extension = get_loaded_extensions();
	if ( !in_array('gd', $extension) )
		return;

	// cr�ation de l'objet image � partir de l'extension
	$listimage = explode("|", $file);

	$path      = ( count($listimage) > 1 ) ? $listimage[0] : $file ;
	$file_ext  = ( count($listimage) > 1 ) ? $listimage[1] : $file ;

	switch ( strtolower(extension($file_ext)) ) {
		case "gif" :
			$srcImage = @imagecreatefromgif( $path ); 
			break;
		case "jpg" :
		case "jpeg" :
			$srcImage = @imagecreatefromjpeg( $path ); 
			break;
		default :
			$srcImage = @imagecreatefrompng( $path ); 
			break;
		}

	if ( $srcImage ) {
		// taille de l'image
		$srcWidth    = imagesx( $srcImage );
		$srcHeight   = imagesy( $srcImage );

		// lib�ration de la m�moire
		imagedestroy( $srcImage );
		}
}
//---------------------------------------------------------------------------
function vignette($path, $dest, $file, &$srcWidth, &$srcHeight, $maxWidth = 0, $maxHeight = 0)
{
/*
 * fonction :	extraction de l'extension du nom de fichier
 * in :		$path : path de l'image source, $dest : r�pertoire des vignettes, $file : nom de fichier destination
 *                $srcWidth : largeur vignette, $srcHeight : hauteur vignette
 *                $maxWidth : largeur max vignette, $maxHeight : hauteur max vignette
 * out :		1 si vignette cr��e, 0 sinon
 */

	global	$MAXIMGWDTH;				// largeur max des vignettes (en pixels)
	global	$MAXIMGHGTH;				// hauteur max des vignettes (en pixels)

	require_once $_SESSION["ROOTDIR"]."/include/filext.php";
	require_once $_SESSION["ROOTDIR"]."/include/urlencode.php";

	require $_SESSION["ROOTDIR"]."/msg/vignette.php";
	require_once $_SESSION["ROOTDIR"]."/include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/vignette.php");

	$maxWidth  = ( $maxWidth ) ? $maxWidth : $MAXIMGWDTH ;
	$maxHeight = ( $maxHeight ) ? $maxHeight : $MAXIMGHGTH;

	// cr�ation de l'objet image � partir de l'extension
	$listimage = explode("|", $path);

	$path      = ( count($listimage) > 1 ) ? $listimage[0] : $path ;
	$file_ext  = extension(count($listimage) > 1 ? $listimage[1] : $file);

	switch ( strtolower($file_ext) ) {
		case "gif" :
//			$srcImage = @imagecreatefromgif( $path ); 
			$srcImage = imagecreatefromgif( $path ); 
			break;
		case "jpg" :
		case "jpeg" :
//			$srcImage = @imagecreatefromjpeg( $path ); 
			$srcImage = imagecreatefromjpeg( $path ); 
			break;
		default :
//			$srcImage = @imagecreatefrompng( $path ); 
			$srcImage = imagecreatefrompng( $path ); 
			break;
		}

	// copie des vignettes
	if ( $srcImage ) {
		// taille de l'image
		$srcWidth    = imagesx( $srcImage );
		$srcHeight   = imagesy( $srcImage );

		$ratioWidth  = $srcWidth  / $maxWidth;
		$ratioHeight = $srcHeight / $maxHeight;

		// taille maximale d�pass�e ?
		if ( $ratioWidth > 1 OR $ratioHeight > 1 ) {
			if( $ratioWidth < $ratioHeight ) { 
				$destWidth  = (int) ($srcWidth / $ratioHeight);
				$destHeight = $maxHeight; 
				}
			else { 
				$destWidth  = $maxWidth; 
				$destHeight = (int) ($srcHeight / $ratioWidth);
				}
			}
		else {
			$destWidth  = $srcWidth;
			$destHeight = $srcHeight;
			}

		// attention � la version de GD install�e sur le serveur h�bergeur
//		if ( $HTTP_POST_VARS['gd'] == 2 AND $file_ext != "gif" ) {
		if ( function_exists('imagecreatetruecolor') AND $file_ext != "gif" ) {
			// Partie 1 : GD 2.0 ou sup�rieur, r�sultat tr�s bons
			$destImage = imagecreatetruecolor($destWidth, $destHeight); 
			if ( !imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight) )
				print("<span style=\"color:#FF0000;\">". $msg->read($VIGNETTE_ERRIMAGE, Array($destWidth, $destHeight)) ."</span>");
			}
		else {
			// Partie 2 : GD inf�rieur � 2, r�sultat tr�s moyens
			$destImage = imagecreate($destWidth, $destHeight);
			if ( !imagecopyresized($destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight) )
				print("<span style=\"color:#FF0000;\">". $msg->read($VIGNETTE_ERRCOPY, Array($destWidth, $destHeight)) ."</span>");
			}

		// cr�ation et sauvegarde de l'image finale sous forme de vignette
		$dest_file = $dest . "/" . substr($file, 0, strrpos($file, ".")) . "." . extension($file);

		switch ( $file_ext ) {
			case "gif" :
				// toutes les fonctions GIF ont �t� supprim�es de la biblioth�que GD version 1.6,
				$ret = ImageGIF($destImage, stripaccent($dest_file));
				break;
			case "jpg" :
			case "jpeg" :
				// Le support JPEG n'est disponible que si PHP est compil� avec GD-1.8 ou plus r�cent.
				$ret = ImageJPEG($destImage, stripaccent($dest_file));
				break;
			default :
				$ret = ImagePNG($destImage, stripaccent($dest_file));
				break;
			}

		// test de la cr�ation de l'image
		if ( !$ret )
			print("<span style=\"color:#FF0000;\">". $msg->read($VIGNETTE_ERRCREATE, $file_ext) ."</span>");

		// lib�ration de la m�moire
		imagedestroy( $srcImage );
		imagedestroy( $destImage );

		//code retour
		return 1;
		}
	else
		print("<span style=\"color:#FF0000;\">". $msg->read($VIGNETTE_ERRFORMAT, $file_ext) ."</span>");

	//code retour
	return 0;
}
//---------------------------------------------------------------------------
function importGallery($IDdata, $src, $move = false, $maxsize = 0)
{
/*
 * fonction :	importation d'images dans une galerie
 * in :		$IDdata : ID de la galerie, $src : r�pertoire source
 */

	require $_SESSION["ROOTDIR"]."/globals.php";

	require_once $_SESSION["ROOTDIR"]."/include/filext.php";

	// la cr�ation de la DB peut prendre du temps => on supprime le tps max d'ex�cution des requ�tes
	// attention : safe_mode doit �tre d�sactiv�
	$safe_mode  = ini_get("safe_mode");
	$time_limit = ini_get("max_execution_time");

	if ( $safe_mode != "1" )
		set_time_limit(0);

	$dest  = $_SESSION["ROOTDIR"]."/$DOWNLOAD/galerie/$IDdata";
	$path  = ( strlen($src) )
		? substr(str_replace("\\", "/", $src), 0, strrpos(str_replace("\\", "/", $src), "/"))
		: "$DOWNLOAD/$IMGUPLOAD" ;

	$myDir = @opendir( $path );

	// lecture des r�pertoires
	while ( $entry = @readdir($myDir) ) {
		switch ( strtolower(extension($entry)) ) {
			case "jpeg" :
			case "jpg" :
			case "png" :
			case "gif" :
				// on d�termine le r�pertoire de stockage des images
				if ( !is_dir($dest) )
					mymkdir($dest, $CHMOD);

				// on d�termine le r�pertoire de stockage des vignettes
				$small = "$dest/vignettes";
				if ( !is_dir($small) )
					mymkdir($small, $CHMOD);

				// fichier destination
				$src  = "$path/$entry";
				$dst  = stripaccent(strtolower("$dest/$entry"));

				// on efface les fichiers existants pour �viter des conflits
				if ( file_exists($dst) )
					unlink($dst);

				// copie du fichier temporaire -> r�pertoire de stockage
				if ( $maxsize ) {
					imageSize($src, $srcWidth, $srcHeight);

					$ratio     = ( $srcWidth > $maxsize ) ? (float) ($maxsize / $srcWidth) : 1.0 ;
					$maxWidth  = (int) ($srcWidth * $ratio);
					$maxHeight = (int) ($srcHeight * $ratio);

					$isOk = vignette(
						$src,
						$dest,
						stripaccent(strtolower($entry)),
						$srcWidth,
						$srcHeight,
						$maxWidth,
						$maxHeight);
					}
				else
					$isOk = copy($src, $dst);

				if ( $isOk )
					if ( vignette($dst, $small, stripaccent(strtolower($entry)), $srcWidth, $srcHeight) ) {
						// initialisation des champs
						$date     = date("Y-m-d H:i:s");
						$filesize = filesize($src);

						// et on ins�re une nouvelle image dans la base de donn�es
						$Query  = "insert into gallery_items ";
						$Query .= "values('', '$IDdata', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '$entry', '$filesize', '$srcWidth', '$srcHeight', '0', '', '', 'O')";

						if ( !mysql_query($Query, $mysql_link) )
							sql_error($mysql_link);
						else
							if ( $move )
								unlink($src);
						}	// endif copy
				break;

			default :
				break;
			}	// endswitch
		}	// endwhile readdir

	// fermeture du r�pertoire
	@closedir($myDir);

	// r�initialisation du tps max d'ex�cution des requ�tes
	if ( $safe_mode != "1" )
		set_time_limit($time_limit);
}
//---------------------------------------------------------------------------
?>
