<?php

require_once "common.php";
session_start();

function run() {
	// On récupère l'URL OpenID
    $openid = $_GET['identifiant_openid'];
    
    // On crée un consommateur pour traiter les entêtes OpenID
    $consumer = getConsumer();

    // Début du processus de vérification
    $auth_request = $consumer->begin($openid);
    if (!$auth_request) {
        displayError("Erreur : URL OpenID non valide.");
    }

	// Liste des informations de l'extension Simple Registration
	// que l'on souhaite récupérer
    $sreg_request = Auth_OpenID_SRegRequest::build(
		// Premier tableau : obligatoires
		// en cas d'absence, l'authentification échoue
		array('nickname','email'),
		// Second tableau : optionnelles
		// en cas d'absence, l'authentification sera valide
		array('fullname','dob','postcode',
			  'language','country','gender','timezone'));

	// Ajout des informations SREG à la requête OpenID
    if ($sreg_request) {
        $auth_request->addExtension($sreg_request);
    }

    // Redirection vers le serveur OpenID pour que l'utilisateur s'authentifie
	$redirect_url = $auth_request->redirectURL(getTrustRoot(), getReturnTo());
    header("Location: ".$redirect_url);
}

run();

?>
