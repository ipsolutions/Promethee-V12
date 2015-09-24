<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2008 by Dominique Laporte (C-E-D@wanadoo.fr)

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
 *		module   : weblog_link.php
 *		projet   : la page d'ajout d'URL
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/09/08
 *		modif    : 
 */


$title   = @$_POST["title"];			// titre du site
$url     = @$_POST["url"];			// URL
$mylang  = ( @$_POST["mylang"] )		// langue du site
	? @$_POST["mylang"]
	: $_SESSION["lang"].".png" ;
?>


<?php
	// initialisation
	$error  = 0;
	$status = $msg->read($WEBLOG_INSERTION) ." ";

	// l'utilisateur a cliqué sur un lien
	switch ( $submit ) {
		case "link_ok" :
			// test d'erreur sur champs non renseignés
			$error = ( !strlen($title) OR !strlen($url) ) ? 1 : 0 ;

			if ( !$error ) {
				if ( $url != "" AND strstr($url, "http://") == "" AND strstr($url, "https://") == "" )
					$url = "http://" . $url;

				$Query  = "insert into weblog_link ";
				$Query .= "values('', '$IDlog', '$title', '$url', '$mylang')";

				if ( !mysql_query($Query, $mysql_link) ) {
					$status .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/bad.gif\" title=\"\" alt=\"X\" />";
					mysql_error($mysql_link);
					}
				else {
					$status .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/ok.gif\" title=\"\" alt=\"O\" />";
					$title   = $url = "";
					}
				}
			break;

		default :
			break;
		}
?>


<div class="maincontent">

	<form id="formulaire" action="index.php" method="post">
	<?php
		print("
			<p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"IDlog\"   value=\"$IDlog\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"submit\"  value=\"link_ok\" /></p>
			");
	?>

	<table class="width100">
	   <tr>
	      <td style="width:10%;" class="align-right"><?php print($msg->read($WEBLOG_STATUS)); ?></td>
	      <td style="width:80%"><?php print("$status"); ?></td>
	      <td style="width:10%;"></td>
	   </tr>

	   <tr>
	     <td></td>
	     <td><hr/></td>
	     <td></td>
	   </tr>

	   <tr>
	     <td></td>
	     <td>

		  <table class="width100">
		  <?php
		  // intitulé non renseigné
		  if ( $error AND !strlen($title) )
		  	print("
			    <tr>
				<td colspan=\"2\">
					<span style=\"color:#FF0000;\">". $msg->read($WEBLOG_ERRIDENT) ."</span>
				</td>
			    </tr>
				");
		  ?>
	    
		    <tr style="background-color:#eeeeee;">
		      <td style="width:100%;" colspan="2"><?php print($msg->read($WEBLOG_WEBSITE)); ?></td>
		    </tr>
	    
		    <tr>
		      <td colspan="2">
				<?php print("<label for=\"title\"><input type=\"text\" id=\"title\" name=\"title\" size=\"50\" value=\"$title\" /></label>"); ?>
		      </td>
		    </tr>

		  <?php
		  // intitulé non renseigné
		  if ( $error AND !strlen($url) )
		  	print("
			    <tr>
				<td colspan=\"2\">
				<span style=\"color:#FF0000;\">". $msg->read($WEBLOG_ERRURL) ."</span>
				</td>
			    </tr>
				");
		  ?>

  		    <tr style="background-color:#eeeeee;">
		      <td colspan="2"><?php print($msg->read($WEBLOG_URL)); ?></td>
		    </tr>

		    <tr>
		      <td colspan="2">
				<?php print("<label for=\"url\"><input type=\"text\" id=\"url\" name=\"url\" size=\"50\" value=\"$url\" /></label>"); ?>
		      </td>
		    </tr>

  		    <tr style="background-color:#eeeeee;">
		      <td colspan="2"><?php print($msg->read($WEBLOG_LANGUAGE)); ?></td>
		    </tr>

		    <tr>
		      <td colspan="2">
				<label for="mylang">
				<select id="mylang" name="mylang">
				<?php
					// recherche des images
					$myDir = @opendir("images/spip/langues");

					// lecture du répertoire
					while ( $entry = readdir($myDir) ) {
						switch ( extension($entry) ) {
							case "png" :	// seul le format PNG est accepté
								if ( $mylang == $entry )
									print("<option selected=\"selected\" value=\"$entry\">$entry</option>");
								else
									print("<option value=\"$entry\">$entry</option>");
								break;

							default :
								break;
							}
				              }

					closedir($myDir);
				?>
				</select>
				</label>
		      </td>
		    </tr>
		  </table>

	     </td>
	     <td></td>
	   </tr>

	   <tr>
	     <td></td>
	     <td><hr/></td>
	     <td></td>
	   </tr>
	</table>

         <table class="width100">
           <tr>
              <td style="width:10%;" class="valign-middle align-center">
              	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($WEBLOG_INPUTOK)."\" />"); ?>
              </td>
              <td class="valign-middle">
              	<?php print($msg->read($WEBLOG_UPDATE)); ?>
              </td>
           </tr>

           <tr>
              <td class="valign-middle align-center">
              	<?php print("<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDlog=$IDlog&IDgroup=$IDgroup")."\">"); ?>
              	<?php print("<img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/cancel.gif\" title=\"\" alt=\"".$msg->read($WEBLOG_INPUTCANCEL)."\" />"); ?></a>
              </td>
              <td class="valign-middle">
              	<?php print($msg->read($WEBLOG_QUIT)); ?>
              </td>
           </tr>
         </table>

	</form>

</div>