<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007-2010 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : login.php
 *		projet   : page de demande d'une clef d'activivation P2P
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 27/12/07
 *		modif    : 
 */


$key     = ( @$_POST["key"] )				// clef de connexion
	? $_POST["key"]
	: @$_GET["key"] ;
$url     = ( @$_POST["url"] )				// site web établissement
	? $_POST["url"]
	: @$_GET["url"] ;
$basedir = ( @$_POST["basedir"] )			// répertoire d'installation de Prométhée
	? $_POST["basedir"]
	: @$_GET["basedir"] ;
$ident   = ( @$_POST["ident"] )			// nom établissement
	? $_POST["ident"]
	: @$_GET["ident"] ;
$address = ( @$_POST["address"] )			// adresse établissement
	? $_POST["address"]
	: @$_GET["address"] ;
$zip     = ( @$_POST["zip"] )				// code postal établissement
	? $_POST["zip"]
	: @$_GET["zip"] ;
$city    = ( @$_POST["city"] )			// ville établissement
	? $_POST["city"]
	: @$_GET["city"] ;
$tel     = ( @$_POST["tel"] )				// téléphone établissement
	? $_POST["tel"]
	: @$_GET["tel"] ;
$fax     = ( @$_POST["fax"] )				// fax établissement
	? $_POST["fax"]
	: @$_GET["fax"] ;
$admin   = ( @$_POST["admin"] )			// email webmaster
	? $_POST["admin"]
	: @$_GET["admin"] ;
$public  = ( @$_POST["public"] )			// accès public pour hébergement
	? $_POST["public"]
	: @$_GET["public"] ;

$submit  = @$_POST["submit_x"];			// bouton de validation

//---------------------------------------------------------------------------
function isValidEmail($address)
{
/*
 * fonction :	test si une adresse email est valide ou non
 * in :		$address : adresse email
 * out :		true si valide, false sinon
 */

	if ( mb_ereg(".*<(.+)>", $address, $regs) )
		$address = $regs[1];

 	return ( mb_ereg("^[^@  ]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}|net|com|gov|mil|org|edu|int)\$", $address) ) 
 		? true
	 	: false ;
}
//---------------------------------------------------------------------------
?>


<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/server.php";
	require_once "include/TMessage.php";

	$msg = new TMessage("msg/".$_SESSION["lang"]."/server.php");
?>

<div><img src="download/logos/<?php echo rawurlencode($_SESSION["CfgIdent"]) ?>/logo01.jpg" title="" alt="" /></div>

<div class="maintitle" style="background-image: url('<?php echo $_SESSION["CfgHeader"]; ?>'); background-repeat: repeat;">
	<div style="text-align: center;">
		<?php print($msg->read($SERVER_TITLE)); ?>
	</div>
</div>

<div class="maincontent">
<?php
	// initialisation
	$query  = "select _visible, _basedir ";
	$query .= "from p2p_data ";
	$query .= "where _key = '$key' ";
	$query .= "limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $submit ) {
		$key     = trim($key);					// clef de connexion
		$url     = trim($url);					// site web établissement
		$basedir = trim($basedir);				// répertoire d'installation de Prométhée
		$ident   = stripslashes(trim($ident));		// nom établissement
		$address = stripslashes(trim($address));		// adresse établissement
		$zip     = stripslashes(trim($zip));		// code postal établissement
		$city    = stripslashes(trim($city));		// ville établissement
		$tel     = trim($tel);					// téléphone établissement
		$fax     = trim($fax);					// fax établissement
		$admin   = trim($admin);				// email webmaster
		$public  = ( $public ) ? "O" : "N" ;		// accès public pour hébergement

		// vérification
		if ( $ident == "" OR $address == "" OR $zip == "" OR $city == "" OR $tel == "" OR $url == "" OR !isValidEmail($admin) )
			print("<p style=\"text-align:center;\">".$msg->read($SERVER_ERROR)."</p>");
		else {
			// confirmation formulaire
			$newkey  = SessionID();
			$ident   = addslashes($ident);
			$address = addslashes($address);
			$date    = date("Y-m-d H:i:s");
			$http    = ( strstr($url, "http://") OR strstr($url, "https://") )
				? $url
				: "http://$url" ;

			$query   = "insert into p2p_data ";
			$query  .= "values('', '$newkey', '$ident', '$address', '$zip', '$city', '$tel', '$fax', '$http', '$basedir', '$admin', '$date', '', 'N', '$public')";

			if ( !mysql_query($query, $mysql_link) ) {
				$query  = "update p2p_data ";
				$query .= "set _key = '$newkey', _basedir = '$basedir', _adresse = '$address', _zip = '$zip', _city = '$city', _tel = '$tel', _fax = '$fax', _url = '$url', _update = '$date' ";
				$query .= "where _key = '$key' ";
				$query .= "limit 1";

				if ( mysql_query($query, $mysql_link) )
					// envoi d'un email aux utilisateurs
					if ( $row[0] == "O" ) {
						require_once "lib/libmail.php";

						$mymail = new Mail();	// create the mail

						$mymail->From("noreply@".$_SESSION["CfgWeb"]);
						$mymail->To($admin);
						$mymail->Subject($msg->read($SERVER_YOURKEY));	
						$mymail->Body($msg->read($SERVER_OBJECT, Array($key, $WEBSITE)));	// set the body

						$mymail->Send();		// send the mail
						}
				}
			else
				// envoi d'un email à l'administrateur
				if ( isValidEmail($_SESSION["CfgAdmin"]) ) {
					$mymail = new Mail(); // create the mail

					// corps du message
					$texte  = $msg->read($SERVER_AWAITBODYTEXT, $ident);
					$texte .= "\n--\n";
					$texte .= $_SESSION["CfgAdr"] . "\n";
					$texte .= $_SESSION["CfgWeb"];

					$mymail->From("noreply@".$_SESSION["CfgWeb"]);
					$mymail->To($_SESSION["CfgAdmin"]);
					$mymail->Subject($msg->read($SERVER_AWAITING, $_SESSION["CfgWew"]));	
					$mymail->Body($texte, $CHARSET);	// set the body

					$mymail->Send();	// send the mail
					}

			print("<p style=\"text-align:center;\">".$msg->read($SERVER_KEYSENT, $admin)."</p>");
			}
		}
	else {
		// affichage formulaire
		$rdonly = ( $public == "N" ) ? "readonly=\"readonly\"" : "" ;

		print("
			<form id=\"formulaire\" action=\"\" method=\"post\">

			<table summary=\"\" width=\"100%\" cellspacing=\"0\" cellpadding=\"5\">
		        <tr>
		          <td style=\"width:30%;\" align=\"right\">".$msg->read($SERVER_IDENT)."</td>
			    <td>
				<label for=\"ident\">
				<input type=\"text\" id=\"ident\" name=\"ident\" value=\"$ident\" size=\"30\" $rdonly /> * 
				</label>");

				$alt  = strlen($ident) ? "O" : "X" ;
				$isok = strlen($ident) ? "on" : "off" ;

				print("<img src=\"images/setup/check_$isok.png\" title=\"\" alt=\"$alt\" />");

		print("
			    </td>
		        </tr>

		        <tr>
		          <td align=\"right\">".$msg->read($SERVER_ADDRESS)."</td>
			    <td>
				<label for=\"address\">
				<input type=\"text\" id=\"address\" name=\"address\" value=\"$address\" size=\"30\" $rdonly /> * 
				</label>");

				$alt  = strlen($address) ? "O" : "X" ;
				$isok = strlen($address) ? "on" : "off" ;

				print("<img src=\"images/setup/check_$isok.png\" title=\"\" alt=\"$alt\" />");

		print("
			    </td>
		        </tr>

		        <tr>
		          <td align=\"right\">".$msg->read($SERVER_ZIPCODE)."</td>
			    <td>
				<label for=\"zip\">
				<input type=\"text\" id=\"zip\" name=\"zip\" value=\"$zip\" size=\"6\" $rdonly />
				</label> -
				<label for=\"city\">
				<input type=\"text\" id=\"city\" name=\"city\" value=\"$city\" size=\"20\" $rdonly /> * 
				</label>");

				$alt  = ( strlen($zip) AND strlen($city) ) ? "O" : "X" ;
				$isok = ( strlen($zip) AND strlen($city) ) ? "on" : "off" ;

				print("<img src=\"images/setup/check_$isok.png\" title=\"\" alt=\"$alt\" />");

		print("
			    </td>
		        </tr>

		        <tr>
		          <td align=\"right\">".$msg->read($SERVER_TEL)."</td>
			    <td>
				<label for=\"tel\">
				<input type=\"text\" id=\"tel\" name=\"tel\" value=\"$tel\" size=\"30\" $rdonly /> * 
				</label>");

				$alt  = strlen($tel) ? "O" : "X" ;
				$isok = strlen($tel) ? "on" : "off" ;

				print("<img src=\"images/setup/check_$isok.png\" title=\"\" alt=\"$alt\" />");

		print("
			    </td>
		        </tr>

		        <tr>
		          <td align=\"right\">".$msg->read($SERVER_FAX)."</td>
			    <td>
				<label for=\"fax\">
				<input type=\"text\" id=\"fax\" name=\"fax\" value=\"$fax\" size=\"30\" $rdonly />
				</label>
			    </td>
		        </tr>

		        <tr>
		          <td align=\"right\">".$msg->read($SERVER_URL)."</td>
			    <td>
				<label for=\"url\">
				<input type=\"text\" id=\"url\" name=\"url\" value=\"$url\" size=\"30\" $rdonly /> * 
				</label>");

				$alt  = strlen($url) ? "O" : "X" ;
				$isok = strlen($url) ? "on" : "off" ;

				print("<img src=\"images/setup/check_$isok.png\" title=\"\" alt=\"$alt\" />");

		print("
			    </td>
		        </tr>

		        <tr>
		          <td align=\"right\">".$msg->read($SERVER_BASEDIR)."</td>
			    <td>
				<label for=\"basedir\">
				<input type=\"text\" id=\"basedir\" name=\"basedir\" value=\"$row[1]\" size=\"30\" />
				</label>
			    </td>
		        </tr>

		        <tr>
		          <td align=\"right\">".$msg->read($SERVER_ADMIN)."</td>
			    <td>
				<label for=\"admin\">
				<input type=\"text\" id=\"admin\" name=\"admin\" value=\"$admin\" size=\"30\" $rdonly /> * 
				</label>");

				$alt  = isValidEmail($admin) ? "O" : "X" ;
				$isok = isValidEmail($admin) ? "on" : "off" ;

				print("<img src=\"images/setup/check_$isok.png\" title=\"\" alt=\"$alt\" />");

		print("
			    </td>
		        </tr>

		        <tr>
		          <td colspan=\"2\" align=\"center\"><hr style=\"width:80%;\" /></td>
		        </tr>

		        <tr>
		          <td valign=\"middle\" align=\"right\">
				<input type=\"image\" src=\"images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"submit\" alt=\"".$msg->read($SERVER_INPUTOK)."\" />
		          </td>
		          <td valign=\"middle\">".$msg->read($SERVER_VALIDATE)."</td>
		        </tr>
			</table>

			</form>");
		}
?>
</div>

<p style="text-align:center;">
	[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($SERVER_CLOSEWINDOW)); ?></a>]
</p>

</body>
