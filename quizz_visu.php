<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2008 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by frédéric poyet(frederic.poyet@free.fr)
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
 *		module   : quizz_php.htm
 *		projet   : la page de saisie/visualisation du test du quizz
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/06/04
 *		modif    : 19/06/06 - par Fred POYET
 *                     migration php5
 *		           17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDtext  = ( @$_POST["IDtext"] )		// Identifiant de la question
	? (int) $_POST["IDtext"]
	: (int) @$_GET["IDtext"] ;
$nbcount = ( @$_POST["nbcount"] )		// nombre de questions
	? (int) $_POST["nbcount"]
	: (int) @$_GET["nbcount"] ;
$count   = (int) @$_POST["count"];		// la question en cours

$prev    = (int) @$_POST["prev_x"];
$next    = (int) @$_POST["next_x"];
$end     = (int) @$_POST["end_x"] + (int) @$_POST["valid_x"];
?>


<?php
	//---------------------------------------------------------------------------
	function display($url, $quizz, $row, $IDuser, $count, $nbcount, $norec, $reponse)
	{
		require "globals.php";

		require "msg/quizz.php";
		require_once "include/TMessage.php";

		$msg = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/quizz.php");

		// modification du quizz
		$maj = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $quizz[4] )
			? "<a href=\"".myurlencode("index.php?$url&cmde=upload&IDquizz=$quizz[9]&IDtext=$row[0]&nbcount=$nbcount")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"".$msg->read($QUIZZ_UPDATEQUESTION)."\" alt=\"".$msg->read($QUIZZ_UPDATEQUESTION)."\" /></a>"
			: "" ;

		print("
            	<table class=\"width100\">
	              <tr>
	                <td>
				<a href=\"". myurlencode("index.php?$url") ."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/logout.png\" title=\"".$msg->read($QUIZZ_GOBACK)."\" alt=\"".$msg->read($QUIZZ_GOBACK)."\" /></a>
				<strong>$quizz[0]</strong>
			    </td>
	                <td class=\"align-right\">
				". $msg->read($QUIZZ_NBQUESTION, Array("$count", "$nbcount")) ." $maj
			    </td>
	              </tr>
			");

		if ( strlen($quizz[1]) )
			print("
		              <tr style=\"background-color:#eeeeee;\">
		                <td colspan=\"2\" class=\"align-justify\">$quizz[1]</td>
	      	        </tr>
				");

		print("
	            </table>
			");

		// affichage des réponses
		$Query  = "select _texte, _pts, _IDitem from quizz_items ";
		$Query .= "where _IDdata = '$row[0]' ";
		$Query .= ( $row[3] == 2 ) ? "order by _texte" : "order by _IDitem asc" ;

		$return = mysql_query($Query, $mysql_link);
		$q      = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		// initialisation
		$total  = $value = 0;
		$texte  = str_replace("\n", "<br/>", $row[1]);

		switch ( $row[3] ) {
			case 0 :	// réponse unique
			case 1 :	// réponses multiples
				$answer = "";

				// réponse de l'utilisateur
				$query  = "select _index, _iditem from quizz_vote ";
				$query .= "where _IDquizz = '$quizz[9]' AND _IDdata = '$row[0]' ";
				$query .= "AND _ID = '$IDuser' ";
				$query .= "limit 1";

				$ret    = mysql_query($query, $mysql_link);
				$user   = ( $ret ) ? mysql_fetch_row($ret) : 0 ;

				while ( $q ) {
					// si le questionnaire est terminé, on affiche les résultats aux questions
					if ( $norec == 1 ) {
						$ctrl    = ( @$q[1] > 0 ) ? "on" : "off" ;
						$check   = ( $user[1] & pow(2, (int) $value) ) ? "on" : "off" ;

						$answer .= ( $row[3] == 0 )
							? "<img src=\"".$_SESSION["ROOTDIR"]."/images/radio_$ctrl.gif\" title=\"\" alt=\"$ctrl\" /> "
							: "<img src=\"".$_SESSION["ROOTDIR"]."/images/checkbox_$ctrl.gif\" title=\"\" alt=\"$ctrl\" /> " ;
						$answer .= ( $row[3] == 0 )
							? "<img src=\"".$_SESSION["ROOTDIR"]."/images/radio_$check.gif\" title=\"\" alt=\"$check\" /> $q[0]<br/>"
							: "<img src=\"".$_SESSION["ROOTDIR"]."/images/checkbox_$check.gif\" title=\"\" alt=\"$check\" /> $q[0]<br/>" ;
						}
					// sinon uniquement les questions
					else {
						$check   = ( $user[1] & pow(2, (int) $value) ) ? "checked=\"checked\"" : "" ;

						$answer .= ( $row[3] == 0 )
							? "<label for=\"q_".$count."_$value\"><input type=\"radio\" id=\"q_".$count."_$value\" name=\"q[$count][0]\" value=\"$value\" $check /> $q[0]</label><br/>"
							: "<label for=\"q_".$count."_$total\"><input type=\"checkbox\" id=\"q_".$count."_$total\" name=\"q[$count][$total]\" value=\"$value\" $check /> $q[0]</label><br/>" ;
						}

					$value++;
					if ( $row[3] ) $total++;

					$q = remove_magic_quotes(mysql_fetch_row($return));
					}

				// le nombre de réponses
				$total = ( $row[3] == 0 ) ? 1 : $value ; 
				break;

			case 2 :	// liste
				$answer = str_replace("\n", "<br/>", $row[1]);

				preg_match_all("`\##(\d)\##`", $texte, $out);

				foreach(array_unique($out[0]) as $k) {
					sscanf($k, "##%d##", $i);

					// réponse de l'utilisateur
					$query   = "select _text from quizz_vote ";
					$query  .= "where _IDquizz = '$quizz[9]' AND _IDdata = '$row[0]' AND _index = '$i' ";
					$query  .= "AND _ID = '$IDuser' ";
					$query  .= "limit 1";

					$ret     = mysql_query($query, $mysql_link);
					$user    = ( $ret ) ? mysql_fetch_row($ret) : 0 ;

					// réponse correcte
					$iditem  = $i - 1;

					$query   = "select _texte from quizz_items ";
					$query  .= "where _IDdata = '$row[0]' AND _IDitem = '$iditem' ";
					$query  .= "limit 1";

					$ret     = mysql_query($query, $mysql_link);
					$myrow   = ( $ret ) ? remove_magic_quotes(mysql_fetch_row($ret)) : 0 ;

					$isok    = ( $norec ) ? "disabled=\"disabled\"" : "" ;

					$select  = "<label for=\"select_".$count."_$total\">";
					$select .= "<select id=\"select_".$count."_$total\" name=\"select[$count][$i]\" $isok>";
					$select .= "<option value=\"\" >&nbsp;</option>";

					mysql_data_seek($return, 0);
					$q = remove_magic_quotes(mysql_fetch_row($return));

					while ( $q ) {
						$check   = ( $user[0] == $q[0] ) ? "selected=\"selected\"" : "" ;
						$select .= "<option value=\"$q[0]\" $check>$q[0]</option>";

						$q = remove_magic_quotes(mysql_fetch_row($return));
						}

					$select .= "</select>";
					$select .= "</label>";

					$texte   = str_replace($k, $select, $texte);
					$answer  = str_replace($k, "<strong>$myrow[0]</strong>", $answer);

					// le nombre de réponses (index max)
					$total   = ( $i > $total ) ? $i : $total ;
					}

				// si le questionnaire est terminé, on affiche le texte
				$answer = ( $norec ) ? $answer : "" ;
				break;

			default :	// zone de texte
				$answer = str_replace("\n", "<br/>", $row[1]);

				preg_match_all("`\##(\d)\##`", $texte, $out); 

				foreach(array_unique($out[0]) as $k) {
					sscanf($k, "##%d##", $i);

					// réponse de l'utilisateur
					$query   = "select _text from quizz_vote ";
					$query  .= "where _IDquizz = '$quizz[9]' AND _IDdata = '$row[0]' AND _index = '$i' ";
					$query  .= "AND _ID = '$IDuser' ";
					$query  .= "limit 1";

					$ret     = mysql_query($query, $mysql_link);
					$user    = ( $ret ) ? remove_magic_quotes(mysql_fetch_row($ret)) : 0 ;

					// réponse correcte
					$iditem  = $i - 1;

					$query   = "select _texte from quizz_items ";
					$query  .= "where _IDdata = '$row[0]' AND _IDitem = '$iditem' ";
					$query  .= "limit 1";

					$ret     = mysql_query($query, $mysql_link);
					$myrow   = ( $ret ) ? remove_magic_quotes(mysql_fetch_row($ret)) : 0 ;

					$isok    = ( $norec ) ? "disabled=\"disabled\"" : "" ;

					$input   = "<label for=\"input_".$count."_$i\">";
					$input  .= "<input id=\"input_".$count."_$i\" name=\"input[$count][$i]\" size=\"10\" value=\"$user[0]\" $isok/>";
					$input  .= "</label>";

					$texte   = str_replace($k, $input, $texte);
					$answer  = str_replace($k, "<strong>$myrow[0]</strong>", $answer);

					// le nombre de réponses (index max)
					$total   = ( $i > $total ) ? $i : $total ;
					}

				// si le questionnaire est terminé, on affiche le texte
				$answer = ( $norec ) ? $answer : "" ;
				break;
			}

		// lecture des points des questions/réponses
		$query  = "select quizz_items._pts ";
		$query .= "from quizz_items, quizz_data ";
		$query .= "where quizz_data._IDquizz = '$quizz[9]' AND quizz_data._IDdata = '$row[0]' ";
		$query .= "AND quizz_items._IDdata = quizz_data._IDdata ";
		$query .= "AND quizz_items._pts > 0 ";

		$return = mysql_query($query, $mysql_link);
		$pts    = ( $return ) ? mysql_fetch_row($return) : 0 ;

		$max    = 0;

		while ( $pts ) {
			$max += (int) $pts[0];

			$pts  = mysql_fetch_row($return);
			}

		if ( $quizz[5] == "O" ) {
			$query  = "select _Iditem, _IDdata " ;
			$query .= "from quizz_vote ";
			$query .= "where _IDquizz = '$quizz[9]' ";
			$query .= "AND _ID = '$IDuser' ";
			$query .= "order by _IDdata";

			$myret  = mysql_query($query, $mysql_link);
			$myrow  = mysql_fetch_row($myret);

			// les points de la question
			$totpts = 0;

			while ( $myrow ) {
				if ( $myrow[0] )
					for ($j = 0; pow(2, $j) <= $myrow[0]; $j++)
						if ( pow(2, $j) & $myrow[0] ) {
							$query   = "select _pts from quizz_items ";
							$query  .= "where _IDdata = '$myrow[1]' ";
							$query  .= "AND _IDitem = '$j' ";
							$query  .= "limit 1";

							$return  = mysql_query($query, $mysql_link);
							$pts     = mysql_fetch_row($return);

							$totpts += $pts[0];
							}

				$myrow = mysql_fetch_row($myret);
				}

			// lecture des réponses des utilisateurs
			$query  = "select quizz_vote._IDdata, quizz_vote._ID, quizz_vote._IP, quizz_vote._Iditem, quizz_vote._text, quizz_vote._index, " ;
			$query .= "quizz_data._type " ;
			$query .= "from quizz_vote, quizz_data ";
			$query .= "where quizz_vote._IDquizz = '$quizz[9]' ";
			$query .= "AND quizz_vote._IDdata = '$row[0]' ";
			$query .= "AND quizz_vote._IDdata = quizz_data._IDdata ";
			$query .= ( $quizz[5] == "N" ) ? "AND quizz_vote._IP = '$IDuser' " : "AND quizz_vote._ID = '$IDuser' " ;
			$query .= "order by quizz_vote._index desc";

			$res    = mysql_query($query, $mysql_link);
			$myrow  = ( $res ) ? remove_magic_quotes(mysql_fetch_row($res)) : 0 ;

			// les points de la question
			$pts    = "";

			while ( $myrow ) {
				// calcul des points gagnés
				switch ( $myrow[6] ) {
					case 0 :
					case 1 :
						$pts = (int) $pts + compute_quizz($myrow[0], $myrow[3], $myrow[6]);
						break;

					default :
						$pts = (int) $pts + compute_quizz($myrow[0], $myrow[5], $myrow[6], $myrow[4]);
						break;
					}

				$myrow = remove_magic_quotes(mysql_fetch_row($res));
				}	// endwhile réponse

			$comment = $msg->read($QUIZZ_TOTAL, Array("$pts", "$max", "$totpts"));
			}
		else
			$comment = "";

		// image associée à une question
		$image  = ( $row[2] )
			? (strncmp(strtolower($row[2]), "http://", 7) 
				? "<img src=\"$DOWNLOAD/quizz/$row[0]-$row[2]\" title=\"\" alt=\"\" style=\"margin:5px;\" />"
				: "<img src=\"$row[2]\" title=\"\" alt=\"\" style=\"margin:5px;\" />")
			: "" ;

		// attention à la réponse obligatoire
		$comment .= ( !$reponse AND $quizz[6] == "O" )
			? " <span style=\"color:#ff0000\">". $msg->read($QUIZZ_ERRMANDATORY) ."</span>"
			: "" ;

		print("
            	<table class=\"width100\">
	              <tr>
				<td class=\"align-justify\" style=\"border:#cccccc solid 1px;\">
					$texte<br />
					$image
				</td>
	              </tr>

	              <tr style=\"background-color:#eeeeee;\">
				<td>". $msg->read($QUIZZ_COMMENT, $comment) ."</td>
	              </tr>

	              <tr>
				<td>$answer</td>
	              </tr>
	            </table>
			");

		print("
			<p class=\"hidden\"><input type=\"hidden\" name=\"nbq[$count]\"    value=\"$total\" /></p> 
			<p class=\"hidden\"><input type=\"hidden\" name=\"type[$count]\"   value=\"$row[3]\" /></p>
			<p class=\"hidden\"><input type=\"hidden\" name=\"iddata[$count]\" value=\"$row[0]\" /></p>");

		print("<hr/>");
	}
	//---------------------------------------------------------------------------

    	// initialisation
	$reponse = false;
	$url     = "item=$item&IDmat=$IDmat&IDdata=$IDdata";

	// l'utilisateur a validé (flèches << ou >>)
	if ( $prev OR $next OR $end ) {
		// en mode visualisation de résultat, on n'enregistre pas les réponses
		if ( $norec != 1 ) {
			$iddata = @$_POST["iddata"];			// ID question
			$type   = @$_POST["type"];			// type QCM
			$nbq    = @$_POST["nbq"];			// nombre de réponses possibles
			$q      = @$_POST["q"];				// les réponses
			$select = @$_POST["select"];			// la liste déroulante
			$input  = @$_POST["input"];			// la zone de saisie

			$total  = ( $quizz[7] == "O" ) ? $nbcount : 1 ;

			for ($k = 0; $k < $total; $k++) {
				$j = $count + $k + 1;

				switch ( $type[$j] ) {
					case 0 :	// réponse unique
					case 1 :	// réponses multiples
						$iditem = 0;

						// l'utilisateur peut ne rien avoir saisie : il ne sait pas
						for ($i = 0; $i < $nbq[$j]; $i++)
							if ( strlen(@$q[$j][$i]) )
								$iditem += pow(2, (int) $q[$j][$i]);

						$reponse = (bool) $iditem;

						// requête SQL
						if ( $iditem )
							if ( !insert_quizz($quizz[9], $iddata[$j], $iditem) )
								update_quizz($quizz[9], $iddata[$j], $iditem);
						break;

					case 2 :	// liste
						// l'utilisateur peut ne rien avoir saisie : il ne sait pas
						for ($i = 0; $i <= $nbq[$j]; $i++)
							if ( @$select[$j][$i] ) {
								$reponse = true;

								// requête SQL
								if ( !insert_quizz($quizz[9], $iddata[$j], 0, $select[$j][$i], $i) )
									update_quizz($quizz[9], $iddata[$j], $select[$j][$i], $i);
								}
						break;

					default :	// zone de saisie
						// l'utilisateur peut ne rien avoir saisie : il ne sait pas
						for ($i = 0; $i <= $nbq[$j]; $i++)
							if ( @$input[$j][$i] ) {
								$reponse = true;

								// requête SQL
								if ( !insert_quizz($quizz[9], $iddata[$j], 0, $input[$j][$i], $i) )
									update_quizz($quizz[9], $iddata[$j], 0, $input[$j][$i], $i);
								}
						break;
					}	// endswitch
				}	// endfor
			} // endif
		}

	// l'utilisateur a terminé
	if ( $end ) {
		$back  = "index.php?item=$item&IDmat=$IDmat&IDdata=$IDdata&IDsel=$IDsel";
		$back .= ( $norec == 1 ) ? "&IDquizz=$quizz[9]&cmde=show" : "" ;

		print("
	            <div style=\"text-align:center\">
				<p>". $msg->read($QUIZZ_FINISH) ."</p>
				[<a href=\"".myurlencode($back)."\">". $msg->read($QUIZZ_GOBACK) ."</a>]
	            </div>
			");
		}
	else {
		// affichage de la question
		$Query  = "select _IDdata, _texte, _image, _type from quizz_data where _IDquizz = '$quizz[9]' ";
		$Query .= "order by _IDdata asc";

		$result = mysql_query($Query, $mysql_link);

		// attention à la réponse obligatoire sur une question
		if ( $reponse OR $quizz[6] == "N" )
			if ( $next AND $count < $nbcount - 1 )
				$count++;
			else
				if ( $prev AND $count > 0 )
					$count--;

		print("
			<form id=\"formulaire\" action=\"index.php\" method=\"post\">
            		<p class=\"hidden\"><input type=\"hidden\" name=\"item\"    value=\"$item\"/></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"    value=\"$cmde\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDquizz\" value=\"$quizz[9]\" /></p> 
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDmat\"   value=\"$IDmat\" /></p>
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDdata\"  value=\"$IDdata\" /></p> 
				<p class=\"hidden\"><input type=\"hidden\" name=\"IDuser\"  value=\"$IDuser\" /></p> 
				<p class=\"hidden\"><input type=\"hidden\" name=\"nbcount\" value=\"$nbcount\" /></p> 
				<p class=\"hidden\"><input type=\"hidden\" name=\"count\"   value=\"$count\" /></p> 
				<p class=\"hidden\"><input type=\"hidden\" name=\"norec\"   value=\"$norec\" /></p>
			");

		$back = ( $norec == 1 )
			? "[<a href=\"".myurlencode("index.php?item=$item&cmde=show&IDmat=$IDmat&IDdata=$IDdata&IDtext=$row[0]&IDquizz=$quizz[9]")."\">".$msg->read($QUIZZ_GO2RESULT)."</a>]"
			: "&nbsp;" ;

		print("<div style=\"position: absolute;\">". $msg->read($QUIZZ_USER, getUserName($IDuser)) ."</div>");
		print("<div style=\"text-align: right; margin-bottom: 10px;\">$back</div>");

		// la liste des questions
		$list = explode(";", $sql[1]);

		// type d'affichage des questions
		if ( $quizz[7] == "O" ) {
			//---- affichage sur une page
			for ($i = 0; $i < count($list); $i++) {
				mysql_data_seek($result, $i);
				$row = remove_magic_quotes(mysql_fetch_row($result));

				display($url, $quizz, $row, $IDuser, $list[$i], $nbcount, $norec, $reponse);
				}

			// boutons de validation
			print("
		            <table class=\"width100\">
		              <tr>
					<td style=\"width:10%;\" class=\"align-center\">
              				<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/lang/".$_SESSION["lang"]."/valid.gif\" name=\"valid\" alt=\"".$msg->read($QUIZZ_INPUTOK)."\" />
					</td>
					<td class= \"valign-middle\">". $msg->read($QUIZZ_CONFIRM) ."</td>
		              </tr>
		            </table>");
			}
		else {
			//---- affichage question par question
			mysql_data_seek($result, $count);
			$row  = remove_magic_quotes(mysql_fetch_row($result));

			display($url, $quizz, $row, $IDuser, $list[$count], $nbcount, $norec, $reponse);

			// boutons suivant/précédent
			$next = ( $count < $nbcount - 1 )
	      	     	? $msg->read($QUIZZ_NEXT) ." <input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/fleche_droite.gif\" name=\"next\" title=\"»\" alt=\"»\" />"
	           		: $msg->read($QUIZZ_TERMINATED) ." <input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/fleche_droite.gif\" name=\"end\" title=\"»\" alt=\"»\" />" ;
		     	$prev = ( $count > 0 AND $quizz[2] == "O" )
		           	? "<input type=\"image\" src=\"".$_SESSION["ROOTDIR"]."/images/fleche_gauche.gif\" name=\"prev\" title=\"«\" alt=\"«\" /> ". $msg->read($QUIZZ_PREV)
				: "" ;

			$page = $count + 1;

			print("
		            <table class=\"width100\">
		              <tr>
					<td style=\"width:45%;\" class=\"valign-middle\">$prev</td>
					<td style=\"width:10%;\" class=\"valign-middle\"><strong>$page/$nbcount</strong></td>
					<td style=\"width:45%;\" class=\"valign-middle align-right\">$next</td>
		              </tr>
		            </table>");
			}

		print("</form>");
		}
?>
