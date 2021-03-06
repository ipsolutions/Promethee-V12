<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
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


/*
 *		module   : nl2br.php
 *		projet   : primitive php du m�me nom
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 18/12/03
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */
//---------------------------------------------------------------------------
function nltobr($text)
{
	/*
	 * fonction :	pour rem�dier au bug sur certains navigateurs
	 * in :		texte avec saut de ligne
	 * out :		texte formatt� html
	 */

//	return str_replace("\n", "<br/>", $text);
	return str_replace("<br>", "<br/>", nl2br($text));
}
//---------------------------------------------------------------------------
?>