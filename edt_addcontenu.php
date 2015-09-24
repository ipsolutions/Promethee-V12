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
 *		module   : edt_addcontenu.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php
session_start();
include_once("php/dbconfig.php");
include_once("php/functions.php");

$st   = ( @$_POST["st"] )
	? $_POST["st"]
	: @$_GET["st"] ;
	
$IDx   = ( @$_POST["IDx"] )
	? $_POST["IDx"]
	: @$_GET["IDx"] ;
	
$IDmat   = ( @$_POST["IDmat"] )
	? $_POST["IDmat"]
	: @$_GET["IDmat"] ;
	
$generique   = ( @$_POST["generique"] )
	? $_POST["generique"]
	: @$_GET["generique"] ;

$texte = @$_POST["texte"];
$nosemaine = (int) @$_POST["nosemaine"];
$submit = @$_POST["submit"];

require "page_banner.htm";
?>
<script src="script/ckeditor/ckeditor.js"></script>
<?php

if($generique == "off")
{
	$sql = "select * from ctn_items where _type = 0 and _nosemaine = ".date("W", js2PhpTime($st))."  and _IDcours = ".$IDx;
}

$handle = mysql_query($sql);
$nbdev = 0;
$textdev = "";
while ($row2 = mysql_fetch_object($handle))
{
	$nbdev++;
	$textdev = $row2->_texte;
}

if(isset($_POST["submit"]))
{
	if($nbdev > 0)
	{
		if($generique == "on")
		{
			$update  = "update ctn_items set _texte = '".addslashes($texte)."' where _IDcours = $IDx and _nosemaine = $nosemaine and _type = 0";
		}
		else
		{
			$update  = "update ctn_items set _texte = '".addslashes($texte)."' where _IDcours = $IDx and _type = 0";
		}
		
		mysql_query($update);
		?>
		<div class="alert alert-success" style="margin-bottom: 0px; margin-top: 10px"><center><strong>Ok !</strong></center></div>
		<?php
	}
	else
	{
		if($generique == "on")
		{
			$update  = "insert into ctn_items values ('', '_IDctn', '$IDmat', '_ID' , '_IP', '', '1:00', 'chap', '".addslashes($texte)."', 'N', '', 'O', '0', '$IDx', '$nosemaine')";
		}
		else
		{
			$update  = "insert into ctn_items values ('', '_IDctn', '$IDmat', '_ID' , '_IP', '', '1:00', 'chap', '".addslashes($texte)."', 'N', '', 'O', '0', '$IDx', '$nosemaine')";
		}
		
		mysql_query($update);
		?>
		<div class="alert alert-success" style="margin-bottom: 0px; margin-top: 10px"><center><strong>Ok !</strong></center></div>
		<?php
	}
	
	$textdev = $texte;
}

?>

<br />
<form method="post">
	<input type="hidden" name="IDx" value="<?php echo $IDx; ?>" />
	<input type="hidden" name="nosemaine" value="<?php echo date("W", js2PhpTime($st)); ?>" />
	<input type="hidden" name="generique" value="<?php echo $generique; ?>" />
	
	<?php
	/*$oFCKeditor           = new FCKeditor("texte") ;
	$oFCKeditor->BasePath = "./script/fckeditor/";
	$oFCKeditor->Height   = 250;
	$oFCKeditor->Value    = $textdev;
	$oFCKeditor->Create();*/
	?>

	<textarea name="texte" id="texte"><?php echo $textdev; ?></textarea>
	<p></p>
	
	<script>
	CKEDITOR.replace('texte');
	</script>
	
	<table width="100%">
		<tr>
			<td class="align-right" width="75%">
			</td>
			<td class="align-left" width="25%" style="padding-left: 10px">
				<button class="btn btn-success" type="submit" name="submit">Valider</button>
			</td>
		</tr>
	</table>
</form>