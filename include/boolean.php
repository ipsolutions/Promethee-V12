<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2005 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : boolean.php
 *		projet   : classe objet bool�en pour des donn�es > 32 bits
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 18/09/05
 *		modif    :  
 */


//---------------------------------------------------------------------------
class boolean
{
	var	$size;

	// construteur --------------------------------------------------------
	function boolean($size = 255)
	{
		$this->size = $size;
	}
	// conversion d�cimal -> binaire --------------------------------------
	function dec2bin($value)
	{
		$bin = "";

		for ($i = 0; $i < $this->size; $i++) {
			$bin .= ( $value & 1 ) ? "1" : "0" ;
			$value /= 2;
			}

		return $bin;
	}
	// ET logique ----------------------------------------------------------
	function boolean_and($val1, $val2)
	{
		$bin1 = $this->dec2bin($val1);
		$bin2 = $this->dec2bin($val2);

		for ($i = 0; $i < $this->size; $i++)
			if ( $bin1[$i] == "1" AND $bin2[$i] == "1" )
				return true;

		return false;
	}
	// OU logique ----------------------------------------------------------
	function boolean_or($val1, $val2)
	{
		$bin1 = $this->dec2bin($val1);
		$bin2 = $this->dec2bin($val2);

		for ($i = 0; $i < $this->size; $i++)
			if ( $bin1[$i] == "1" OR $bin2[$i] == "1" )
				return true;

		return false;
	}
	// --------------------------------------------------------------------
}
//---------------------------------------------------------------------------
?>