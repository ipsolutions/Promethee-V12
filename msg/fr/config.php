<?php
/*-----------------------------------------------------------------------*
   Copyright (c) 2007 by Dominique Laporte(C-E-D@wanadoo.fr)

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
 *		module   : config.php
 *		projet   : d�finition des messages
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 05/04/2007
 *		modif    : 
 *
 */

//---------------------------------------------------------------------------
static	$message = Array(

"<strong>Configuration de l'intranet</strong>",
"personnalisation",
"base de donn�es",
"menus",
"<strong>. S�curit�</strong>",
"Connexion persistante :",
"Cr�ation de compte :",
"par les utilisateurs",
"Dur�e de validit� :",
"des comptes (aaaa-mm-jj)",
"Filtrage IP :",
"Mode DEBUG :",
"Mode DEMO :",
"(connexions multiples sous le m�me ID)",
"Mot de passe :",
"caract�re(s)",
"D�lai des pages :",
"minutes",
"D�lai des liens :",
"jours",
"<strong>. Donn�es</strong>",
"Taille des fichiers :",
"Quotas disque :",
"Dur�e des logs :",
"Dur�e des stats :",
"Dur�e des post-it :",
"semaines",
"<strong>. Affichage</strong>",
"Menus :",
"2 colonnes,gauche,droite",
"Espacement :",
"pixel(s)",
"Page d'accueil :",
"flash info par d�faut",
"Donn�es par page :",
"Nombre de pages :",
"Derniers messages :",
"forum style egroup",
"<strong>. Documents autoris�s</strong>",
"Modifier",
"Cr�er",
"- extension :",
"ajouter un document",
"pour valider la configuration.",
"pour revenir � l'accueil.",
"<strong>Configuration de la base de donn�es</strong>",
"<strong>. Centres constitutifs</strong>",
"visible",
"invisible",
"supprimer",
"ajouter un enregistrement",
"<strong>. Groupes utilisateurs</strong>",
"droits �tendus",
"droits limit�s",
"<strong>. Classes/Fili�res/Formations</strong>",
"<strong>. Mati�res/UV/Modules</strong>",
"<em>afin de personnaliser votre intranet, veuillez compl�ter le formulaire suivant</em>",
"Prom�th�e, l'ENT � clef en main � Libre et gratuit",
"Bienvenue sur votre intranet",
"Veuillez taper votre ID utilisateur et votre mot de passe pour vous connecter.",
"Erreur � la cr�ation de \"%1\" : v�rifiez que vous poss�dez les droits d'�criture.",
"Erreur � la cr�ation de %1 : v�rifiez que vous poss�dez les droits d'�criture.",
"Bravo, vous avez r�ussi � param�trer votre intranet !<br/><br/>
Il vous reste � cr�er les comptes :<br/>
%1 des utilisateurs avec phpMyAdmin (base %2, table user_id).<br/>
%3 des %4 avec phpMyAdmin (base %5, table user_student).<br/><br/>
Pour tester l'intranet, utilisez le compte administrateur \"<strong>%6</strong>\" (pas de mot de passe).<br/>
Pour vous connecter maintenant cliquez <a href=\"%7\">ici</a>.",
"options",
"choisissez un menu :",
"nouvel intitul� :",
"<strong>sous menu</strong>",
"ne pas afficher le lien",
"afficher le lien",
"Personnalisation de l'intranet : %1/2",
"<strong>Attention :</strong> veuillez indiquer le nom de votre �tablissement.",
"Le \"nom\" de votre �tablissement est utilis� pour cr�er un r�pertoire images/logos/\"nom\" o� seront copi�s le logo de votre �tablissement (logo01.jpg) ainsi que celui de votre r�gion (logo02.jpg).",
"<strong>Nom �tablissement :</strong>",
"obligatoire",
"Taille maximale conseill�e du logo �tablissement : 700 x 110.",
"<strong>Logo �tablissement :</strong>",
"Taille maximale conseill�e du logo r�gion : 100 x 50.",
"<strong>Logo r�gion :</strong>",
"La couleur du th�me est celle utilis�e pour l'intranet. Elle doit correspondre � votre charte graphique.",
"<strong>Attention:</strong> veuillez indiquer l'adresse de votre �tablissement.",
"<strong>Adresse :</strong>",
"<strong>Attention:</strong> veuillez indiquer le t�l�phone de votre �tablissement.",
"<strong>T�l :</strong>",
"<strong>Fax :</strong>",
"<strong>Site web :</strong>",
"<strong>Email :</strong>",
"Indiquez ici le type de votre �tablissement",
"Suivant >>",
"La base de donn�es va �tre param�tr�e en fonction du type de votre �tablissement.<br/>Veuillez indiquer les centres constitutifs (ie : coll�ge et lyc�e) qui composent votre �tablissement.",
"<strong>Type �tablissement :</strong>",
"Pour terminer l'installation cliquez ici",
"Envoyer",
"Erreur cr�ation %1 (%2)",
"<strong>Personnalisation de l'intranet</strong>",
"choisissez une configuration :",
"<strong>Th�me :</strong>",
"appliquer aux menus",
"<strong>Puces graphiques :</strong>",
"<strong>Fond graphique :</strong>",
"appliquer � la page",
"<strong>Barre des Titres :</strong>",
"<strong>Couleur du bandeau :</strong>",
"<strong>Adresse :</strong>",
"<strong>Logos :</strong>",
"<a href=\"%1\">logo principal</a>",
"Gauche",
"Centr�",
"Droite",
"<strong>Titre de fen�tre :</strong>",
"<strong>Message d'accueil :</strong>",
"Connexion :",
"aide",
"modification du lien",
"nouveau lien",
"insertion",
"modification",
"<strong>Gestionnaire de menus</strong><br/><em>Veuillez compl�ter le formulaire suivant pour param�trer le lien</em>",
"<strong>Statut :</strong>",
"<strong>Auteur :</strong>",
"<strong>Liste :</strong>",
"<strong>Attention :</strong> l'intitul� doit �tre renseign�.",
"<strong>Intitul�</strong>",
"<strong>Attention :</strong> l'url doit �tre renseign�e.",
"<strong>URL</strong> (une adresse internet doit d�buter par http://)",
"<strong>Acc�s visible</strong>",
"<strong>Autorisations</strong>",
"Fermer le lien",
"Acc�s anonyme",
"ajouter un lien",
"pour revenir sur la page pr�c�dente.",
"- public :",
"- validit� :",
"<a href=\"%1\" onclick=\"window.open(this.href, '_blank'); return false;\">logo r�gion</a>",
"Langues autoris�es :",
"<strong>Image</strong>",
"ajouter un menu",
"modifier un menu",
"nouveau menu",
"<strong>Texte</strong>",
"<strong>Alignement</strong>",
"<strong>Affichage</strong>",
"fermer le menu",
"d�filement",
"Bienvenue sur la page %1.",
"<strong>Pictogramme</strong>",
"<strong>Contenu</strong>",
"<strong>. SMS</strong>",
"Service SMS :",
"<strong>Webmestre :</strong>",
"Installer",
"D�sinstaller",
"P2P",
"<strong>Clef :</strong>",
"Connexion",
"Obtenir une clef",
"<strong>Partage :</strong>",
"<strong>Maintenance :</strong>",
"Choisissez un centre :",
"<strong>Filtrage :</strong>",
"<strong>Filtrage des acc�s</strong>",
"du",
"au",
"aaaa-mm-jj",
"Encodage :",
"== personnalis� ==",
"Backoffice",
"trier les items",
"Activ�",
"D�sactiv�",
"<strong>Taille</strong>",
"Ko",
"<strong>Serveur :</strong>",
"<strong>Configuration du P2P</strong>",
"<strong>Configuration des menus</strong>",
"<strong>Configuration des mot-clefs</strong>",
"Mot-clefs",
"<strong>Synchronisation :</strong>",
"lancer la synchronisation",
"Documents",
"Annuaire",
"<strong>Robot d'indexation :</strong>",
"<strong>Code postal + ville :</strong>",
"Fuseau horaire",
"Architecture",
"bits",
"[nouveau]",
"[r�pondre]",
"[valider]",
"[annuler]",
"<strong>Couleur bandeau menu haut :</strong>",
"Emploi du temps",
"Vacances",
"Configuration semaine paire/impaire",
"Configuration des vacances",
"Couleur",
"Semaine",
"au"
);
//---------------------------------------------------------------------------
?>