<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2004-2007 by Dominique Laporte(C-E-D@wanadoo.fr)

   This file is part of Prom�th�e.

   Prom�th�e is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   Prom�th�e is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.
 *-----------------------------------------------------------------------*/
?>

<?php
/*
 *		module   : TMessage.php
 *		projet   : classe objet message
 *
 *		version  : 2.0
 *		auteur   : laporte
 *		creation : 22/12/04
 *		modif    : 15/07/06 - par D. Laporte
 *                     g�n�ration des fichiers messages (m�thode add)
 */


//---------------------------------------------------------------------------
class TMessage
{
	var	$rootDir     = ".";		// r�pertoire racine des fichiers messages
	var	$file        = "";		// fichier message
	var	$path        = "";		// fichier mn�monique
	var	$plural      = "s";		// pluriel dans les messages
	var	$isPlural    = false;		// utilisation du pluriel dans les messages
	var	$separator   = "|";		// s�parateur mot singulier/pluriel
	var	$raw         = false;		// mode brut d'affichage des messages
	var	$debug       = false;		// mode debug des messages
	var	$varDecl     = array();		// tableau des mn�moniques
	var	$message     = array();		// tableau des messages
	var	$msg_search  = array();		// tableau des chaines de texte � trouver
	var	$msg_replace = array();		// tableau des chaines de texte de remplacement

	// constructeur -------------------------------------------------------
	/*
	 * @author : D. Laporte
	 * @date : Date de cr�ation : 12:40:12 / 3 nov. 04
	 * @date : Date de modification :
	 *
	 * @description : constructeur de la classe TMessage
	 *
	 * @param : string $file
	 * @param : string $rootDir
	 * @return : void
	 *
	 * @access : public
       */
	function TMessage($file, $rootDir = ".")
	{
	/*
	 * fonction :	constructeur
	 * in :		$file, fichier message
	 * 			$rootDir, dossier racine o� se trouve les fichiers de messages
	 */

		$this->file    = $file;
		$this->rootDir = $rootDir;

		// le pluriel n'est pas toujours le "s" selon les langues
		if ( strpos($file, "/de/") OR strpos($file, "/it/") )
			$this->plural = "|";

		// lecture des messages
		if ( $this->readMessages() )
			// lecture des mn�moniques
			$this->readHeader();
	}
	// choix du message pour le pluriel -----------------------------------
	function check($msg)
	{
		$words = explode(" ", $msg);

		// recherche de la forme singulier|pluriel
		for ($i = 0; $i < count($words) ; $i++)
			if ( strchr($words[$i], $this->separator) ) {
				$list = explode("|", $words[$i]);

				$msg  = ( $this->isPlural )
					? str_replace($list[0].$this->separator, "", $msg)
					: str_replace($this->separator.$list[1], "", $msg) ;
				}

		return $msg;
	}
	// v�rification des messages au pluriel -------------------------------
	function verify($msg)
	{
		if ( $this->plural == "|" )
			return $this->check($msg);

		// s'il y a %s dans la cha�ne, on remplace par la forme plurielle
		return ( $this->isPlural )
			? str_replace("%s", $this->plural, $msg)
			: str_replace("%s", "", $msg) ;
	}
	// lecture du message -------------------------------------------------
	function read($IDmsg, $arg = "")
	{
	/*
	 * fonction :	lecture du message
	 * in :		$IDmsg, n� du message
	 * 			$arg, n� argument dans le message
	 * out :		message texte
	 */

		if ( $IDmsg > -1 AND $IDmsg < $this->count() ) {
			$debug  = ( $this->debug )
				? "#$IDmsg#"
				: "" ;

			$texte  = $debug;
			$texte .= $this->message[$IDmsg];

			if ( $this->raw )
				return $texte;

			if ( !is_array($arg) )
				$texte = str_replace("%1", $arg, $texte);
			else
				for ($i = 1; $i <= sizeof($arg); $i++)
					$texte = str_replace("%$i", $arg[$i-1], $texte);

			return $this->verify(str_replace($this->msg_search, $this->msg_replace, $texte));
			}

		// message non trouv�
		return "$this->rootDir/$this->file/#$IDmsg#";
	}
	// lecture de l'ent�te ------------------------------------------------
	function readHeader()
	{
		$list = explode("/", $this->file);

		$this->path = ( count($list) - 2 > 0 ) ? $list[0] : "" ;

		for ($i = 1; $i < count($list) ; $i++)
			if ( $i != count($list) - 2 )
				$this->path .= "/".$list[$i];

		if ( is_file("$this->rootDir/$this->path") )
			if ( ($in  = @fopen("$this->rootDir/$this->path", "r")) ) {

				// raz tableau
				$this->varDecl = array();

				while ( !feof($in) ) {
					$line = fgets($in, 255);
					if ( strstr($line, "static") ) {
						list($i, $j) = preg_split("/[$=]/", $line);
						array_push($this->varDecl, trim($j));
						}
					}

				fclose($in);
				}

		return $this->count();
	}
	// lecture des messages -----------------------------------------------
	function readMessages()
	{
		if ( is_file("$this->rootDir/$this->file") ) {
			// lecture du tableau des messages
			require "$this->rootDir/$this->file";

			$this->message = $message;

			return true;
			}

		return false;
	}
	// cr�ation des liens sur les langues disponibles ---------------------
	function languageBanner($dir, $url="index.php")
	{
	/*
	 * fonction :	cr�ation de la bani�re des langues disponibles
	 * in :		$dir, r�pertoire des fichiers de langue
	 * 			$url, adresse url de retour
	 * out :		nombre de langues disponibles
	 */

		$count = 0;

		// ouverture du r�pertoire des langues
		$myDir = @opendir("$this->rootDir/$dir");

		// lecture des r�pertoires
		while ( $entry = @readdir($myDir) )
			if ( is_dir("$this->rootDir/$dir/$entry") AND strlen($entry) == 2 )
				switch ( $entry ) {
					case "." :
					case ".." :
						break;

					default :
						$count++;
						print("&nbsp;<a href=\"$url?lang=$entry\"><img src=\"$this->rootDir/images/lang/ico-$entry.png\" title=\"$entry\" alt=\"[$entry]\" /></a>");
						break;
					}

		// fermeture du r�pertoire
		@closedir($myDir);

		return $count;
	}
	
	// cr�ation des liens sur les langues disponibles TYPE MENU ---------------------
	function languageBannerTypeMenu($dir, $url="index.php")
	{
	/*
	 * fonction :	cr�ation de la bani�re des langues disponibles
	 * in :		$dir, r�pertoire des fichiers de langue
	 * 			$url, adresse url de retour
	 * out :		nombre de langues disponibles
	 */

		$count = 0;

		// ouverture du r�pertoire des langues
		$myDir = @opendir("$this->rootDir/$dir");

		echo '
		<ul class="nav pull-right">
			<li id="fat-menu" class="dropdown">
			  <a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
			  <img src="images/lang/ico-'.$_SESSION["lang"].'.png" title="'.$_SESSION["lang"].'" alt="['.$_SESSION["lang"].']" />
			  <b class="caret"></b></a>
			  <ul class="dropdown-menu" role="menu" aria-labelledby="drop1" style="min-width: 50px">';
		
		// lecture des r�pertoires
		while ( $entry = @readdir($myDir) )
			if ( is_dir("$this->rootDir/$dir/$entry") AND strlen($entry) == 2 )
				switch ( $entry ) {
					case "." :
					case ".." :
						break;

					default :
						$count++;
						print("&nbsp;<li role=\"presentation\"><a role=\"menuitem\" href=\"$url?lang=$entry\"><img src=\"$this->rootDir/images/lang/ico-$entry.png\" title=\"$entry\" alt=\"[$entry]\" /></a></li>");
						break;
					}

		echo '
				</ul>
			</li>
		</ul>';
		
		// fermeture du r�pertoire
		@closedir($myDir);

		return $count;
	}
	
	// cr�ation des liens sur les langues disponibles ---------------------
	function languageList($dir, $url = "")
	{
	/*
	 * fonction :	cr�ation de la bani�re des langues disponibles
	 * in :		$dir : r�pertoire des fichiers de langue, $url : url retour sur formulaire
	 * out :		nombre de langues disponibles
	 */

		$count  = 0;

 		print("<form id=\"langlist\" action=\"$url\" method=\"post\">");
 		print("<select name=\"lang\">");

		// ouverture du r�pertoire des langues
		$myDir = @opendir("$this->rootDir/$dir");

		// lecture des r�pertoires
		while ( $entry = @readdir($myDir) )
			if ( is_dir("$this->rootDir/$dir/$entry") )
				switch ( $entry ) {
					case "." :
					case ".." :
						break;

					default :
						$count++;
						print("<option value=\"$entry\">$entry</option>");
						break;
					}

		// fermeture du r�pertoire
		@closedir($myDir);

 		print("</select>");
 		print("</form>");

		return $count;
	}
	// ajoute/modifie un message ------------------------------------------
	function add($titre, $texte, $IDmsg = -1)
	{
		if ( ($titre = strtoupper(trim($titre))) == "" )
			return 0;

		// ajout de message
		if ( $IDmsg == -1 ) {
			array_push($this->varDecl, $titre);
			array_push($this->message, $texte);
			}
		// modification de message
		else
			if ( $IDmsg < $this->count() ) {
				$this->varDecl[$IDmsg] = $titre;
				$this->message[$IDmsg] = $texte;
				}

		return $this->write();
	}
	// �crit le fichier messages -----------------------------------------
	function write()
	{
		$count = 0;

		$gnu   = "<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2006 by Dominique Laporte(C-E-D@wanadoo.fr)

   This program is free software. You can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License.
*-----------------------------------------------------------------------*/
?>";

		$separator = "//---------------------------------------------------------------------------";

		$header = "<?php
/*
 *		module   : $this->rootDir/$this->path
 *		projet   : d�finition des mn�moniques des messages
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : ". date("d/m/Y") ."
 *		modif    : 
 *
 */";

		// enregistrement des mn�moniques
		if ( ($out = @fopen("$this->rootDir/$this->path", "w")) ) {
			$count++;

			fputs($out, "$gnu\r\n\r\n");
			fputs($out, "$header\r\n\r\n");
			fputs($out, "$separator\r\n");

			for ($i = 0; $i < count($this->varDecl); $i++)
				fputs($out, "static	$".$this->varDecl[$i]."      = $i;\r\n");

			fputs($out, "$separator\r\n?>");

			//fermeture fichiers
			fclose($out);
			}

		$header = "<?php
/*
 *		module   : $this->rootDir/$this->file
 *		projet   : d�finition des messages
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : ". date("d/m/Y") ."
 *		modif    : 
 *
 */";

		// enregistrement des messages
		if ( ($out = @fopen("$this->rootDir/$this->file", "w")) ) {
			$count++;

			fputs($out, "$gnu\r\n\r\n");
			fputs($out, "$header\r\n\r\n");
			fputs($out, "$separator\r\n");
			fputs($out, "static	$"."message = Array(\r\n\r\n");

			for ($i = 0; $i < count($this->message); $i++)
				if ( $i == count($this->message) - 1 )
					fputs($out, "\"".$this->message[$i]."\"\r\n");
				else
					fputs($out, "\"".$this->message[$i]."\",\r\n");

			fputs($out, "\r\n);\r\n");
			fputs($out, "$separator\r\n?>");

			//fermeture fichiers
			fclose($out);
			}

		return $count;
	}
	// efface un message --------------------------------------------------
	function delete($IDmsg)
	{
		array_splice($this->varDecl, $IDmsg, 1);
		array_splice($this->message, $IDmsg, 1);

		return $this->write();
	}
	// nombre de messages -------------------------------------------------
	function count()
	{
		return ( is_file("$this->rootDir/$this->file") )
			? count($this->varDecl)
			: -1 ;
	}
	// --------------------------------------------------------------------
}
//---------------------------------------------------------------------------
?>