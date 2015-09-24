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
 *		module   : stage_cv.php
 *		projet   : page de saisie du CV
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 5/08/07
 *		modif    : 
 */


$sid      = @$_GET["sid"];						// session de l'utilisateur
$idx      = (int) @$_GET["idx"];					// index de l'enregistrement
$msgid    = (int) @$_GET["msgid"];					// paragraphe du parcours

$start    = addslashes(trim(@$_POST["start"]));			// date début
$end      = addslashes(trim(@$_POST["end"]));			// date fin
$company  = addslashes(trim(@$_POST["company"]));		// nom société
$detail   = addslashes(trim(@$_POST["detail"]));		// détails
$IDposte  = (int) @$_POST["IDposte"];				// ID du type de poste
$IDdegree = (int) @$_POST["IDdegree"];				// ID du diplome
$IDlang   = (int) @$_POST["IDlang"];				// ID de la langue
$IDlevel  = (int) @$_POST["IDlevel"];				// niveau de maîtrise

$submit   = @$_POST["valid_x"];					// bouton de validation
?>


<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?php require "page_banner.htm"; ?>

<body style="background-color:#FFFFFF; margin:5px;">

<?php
	require "msg/stage.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/stage.php");

	// qui suis-je ?
	$query  = "select distinctrow user_id._ID from user_id, user_session ";
	$query .= "where user_session._IDsess = '$sid' " ;
	$query .= "AND user_id._ID = user_session._ID ";
	$query .= "order by _lastaction limit 1";

	$result = mysql_query($query, $mysql_link);
	$row    = ( $result ) ? mysql_fetch_row($result) : 0 ;

	if ( $submit ) {
		// initialisation
		$error  = false;

		// le CV
		$query  = "select _IDcv from cv ";
		$query .= "where _IDuser = '$row[0]' ";
		$query .= "limit 1";

		$result = mysql_query($query, $mysql_link);
		$myrow  = ( $result ) ? mysql_fetch_row($result) : 0 ;

		switch ( $msgid ) {
			case $STAGE_EXP :
				$error   = (bool) ($start == "" OR $company == "");
				$start  .= ( strlen($start) == 4 ) ? "-01-00" : "-00" ;
				$end    .= ( $end != "" )
					? (strlen($end) == 4 ? "-01-00" : "-00") 
					: "9999-00-00" ;

				$query   = ( $idx )
					? "update cv_exp set _IDposte = '$IDposte', _ident = '$company', _text = '$detail', _start = '$start', _end = '$end' where _IDexp = '$idx' limit 1"
					: "insert into cv_exp values('', '$myrow[0]', '$IDposte', '$company', '$detail', '$start', '$end')" ;
				break;

			case $STAGE_DIPLOMA :
				$error   = (bool) ($start == "");

				$query   = ( $idx )
					? "update cv_form set _year = '$start', _IDlevel = '$IDdegree', _text = '$detail' where _IDdegree = '$idx' limit 1"
					: "insert into cv_form values('', '$myrow[0]', '$start', '$IDdegree', '$detail')" ;
				break;

			case $STAGE_LANG :
				$query   = ( $idx )
					? "update cv_lang set _IDtype = '$IDlang', _IDlevel = '$IDlevel' where _IDlang = '$idx' limit 1"
					: "insert into cv_lang values('', '$myrow[0]', '$IDlang', '$IDlevel')" ;
				break;

			default :
				$query   = "update cv set _divers = '$detail' where _IDuser = '$row[0]' limit 1";
				break;
			}

		if ( !$error )
			mysql_query($query, $mysql_link);

		// retour à la fénêtre appelante
		print("
			<script type=\"text/javascript\">
			window.opener.location=\"index.php?item=".@$_GET["item"]."&cmde=post&show=0:1:0\";
			self.close();
			</script>");
		}

	if ( $idx )
		switch ( $msgid ) {
			case $STAGE_EXP :
				$query   = "select _start, _end, _IDposte, _ident, _text from cv_exp ";
				$query  .= "where _IDexp = '$idx' ";
				$query  .= "limit 1";

				$result  = mysql_query($query, $mysql_link);
				$myrow   = ( $result ) ? mysql_fetch_row($result) : 0 ;

				$start   = substr(@$myrow[0], 0, 7);
				$end     = ( @$myrow[1] == "9999-00-00" ) ? "" : substr(@$myrow[1], 0, 7) ;
				$IDposte = @$myrow[2];
				$company = @$myrow[3];
				$detail  = @$myrow[4];
				break;

			case $STAGE_DIPLOMA :
				$query   = "select _year, _IDlevel, _text from cv_form ";
				$query  .= "where _IDdegree = '$idx' ";
				$query  .= "limit 1";

				$result  = mysql_query($query, $mysql_link);
				$myrow   = ( $result ) ? mysql_fetch_row($result) : 0 ;

				$start   = @$myrow[0];
				$IDdegree = @$myrow[1];
				$detail  = @$myrow[2];
				break;

			case $STAGE_LANG :
				$query   = "select _IDtype, _IDlevel from cv_lang ";
				$query  .= "where _IDlang = '$idx' ";
				$query  .= "limit 1";

				$result  = mysql_query($query, $mysql_link);
				$myrow   = ( $result ) ? mysql_fetch_row($result) : 0 ;

				$IDlang  = @$myrow[0];
				$IDlevel = @$myrow[1];
				break;

			default :
				$query   = "select _divers from cv ";
				$query  .= "where _IDuser = '$row[0]' ";
				$query  .= "limit 1";

				$result  = mysql_query($query, $mysql_link);
				$myrow   = ( $result ) ? mysql_fetch_row($result) : 0 ;

				$detail  = @$myrow[0];
				break;
			}
?>

<table class="width100">
  <tr>
     <td class="align-center" style="width:20%;background-color:<?php print($_SESSION["CfgColor"]); ?>">
		<span style="color:#FFFFFF;"><?php print($msg->read($msgid)); ?></span>
     </td>
  </tr>

  <tr>
     <td>

	<form id="formulaire" action="" method="post">

	<table class="width100">
	<?php
		switch ( $msgid ) {
			case $STAGE_EXP :
				print("
				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_START) ."
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"start\"><input type=\"text\" id=\"start\" name=\"start\" size=\"10\" value=\"$start\" /></label>
						". $msg->read($STAGE_FORMAT) ."
		            		<span style=\"color:#ff0000;\"> ". $msg->read($STAGE_MANDATORY) ."</span>
					    </td>
				        </tr>

				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_END) ."
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"end\"><input type=\"text\" id=\"end\" name=\"end\" size=\"10\" value=\"$end\" /></label>
						". $msg->read($STAGE_FORMAT) ."
					    </td>
				        </tr>

				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_JOB) ."
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"IDposte\">
						<select id=\"IDposte\" name=\"IDposte\">");

						// lecture des poste
						$query  = "select _IDposte, _ident from cv_poste ";
						$query .= "where _lang = '".$_SESSION["lang"]."' ";
						$query .= "order by _IDposte";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							if ( $IDposte == $row[0] )
								print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
							else
								print("<option value=\"$row[0]\">$row[1]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}

				print("		
						</select>
						</label>
					    </td>
				        </tr>

				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_COMPANYLOC) ."
					    </td>
					    <td class= \"valign-middle\">
						<input type=\"text\" name=\"company\" size=\"50\" value=\"$company\" />
		            		<span style=\"color:#ff0000;\"> ". $msg->read($STAGE_MANDATORY) ."</span>
					    </td>
				        </tr>

				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_DETAIL) ." <a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/spip_typo.php?lang=".$_SESSION["lang"]."', '450', '350'); return false;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/aide.gif\" title=\"".$msg->read($STAGE_HELP)."\" alt=\"".$msg->read($STAGE_HELP)."\" /></a>
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"detail\"><textarea id=\"detail\" name=\"detail\" rows=\"11\" cols=\"60\">$detail</textarea></label>
					    </td>
				        </tr>
					");
				break;

			case $STAGE_DIPLOMA :
				print("
				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_GETTING) ."
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"start\"><input type=\"text\" id=\"start\" name=\"start\" size=\"4\" value=\"$start\" /></label>
		            		<span style=\"color:#ff0000;\"> ". $msg->read($STAGE_MANDATORY) ."</span>
					    </td>
				        </tr>

				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_DIPLOMA) ."
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"IDdegree\">
						<select id=\"IDdegree\" name=\"IDdegree\">");

						// lecture des diplômes
						$query  = "select _IDdegree, _ident from cv_degree ";
						$query .= "where _lang = '".$_SESSION["lang"]."' ";
						$query .= "order by _IDdegree";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							if ( $IDdegree == $row[0] )
								print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
							else
								print("<option value=\"$row[0]\">$row[1]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}

				print("		
						</select>
						</label>
					    </td>
				        </tr>

				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_DETAIL) ." <a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/spip_typo.php?lang=".$_SESSION["lang"]."', '450', '350'); return false;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/aide.gif\" title=\"".$msg->read($STAGE_HELP)."\" alt=\"".$msg->read($STAGE_HELP)."\" /></a>
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"detail\"><textarea id=\"detail\" name=\"detail\" rows=\"2\" cols=\"60\">$detail</textarea></label>
					    </td>
				        </tr>
					");
				break;

			case $STAGE_LANG :
				print("
				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_LANGUAGE) ."
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"IDlang\">
						<select id=\"IDlang\" name=\"IDlang\">");

						// lecture des langues
						$query  = "select _IDtype, _ident from cv_langtype ";
						$query .= "where _lang = '".$_SESSION["lang"]."' ";
						$query .= "order by _IDtype";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							if ( $IDlang == $row[0] )
								print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
							else
								print("<option value=\"$row[0]\">$row[1]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}

				print("		
						</select>
						</label>
					    </td>
				        </tr>

				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_LEVEL) ."
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"IDlevel\">
						<select id=\"IDlevel\" name=\"IDlevel\">");

						// lecture de la maîtrise de la langue
						$query  = "select _IDlevel, _ident from cv_langlevel ";
						$query .= "where _lang = '".$_SESSION["lang"]."' ";
						$query .= "order by _IDlevel";

						$result = mysql_query($query, $mysql_link);
						$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

						while ( $row ) {			
							if ( $IDlevel == $row[0] )
								print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
							else
								print("<option value=\"$row[0]\">$row[1]</option>");

							$row = remove_magic_quotes(mysql_fetch_row($result));
							}

				print("		
						</select>
						</label>
					    </td>
				        </tr>
					");
				break;

			default :
				print("		
				        <tr>
				          <td style=\"width:30%;\" class=\"align-right valign-middle\">
						". $msg->read($STAGE_DETAIL) ." <a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/spip_typo.php?lang=".$_SESSION["lang"]."', '450', '350'); return false;\">
						<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/aide.gif\" title=\"".$msg->read($STAGE_HELP)."\" alt=\"".$msg->read($STAGE_HELP)."\" /></a>
					    </td>
					    <td class= \"valign-middle\">
						<label for=\"detail\"><textarea id=\"detail\" name=\"detail\" rows=\"7\" cols=\"60\">$detail</textarea></label>
					    </td>
				        </tr>
					");
				break;
			}
	?>

        <tr>
          <td colspan="2"><hr style="width:80%; text-align:center;" /></td>
        </tr>

        <tr>
          <td style="width:10%;" class="align-right valign-middle">
           	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($STAGE_INPUTOK)."\" />"); ?>
          </td>
          <td class="valign-middle"><?php print($msg->read($STAGE_VALIDATE)); ?></td>
        </tr>
	</table>

	</form>

     </td>
  </tr>
</table>

<p style="text-align:center;">
[<a href="#" onclick="window.close(); return false;"><?php print($msg->read($STAGE_CLOSEWINDOW)); ?></a>]
</p>

</body>
</html>