<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2010 by IP-Solutions (contact@ip-solutions.fr)

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
 *		module   : index.php
 *		projet   : la page provisoire d'installation
 *
 *		version  : 1.0
 *		auteur   : IP-Solution
 *		creation : 15/11/2013
 *		modif    : 
 */


// Si le fichier config n'existe pas alors on redirige vers une nouvel installation
if(!file_exists("config.php"))
{
	header("Location: include/clearindex.php?action=setup");
}
else if(file_exists("config.php")) // Si le fichier config existe alors on verifie la version de PMT
{
	// Si c'est une V12 alors c'est bon
	if(strpos(file_get_contents("config.php"), '"12.0"') > 0)
	{
		header("Location: include/clearindex.php?action=v12");
	}
	else // Si c'est v11 alors maj
	{
		header("Location: include/clearindex.php?action=v11");
	}
}
?>