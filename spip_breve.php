<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2003-2007 by Dominique Laporte(C-E-D@wanadoo.fr)
   Copyright (c) 2006 by Didier Roy (miraceti@free.fr)
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
 *		module   : spip_breve.php
 *		projet   : la page de visualisation des dépêches
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 20/03/04
 *		modif    : 16/06/06 - par Didier Roy
 *		           migration PHP5 
 *		           17/07/06 - Nordine Zetoutou
 * 	                 migration des balises HTML en XHTML 1.0 strict
 */


$IDlink  = ( @$_POST["IDlink"] )		// ID du lien
	? (int) $_POST["IDlink"]
	: (int) @$_GET["IDlink"] ;	
$IDmat   = ( strlen(@$_POST["IDmat"]) )	// ID de la matière
	? (int) $_POST["IDmat"]
	: (int) @$_GET["IDmat"] ;
$IDbreve = ( strlen(@$_POST["IDbreve"]) )	// ID de la dépêche
	? (int) $_POST["IDbreve"]
	: (int) @$_GET["IDbreve"] ;	
$IDdown  = ( strlen(@$_POST["IDdown"]) )	// ID du download
	? (int) $_POST["IDdown"]
	: (int) @$_GET["IDdown"] ;

$rb      = @$_POST["rb"];			// notation de la dépêche

$skpage  = ( @$_GET["skpage"] )		// n° de la page affichée
	? (int) $_GET["skpage"]
	: 1 ;
$skshow  = ( @$_GET["skshow"] )		// n° du flash info
	? (int) $_GET["skshow"]
	: 1 ; 

$submit   = ( @$_POST["submit"] )		// bouton de validation
	? $_POST["submit"]
	: @$_GET["submit"] ; 
?>


<?php
	require_once "include/smileys.php";
	require_once "include/spip.php";

	require "msg/spip.php";
	require_once "include/TMessage.php";

	$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/spip.php");

	//---------------------------------------------------------------------------
	function make_title($id, $ip, $breve, $titre, $date)
	{
		/*
		 *	fonction : création d'un titre de dépêche
		 *	in : ID de connexion, IP station, $ID dépêche, titre dépêche, date du post
		 *	out : titre dépêche formaté
		 */

		global	$mysql_link;

		require "msg/spip.php";
		require_once "include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/spip.php");

		// lecture des notes de la dépêche
		$return  = mysql_query("select sum(_vote) from flash_vote where _IDbreve = '$breve'", $mysql_link);
		$total   = ( $return ) ? mysql_fetch_row($return) : 0 ;

		$return  = mysql_query("select _IDvote from flash_vote where _IDbreve = '$breve'", $mysql_link);
		$nbvote  = ( $return ) ? mysql_num_rows($return) : 0 ;

		// attribution des étoiles
		$star    = ( $nbvote ) ? (int) ($total[0] / $nbvote) : 0 ;
		$etoile  = ( $star ) ? "<img src=\"".$_SESSION["ROOTDIR"]."/images/stats/etoile$star.gif\" title=\"\" alt=\"\" />" : "" ;

		$msg->isPlural = (bool) ( $nbvote > 1 );

		// infos concernant l'en-tête
	    	$header  = "<span class=\"large\"><strong>$titre</strong></span> ".$msg->read($SPIP_NOTE, strval($nbvote))." $etoile<br/>";
	    	$header .= "<span class=\"x-small\">".$msg->read($SPIP_POSTBY, Array(getUserName($id), $date));
	    	$header .= " " . _getHostName($ip) . "</span>";

		return $header;
	}
	//---------------------------------------------------------------------------
	function make_text($texte, $hit, $link)
	{
		/*
		 *	fonction : création d'un texte de dépêche
		 *	in : texte dépêche, nbr de hit, lien sur dépêche
		 *	out : texte dépêche formaté
		 */

		require "msg/spip.php";
		require_once "include/TMessage.php";

		$msg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/spip.php");

		// attention au pluriel !
		$msg->isPlural = (bool) ( $hit > 1 );

		// extrait du texte de la dépêche
		$string  = substr(str_replace("\r", "", str_replace("\n", " ", replace_smile($texte))), 0, 160) . "...";

		$footer  = find_image(find_typo($string, $note));
		$footer .= "<br/>". $msg->read($SPIP_MORE, Array($link, strval($hit)));

		return $footer;
	}
	//---------------------------------------------------------------------------

	// commandes utilisateur
	switch ( $submit ) {
		case "delete" :		// on efface la dépêche
			$Query  = "delete from flash_breve where _IDbreve = '$IDbreve' ";
			$Query .= ( $_SESSION["CnxAdm"] != 255 ) ? "AND _ID = '".$_SESSION["CnxID"]."'" : "" ;

			if ( mysql_query($Query, $mysql_link) )
				if ( !mysql_query("delete from flash_vote where _IDbreve = '$IDbreve'", $mysql_link) )
					sql_error($mysql_link);

			$IDbreve = 0;
			break;

		case "dellink" :	// on efface le lien
			$Query  = "delete from flash_link where _IDlink = '$IDlink' ";
//			$Query .= ( $_SESSION["CnxAdm"] != 255 ) ? "AND _ID = '".$_SESSION["CnxID"]."'" : "" ;

			if ( !mysql_query($Query, $mysql_link) )
				sql_error($mysql_link);
			break;

		default :
			// l'utilisateur a voté
			if ( $submit == $msg->read($SPIP_VALIDATE) AND strlen($rb) )
				if ( !mysql_query("insert into flash_vote values('', '$IDbreve', '".$_SESSION["CnxID"]."', '$rb')", $mysql_link) )
					sql_error($mysql_link);
			break;
		}

	// lecture de la publi
	$Query  = "select _template, _title, _IDgrprd, _IDmod from flash ";
	$Query .= "where _IDflash = '$IDflash' ";

	$result = mysql_query($Query, $mysql_link);
	$row    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

	if ( mysql_affected_rows($mysql_link) AND ($_SESSION["CnxAdm"] == 255 OR ($row[2] & pow(2, $_SESSION["CnxGrp"] - 1))) ) {

		// on charge le modèle
		$file   = "download/spip/templates/".$_SESSION["lang"]."/$row[0]";

		if ( ($fp = fopen($file, "r")) != 0 ) {
		    	//---- lecture de la dépêche sélectionnée ou de la 1ère dépêche
			$Query   = "select _IDbreve, _title, _texte, _img, _color, _date, _ID, _IP, _hit from flash_breve ";
			$Query  .= "where _IDflash = '$IDflash' ";
			$Query  .= ( $_SESSION["CnxClass"] ) ? "AND _IDgrp like '% ".$_SESSION["CnxClass"]." %' " : "" ;
			$Query  .= ( $IDbreve ) ? "AND _IDbreve = '$IDbreve'" : "order by _IDbreve desc limit 1";

			$result  = mysql_query($Query, $mysql_link);
			$info    = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			$IDbreve = $info[0];

		    	// log des clicks sur la dépêche
			mysql_query("update flash_breve set _hit = _hit + 1 where _IDbreve = '$IDbreve' ", $mysql_link);

		    	//---- lecture des brèves de seconde page
			$Query   = "select _IDbreve, _title, _texte, _date, _ID, _IP, _hit from flash_breve ";
			$Query  .= "where _IDflash = '$IDflash' AND _IDbreve != '$IDbreve' ";
			$Query  .= ( $_SESSION["CnxClass"] ) ? "AND _IDgrp like '% ".$_SESSION["CnxClass"]." %' " : "" ;
			$Query  .= "order by _IDbreve desc";

//			$result  = mysql_query($Query, $mysql_link);
//			$breve   = ( $result ) ? remove_magic_quotes(mysql_fetch_row($result)) : 0 ;

			// détermination du nombre de pages
			$result  = mysql_query($Query, $mysql_link);
			$nbelem  = ( $result ) ? mysql_affected_rows($mysql_link) : 0 ;

			$page    = $nbelem;
			$show    = 1;

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
				$pos   = $first;

				// se positionne sur la page ad hoc
				mysql_data_seek($result, $first - 1);
				$breve = remove_magic_quotes(mysql_fetch_row($result));
				}
			else
				$breve = 0;

			// intitialisation structure de controle
			$loop    = false;

			// lecture du modèle
			while ( !feof($fp) ) {
				// lecture du modèle
				$line = fgets($fp, 512);

				// traitement du code
				switch ( find_meta($line) ) {
					case "##TITLE ARTICLE##" :
						// suppression de l'annonce
						$req  = $msg->read($SPIP_DELANNOUNCE);
						$del  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $info[6] )
							? "<a href=\"index.php?item=$item&amp;cmde=$cmde&amp;IDflash=$IDflash&amp;IDbreve=$info[0]&amp;IDmat=$IDmat&amp;submit=delete\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"$req\" alt=\"\" /></a>"
							: "" ;

						// modification de l'annonce
						$maj  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $info[6] )
							? "<a href=\"index.php?item=6&amp;cmde=add&amp;IDflash=$IDflash&amp;IDbreve=$info[0]&amp;IDmat=$IDmat\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"". $msg->read($SPIP_UPDTANNOUNCE) ."\" alt=\"\" /></a>"
							: "" ;

						// infos concernant l'en-tête
					    	$header  = "<span class=\"large\"><strong>$row[1] : $info[1]</strong></span> $del $maj<br/>";
					    	$header .= "<span class=\"x-small\">". $msg->read($SPIP_POSTBY, Array(getUserName($info[6]), $info[5]));
					    	$header .= " " . _getHostName($info[7]) . "</span>";

						print( str_replace("##TITLE ARTICLE##", replace_smile($header), $line) );
						break;

					case "##IMAGE ARTICLE##" :
						// illustration du thème de la dépêche
						$header  = "<img src=\"".$_SESSION["ROOTDIR"]."/images/spip/annonces/$info[3]\" title=\"\" alt=\"\" />";

						print( str_replace("##IMAGE ARTICLE##", replace_smile($header), $line) );
						break;

					case "##TEXT ARTICLE##" :
						// texte de la dépêche
						$header = find_typo($info[2], $note);

						print( str_replace("##TEXT ARTICLE##", replace_smile($header), $line) );

						//---- les liens
						$return = mysql_query("select _titre, _url, _lang, _IDlink from flash_link where _IDbreve = '$info[0]'", $mysql_link);
						$link   = ( $return ) ? remove_magic_quotes(mysql_fetch_row($return)) : 0 ;

						if ( $link ) {
							print("<ul>");

							while ( $link ) {
								// lecture du compteur des téléchargements
								$res   = mysql_query("select _IDdown, _count from download_data where _file = '$link[1]'", $mysql_link);
								$down  = ( $res ) ? mysql_fetch_row($res) : 0 ;

								$count = ( $down[0] )
									? "<a href=\"*\" onclick=\"popWin('".$_SESSION["ROOTDIR"]."/user_list.php?sid=".$_SESSION["sessID"]."&amp;IDdown=$down[0]&amp;cmde=dwload&am;lang=".$_SESSION["lang"]."', '450', '200'); return false;\">$down[1]</a>"
									: "0" ;

								$msg->isPlural = (bool) ( $down[1] > 1 );

								// suppression du lien
								$req  = $msg->read($SPIP_DELLINK);
								$del  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $info[6] )
									? "<a href=\"".myurlencode("index.php?item=$item&cmde=$cmde&IDlink=$link[3]&IDbreve=$info[0]&IDmat=$IDmat&submit=dellink")."\" onclick=\"return confirmLink(this, '$req');\"><img src=\"".$_SESSION["ROOTDIR"]."/images/corb.gif\" title=\"$req\" alt=\"\" /></a>"
									: "" ;

								// modification du lien
								$maj  = ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $info[6] )
									? "<a href=\"".myurlencode("index.php?item=6&cmde=addlink&IDlink=$link[3]&IDbreve=$info[0]&IDmat=$IDmat")."\"><img src=\"".$_SESSION["ROOTDIR"]."/images/stats/post.gif\" title=\"". $msg->read($SPIP_UPDTLINK) ."\" alt=\"\" /></a>"
									: "" ;

								print("
									<li>
									  <img src=\"".$_SESSION["ROOTDIR"]."/images/spip/langues/$link[2]\" title=\"\" alt =\"$link[2]\" style=\"border-style:solid; border-color:#000000; border-width:1px;\" />
									  <a href=\"".myurlencode("index.php?file=$link[1]")."\" onclick=\"window.open(this.href, '_blank'); return false;\">$link[0]</a> ".$msg->read($SPIP_HIT, strval($count))."
									  $del $maj
									</li>
									");

								$link  = remove_magic_quotes(mysql_fetch_row($return));
								}

							print("</ul>");
							}
						else
							print("<br/><br/>");

						if ( $_SESSION["CnxAdm"] == 255 OR $_SESSION["CnxID"] == $row[3] )
							print("
								[<a href=\"".myurlencode("index.php?item=6&cmde=addlink&IDbreve=$info[0]&IDmat=$IDmat")."\">". $msg->read($SPIP_NEWLINK) ."</a>]<br/><br/>
								");

						//---- le vote
						mysql_query("select _IDvote from flash_vote where _IDbreve = '$info[0]' AND _ID = '".$_SESSION["CnxID"]."'", $mysql_link);

						if ( mysql_affected_rows($mysql_link) ) {
							// lecture des notes de la dépêche
							$return  = mysql_query("select sum(_vote) from flash_vote where _IDbreve = '$info[0]'", $mysql_link);
							$total   = ( $return ) ? mysql_fetch_row($return) : 0 ;

							$return  = mysql_query("select _IDvote from flash_vote where _IDbreve = '$info[0]'", $mysql_link);
							$nbvote  = ( $return ) ? mysql_num_rows($return) : 0 ;

							// attribution des étoiles
							$star    = ( $nbvote ) ? (int) ($total[0] / $nbvote) : 0 ;
							$etoile  = ( $star ) ? "<img src=\"".$_SESSION["ROOTDIR"]."/images/stats/etoile$star.gif\" title=\"\" alt=\"$star\" />" : "" ;

							$msg->isPlural = (bool) ( $nbvote > 1 );


							print("
								<div style=\"width:90%; padding:5px; border-style:solid; border-color:#000000; border-width:1px; background-image: url('".$_SESSION["CfgHeader"]."'); background-repeat: repeat;\" >
									$etoile ". $msg->read($SPIP_HIT, Array(strval($nbvote), strval($total[0] / $nbvote))) ."
								</div>");
							}
						else {
							$rb   = "";
							$list = explode(",", $msg->read($SPIP_COMMENT));

							for ($i = 0; $i < count($list); $i++)
								$rb .= "<label for=\"rb_$i\"><input type=\"radio\" id=\"rb_$i\" name=\"rb\" value=\"$i\" />$list[$i] </label>";

							print("
								<div style=\"width:90%; padding:5px; border-style:solid; border-color:#000000; border-width:1px; background-image: url('".$_SESSION["CfgHeader"]."'); background-repeat: repeat;\" >
									<form id=\"breve\" action=\"index.php\" method=\"post\">
										<p class=\"hidden\"><input type=\"hidden\" name=\"item\"       value=\"$item\" /></p>
										<p class=\"hidden\"><input type=\"hidden\" name=\"IDmat\"      value=\"$IDmat\" /></p>
										<p class=\"hidden\"><input type=\"hidden\" name=\"IDflash\"    value=\"$IDflash\" /></p>
										<p class=\"hidden\"><input type=\"hidden\" name=\"cmde\"       value=\"$cmde\" /></p>
										<p class=\"hidden\"><input type=\"hidden\" name=\"IDbreve\"    value=\"$info[0]\" /></p>

										<p style=\"margin: 0;\">".
											$msg->read($SPIP_POLL) ."$rb<br/>".
											$msg->read($SPIP_THEN) ." <input type=\"submit\" name=\"submit\" value=\"". $msg->read($SPIP_VALIDATE) ."\" style=\"font-size:9px;\" />
										</p>
									</form>
								</div>");
							}
						break;

					case "##LOOP##" :
						$temp = "";
						$loop = true;
						break;

					case "##TITLE NEWS##" :
						if ( $loop )
							$temp .= $line;
						else {
							$header = make_title($breve[4], $breve[5], $breve[0], $breve[1], $breve[3]);
							print( str_replace("##TITLE NEWS##", $header, $line) );
							}
						break;

					case "##TEXT NEWS##" :
						if ( $loop )
							$temp .= $line;
						else {
							// extrait du texte de la dépêche
							$link   = "index.php?item=$item&amp;IDmat=$IDmat&amp;cmde=$cmde&amp;IDbreve=$breve[0]";
							$footer = make_text($breve[2], $breve[6], $link);

							print( str_replace("##TEXT NEWS##", replace_smile($footer), $line) );

							// on passe à la brêve suivante
							$breve  = remove_magic_quotes(mysql_fetch_row($result));
							}
						break;

					case "##ENDLOOP##" :
						while ( $breve AND $i <= $MAXPAGE ) {
							$link   = "index.php?item=$item&amp;IDmat=$IDmat&amp;cmde=$cmde&amp;IDbreve=$breve[0]";
							$header = make_title($breve[4], $breve[5], $breve[0], $breve[1], $breve[3]);
							$footer = make_text($breve[2], $breve[6], $link);

							print( str_replace("##TITLE NEWS##", replace_smile($header), str_replace("##TEXT NEWS##", $footer, $temp)) );

							$breve = remove_magic_quotes(mysql_fetch_row($result));
							$pos++;
							$i++;
							}

						$loop = false;
						break;

					default :
						if ( $loop )
							$temp .= $line;
						else
							print("$line");
						break;
					}
				}

			// barre de navigation dans les brèves
			if ( $nbelem ) {
				// initialisation du lien
				$link   = "index.php?item=$item&amp;IDmat=$IDmat&amp;cmde=$cmde";

				// bouton précédent
				$where = $skshow - 1;
				if ( $skshow == 1 )
					$prev = "";
				else {
					$skpg = 1 + (($skshow - 2) * $MAXSHOW);
					$prev = "[<a href=\"$link&amp;skpage=$skpg&amp;skshow=$where\">". $msg->read($SPIP_PREV) ."</a>]";
					}

				// liens directs sur n° de page
				$start = 1 + (($skshow - 1) * $MAXSHOW);
				$end   = $skshow * $MAXSHOW;

				$choix = ( $skpage == $start )
					? "<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"\" alt =\"\" /><strong>$start</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"\" alt =\"\" />"
					: "<a href=\"$link&amp;skpage=$start&amp;skshow=$skshow\">$start</a>" ;

				for ($j = $start + 1; $j <= $end AND $j <= $page; $j++)
					$choix .= ( $skpage == $j )
						? "|<img src=\"".$_SESSION["ROOTDIR"]."/images/nav_left.gif\" title=\"\" alt =\"\" /><strong>$j</strong><img src=\"".$_SESSION["ROOTDIR"]."/images/nav_right.gif\" title=\"\" alt =\"\" />"
						: "|<a href=\"$link&amp;skpage=$j&amp;skshow=$skshow\">$j</a>" ;

				// bouton suivant
				$where = $skshow + 1;
				$next  = ( $skshow == $show )
					? ""
					: "[<a href=\"$link&amp;skpage=$j&amp;skshow=$where\">". $msg->read($SPIP_NEXT) ."</a>]";

				// affichage de la barre de navigation
				print("<div style=\"text-align:center;\">$prev $choix $next</div>");
				}

			fclose($fp);
			}	// endif fopen
		}	// endif $row
?>
