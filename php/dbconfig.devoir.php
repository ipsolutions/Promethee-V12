<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2013 by IP-Solutions(contact@ip-solutions.fr)

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
 *		module   : dbconfig.devoir.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php
class DBConnection{
	function getConnection(){
	include("config.php");
	  //change to your database server/user name/password
		mysql_connect($SERVER, $USER, $PASSWD) or
         die("Could not connect: " . mysql_error());
    //change to your database name
		mysql_select_db($DATABASE) or 
		     die("Could not select database: " . mysql_error());
	}
}
?>