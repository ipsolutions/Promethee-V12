<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2008 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : ctn_mvc.php
 *		projet   : mod�le vue controleur d'acc�s aux backoffices des Cahiers de Texte Num�rique
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 4/11/08
 *		modif    : 
 */
?>

<?php
	$page = "ctn.htm";

	switch ( getAccess() ) {
		case '1' :	// les �l�ves
			break;

		case '2' :	// le personnel
			$page = "ctn_user.htm";
			break;

		default :	// les autres
			break;
		} // end switch
?>