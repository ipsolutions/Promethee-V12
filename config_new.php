<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2002-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
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
 *		module   : config_new.php
 *		projet   : formulaire d'ajout d'une configuration intranet
 *
 *		version  : 2.0
 *		auteur   : laporte
 *		creation : 16/01/03
 *		modif    : 17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$submit = @$_POST["submit"];		// bouton suivant
?>


<?php
	$text = $msg->read($CONFIG_MYTUNING, strval($step));

	//==== coordonnées de l'établissement ====
	if ( $step == 1 ) {
		// saisie de la configuration
		print("
			<form id=\"formulaire\" action=\"config_init.php\" method=\"post\" enctype=\"multipart/form-data\">
				<p class=\"hidden\"><input type=\"hidden\" name=\"step\"   value=\"2\" /></p>

				<table class=\"width100\">
				  <tr>
				      <td style=\"width:100%;\" colspan=\"2\">
						<strong>$text</strong>.
					</td>
				  </tr>");

		if ( $submit == $msg->read($CONFIG_NEXT) AND !strlen($ident) )
			print("
			    <tr>
			      <td style=\"width:100%;\" class=\"align-left valign-bottom\" colspan=\"2\">
					<span style=\"color:#FF0000;\">". $msg->read($CONFIG_ERRNAME) ."</span>
				</td>
			    </tr>");

		print("
			  <tr style=\"background-color:#eeeeee;\">
			      <td style=\"width:100%; text-align: justify\" colspan=\"2\" class=\"valign-bottom\">
				  <span class=\"x-small\">". $msg->read($CONFIG_IMAGE) ."</span></td>
			  </tr>
			  <tr>
			      <td style=\"width:30%;\" class=\"align-right\">". $msg->read($CONFIG_NAME) ."</td>
			      <td style=\"width:70%;\">
					<label for=\"ident\"><input type=\"text\" id=\"ident\" name=\"ident\" size=\"40\" value=\"$ident\" /></label>
					<span style=\"color:#FF0000;\">". $msg->read($CONFIG_MANDATORY) ."</span>
				</td>
			  </tr>

			  <tr style=\"background-color:#eeeeee;\">
			      <td colspan=\"2\" class=\"valign-bottom\" style=\"text-align: justify\">
				  <span class=\"x-small\">". $msg->read($CONFIG_MAXSIZE) ."</span>
				</td>
			  </tr>
			  <tr>
			      <td class=\"valign-bottom align-right\">
				  ". $msg->read($CONFIG_LOGO) ."
				</td>
			      <td class=\"valign-bottom\">
				  <input type=\"file\" name=\"UploadedFile1\" />
				</td>
			  </tr>

			  <tr style=\"background-color:#eeeeee;\">
			      <td colspan=\"2\" class=\"valign-bottom\" style=\"text-align: justify\">
				  <span class=\"x-small\">". $msg->read($CONFIG_MAXSZREGION) ."</span>
				</td>
			  </tr>
			  <tr>
			      <td class=\"valign-bottom align-right\">
				  ". $msg->read($CONFIG_REGION) ."
				</td>
			      <td class=\"valign-bottom\">
				  <input type=\"file\" name=\"UploadedFile2\" />
				</td>
			  </tr>

			  <tr style=\"background-color:#eeeeee;\">
			      <td colspan=\"2\" class=\"valign-bottom\" style=\"text-align: justify\">
				  <span class=\"x-small\">". $msg->read($CONFIG_COLOR) ."</span>
				</td>
			  </tr>
			  <tr>
			      <td class=\"align-right\">". $msg->read($CONFIG_THEME) ."</td>
			      <td>
					<label for=\"IDtheme\">
					<select id=\"IDtheme\" name=\"IDtheme\">");

		           	// lecture des thèmes
				$result = mysql_query("select _IDtheme, _theme from config_theme order by _IDtheme", $mysql_link);
				$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

				while ( $row ) {
					$select = ( 2 == $row[0] ) ? "selected=\"selected\"" : "" ;

					print("<option value=\"$row[0]\" $select >$row[1]</option>");

					$row    = remove_magic_quotes(mysql_fetch_row($result));
					}

		print("
					</select>
					</label>
				</td>
			  </tr>");

		if ( $submit == $msg->read($CONFIG_NEXT) AND ($adresse == "" OR $zip == "" OR $city == "") )
			print("
			    <tr>
			      <td style=\"width:100%;\" class=\"align-left valign-bottom\" colspan=\"2\">
				  <span style=\"color:#FF0000;\">". $msg->read($CONFIG_ERRADDRESS) ."</span>
				</td>
			    </tr>");

		print("
			  <tr>
			      <td class=\"align-right\">". $msg->read($CONFIG_ADDRESS) ."</td>
			      <td>
					<label for=\"adresse\"><input type=\"text\" id=\"adresse\" name=\"adresse\" size=\"40\" value=\"$adresse\" /></label>
					<span style=\"color:#FF0000;\">". $msg->read($CONFIG_MANDATORY) ."</span>
				</td>
			  </tr>
			  <tr>
			      <td class=\"align-right\">". $msg->read($CONFIG_ZIPCODE) ."</td>
			      <td>
					<label for=\"zip\"><input type=\"text\" id=\"zip\" name=\"zip\" size=\"8\" value=\"$zip\" /></label> - 
					<label for=\"city\"><input type=\"text\" id=\"city\" name=\"city\" size=\"20\" value=\"$city\" /></label>
					<span style=\"color:#FF0000;\">". $msg->read($CONFIG_MANDATORY) ."</span>
				</td>
			  </tr>");

		if ( $submit == $msg->read($CONFIG_NEXT) AND !strlen($tel) )
			print("
			    <tr>
			      <td style=\"width:100%;\" class=\"align-left valign-bottom\" colspan=\"2\">
				  <span style=\"color:#FF0000;\">". $msg->read($CONFIG_ERRTEL) ."</span>
				</td>
			    </tr>");

		print("
			  <tr>
			      <td class=\"align-right\">". $msg->read($CONFIG_TEL) ."</td>
			      <td>
					<label for=\"tel\"><input type=\"text\" id=\"tel\" name=\"tel\" size=\"20\" value=\"$tel\" /></label>
					<span style=\"color:#FF0000;\">". $msg->read($CONFIG_MANDATORY) ."</span>
				</td>
			  </tr>
			  <tr>
			      <td class=\"align-right\">". $msg->read($CONFIG_FAX) ."</td>
			      <td>
					<label for=\"fax\"><input type=\"text\" id=\"fax\" name=\"fax\" size=\"20\" value=\"$fax\" /></label>
				</td>
			  </tr>
			  <tr>
			      <td class=\"align-right\">". $msg->read($CONFIG_WEBSITE) ."</td>
			      <td>
					<label for=\"web\"><input type=\"text\" id=\"web\" name=\"web\" size=\"40\" value=\"$web\" /></label>
				</td>
			  </tr>
			  <tr>
			      <td class=\"align-right\">". $msg->read($CONFIG_EMAIL) ."</td>
			      <td>
					<label for=\"email\"><input type=\"text\" id=\"email\" name=\"email\" size=\"40\" value=\"$email\" /></label>
				</td>
			  </tr>
			</table>

			<hr style=\"width:80%;\" />

		      <p style=\"margin-top: 10; margin-bottom: 0;text-align:right;\">
			". $msg->read($CONFIG_TYPE) ." <input type=\"submit\" value=\"". $msg->read($CONFIG_NEXT) ."\" name=\"submit\" />
			</p>
      
			</form>");
		}

	//==== paramétrage du type d'établissement ====
	if ( $step == 2 ) {
		// saisie de la configuration
		print("
			<form id=\"formulaire\" action=\"config_init.php\" method=\"post\">
				<p class=\"hidden\"><input type=\"hidden\" name=\"step\"   value=\"3\" /></p>

				<table class=\"width100\">
				  <tr>
				      <td style=\"width:100%;\" colspan=\"2\">
						<strong>$text</strong>.<br/>
					</td>
				  </tr>

				  <tr style=\"background-color:#eeeeee;\">
				      <td style=\"width:100%; text-align: justify\" colspan=\"2\" class=\"valign-bottom\">
					  <span class=\"x-small\">". $msg->read($CONFIG_GETCENTER) ."</span>
					</td>
				  </tr>
				  <tr>
				      <td style=\"width:30%;\" class=\"valign-top align-right\">
					  ". $msg->read($CONFIG_CENTERTYPE) ."
					</td>
				      <td style=\"width:70%;\" class=\"valign-bottom\">");

				// lecture des centres constitutifs
				$query  = "select _IDcentre, _ident, _visible from config_centre ";
				$query .= "where _lang = '".$_SESSION["lang"]."' ";
				$query .= "order by _IDcentre";

				$return = mysql_query($query, $mysql_link);
				$centre = ( $return ) ? mysql_fetch_row($return) : 0 ;

				while ( $centre ) {
					$check = ( $centre[2] == "O" ) ? "checked=\"checked\"" : "" ;

					print("<label for=\"cb_$centre[0]\"><input type=\"checkbox\" id=\"cb_$centre[0]\" name=\"cb[]\" value=\"$centre[0]\" $check /></label> $centre[1]<br/>");

					$centre = mysql_fetch_row($return);
					}

		print("
					</td>
				  </tr>
				</table>

			<hr style=\"width:80%;\" />

		      <p  style=\"text-align:right;margin-top: 10; margin-bottom: 0\">
			". $msg->read($CONFIG_TERMINATE) ." <input type=\"submit\" value=\"". $msg->read($CONFIG_SEND) ."\" name=\"submit\" />
			</p>
			</form>");
		}
?>
