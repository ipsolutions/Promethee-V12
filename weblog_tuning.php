<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2008 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : weblog_tuning.php
 *		projet   : la page de personalisation des weblog
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/09/08
 *		modif    : 
 */


$texte  = addslashes(trim(@$_POST["texte"]));
$rb     = ( @$_POST["rb"] ) ? $_POST["rb"] : "O" ;

$submit = @$_POST["submit"];			// bouton de validation
?>


<?php
	// initialisation
	$errident = "";
	$statut   = $msg->read($WEBLOG_MODIFICATION);

	// suppression image
	if ( @$_GET["delimg"] )
		unlink("$DOWNLOAD/weblog/img/$IDlog.png");

	// traitement commande
	if ( $submit == "tuning_ok" ) {
		$Query  = "update weblog ";
		$Query .= "set _text = '$texte', _comment = '$rb' ";
		$Query .= "where _IDlog = $IDlog ";
		$Query .= "limit 1";

		$statut .= ( mysql_query($Query, $mysql_link) )
			? " <img src=\"".$_SESSION["ROOTDIR"]."/images/ok.gif\" title=\"\" alt=\"\" />"
			: " <img src=\"".$_SESSION["ROOTDIR"]."/images/bad.gif\" title=\"\" alt=\"\" /> " ;

		// fichier à transférer
		$file  = @$_FILES["UploadedFile"]["tmp_name"];

		if ( $file AND authfile(@$_FILES["UploadedFile"]["name"]) AND strstr($statut, "ok.gif") ) {
			require_once "include/gallery.php";

	 		switch ( extension(@$_FILES["UploadedFile"]["name"]) ) {
				case "gif" :
				case "jpg" :
				case "jpeg" :
				case "png" :
					// copie du fichier temporaire -> répertoire de stockage
					@unlink("$DOWNLOAD/weblog/img/$IDlog.png");

					// création de la vignette
					vignette("$file|".@$_FILES["UploadedFile"]["name"], "$DOWNLOAD/weblog/img", "$IDlog.png", $srcWidth, $srcHeight, 300, 300);
					break;
				default :
	    				break;
				}
			}
		}

	// lecture du weblog
	$Query  = "select _text, _comment from weblog ";
	$Query .= "where _IDlog = '$IDlog' ";
	$Query .= "limit 1";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	// lectures de données
	$texte  = $row[0];
	$rb     = ( $row[1] ) ? $row[1] : "O" ;

	// on vérifie si la photo existe
	$photo = ( file_exists("$DOWNLOAD/weblog/img/$IDlog.png") ) 
		? "$DOWNLOAD/weblog/img/$IDlog.png"
		: $_SESSION["ROOTDIR"]."/css/themes/".$_SESSION["CfgTheme"]."/images/0.gif" ;
?>

<div class="maincontent">

		<form id="formulaire" action="index.php" method="post" enctype="multipart/form-data">
		<?php
			print("
				<p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDlog\"   value=\"$IDlog\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDgroup\" value=\"$IDgroup\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"submit\"  value=\"tuning_ok\" /></p>
				");
		?>

            <table class="width100">
              <tr>
                <td style="width:20;%;" class="valign-top align-right">
			<?php print($msg->read($WEBLOG_STATUS)); ?>
                </td>
                <td style="width:80;%;" class="valign-top">
			<?php print("$statut"); ?>
                </td>
              </tr>

              <tr>
                <td class="align-center valign-top">
			<?php
				// on vérifie si la photo existe
				$delete = ( file_exists("$DOWNLOAD/weblog/img/$IDlog.png") ) 
					? "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDlog=$IDlog&IDgroup=$IDgroup&delimg=1&submit=tuning")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($WEBLOG_DELIMG)."\" alt=\"".$msg->read($WEBLOG_DELIMG)."\" /></a>"
					: "" ;

				print("<img src=\"$photo\" title=\"$photo\" alt=\"$photo\" />");

				imageSize($photo, $srcWidth, $srcHeight);

				print("<br/>$srcWidth x $srcHeight<br/>$delete");
			?>
                </td>
                <td class="valign-top">

			<div style="border:#cccccc solid 1px;">

				<table class="width100">

				<?php
					print("
						  <tr>
							<td class=\"align-right valign-top\">
							  ". $msg->read($WEBLOG_DESCRIPTION) ." <a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/spip_typo.php?lang=".$_SESSION["lang"]."', '450', '350'); return false;\">
		        				  <img src=\"".$_SESSION["ROOTDIR"]."/images/spip/aide.gif\" title=\"". $msg->read($WEBLOG_HELP) ."\" alt=\"". $msg->read($WEBLOG_HELP) ."\" /></a> :
							</td>
				                  <td>
			                          <label for=\"texte\"><textarea id=\"texte\" name=\"texte\" rows=\"5\" cols=\"40\">$texte</textarea></label>
			                        </td>
						  </tr>");

					$check1 = ( $rb == "N" ) ? "checked=\"checked\"" : "" ;
					$check2 = ( $rb == "O" ) ? "checked=\"checked\"" : "" ;

					print("
			                    <tr>
			                        <td class=\"align-right valign-middle\">". $msg->read($WEBLOG_AUTHCOMMENTS) ."</td>
			                        <td>
							  <label for=\"rb_N\"><input type=\"radio\" id=\"rb_N\" name=\"rb\" value=\"N\" $check1 />". $msg->read($WEBLOG_NO) ."</label>
							  <label for=\"rb_O\"><input type=\"radio\" id=\"rb_O\" name=\"rb\" value=\"O\" $check2 />". $msg->read($WEBLOG_YES) ."</label>
			                        </td>
			                    </tr>

			                    <tr>
							<td class=\"align-right valign-middle\">". $msg->read($WEBLOG_IMAGE) ."</td>
							<td>
							  <p class=\"hidden\"><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$FILESIZE\" /></p>
			      			  <input type=\"file\" name=\"UploadedFile\" />
							</td>
			                    </tr>

			                    <tr>
							<td class=\"align-center\" colspan=\"2\"><hr style=\"width:80%;\" /></td>
			                    </tr>

			                    <tr>
							<td class=\"valign-middle align-right\">
							  <input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($WEBLOG_INPUTOK)."\" />
							</td>
							<td class= \"valign-middle\">
			              		  ". $msg->read($WEBLOG_UPDATE) ."
							</td>
			                    </tr>

				              <tr>
							<td class=\"valign-middle align-right\">
				              	  <a href=\"".myurlencode("index.php?item=$item&cmde=visu&IDlog=$IDlog&IDgroup=$IDgroup")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/cancel.gif\" title=\"\" alt=\"".$msg->read($WEBLOG_INPUTCANCEL)."\" /></a>
							</td>
							<td class= \"valign-middle\">
				              	  ". $msg->read($WEBLOG_QUIT) ."
			      			</td>
						  </tr>");
				?>

				</table>

			</div>

                </td>
              </tr>
            </table>

		</form>

</div>