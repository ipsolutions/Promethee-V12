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
 *		module   : stage_mvc.php
 *		projet   : modèle vue controleur d'accès aux backoffices des stages
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 4/11/08
 *		modif    : 
 */
?>

<?php
	switch ( getAccess() ) {
		case '1' :	// les élèves
			$cmde    = "link";
			$visu    = 1;
			$IDeleve = (int) $_SESSION["CnxID"];
			break;

		case '2' :	// le personnel
			$cmde    = "visit";
			break;

		default :	// les autres
			$cmde    = "search";
			break;
		} // end switch

	$page = "stage_$cmde.htm";
?>