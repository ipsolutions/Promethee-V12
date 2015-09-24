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
 *		module   : stats.php
 *		projet   : d�finition des messages
 *
 *		version  : 1.0
 *		auteur   : laporte
 *		creation : 03/04/2007
 *		modif    : 
 *
 */

//---------------------------------------------------------------------------
static	$message = Array(

"<strong>Statistiques</strong>",
"<strong>statistiques d'utilisation</strong>",
"1er visiteur :",
"Dernier visiteur :",
"Nbr de visiteurs :",
"%1 | hier : %2",
"Pages vues :",
"Nbr de pages / visiteur :",
"<strong>pages visit�es</strong>",
"<strong>Page</strong>",
"<strong>Visites</strong>",
"<strong>statistiques diverses</strong>",
"Utilisateurs enregistr�s :",
"Super utilisateurs :",
"Auteurs/mod�rateurs :",
"Comptes ferm�s :",
"Ressources publi�es :",
"Messages post�s :",
"Messages en attente :",
"Flash infos post�s :",
"Prom�th�e version :",
"PHP version :",
"Base de donn�es version :",
"statistiques utilisateurs messages",
"statistiques utilisateurs ressources",
"<strong>Listes des publications</strong>",
"<strong>centre : </strong>",
"<strong>inscrit le :</strong>",
"<strong>articles :</strong>",
"Donn�es sur %1 jours",
"Donn�es journali�res",
"date, service, groupe, utilisateur, IP",
"<strong>Historique des installations</strong>",
"Le tableau ci-dessous indique l'�tat des diff�rentes installations et mises � jour de la plate-forme.",
"<strong>Version</strong>",
"<strong>date</strong>",
"<strong>tables</strong>",
"<strong>erreurs</strong>",
"aujourd'hui",
"export CSV",
"<strong>Cat�gorie :</strong>",
"<strong>Version :</strong>",
"%1 octets",
"<strong>Licence :</strong>",
"Nombre de tables :",
"page pr�c�dente",
"
forbidden.php : acc�s refus�,
user_login.htm : demande d'identification,
user_new.htm : cr�ation de compte,
user_account.htm : acc�s au compte utilisateur,
user_acl.htm : gestion des ACL,
user_show.htm : liste des _STUDENT,
user_skin.htm : Personnalisation de l'intranet,
user_visu.htm: Liste des utilisateurs,
page_gestion.htm : Personnalisation de l'intranet,
page_submenu.htm : gestion des sous menus,
forum_charte.htm : charte des forums,
forum_post.htm : envoi d'un post dans un forum,
forum_show.htm : visualisation du message d'un forum,
forum_visu.htm : liste des messages dans un forum,
forum.htm : liste des forums,
postit_post.htm : cr�ation d'un nouveau post-it,
postit_visu.htm : visualisation des post-it,
postit.htm : Affichage des Post-it,
gallery_theme : cr�ation d'un nouveau th�me d�une phototh�que,
gallery_new.htm : cr�ation d'une nouvelle galerie,
gallery_visu.htm : visualisation des vignettes de la galerie,
gallery_show.htm : visualisation des images de la galerie,
gallery_upload.htm : upload d'images dans une galerie,
gallery_search.htm : recherche dans les galeries,
gallery.htm : affichage des galeries,
spip_visu.htm : visualisation des articles de publication en ligne,
spip_post.htm : cr�ation d'un nouvel article,
spip_new.htm : cr�ation d'une nouvelle publication en ligne,
spip_add.htm : cr�ation d'une d�p�che,
spip_addlink.htm : ajout d'un lien sur une d�p�che,
spip_search.htm : recherche dans les publications en ligne,
spip.htm : Lecture des publications en ligne,
stats_dba.htm : liste des bases de donn�es install�es,
stats_items.htm : liste des articles par auteurs,
stats.htm : Statistiques g�n�rales,
agenda_new.htm : cr�ation d'une nouvel agenda,
agenda_post.htm : enregistrement d'une annonce dans un agenda,
agenda_search.htm : recherche dans les agendas,
agenda.htm : affichage des Agendas,
campus_class.htm : Liste des _CLASSs,
agenda_visu.htm : Acc�s au campus virtuel,
reservation_post.htm : demande de r�servation,
reservation.htm : affichage des R�servations,
email_new.htm : ajouter un contact,
email_lidi.htm : annuaire,
email_address.htm : carnet d'adresse,
email.htm : Messagerie externe,
liaison.htm : Cahier de liaison,
ctn.htm : Cahier de texte num�rique,
chat.htm : Tchache en direct,
fil.htm : FIL infos,
pfolio.htm : e-portfolio,
egroup.htm : e-groupe,
motd_post.htm : envoi message du jour,
motd_visu.htm : visualisation message du jour,
motd.htm : liste des messages envoy�,
flash_post.htm : saisie des flash-infos,
flash_gestion.htm : gestion des flash-infos,
flash_visu.htm : affichage du flash-info,
flash_promethee.htm : flash-info Prom�th�e,
config_dba.htm : gestion de la base de donn�es,
config_skin.htm : gestion des rev�tements,
config_menu.htm : gestion des menus,
config_submenu.htm : gestion des sous menus,
config.htm : Configuration intranet,
resource_upload.htm : Transfert de ressources,
resource_online.htm : Ressources en ligne,
resource.htm : affichage des Ressources,
resource_ftp.htm : Ressources ftp,
wiki.htm : Wiki,
cursus.htm : Cursus,
weblog.htm : Weblog,
chs.htm : CHS,
stage_search.htm : recherche d'un stage,
stage_link.htm : fiche de liaison,
stage_visit.htm : visites de stage,
etp.htm : Espace Num�rique,
quizz.htm : Acc�s au quizz,
exam_gestion.htm : gestion des r�sultats aux examens,
exam_new.htm : saisie des r�sultats aux examens,
exam_visu.htm : visualisation des r�sultats aux examens,
absent_show.htm : Absences individuelles,
absent_visu.htm : Absences des groupes,
edt.htm : Emplois du temps,
carnet_visu.htm : affichage du carnet � points des _STUDENT,
carnet.htm : affichage du Carnet � points,
retenu_visu.htm : affichage du d�tail des consignes des _STUDENT,
retenu.htm : affichage des Consignes,
page_search.htm : moteur de recherche,
vote_gestion.htm : gestion des sondages,
vote.htm : affichage des sondages
"

);
//---------------------------------------------------------------------------
?>