<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2008 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by FG (persofg@gmail.com)
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
 *-----------------------------------------------------------------------*/


/*
 *		module   : weblog_post.htm
 *		projet   : la page de saisie des messages du weblog
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 3/10/04
 *		modif    : 16/06/05 par FG
 *                     migration -> PHP5
 * 		           17/07/06 - par Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDitem  = ( @ $_POST["IDitem"] )
	? (int) $_POST["IDitem"]
	: (int) @$_GET["IDitem"] ;
$parent  = ( @$_POST["parent"] )
	? (int) $_POST["parent"]
	: (int) @$_GET["parent"] ;

$IDdata  = (int) ( @$_POST["IDdata"] )
	? $_POST["IDdata"]
	: @$_GET["IDdata"] ;
$theme   = addslashes(trim(@$_POST["theme"]));
$subject = addslashes(trim(@$_POST["subject"]));
$texte   = addslashes(trim(@$_POST["texte"]));
$edit    = ( strlen(@$_POST["edit"]) )	// mode d'édition : basique ou avancé
	? (int) $_POST["edit"]
	: (int) (strlen(@$_GET["edit"]) ? $_GET["edit"] : $WYSIWYG) ;
?>


<script src="script/ckeditor/ckeditor.js"></script>

<div class="maincontent">

<?php
	// initialisation
	$raw = "";
	$error_theme = $error_subject = $error_texte = 0;

	switch ( $submit ) {
		case "Valider" :	// l'utilisateur a posté son message
			$isok = 0;

			// test de la saisie
			$error_theme   = ( $IDdata ) ? 0 : !strlen($theme) ;
			$error_subject = ( strlen($subject) ) ? 0 : 1 ;
			$error_texte   = ( strlen($texte) )   ? 0 : 1 ;

			if ( !$error_theme AND !$error_subject AND !$error_texte ) {
				// date de création du message
				$date = date("Y-m-d H:i:s");

				// mode SPIP ou WYSIWYG
				$raw  = ( $edit ) ? "N" : "O" ;

				// la catégorie
				if ( $IDdata == 0 ) {
					$Query  = "insert into weblog_data ";
					$Query .= "values('', '$IDlog', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '$theme')";

					if ( mysql_query($Query, $mysql_link) )
						$IDdata = mysql_insert_id();
					}

				// le message
				if ( $IDitem AND $IDdata ) {
					$Query  = "update weblog_items ";
					$Query .= "set _title = '$subject', _text = '$texte', _update = '$date' ";
					$Query .= "where _IDitem = '$IDitem' ";
					$Query .= "limit 1";

					$isok   = mysql_query($Query, $mysql_link);
					}
				else {
					$Query  = "insert into weblog_items ";
					$Query .= "values('', '$IDdata', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '$date', '$date', '$parent', '$subject', '$texte', '$raw')";

					$isok   = mysql_query($Query, $mysql_link);

					if ( $isok ) {
						$IDitem = mysql_insert_id();

						// transfert d'une Pièce Jointe
						$file   = @$_FILES["UploadPJ"]["tmp_name"];
						if ( $file AND authfile(@$_FILES["UploadPJ"]["name"]) ) {
							// fichier destination
							$dest = "$DOWNLOAD/weblog/$IDitem-" . @$_FILES["UploadPJ"]["name"];

							// copie du fichier temporaire -> répertoire de stockage
							if ( move_uploaded_file($file, $dest) ) {
								mychmod($dest, $CHMOD);

								$Query  = "INSERT INTO weblog_pj ";
								$Query .= "values('', '$IDitem', '".@$_FILES["UploadPJ"]["name"]."', '".@$_FILES["UploadPJ"]["size"]."')";

								$isok   = mysql_query($Query, $mysql_link);
								}
							}
						}
					}

				if ( !$isok )
					sql_error($mysql_link);
				else {
					$retour = myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDlog=$IDlog&cmde=visu&year=$year&month=$month&day=$day");

					print("
						<div class=\"center\">
      						". $msg->read($WEBLOG_SENTOK) ."<br/>
      						". $msg->read($WEBLOG_THANX) ."<br/>
							[<a href=\"$retour\">".$msg->read($WEBLOG_BACK2BLOG)."</a>]
						</div>
						");
					}
				}
			break;

		default :
			if ( $IDitem ) {
				// lecture du message
				$result = mysql_query("select _title, _text, _raw from weblog_items where _IDitem = '$IDitem' limit 1", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				// initialisation des champs de saisie
				$subject = $row[0];
				$texte   = $row[1];
				$raw     = $row[2];
				}
			break;
		}

	// saisie du formulaire si
	// - l'utilisateur n'a pas validé OU
	// - il y a une erreur de saisie => on redemande de compléter le formulaire
	if ( $submit != "Valider" OR $error_theme OR $error_subject OR $error_texte ) {
		print("
			<form id=\"formulaire\" action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\">
				<p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\"/></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDgroup\" value=\"$IDgroup\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDlog\"   value=\"$IDlog\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDitem\"  value=\"$IDitem\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"submit\"  value=\"Valider\" /></p>

			  <table class=\"width100\">
			");

		// lecture des catégories
		$Query  = "select _IDdata from weblog_data ";
		$Query .= "where _IDlog = '$IDlog' ";

		$result = mysql_query($Query, $mysql_link);
		$nbrow  = ( $result ) ? mysql_numrows($result) : 0 ;

		// saisie de la catégorie
		if ( $nbrow AND $IDdata != -1 ) {
			// ajouter une catégorie
			$add = "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDlog=$IDlog&IDdata=-1&submit=post")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/ajouter.gif\" title=\"\" alt=\"+\" /></a>";

		    	print("
			    <tr>
			      <td style=\"background-color:#eeeeee;\">". $msg->read($WEBLOG_CATEGORY) ."</td>
			    </tr>
			    <tr>
			      <td>
				  <label for=\"IDdata\">
					<select id=\"IDdata\" name=\"IDdata\">");

					// recherche des dossiers
					$query  = "select _IDdata, _title from weblog_data ";
					$query .= "where _IDlog = '$IDlog' ";
					$query .= "order by _title";

					$result = mysql_query($query, $mysql_link);
					$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

					while ( $row ) {
						$select = ( $IDdata == $row[0] ) ? "selected=\"selected\"" : "" ;

						print("<option value=\"$row[0]\" $select>$row[1]</option>");

						$row = remove_magic_quotes(mysql_fetch_row($result));
						}

		    	print("
					</select>
				  </label> $add
				</td>
			    </tr>
			    	");
			}
		else {
			if ( $error_theme )
				print("    
				    <tr>
					<td>
						<span style=\"color:#FF0000;\">".$msg->read($WEBLOG_ERRCATEGORY)."</span>
					</td>
				    </tr>
					");

		    	print("
			    <tr>
			      <td style=\"background-color:#eeeeee;\">". $msg->read($WEBLOG_CATEGORY) ."</td>
			    </tr>
			    <tr>
			      <td>
					<label for=\"theme\"><input type=\"text\" id=\"theme\" name=\"theme\" size=\"65\" /></label>
				</td>
			    </tr>
			    	");
			}

		// saisie du sujet
		if ( $error_subject )
			print("    
			    <tr>
				<td>
					<span style=\"color:#FF0000;\">".$msg->read($WEBLOG_ERRSUBJECT)."</span>
				</td>
			    </tr>
				");

	    	print("
		    <tr>
		      <td style=\"background-color:#eeeeee;\">". $msg->read($WEBLOG_SUBJECT) ."</td>
		    </tr>
		    <tr>
		      <td><label for=\"subject\"><input type=\"text\" id=\"subject\" name=\"subject\" size=\"65\" value=\"$subject\" /></label></td>
		    </tr>
		    	");

		// saisie du message à poster
		if ( $error_texte )
			print("    
			    <tr>
				<td>
					<span style=\"color:#FF0000;\">".$msg->read($WEBLOG_ERRMESSAGE)."</span>
				</td>
			    </tr>
				");

		// une fois un texte saisi dans un certain mode, il n'est plus possible d'en changer
		if ( $raw ) {
			$edit    = ( $raw == "O" ) ? 0 : 1 ;
			$editor  = ( $raw == "O" ) ? $msg->read($WEBLOG_BASIC) : $msg->read($WEBLOG_ADVANCED) ;
			}
		else {
			$toggle  = (int) ! $edit;
			$editor  = "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&edit=$toggle")."\">";
			$editor .= ( $edit ) ? $msg->read($WEBLOG_BASIC) : $msg->read($WEBLOG_ADVANCED) ;
			$editor .= "</a>";
			}

		print("
		    <tr>
		      <td style=\"background-color:#eeeeee;\">
		        ". $msg->read($WEBLOG_MESSAGE) ." <a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/spip_typo.php?lang=".$_SESSION["lang"]."', '450', '350'); return false;\">
		        <img src=\"".$_SESSION["ROOTDIR"]."/images/spip/aide.gif\" title=\"".$msg->read($WEBLOG_HELP)."\" alt=\"".$msg->read($WEBLOG_HELP)."\" /></a>
		      </td>
		    </tr>
		    <tr>
		      <td>
			");

		if ( $edit ) {
			/*$oFCKeditor           = new FCKeditor("texte") ;
			$oFCKeditor->BasePath = "./script/fckeditor/";
			$oFCKeditor->Height   = 500;
			$oFCKeditor->Value    = $texte;
			$oFCKeditor->Create() ;*/
			?>
				<textarea name="texte" id="texte"><?php echo $texte; ?></textarea>
				<script>
				CKEDITOR.replace('texte');
				</script>
			<?php
			}
		else
			print("<label for=\"texte\"><textarea id=\"texte\" name=\"texte\" rows=\"20\" cols=\"60\">$texte</textarea></label>");

		print("
		      </td>
		    </tr>

                <tr>
                  <td>
			");

		if ( !$edit ) {
			// affichage des smileys d'édition
			$result = mysql_query("select _code, _ident from smileys where _type = 'T'", $mysql_link);
			$smile  = ( $result ) ? mysql_fetch_row($result) : 0 ;

			while ( $smile ) {
				print("
					<img src=\"".$_SESSION["ROOTDIR"]."/images/smiley/forum/$smile[1].gif\" title=\" code: $smile[0] \" alt=\" code: $smile[0] \" 
					onclick=\"Javacript:ajoutsmile('$smile[0]')\" style=\"cursor: hand;\" />
					");
				
				$smile = ( $result ) ? mysql_fetch_row($result) : 0 ;
				}
			}

		print("
                  </td>
                </tr>
			");

		// Pièce Jointe sur un message
		if ( $auth[3] == "O" )
		    	print("
			    <tr>
			      <td colspan=\"2\" class=\"align-left\">". $msg->read($WEBLOG_ATTACHED) ."
					<p class=\"hidden\"><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$FILESIZE\" /></p>
					<input type=\"file\" name=\"UploadPJ\" style=\"font-size:9px;\" />
			      </td>
			    </tr>
				");

		print("
			</table>

	         <table class=\"width100\">
	           <tr>
	              <td style=\"width:100%;\" colspan=\"2\"><hr style=\"width:80%;\" /></td>
	           </tr>
	           <tr>
	              <td style=\"width:10%;\" class=\"valign-middle align-center\">
	              	<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($WEBLOG_INPUTOK)."\" />
	              </td>
	              <td class= \"valign-middle\">". $msg->read($WEBLOG_POST) ."</td>
	           </tr>
	         </table>

		</form>
			");
		}
?>

</div>
