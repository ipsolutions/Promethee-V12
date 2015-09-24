<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2013 by IP-Solutions(contact@ip-solutions.fr)

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
 *		module   : mail.php
 *
 *		version  : 1.0
 *		auteur   : IP-Solutions
 *		creation : 30/10/2013
 *		modif    : 
 */
?>

<?php
/** Etape 1 : initialisation de la session **/
$ch= curl_init() ;
/** Etape 2 : définition des options **/
curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
curl_setopt($ch, CURLOPT_URL, "https://ssl0.ovh.net/roundcube");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPHOST, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
/** Etape 3 : exécution de la requête **/
$content = curl_exec($ch) ;
/** Etape 4 : fermeture de la session **/
curl_close($ch) ;

$token = $content;
$token = substr($token, strpos($token, "_token\":\"") + 9);
$token = substr($token, 0, strpos($token, "\""));

$Query  = "select _email from user_id ";
$Query .= "where _ID = ".$_SESSION["CnxID"]." ";

$result = mysql_query($Query, $mysql_link);
$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

?>
<iframe src="https://ssl0.ovh.net/roundcube/?_task=logout" id="pre_frame" style="display: none"></iframe>
<form action="https://ssl0.ovh.net/roundcube/?_task=login" method="post" target="my_iframe" id="my_form">
	<input name="_action" type="hidden" value="login" />
	<input name="_user" type="hidden" value="<?php echo $row[0]; ?>" />
	<input name="_pass" type="hidden" value="pmtips00" />
	<input name="_timezone" type="hidden" value="2" />
	<input name="_token" type="hidden" value="<?php echo $token; ?>" />
	<input name="_url" type="hidden" value="" />
</form>

<script>
jQuery("#pre_frame").load(function() {
	jQuery("#my_form").ready(function() {
		jQuery("#my_form").submit();
	});
});
</script>

<div>
<iframe src="about:blank" class="width100" style="border: 0; height: 600px" name="my_iframe" id="my_frame"></iframe>
</div>