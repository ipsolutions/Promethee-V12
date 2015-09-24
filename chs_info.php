<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

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
/*-------------------------------------------------------------------------*/

/*
 *		module   : chs_info.htm
 *		projet   : 
 *
 *		version  : 1.1
 *		auteur   : laporte
 *		creation : 21/03/06
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/chs.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/chs.php");
?>

<p style="text-align:justify">
<?php print($msg->read($CHS_INFO1)); ?>
</p>

<p style="text-align:justify">
<?php
	$list = explode("-", $msg->read($CHS_LIST1));

	for ($i=1; $i < count($list); $i++)
		print("<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/puce.gif\" title=\"\" alt=\"\" /> $list[$i]<br/>");
?>
</p>

<p style="text-align:justify">
<?php print($msg->read($CHS_INFO2)); ?>
</p>

<p style="text-align:justify">
<?php
	$list = explode("-", $msg->read($CHS_LIST2));

	for ($i=1; $i < count($list); $i++)
		print("<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/puce.gif\" title=\"\" alt=\"\" /> $list[$i]<br/>");
?>
</p>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($CHS_CLOSEWINDOW)); ?></a>]
</p>

</body>

</html>
