<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
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
?>

<?php
/*
 *		module   : vote_saisie.php
 *		projet   : formulaire de saisie des votes
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation :  8/06/03
 *		modif    : 17/07/06 - par Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */
?>


<form id="formulaire" action="index.php" method="post">
	<?php
		print("
		      <p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\" /></p> 
		      <p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p> 
	      	<p class=\"hidden\"><input type=\"hidden\" name=\"IDdata\"  value=\"$IDdata\" /></p> 
		      <p class=\"hidden\"><input type=\"hidden\" name=\"nbq\"     value=\"$nbq\" /></p> 
			");
	?>

	<div><?php print($msg->read($VOTE_TEXT)); ?></div>

	<hr style="width:80%;" />

<?php
	// initialisation
	$warning = "";

	if ( $cmde != "new" ) {
		// commande ouverture/fermeture sondage
		$show = ( $visible == "O" )
			? "<a href=\"index.php?item=$item&amp;IDpoll=$IDpoll&amp;IDdata=$IDdata&amp;cmde=close\"><img src=\"".$_SESSION["ROOTDIR"]."/images/unlocked.gif\" title=\"".$msg->read($VOTE_CLOSEPOLL)."\" alt=\"".$msg->read($VOTE_CLOSEPOLL)."\" /></a>"
			: "<a href=\"index.php?item=$item&amp;IDpoll=$IDpoll&amp;IDdata=$IDdata&amp;cmde=open\"><img src=\"".$_SESSION["ROOTDIR"]."/images/locked.gif\" title=\"".$msg->read($VOTE_OPENPOLL)."\" alt=\"".$msg->read($VOTE_OPENPOLL)."\" /></a>" ;

		print("
			<table class=\"width100\">
			  <tr>
			    <td class=\"align-center\">
			    	$show ".$msg->read($VOTE_POLLING)." 
				<label for=\"IDpoll\">
			  	<select id=\"IDpoll\" name=\"IDpoll\" onchange=\"document.forms.formulaire.submit()\">
			");

		$query  = "select _IDpoll, _title from sondage_data ";
		$query .= "where _IDdata = '$IDdata' AND _lang = '".$_SESSION["lang"]."' ";
		$query .= "order by _IDpoll desc";

		$result = mysql_query($query, $mysql_link);
		$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

		while ( $row ) {			
			if ( $IDpoll == $row[0] )
				print("<option selected=\"selected\" value=\"$row[0]\">$row[1]</option>");
			else
				print("<option value=\"$row[0]\">$row[1]</option>");

			$row = remove_magic_quotes(mysql_fetch_row($result));
			}				

		print("
				</select>
				</label>
				<a href=\"index.php?item=$item&amp;IDdata=$IDdata&amp;cmde=new\"><img src=\"".$_SESSION["ROOTDIR"]."/images/ajouter.gif\" title=\"".$msg->read($VOTE_ADDPOLL)."\" alt=\"".$msg->read($VOTE_ADDPOLL)."\" /></a>
				<a href=\"index.php?item=$item&amp;IDdata=$IDdata&amp;IDpoll=$IDpoll&amp;cmde=del\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($VOTE_DELPOLL)."\" alt=\"".$msg->read($VOTE_DELPOLL)."\" /></a>
			    </td>
			  </tr>
			</table>
			");

		$warning = "<div>". $msg->read($VOTE_WARNING) ."</div>";
		}
?>

	<hr style="width:80%;" />

	<?php print("$warning"); ?>

      <table class="width100">
        <tr style="background-color:#eeeeee;">
          <td colspan="2"><?php print($msg->read($VOTE_QUESTION, $error1)); ?></td>
        </tr>
        <tr>
          <td colspan="2">
		<label for="title"><textarea id="title" name="title" rows="4" cols="40"><?php print("$title"); ?></textarea></label>
            <span style="color:#ff0000"><?php print($msg->read($VOTE_MANDATORY)); ?></span>
          </td>
        </tr>

        <tr style="background-color:#eeeeee;">
          <td colspan="2"><?php print($msg->read($VOTE_ANSWERS, $error2)); ?></td>
        </tr>
        <tr>
          <td colspan="2">
            <table>
              <?php
			$j = 0;
              	for ($i = 1; $i <= $nbq; $i++) {
              		print("
					<tr class=\"valign-middle\">
						<td>". $msg->read($VOTE_MYANSWER, strval($i)) ."</td>
						<td><label for=\"q_$j\"><input type=\"text\" size=\"30\" id=\"q_$j\" name=\"q[$j]\" value=\"$q[$j]\" /></label>
					");
				$j++;

				if ( $i < 3 )
					print(" <span style=\"color:#FF0000;\">".$msg->read($VOTE_MANDATORY)."</span>");

				print("</td></tr>");
				}
              ?>
              <tr class="valign-middle">
                <td></td>
                <td><input type="submit" value="<?php print($msg->read($VOTE_ADDANSWERS)); ?>" name="MoreChoices" /></td>
              </tr>
            </table>
          </td>
        </tr>
            
        <tr class="align-left" style="background-color:#eeeeee;">
          <td><?php print($msg->read($VOTE_WRITER)); ?></td>
          <td><?php print($msg->read($VOTE_READER)); ?></td>
        </tr>
        <tr>
          <td>
		<?php
			// recherche des groupes
			$query  = "select _ident, _IDgrp from user_group ";
			$query .= "where _visible = 'O' AND _lang = '".$_SESSION["lang"]."' ";
			$query .= "order by _IDgrp asc";

			$result = mysql_query($query, $mysql_link);
			$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			while ( $row ) {
				$check = ( $grpwr & pow(2, $row[1] - 1) ) ? "checked=\"checked\"" : "" ;

				print("<label for=\"cbwr_$row[1]\"><input type=\"checkbox\" id=\"cbwr_$row[1]\" name=\"cbwr[]\" value=\"". pow(2, $row[1] - 1) ."\" $check /> $row[0]</label><br/>");

				$row = remove_magic_quotes(mysql_fetch_row($result));
	   			}
		?>
          </td>
          <td>
		<?php
			// on affiche les groupes
			$row = mysql_data_seek($result, 0) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			while ( $row ) {
				$check = ( $grprd & pow(2, $row[1] - 1) ) ? "checked=\"checked\"" : "" ;

				print("<label for=\"cbrd_$row[1]\"><input type=\"checkbox\" id=\"cbrd_$row[1]\" name=\"cbrd[]\" value=\"". pow(2, $row[1] - 1) ."\" $check /> $row[0]</label><br/>");

				$row = remove_magic_quotes(mysql_fetch_row($result));
	   			}
		?>
          </td>
        </tr>

        <tr class="align-left" style="background-color:#eeeeee;">
          <td colspan="2"><?php print($msg->read($VOTE_SELECT)); ?></td>
        </tr>
        <tr>
          <td colspan="2">
		<?php print($msg->read($VOTE_TYPE)); ?><br/>
            <label for="single_O"><input type="radio" id="single_O" name="single" <?php print(($single == "O") ? "checked=\"checked\"" : ""); ?> value="O" /> <?php print($msg->read($VOTE_UNIQUE)); ?></label><br/>
            <label for="single_N"><input type="radio" id="single_N" name="single" <?php print(($single == "N") ? "checked=\"checked\"" : ""); ?> value="N" /> <?php print($msg->read($VOTE_MULTIPLE)); ?></label><br/><br/>
                        
            <?php print($msg->read($VOTE_RESULTS)); ?><br/>
            <label for="end_N"><input type="radio" id="end_N" name="end" <?php print(($end == "N") ? "checked=\"checked\"" : ""); ?> value="N" /> <?php print($msg->read($VOTE_SHOWDURING)); ?></label><br/>
            <label for="end_O"><input type="radio" id="end_O" name="end" <?php print(($end == "O") ? "checked=\"checked\"" : ""); ?> value="O" /> <?php print($msg->read($VOTE_SHOWEND)); ?></label><br/><br/>
            
            <?php print($msg->read($VOTE_ANONYMOUS)); ?><br/>
            <label for="anonyme_O"><input type="radio" id="anonyme_O" name="anonyme" <?php print(($anonyme == "O") ? "checked=\"checked\"" : ""); ?> value="O" /> <?php print($msg->read($VOTE_NOID)); ?></label><br/>
            <label for="anonyme_O"><input type="radio" id="anonyme_N" name="anonyme" <?php print(($anonyme == "N") ? "checked=\"checked\"" : ""); ?> value="N" /> <?php print($msg->read($VOTE_ID)); ?></label><br/><br/>

		<?php
			require_once "include/calendar_tools.php";

			// initialisation
			if ( !isset($endYear) )
				$endYear  = date("Y");
			else
				$endYear  = ( $endYear < date("Y") ) ? date("Y") : $endYear ;

			if ( !isset($endMonth) )
				$endMonth = date("m") - 1;
			else
				$endMonth = ( $endYear == date("Y") AND $endMonth < date("m") ) ? date("m") - 1 : $endMonth ;

			if ( !isset($endDay) )
				$endDay   = date("d");
			else
				$endDay   = ( $endYear == date("Y") AND $endMonth == date("m") - 1 AND $endDay < date("d") ) ? date("d") : $endDay ;
		?>

            <?php print($msg->read($VOTE_CLOSE)); ?><br/>
            <label for="autoclose_0"><input type="radio" id="autoclose_0" name="autoclose" value="0" <?php print($autoclose ? "" : "checked=\"checked\""); ?> /> <?php print($msg->read($VOTE_MANUAL)); ?></label><br/>
            <label for="autoclose_1"><input type="radio" id="autoclose_1" name="autoclose" value="1" <?php print($autoclose ? "checked=\"checked\"" : ""); ?> /> <?php print($msg->read($VOTE_ON)); ?></label>

		<label for="endDay">
            <select id="endDay" name="endDay">
		<?php
			for ($i = 1; $i <= getmaxdays($endYear, $endMonth + 1); $i++) {
				$select = ( $endDay == $i ) ? "selected=\"selected\"" : "" ;
				print("<option $select value=\"$i\">$i</option>");
				}
		?>
		</select>
		</label>

		<label for="endMonth">
            <select id="endMonth" name="endMonth">
		<?php
			$mois = explode(",", $msg->read($VOTE_MONTHFULL));

			for ($i = 0; $i < 12; $i++) {
				$select = ( $endMonth == $i ) ? "selected=\"selected\"" : "" ;
				print("<option $select value=\"$i\">$mois[$i]</option>");
				}
		?>
		</select>
		</label>

		<label for="endYear">
            <select id="endYear" name="endYear">
		<?php
			for ($i = date("Y"); $i < date("Y") + 3; $i++) {
				$select = ( $endYear == $i ) ? "selected=\"selected\"" : "" ;
				print("<option $select value=\"$i\">$i</option>");
				}
		?>
            </select> 
		</label>
          </td>
        </tr>
      </table>

      <table class="width100">
        <tr>
           <td style="width:100%;" colspan="2"><hr style="width:80%;" /></td>
        </tr>
        <tr>
           <td style="width:10%;" class="valign-middle align-center">
            	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($VOTE_INPUTOK)."\" />"); ?>
           </td>
           <td class="valign-middle"><?php print($msg->read($VOTE_RECORD)); ?></td>
        </tr>
        <tr>
		<td class="valign-middle align-center">
             	<?php print("<a href=\"index.php\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/cancel.gif\" title=\"\" alt=\"".$msg->read($VOTE_INPUTCANCEL)."\" /></a>"); ?>
		</td>
		<td class="valign-middle"><?php print($msg->read($VOTE_GOBACK)); ?></td>
        </tr>
      </table>

</form>
