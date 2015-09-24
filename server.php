<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : server.php
 *		projet   : affichage des pages en fonction du menu
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 24/12/07
 *		modif    : 
 */

// d�but de session
session_start();

//---- compteur des t�l�chargements ----//
if ( @$_SESSION["sessID"] AND @$_GET["id"] AND @$_GET["file"] ) {
	// lancement du t�l�chargement
	Header("Location: $file");

	// mise � jour des fichiers de log
	require "include/download.php";
	}
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	// lecture de la configuration
	require "page_banner.htm";

	switch ( @$_GET["cmde"] ) {
		case 'share' :		// acc�s au partage des ressources
			$page = "server/share.php";
			break;
		case 'share_user' :	// acc�s � l'annuaire centralis�
			$page = "server/share_user.php";
			break;
		case 'school' :		// liste des �tablissements
			$page = "server/school.php";
			break;
		default :			// identification
			$page = "server/login.php";
			break;
		}

	if ( file_exists($page) )
		// affichage page
		require "$page";
	else
		// acc�s refus�
		require "forbidden.php";
?>

</html>
