<?php

require_once "common.php";
session_start();

function run() {
	// Création d'un consommateur pour traiter les entêtes OpenID
    $consumer = getConsumer();

    // Récupération de la réponse du serveur OpenID
    $return_to = getReturnTo();
    $response = $consumer->complete($return_to);

    // Vérification de l'état
    if ($response->status == Auth_OpenID_CANCEL) {
        // La vérification a été annulée
        $msg = 'Verification cancelled.';
    } else if ($response->status == Auth_OpenID_FAILURE) {
        // La vérification du serveur OpenID a échoué
        $msg = "OpenID authentication failed: " . $response->message;
    } else if ($response->status == Auth_OpenID_SUCCESS) {
        // La vérification est un succès
        
        // On récupère l'URL de l'identité numérique
        $openid = $response->getDisplayIdentifier();
        $esc_identity = htmlspecialchars($openid, ENT_QUOTES);
        $success = "<p>Votre identité " .
                   "<a href=\"$esc_identity\">$esc_identity</a>" .
                   " a été validée.</p>";

		// On récupère les informations de l'extension Simple Registration
        $sreg_resp = Auth_OpenID_SRegResponse::fromSuccessResponse($response);

        $sreg = $sreg_resp->contents();
		$success .= "<p>Vous avez aussi retourné ces informations :";
		$success .= "<table>";
		
        if (@$sreg['email']) {
            $success .= "<tr><td>Email</td><td>".$sreg['email']."</td></tr>";
        }

        if (@$sreg['nickname']) {
            $success .= "<tr><td>Pseudonyme (nickname)</td><td>".$sreg['nickname']."</td></tr>";
        }

        if (@$sreg['fullname']) {
            $success .= "<tr><td>Nom complet (fullname)</td><td>".$sreg['fullname']."</td></tr>";
        }

        if (@$sreg['dob']) {
            $success .= "<tr><td>Date de naissance (dob)</td><td>".$sreg['dob']."</td></tr>";
        }

        if (@$sreg['timezone']) {
            $success .= "<tr><td>Zone horaire (timezone)</td><td>".$sreg['timezone']."</td></tr>";
        }

        if (@$sreg['gender']) {
            $success .= "<tr><td>Sexe (gender)</td><td>".$sreg['gender']."</td></tr>";
        }

        if (@$sreg['country']) {
            $success .= "<tr><td>Pays (country)</td><td>".$sreg['country']."</td></tr>";
        }

        if (@$sreg['language']) {
            $success .= "<tr><td>Langue (language)</td><td>".$sreg['language']."</td></tr>";
        }

        if (@$sreg['postcode']) {
            $success .= "<tr><td>Code postal (postcode)</td><td>".$sreg['postcode']."</td></tr>";
        }
		$success .= "</table></p>";
    }

    include 'index.php';
}

run();

?>
