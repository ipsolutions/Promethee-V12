<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
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
 *		module   : weblog_visu.php
 *		projet   : la page des blogs persos
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 26/09/04
 *		modif    : 16/06/05 par FG
 *                     migration -> PHP5
 * 		           17/07/06 - par Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$skpage  = ( @$_GET["skpage"] )		// n° de la page affichée
	? (int) $_GET["skpage"]
	: 1 ;
$skshow  = ( @$_GET["skshow"] )		// n° du flash info
	? (int) $_GET["skshow"]
	: 1 ;


require_once "include/smileys.php";
require_once "include/spip.php";

// lecture des messages
$Query  = "select distinctrow weblog_items._IDitem, weblog_items._ID, weblog_items._IP, weblog_items._date, weblog_items._update, weblog_items._title, weblog_items._text, weblog_items._IDdata ";
$Query .= "from weblog_items, weblog_data ";
$Query .= "where weblog_data._IDlog = '$IDlog' ";
$Query .= "AND weblog_data._IDdata = weblog_items._IDdata ";
$Query .= ( $IDdata ) ? "AND weblog_data._IDdata = '$IDdata' " : "" ;
$Query .= ( $IDitem ) ? "AND weblog_items._IDitem = '$IDitem' " : "" ;
$Query .= ( $IDuser ) ? "AND weblog_items._ID = '$IDuser' " : "" ;
$Query .= ( $year AND $month ) ? "AND weblog_items._date >= '$year-$month-01 00:00:00' AND weblog_items._date <= '$year-$month-31 23:59:59' " : "" ;
$Query .= "order by weblog_items._IDitem desc";

// détermination du nombre de pages
$result = mysql_query($Query, $mysql_link);
$nbelem = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

$page   = $nbelem;
$show   = 1;

if ( $nbelem ) {
	$page  = ( $page % $MAXPAGE )
		? (int) ($page / $MAXPAGE) + 1
		: (int) ($page / $MAXPAGE) ;

	$show  = ( $page % $MAXSHOW )
		? (int) ($page / $MAXSHOW) + 1
		: (int) ($page / $MAXSHOW) ;

	// initialisation
	$i     = 1;
	$first = 1 + (($skpage - 1) * $MAXPAGE);

	// se positionne sur la page ad hoc
	mysql_data_seek($result, $first - 1);
	$row   = remove_magic_quotes(mysql_fetch_row($result));

	while ( $row AND $i++ <= $MAXPAGE ) {
		// log des lectures
		if ( $_SESSION["CnxID"] != $auth[0] )
			mysql_query("insert into weblog_vu values('$row[0]', '".$_SESSION["CnxID"]."', '".$_SESSION["CnxIP"]."', '".date("Y-m-d H:i:s")."')", $mysql_link);

		$Query  = "select _IDitem from weblog_vu ";
		$Query .= "where _IDitem = '$row[0]'";

		$return = mysql_query($Query, $mysql_link);
		$nbrows = ( $return ) ? mysql_affected_rows($mysql_link) : 0 ;

		$vu    = ( $nbrows )
			? "<span class=\"x-small\">, (<a href=\"#\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/user_list.php?sid=".$_SESSION["sessID"]."&amp;IDitem=$row[0]&amp;cmde=blog&amp;lang=".$_SESSION["lang"]."', '450', '200'); return false;\">".$msg->read($WEBLOG_HIT, strval($nbrows))."</a>)</span>"
			: "" ;

		// modification des messages
		$modif = ( $row[3] != $row[4] )
			? "<span class=\"x-small\">, ".$msg->read($WEBLOG_MODIFYBY, date2longfmt($row[4]))."</span>"
			: "" ;

		$maj   = ( $row[1] == @$_SESSION["CnxID"] )
			? "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&IDitem=$row[0]&year=$year&month=$month&day=$day&submit=update")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"". $msg->read($WEBLOG_UPDTMESSAGE) ."\" alt=\"". $msg->read($WEBLOG_UPDTMESSAGE) ."\" /></a>"
			: "" ;

		// supression des messages
		$delete = ( $row[1] == @$_SESSION["CnxID"] )
			? "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&IDitem=$row[0]&year=$year&month=$month&day=$day&submit=delete")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"". $msg->read($WEBLOG_DELBLOG) ."\" alt=\"". $msg->read($WEBLOG_DELBLOG) ."\" /></a>"
			: "" ;

		// visualisation des pièces jointes
		$query  = "select _file, _size from weblog_pj ";
		$query .= "where _IDitem = '$row[0]' ";
		$query .= "limit 1";

		$return = mysql_query($query, $mysql_link);
		$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

		if ( $row[1] == @$_SESSION["CnxID"] ) {
			$req  = $msg->read($WEBLOG_DELATTACH);

			$del  = "<a href=\"".myurlencode("index.php?item=$item&IDgroup=$IDgroup&IDlog=$IDlog&IDitem=$row[0]&cmde=$cmde&year=$year&month=$month&day=$day&submit=delpj")."\" onclick=\"return confirmLink(this, '$req');\">";
			$del .= "<img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"$req\" alt=\"$req\" />";
			$del .= "</a>";
			}
		else
			$del = "";

		$mypj   = ( $myrow )
			? "<img src=\"".$_SESSION["ROOTDIR"]."/images/mime/".extension($myrow[0]).".gif\" title=\"\" alt=\"\" /> ".$msg->read($WEBLOG_DOC, Array("$DOWNLOAD/weblog/$row[0]-$myrow[0]", strval($myrow[1])))." $del"
			: "" ;

		// lecture de la catégorie
		$Query  = "select _title from weblog_data ";
		$Query .= "where _IDdata = '$row[7]' ";
		$Query .= "limit 1";

		$return = mysql_query($Query, $mysql_link);
		$cat    = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;
		$mycat  = "<a href=\"".myurlencode("index.php?item=36&cmde=visu&IDlog=$IDlog&IDdata=$row[7]")."\">$cat[0]</a>";

		// autorisation des commentaires
		$click  = "onclick=\"popWin('".myurlencode($_SESSION["ROOTDIR"]."/weblog_note.php?sid=".$_SESSION["sessID"]."&item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&year=$year&month=$month&day=$day&IDitem=$row[0]&lang=".$_SESSION["lang"])."', '450', '305'); return false;\"";
		$add    = ( $auth[4] == "O" AND $row[1] != @$_SESSION["CnxID"] AND ($auth[2] & pow(2, $_SESSION["CnxGrp"] - 1)) )
			? "<a href=\"#\" $click>". $msg->read($WEBLOG_ADDCOMMENT) ."</a>"
			: "" ;

		// lecture des commentaires
		$Query  = "select _IDnote from weblog_note ";
		$Query .= "where _IDitem = '$row[0]' ";
		$Query .= "AND _parent = '0' ";

		$return = mysql_query($Query, $mysql_link);
		$count  = ( $return ) ? mysql_numrows($return) : 0 ;

		$msg->isPlural = (bool) ( $count > 1 );

		$reply  = ( $count )
			? "- <a href=\"". myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&IDitem=$row[0]&year=$year&month=$month&day=$day&comment=1")."\">". $msg->read($WEBLOG_NBCOMMENT, strval($count)) ."</a>"
			: "" ;

		$file   = "download/weblog/tpl/weblog.html";
		$buffer = file_get_contents($file);

		print(
			str_replace(
				Array('#date#', '#title#', '#text#', '#attachment#', '#author#', '#comment#', '#addcomment#'), 
				Array(date2longfmt($row[3]).$vu.' '.$modif.' '.$maj.' '.$delete, $row[5], $row[6], $mypj, $msg->read($WEBLOG_POSTEDBY, Array(getUserName($row[1]), _getHostName($row[2]), $mycat)), $reply, $add),
				$buffer
				)
			);

		if ( $comment ) {
			$file   = "download/weblog/tpl/comment.html";
			$buffer = file_get_contents($file);

			// lecture des commentaires
			$Query  = "select _ID, _IP, _date, _text, _IDnote, _title from weblog_note ";
			$Query .= "where _IDitem = '$row[0]' ";
			$Query .= "AND _parent = '0' ";
			$Query .= "order by _IDnote";

			$return = mysql_query($Query, $mysql_link);
			$myrow  = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

			$j = 1;
			while ( $myrow ) {
				// lecture des réponses à commentaires
				$Query  = "select _ID, _IP, _date, _text, _title from weblog_note ";
				$Query .= "where _parent = '$myrow[4]' ";
				$Query .= "limit 1";

				$sql    = mysql_query($Query, $mysql_link);
				$answer = ( $sql ) ? remove_magic_quotes(mysql_fetch_row($sql)) : 0 ;

				if ( $answer ) {
					$file  = "download/weblog/tpl/reply.html";
					$mybuf = file_get_contents($file);

					$fback = str_replace(
						Array('#date#', '#title#', '#text#'), 
						Array($msg->read($WEBLOG_REPLYBY, Array(getUserName($answer[0]), _getHostName($answer[1]), date2longfmt($answer[2]))), $answer[4], find_typo($answer[3], $nil)),
						$mybuf
						);
					}
				else
					$fback = "";

				// réponse à commentaire
				$click  = "onclick=\"popWin('".myurlencode($_SESSION["ROOTDIR"]."/weblog_note.php?sid=".$_SESSION["sessID"]."&item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&year=$year&month=$month&day=$day&IDitem=$row[0]&parent=$myrow[4]&lang=".$_SESSION["lang"])."', '450', '305'); return false;\"";
				$reply  = ( $myrow[0] != @$_SESSION["CnxID"] AND $answer == 0 )
					? "<a href=\"#\" $click><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"". $msg->read($WEBLOG_REPLYTO, getUserName($myrow[0], false)) ."\" alt=\"". $msg->read($WEBLOG_REPLYTO, getUserName($myrow[0], false)) ."\" /></a>"
					: "" ;

				print(
					str_replace(
						Array('#anchor#', '#date#', '#title#', '#text#'), 
						Array('comment_'.$myrow[4], $msg->read($WEBLOG_COMMENTBY, Array(strval($j), getUserName($myrow[0]), _getHostName($myrow[1]), date2longfmt($myrow[2]))).' '.$reply, $myrow[5], find_typo($myrow[3], $nil).$fback),
						$buffer
						)
					);

				$j++;
				$myrow  = remove_magic_quotes(mysql_fetch_row($return));
				}
			}

		$row = remove_magic_quotes(mysql_fetch_row($result));
		}
	}

	// bouton précédent
	$where = $skshow - 1;

	if ( $skshow == 1 )
		$prev = "";
	else {
		$skpg = 1 + (($skshow - 2) * $MAXSHOW);
		$prev = "[<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&IDuser=$IDuser&year=$year&month=$month&day=$day&skpage=$skpg&skshow=$where")."\">". $msg->read($WEBLOG_PREV) ."</a>]";
		}

	// liens directs sur n° de page
	$start = 1 + (($skshow - 1) * $MAXSHOW);
	$end   = $skshow * $MAXSHOW;

	$choix = ( $skpage == $start )
		? "<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"«\" alt=\"«\" /><strong>$start</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"»\" alt=\"»\" />"
		: "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&IDuser=$IDuser&year=$year&month=$month&day=$day&skpage=$start&skshow=$skshow")."\">$start</a>" ;

	for ($j = $start + 1; $j <= $end AND $j <= $page; $j++)
		$choix .= ( $skpage == $j )
			? "|<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"«\" alt=\"«\" /><strong>$j</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"»\" alt=\"»\" />"
			: "|<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&IDuser=$IDuser&year=$year&month=$month&day=$day&skpage=$j&skshow=$skshow")."\">$j</a>" ;

	// bouton suivant
	$where = $skshow + 1;
	$next  = ( $skshow == $show )
		? ""
		: "[<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDgroup=$IDgroup&IDlog=$IDlog&IDuser=$IDuser&year=$year&month=$month&day=$day&skpage=$j&skshow=$where")."\">". $msg->read($WEBLOG_NEXT) ."</a>]" ;

	print("<hr/>");

	if ( $nbelem )
		print("<div style=\"text-align:center;\">$prev $choix $next</div>");
?>
