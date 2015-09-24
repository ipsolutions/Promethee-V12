<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : forbidden.php
 *		projet   : la page de redirection en cas de problème
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 14/01/07
 *		modif    : 
 */
?>



<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php
	require "msg/forbidden.php";
	require_once "include/TMessage.php";

	$mylang = ( @$_GET["lang"] ) ? $_GET["lang"] : @$_SESSION["lang"] ;

	$_msg   = new TMessage($_SESSION["ROOTDIR"]."/msg/$mylang/forbidden.php");
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $mylang; ?>" lang="<?php echo $mylang; ?>">
<head>
	<title><?php print($_msg->read($FORBIDDEN_CONNECT)); ?></title>

	<!-- début link -->
	<link href="<?php echo $_SESSION["ROOTDIR"]; ?>/css/themes/globals.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body style="background-color:#FFFFFF; margin-top:50px; margin-left:200px; margin-right:200px;">

	<!-- partie centrale : page forbidden.php -->
	<div style="border-style: dashed">
		<table class="width100">
		  <tr>
		    <td style="width:15%;" class="align-center valign-top">
			<img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/warning-large.png" title="" alt="" />
		    </td>
		    <td>
			<span class="x-large"><strong><?php print($_msg->read($FORBIDDEN_DENIED)); ?></strong></span>
			<hr/>
			<?php print($_msg->read($FORBIDDEN_ACCESS)); ?>
			<hr/>
			  <ul>
				<li><?php print($_msg->read($FORBIDDEN_NOTEXIST)); ?></li>
				<li><?php print($_msg->read($FORBIDDEN_NOPERM)); ?></li>
				<li><?php print($_msg->read($FORBIDDEN_NOACCESS)); ?></li>
			  </ul>
			<hr/>
			<form id="formulaire" action="index.php" method="post">
				<p style="margin:0px;"><input type="submit" value="<?php print($_msg->read($FORBIDDEN_RETRY)); ?>" name="submit" /></p>
			</form>
		    </td>
		  </tr>
		</table>
	</div>

</body>
</html>
