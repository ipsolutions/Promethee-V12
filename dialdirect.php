<?php
/*

SERVICE DIALDIRECT
compatible PHP 4.3 ou superieur.

*/


// PAS DE CACHE NAVIGATEUR
/*
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified:".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
*/


// CONFIGURATION
$path="tmp/";

// chemin pour les fichiers de sauvegarde
define('DEFAUT_PATH', '$path');

// nombre de messages maximum envoyés
define('MAX_MESSAGE', 15);

// taille maximum du fichier de sauvegarde (un par salle)
define('MAX_SIZE', 10000);

// utilisation la memoire au lieu de fichiers texte
define('USE_MEM', true);


// CONTROLE SALLE AUTORISEE / SESSION / UTILISATEUR / IP / etc..
// rien pour l'instant

//	require "msg/chat.php";
//	require_once "include/TMessage.php";

//	$mymsg  = new TMessage($_SESSION["ROOTDIR"]."/msg/".$_SESSION["lang"]."/chat.php");

// TRAITEMENT DES DONNEES

// retourne la date interne
function getInterneDate(){
	list($m, $s) = explode(" ", microtime());
	return  round ( ((float)$s+(float)$m) * 100 );
}

// VERIFICATION DU JEU DE CARACTERE 
// (pas certain que cela fonctionne, même peu probable)
$utf8 = mb_eregi('UTF-8', $_SERVER['HTTP_ACCEPT_CHARSET']);

// recuperation des données
// -> ( version >= PHP-4.3.0 );
$input = file_get_contents('php://input');
// pour version PHP <= 4.2.0
//$input = $HTTP_RAW_POST_DATA;

if($utf8){$input = utf8_decode($input);}

/* FORME DU MESSAGE RECU:
	ligne 0 : salle
	ligne 1 : dernière date du rafraichissement
	ligne 2 : id utilisateur
	ligne 3 : id interlocuteur
	ligne 4 : attributs message (prof/prive/etc...)
	ligne 5 : le message
*/
$input = preg_split("/\n/",$input);

// VERSION FICHIER TXT.
// (ajouter mecanisme flock ?)

// nom du fichier de stockage
$file = DEFAUT_PATH . md5($input[0]). ".txt";

// MEMOIRE PARTAGEE AU LIEU ET PLACE DE FICHIERS

/* retourn une cle entière pour identifiant de block mémoire... */
/* à tester. ne garantie pas l'absence de collisions */
function ftok2($pathname) {
	$tmp =0;
	for($i = 0; $i<strlen($pathname); $i++){ $tmp += ord($pathname[$i]); }
	$key = sprintf("%u", strlen($pathname)+$tmp*100 );
	return $key;
}

// verification de l'existence des fonctions pour utilisation de la memoire
$toMemory = false;
if ( (USE_MEM) && ( function_exists('shmop_open')) ){
	// verification de la possibilite de creer le block memoire
	if ( $pmem = ftok2($file) ){
		// ouverture
		if( $mem = @shmop_open($pmem,'w', 0, 0) ){
			$toMemory = true;
		// sinon création
		}else if( $mem = shmop_open($pmem,'c', 0666, MAX_SIZE) ){
			shmop_write($mem, str_to_nts(''), 0);
			$toMemory = true;		
		}
		// pour effacer le block memoire...
		//shmop_delete($mem);
	}
}

// fonctions pour transformer block mémoire <-> string
function str_to_nts($value) {
	return "$value\0";
}

function str_from_mem(&$value) {
	$i = strpos($value, "\0");
	if ($i == false) {
		return $value;
	}
	$result =  substr($value, 0, $i);
	return $result;
}


// date de la requete
$temps = getInterneDate();

// lecture des messages
if($toMemory){
	// en memoire
	if ($str = shmop_read($mem, 0, MAX_SIZE)){
		$str = str_from_mem($str);
	}else{
		$str='';
	}
}else{
	// dans un fichier
	if (!$str = @file_get_contents($file)){$str='';}
}

// transformation des accentuations
function myhtmlspecialchars($string) {
	return str_replace(
		Array("é", "è", "à", "ô", "ü", "ë", "ç", "â", "ê", "î", "ï", "œ", "ù", "û", "°"),
		Array("&eacute;", "&egrave;", "&agrave;", "&ocirc;", "&uuml;", "&euml;", "&ccedil;", "&acirc;", "&ecirc;", "&icirc;", "&iuml;", "&oelig;", "&ugrave;", "&ucirc;", "&deg;"),
		$string);
	}

// marquer la connexion/deconnexion pas trop fiable
if ( $input[1]=='connect' ){
//	$str =  $temps ."\n\n". myhtmlspecialchars($mymsg->read($CHAT_CONNECT, Array($input[2], date("H:i:s")))) ."\n". htmlspecialchars($input[4]) ."\n\n" .$str;
//	$str =  $temps ."\n\n". htmlspecialchars($input[2]) ." connect @ ". date("H:i:s") ."\n-". htmlspecialchars($input[4]) ."--\n\n" .$str;
	if($toMemory){
		shmop_write($mem, str_to_nts($str), 0);
	}else{
		$f = fopen($file, 'w');
		fwrite($f, $str, MAX_SIZE);
		fclose($f);
	}
	$input[1]=0;
}else if( $input[1]=='deconnect' ){
//	$str =  $temps ."\n\n". myhtmlspecialchars($mymsg->read($CHAT_LOGOUT, Array($input[2], date("H:i:s")))) ."\n". htmlspecialchars($input[4]) ."\n\n" .$str;
//	$str =  $temps ."\n\n". myhtmlspecialchars($input[2]) ." disconnect @ ". date("H:i:s") ."\n\n" .$str;
	if($toMemory){
		shmop_write($mem, str_to_nts($str), 0);
	}else{
		$f = fopen($file, 'w');
		fwrite($f, $str, MAX_SIZE);
		fclose($f);
	}
	$input[1]=0;
}

// sauvegarde du message (si besoin)
if( isset($input[4]) ){
	$str =  $temps ."\n". myhtmlspecialchars($input[3])  ."\n". myhtmlspecialchars($input[2]) ."\t". date("H:i:s")  ."\n". myhtmlspecialchars($input[4]) ."\n". myhtmlspecialchars($input[5]) ."\n" .$str;
	if($toMemory){
		shmop_write($mem, str_to_nts($str), 0);
	}else{
		$f = fopen($file, 'w');
		fwrite($f, $str, MAX_SIZE);
		fclose($f);
	}
}

// fermeture block memoire si necessaire
if($toMemory){
	shmop_close($mem);
}

// fabrication des reponses
//$sortie .= "";
$sortie = "";
$mes = preg_split("/\n/", $str);
$cpt = 0;
$long = count($mes);
$nbmess=0;

while ( ( $nbmess < MAX_MESSAGE ) && ( $mes[$cpt*5] > $input[1] ) && ( $cpt*5 < $long ) ){
	// message ok (inteloc est tous) || (interloc est utilisateur) || (auteur est utilisateur)
	if( ($mes[($cpt*5)+1]=='') || ($mes[($cpt*5)+1]==$input[2]) || ( mb_ereg ($input[2], $mes[($cpt*5)+2])) ){
		$tmp = $mes[$cpt*5]."\n"; 	// date
		$tmp .= $mes[($cpt*5)+1]."\n"; 	// id interlocuteur
		$tmp .= $mes[($cpt*5)+2]."\n";  //auteur
		$tmp .= $mes[($cpt*5)+3]."\n"; 	// attributs
		$tmp .= $mes[($cpt*5)+4]."\n"; //message	
		$sortie = $tmp . $sortie;
		$nbmess++;
	}
	$cpt++;
}
$sortie = myhtmlspecialchars($temps ."\n". $sortie);


/* FORME DU MESSAGE ENVOYE:
	ligne 1 : date du rafraichissement
	POUR TOUS LES X MESSAGES ENVOYE
		ligne x+0 : date postage
		ligne x+1 : id interlocuteur (vide +"\n" : tous)
		ligne X+2 : ID AUTEUR MESSAGE [TABULATION] DATE LISIBLE
		ligne x+3 : attributs message (prof/prive/etc...)
		ligne X+4 : MESSSAGE
*/



/*
// le message
$sortie .= $input[1]."\n"; 	// date
$sortie .= $input[2]."\n"; 	// id interlocuteur
$sortie .= $input[3]."\t".date("H:i:s")."\n";  //auteur
$sortie .= $input[4]."\n"; 	// attributs
$sortie .= htmlspecialchars($input[5])."\n"; //message
*/


//if($utf8){$sortie = utf8_encode($sortie);}

echo $sortie;

?>