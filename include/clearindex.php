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
 *		module   : clearindex.php
 *		projet   : traitement de la page provisoire index
 *
 *		version  : 1.0
 *		auteur   : IP-Solution
 *		creation : 15/11/2013
 *		modif    : 
 */
 
$action = $_GET["action"];

if($action == "setup")
{
	$file = fopen("../config.php", "w+"); 
	unlink("../index.php");
	rename("../index.prod.php", "../index.php");
	header("Location: ../setup.php");
}
else if($action == "v11")
{
	unlink("../index.php");
	rename("../index.prod.php", "../index.php");
	header("Location: ../update_v12.php");
}
else if($action == "v12")
{
	unlink("../index.php");
	rename("../index.prod.php", "../index.php");
	header("Location: ../index.php");
}
?>