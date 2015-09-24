<?php

function displayError($message) {
    $error = $message;
    include 'index.php';
    exit(0);
}

function doIncludes() {
    require_once "Auth/OpenID/Consumer.php";
    require_once "Auth/OpenID/FileStore.php";
    require_once "Auth/OpenID/SReg.php";
}

doIncludes();

// Répertoire FileStore dans lequel on va stocker
// les informations reçues du serveur OpenID
function &getStore() {
    $store_path = "/tmp/_php_consumer_test";

    if (!file_exists($store_path) &&
        !mkdir($store_path)) {
        print "Impossible de créer le répertoire FileStore ".
        	  "'$store_path'. Vérifiez les permissions.";
        exit(0);
    }
    return new Auth_OpenID_FileStore($store_path);
}

// Création d'un consommateur lié au répertoire FileStore
function &getConsumer() {
    $store = getStore();
    return new Auth_OpenID_Consumer($store);
}

// Renvoie le préfixe d'URL selon que le site est sécurisé ou non
function getScheme() {
    $scheme = 'http';
    if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on') {
        $scheme .= 's';
    }
    return $scheme;
}

// Crée l'URL du script qui recvra les informations du serveur OpenID
function getReturnTo() {
    return sprintf("%s://%s:%s%s/recuperation.php",
                   getScheme(), $_SERVER['SERVER_NAME'],
                   $_SERVER['SERVER_PORT'],
                   dirname($_SERVER['PHP_SELF']));
}

// Construit l'URL de base pour laquelle l'authentification sera
// valide, par défaut le répertoire de notre script
function getTrustRoot() {
    return sprintf("%s://%s:%s%s/",
                   getScheme(), $_SERVER['SERVER_NAME'],
                   $_SERVER['SERVER_PORT'],
                   dirname($_SERVER['PHP_SELF']));
}

?>
