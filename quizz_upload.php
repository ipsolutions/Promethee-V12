<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2008 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by frédéric poyet(frederic.poyet@free.fr)
   Copyright (c) 2006 by Nordine Zetoutou (nordine.zetoutou@educagri.fr)

   This program is free software. You can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License.
 *-----------------------------------------------------------------------*/


/*
 *		module   : quizz_upload.php
 *		projet   : formulaire de saisie des questions du quizz
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/06/04
 *		modif    : 19/06/06 - par Fred POYET
 *                     migration php5
 *		           17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */
?>


<?php
	// lecture du quizz
	$result  = mysql_query("select _titre, _texte from quizz where _IDquizz = '$IDquizz' limit 1", $mysql_link);
	$quizz   = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	// lecture du nombre de questions
	$result  = mysql_query("select _IDdata from quizz_data where _IDquizz = '$IDquizz'", $mysql_link);
	$nbcount = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

	// lecture de la question
	$query  = "select _texte, _type, _image, _IDdata from quizz_data ";
	$query  .= "where _IDquizz = '$IDquizz' ";
	switch ( $show ) {
		case "next" :
			$query .= "AND _IDdata > '$IDtext' order by _IDdata asc";
			break;
		case "prev" :
			$query .= "AND _IDdata < '$IDtext' order by _IDdata desc";
			break;
		default :
			$query .= ( $IDtext )
				? "AND _IDdata >= '$IDtext' order by _IDdata asc"
				: "order by _IDdata desc limit 1" ;
			break;
		}

	$result  = mysql_query($query, $mysql_link);
	$row     = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;
	$nbpos   = ( $result )
		? ($show == "prev"
			? mysql_affected_rows($mysql_link) 
			: $nbcount - mysql_affected_rows($mysql_link) + 1)
		: 0 ;

	if ( !$IDtext )
		$nbpos = $nbcount + 1;

	if ( $row AND $IDtext ) {
		$title  = $row[0];
		$type   = $row[1];
		$image  = $row[2];
		$IDtext = $row[3];

		// on recherche les réponses possibles
		$Query  = "select _texte, _pts from quizz_items ";
		$Query .= "where _IDdata = '$IDtext' ";
		$Query .= "order by _IDitem";

		$res    = mysql_query($Query, $mysql_link);
		$myrow  = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

		$i = 0;
		while ( $myrow ) {
           		$q[$i] = $myrow[0];
           		$p[$i] = $myrow[1];

			$myrow = remove_magic_quotes(mysql_fetch_row($res));
			$i++;
			}
		}
	else {
     		$title = "";
     		$type  = 0;
		$image = "";

           	for ($i = 0; $i < $nbq; $i++)
           		$q[$i] = $p[$i] = "";
		}

	// boutons suivant/précédent
	$img_next = "<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"".$msg->read($QUIZZ_NEXT)."\" alt=\"".$msg->read($QUIZZ_NEXT)."\" />";
	$img_prev = "<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"".$msg->read($QUIZZ_PREV)."\" alt=\"".$msg->read($QUIZZ_PREV)."\" />";

	$next = ( $nbpos < $nbcount )
		? "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDmat=$IDmat&IDquizz=$IDquizz&IDdata=$IDdata&IDtext=$row[3]&show=next")."\">$img_next</a>"
		: "" ;

	$prev = ( $nbpos > 1 )
		? "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDmat=$IDmat&IDquizz=$IDquizz&IDdata=$IDdata&IDtext=$row[3]&show=prev")."\">$img_prev</a>"
		: "" ;

	$add  = "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDmat=$IDmat&IDdata=$IDdata&IDquizz=$IDquizz&IDsel=$IDsel")."\">";
	$add .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/ajouter.gif\" title=\"".$msg->read($QUIZZ_ADDQUESTION)."\" alt=\"".$msg->read($QUIZZ_ADDQUESTION)."\" />";
	$add .= "</a>";

	$del  = "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDmat=$IDmat&IDdata=$IDdata&IDquizz=$IDquizz&IDsel=$IDsel&IDtext=$IDtext&submit=remove")."\">";
	$del .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"".$msg->read($QUIZZ_DELQUESTION)."\" alt=\"".$msg->read($QUIZZ_DELQUESTION)."\" />";
	$del .= "</a>";

	print("
            <table class=\"width100\">
              <tr>
                <td><strong>$quizz[0]</strong></td>
                <td class=\"align-right\">
			$prev $nbpos/$nbcount $next $add $del</td>
              </tr>
              <tr>
                <td colspan=\"2\" class=\"align-justify\" style=\"border:#cccccc solid 1px; padding: 2px;\">$quizz[1]</td>
              </tr>
            </table>
		");
?>

<form id="formulaire" action="index.php" method="post" enctype="multipart/form-data">
<?php
	print("
	      <p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\"/></p>
	      <p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p> 
	      <p class=\"hidden\"><input type=\"hidden\" name=\"IDsel\"   value=\"$IDsel\" /></p> 
	      <p class=\"hidden\"><input type=\"hidden\" name=\"IDmat\"   value=\"$IDmat\" /></p> 
		<p class=\"hidden\"><input type=\"hidden\" name=\"IDquizz\" value=\"$IDquizz\" /></p>
		<p class=\"hidden\"><input type=\"hidden\" name=\"IDdata\"  value=\"$IDdata\" /></p>
		<p class=\"hidden\"><input type=\"hidden\" name=\"IDtext\"  value=\"$IDtext\" /></p>
		<p class=\"hidden\"><input type=\"hidden\" name=\"nbcount\" value=\"$nbcount\" /></p> 
	      <p class=\"hidden\"><input type=\"hidden\" name=\"nbq\"     value=\"$nbq\" /></p> 
		");
?>

      <table class="width100">
        <tr class="align-left" style="background-color:#eeeeee;">
          <td colspan="4"><?php print($msg->read($QUIZZ_QUESTION, $error1)); ?></td>
        </tr>

        <tr class="valign-top align-left">
          <td colspan="4">
		<label for="title"><textarea id="title" name="title" rows="5" cols="50"><?php print("$title"); ?></textarea></label> 
		<a href="#" class="overlib"><img src="<?php echo $_SESSION["ROOTDIR"]; ?>/images/spip/aide.gif" title="" alt="?" /><span><?php print($msg->read($QUIZZ_HELP)); ?></span></a>
		<span style="color:#ff0000"><?php print($msg->read($QUIZZ_MANDATORY)); ?></span>
          </td>
        </tr>

	<?php
		// fichier à transférer
		$my_del = $my_img = "";
		if ( strlen($image) ) {
			$my_del = "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDmat=$IDmat&IDquizz=$IDquizz&IDdata=$IDdata&IDtext=$IDtext&submit=delete")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"". $msg->read($QUIZZ_DELIMAGE) ."\" alt=\"". $msg->read($QUIZZ_DELIMAGE) ."\" /></a>";
			$my_img = strncmp(strtolower($image), "http://", 7) 
				? "<img src=\"$DOWNLOAD/quizz/vignettes/$IDtext-$image\" title=\"\" alt=\"\" style=\"border: 1px solid black;\" /><br/>"
				: "<img src=\"$image\" title=\"\" alt=\"\" style=\"border: 1px solid black;\" /><br/>" ;
			}

	  	print("
		    <tr class=\"align-left\" style=\"background-color:#eeeeee;\">
		      <td colspan=\"4\">
		        ". $msg->read($QUIZZ_SELECTIMAGE) ." $my_del
		      </td>
		    </tr>

		    <tr>
		      <td class=\"valign-top\" colspan=\"4\">
			  $my_img
		        <p class=\"hidden\"><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$FILESIZE\" /></p>
		        <input type=\"file\" name=\"UploadedFile\" /> ". $msg->read($QUIZZ_OR) ."
		      </td>
		    </tr>

		    <tr>
		      <td class=\"valign-top\" colspan=\"4\">
		        <label for=\"permalink\"><input type=\"text\" id=\"permalink\" name=\"permalink\" size=\"65\" /> ". $msg->read($QUIZZ_PERMALINK) ."</label>
		      </td>
		    </tr>
			");
	?>

        <tr class="align-left" style="background-color:#eeeeee;">
          <td colspan="4"><?php print($msg->read($QUIZZ_ANSWER)); ?></td>
        </tr>

        <tr class="valign-top">
		<?php
			$list = explode(",", $msg->read($QUIZZ_TYPE));

			for ($i = 0; $i < count($list); $i++) {
				$check = ( $type == $i ) ? "checked=\"checked\"" : "" ;

				print("<td style=\"width:25%;\"><label for=\"type_$i\"><input type=\"radio\" id=\"type_$i\" name=\"type\" value=\"$i\" $check /> $list[$i]</label></td>");
				}
		?>
        </tr>

        <tr class="align-left" style="background-color:#eeeeee;">
          <td colspan="4"><?php print($msg->read($QUIZZ_MYANSWER, $error2)); ?></td>
        </tr>

        <tr class="valign-top align-left">
          <td colspan="4">
            <table>
              <?php
			$j = 0;
              	for ($i = 1; $i <= $nbq; $i++) {
				print("<tr class=\"align-left\">");

				$qtn  = @$q[$j];
				$pts  = @$p[$j];

				$warn = ( $i < 3 )
					? "<span style=\"color:#FF0000;\"> ".$msg->read($QUIZZ_MANDATORY)."</span>"
					: "" ;

              		print("
					<td>". $msg->read($QUIZZ_GETANSWER, strval($i)) ."</td>
					<td><label for=\"q_$j\"><input type=\"text\" id=\"q_$j\" name=\"q[$j]\" size=\"40\" value=\"$qtn\" /></label></td>
					<td><label for=\"p_$j\"><input type=\"text\" id=\"p_$j\" name=\"p[$j]\" size=\"4\"  value=\"$pts\" /> ". $msg->read($QUIZZ_POINTS) ." $warn</label></td>
					");
				$j++;

				print("</tr>");
				}
              ?>

              <tr class="valign-middle align-left">
                <td></td>
                <td><input type="submit" value="<?php print($msg->read($QUIZZ_MORECHOICE)); ?>" name="MoreChoices" /></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

	<hr style="width:80%;" />

      <table class="width100">
        <tr>
		<td style="width:10%;" class="align-right">
            	<?php print("<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($QUIZZ_INPUTOK)."\" />"); ?>
		</td>
		<td class="align-left">
		<?php
			print($IDtext
				? $msg->read($QUIZZ_UPDATEQUESTION)
				: $msg->read($QUIZZ_RECORD) );
		?>
		</td>
        </tr>
        <tr>
		<td class="align-right">
            <?php
			$cmde = ( $IDtext ) ? "visu" : "" ;

			print("<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDsel=$IDsel&IDmat=$IDmat&IDdata=$IDdata&IDquizz=$IDquizz&IDtext=$IDtext&nbcount=$nbcount")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/cancel.gif\" title=\"\" alt=\"".$msg->read($QUIZZ_INPUTCANCEL)."\" /></a>");
		?>
		</td>
		<td class="align-left"><?php print($msg->read($QUIZZ_BACK)); ?></td>
        </tr>
      </table>

</form>
