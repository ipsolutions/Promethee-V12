##############################################################################
#    Copyright (c) 2002-2005 by Dominique Laporte (C-E-D@wanadoo.fr)         #
#                                                                            #
#    This file is part of Prométhée.                                         #
#                                                                            #
#    Prométhée is free software: you can redistribute it and/or modify       #
#    it under the terms of the GNU General Public License as published by    #
#    the Free Software Foundation, either version 3 of the License, or       #
#    (at your option) any later version.                                     #
#                                                                            #
#    Prométhée is distributed in the hope that it will be useful,            #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of          #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           #
#    GNU General Public License for more details.                            #
#                                                                            #
#    You should have received a copy of the GNU General Public License       #
#    along with Prométhée.  If not, see <http://www.gnu.org/licenses/>.      #
##############################################################################


use `##DATABASE##`;

###############################################################################
# table des stages professionnels
# ver 1.2
#
## ajout champ _IDclasse

create table stage (
	_IDstage	int unsigned not null auto_increment,		# ID du stage
	_IDlieu		int unsigned not null, 				# ID lieu de stage choisi par l'élève
	_IDeleve	int unsigned not null,				# ID de l'élève
	_IDclasse	int unsigned not null,				# classe de l'élève au moment du stage
	_convention	int unsigned not null,				# n° de convention de stage
	_travaux	tinytext not null, 				# travaux réalisés sur le lieu de stage
	_problem	tinytext not null, 				# problématique envisagée (UNIQUEMENT POUR LES STAE)
	_commstage  	tinytext not null, 				# commentaires du maitre de stage sur le stagiaire
	_commeleve  	tinytext not null, 				# commentaires de l'élève sur son stage
	primary key _key(_IDstage)
	) ENGINE = MyISAM COMMENT = "Table des stages professionnels";

###############################################################################
# table des droits d'accès aux modules des stages professionnels
# ver 1.2
#
## ajout champ _rss

create table stage_data (
	_mod		varchar(10) not null,				# ID du module des stages
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_rss		enum('O', 'N') default 'N' not null,		# alimenter le flus rss (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# menu publiable (O : Oui, N : Non)
	primary key (_mod)
	) ENGINE = MyISAM COMMENT = "Table droits d'accès aux modules des stages professionnels";

###############################################################################
# table des périodes des stages professionnels
# ver 1.1

create table stage_periode (
	_IDperiode	int unsigned not null auto_increment,		# ID période de stage
	_IDstage	int unsigned not null,				# ID du stage
	_nbstage	int unsigned default '1' not null,		# indice de la période pendant le stage
	_debut 		varchar(10) not null,				# date de début de stage
	_fin	 	varchar(10) not null,				# date de fin de stage
	_ID		int unsigned default '0' not null,		# ID prof (0 si non attribué)
	_mode       	enum ('T', 'D') default 'D' not null,		# mode de "visite" (T : Téléphone, D : Déplacement)
	_commlieu   	tinytext not null,				# commentaires du professeur sur le lieu et le maître de stage
	primary key (_IDperiode)
	) ENGINE = MyISAM COMMENT = "Table des périodes de stages professionnels";

###############################################################################
# table des stages professionnels adaptés aux filières
# ver 1.0

create table stage_ok (
	_IDlieu		int unsigned not null ,				# ID lieu de stage
	_IDclasse	int unsigned not null,				# ID classe à laquelle le stage est le plus adapté
	unique key _key(_IDlieu, _IDclasse)
	) ENGINE = MyISAM COMMENT = "Table des filières adaptées aux stages professionnels";

###############################################################################
# table des maîtres de stage
# ver 1.5
#
# remarque : les fichiers images du secteur et des pictogrammes sont placés dans le répertoire images/stage/<_secteur>.gif
#
## modification index unique (ajout ville)

create table stage_lieu (
	_IDlieu		int unsigned not null auto_increment,		# ID lieu de stage
	_date		datetime,					# date et heure de saisie
	_secteur	int unsigned default '1' not null,		# secteur d'activité (voir table stage_secteur)
	_societe	varchar(60) not null, 				# nom de l'entreprise
	_statut		varchar(20) not null,				# statut juridique de l'entreprise (GAEC, EARL...)
	_activite	varchar(80) not null,				# activité principale de l'entreprise (ex: bovin lait, accueil personnes agées, photographe, etc...)
	_text		mediumtext not null,				# description de l'entreprise
	_adresse	varchar(40) not null, 				# adresse de l'entreprise
	_cp 		varchar(5) not null, 				# code postal de l'entreprise
	_ville 		varchar(40) not null, 				# ville de l'entreprise
	_tel		varchar(20) not null, 				# téléphone de l'entreprise
	_fax		varchar(20) not null,				# fax de l'entreprise
	_email		varchar(40) not null, 				# email de l'entreprise
	_web		varchar(40) not null, 				# site web de l'entreprise
	_directeur	varchar(40) not null, 				# directeur de l'entreprise
	_resp		varchar(40) not null,				# responsable du stagiaire dans l'entreprise
	_taille		int unsigned default '0' not null,		# taille de l'entrepise (en nombre d'employés)
	_periode	varchar(80) not null,				# périodes de travail ou de surcharge de travail 
	_mineur		enum('O', 'N') default 'O' not null,		# stagiaire mineur accepté : Oui ou Non
	_fille		enum('O', 'N') default 'O' not null,		# stagiaire fille accepté : Oui ou Non
	_loge		enum('O', 'N') default 'N' not null,		# stagiaire logé : Oui ou Non
	_remark1	varchar(80) not null,				# remarque concernant le logement
	_nourri		enum('O', 'N') default 'N' not null,		# stagiaire nourri : Oui ou Non
	_remark2	varchar(80) not null,				# remarque concernant la nourriture
	_comment	mediumtext not null,				# commentaires
	##### CHAMPS SPECIFIQUES AUX EXPLOITATIONS AGRICOLES : _secteur = A #####
	_uth		int unsigned default '0' not null,		# Unité Temps Horaire
	_st		int unsigned default '0' not null,		# Surface Totale
	_sau		int unsigned default '0' not null,		# Surface Agricole Utile
	_sfp		int unsigned default '0' not null,		# Surface Fourragère Principale
	_tl		int unsigned default '0' not null,		# Surface Terre Labourable
	_extra		varchar(40) not null,				# responsabilités extra-professionelles de l'exploitant
	_tva		enum('O', 'N') default 'N' not null,		# exploitant assujetti à la TVA : Oui ou Non
	_compta		enum('O', 'N') default 'N' not null,		# exploitant capable de fournir la comptabilité de gestion des 2 dernières années au minimum : Oui ou Non
	_sol		enum('O', 'N') default 'N' not null,		# travail du sol réalisé sur les surf agricoles : Oui ou Non
	##### CHAMPS SPECIFIQUES AUX AUTRES SECTEURS D'ACTIVITE #####
	_actif		enum('O', 'N') default 'N' not null,		# participe à toutes les activités
	_accueil	enum('O', 'N') default 'N' not null,		# activité d'accueil
	_anim		enum('O', 'N') default 'N' not null,		# activité d'animation
	_resto		enum('O', 'N') default 'N' not null,		# activité de service restauration
	_autre		enum('O', 'N') default 'N' not null,		# autres services
	_negocier	enum('O', 'N') default 'N' not null,		# activités à négocier avant de commencer le stage
	##########
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste)
	primary key (_IDlieu),
	unique key _key(_societe, _secteur, _ville)
	) ENGINE = MyISAM COMMENT = "Table des maitres de stages professionnels";

###############################################################################
# table des secteurs d'activités
# ver 1.2
#
## modification clef unique

create table stage_secteur (
	_IDsecteur	int unsigned not null auto_increment,		# ID du secteur de production
	_IDblock	int unsigned not null,				# ID bloc langue
	_ident		varchar(20) not null,				# intitulé du secteur
	_infos		enum('O', 'N') default 'N' not null,		# informations complémentaires (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# secteur visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDsecteur),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des secteurs d'activités des stages professionnels";

###############################################################################
# table des productions animales
# ver 1.0

create table prod_pa (
	_IDpa		int unsigned not null auto_increment,		# ID de production animale
	_IDlieu		int unsigned not null,				# ID lieu de stage
	_IDcat		int unsigned not null,				# ID de la catégorie de production
	_IDrace		int unsigned not null,				# ID de la race élevée
	_upra		enum('O', 'N') default 'N' not null,		# troupeau enregistré à l'UPRa : Oui ou Non
	_control	enum('O', 'N') default 'N' not null,		# contrôle des performances : Oui ou Non
	_quality	enum('O', 'N') default 'N' not null,		# vente de produits sous signe de qualité : Oui ou Non
	_devenir	enum('L', 'C', 'E'),				# débouché UNIQUEMENT POUR LES EQUINS (L : Loisir, C : Compétition, E : Elevage)
	_taille		int unsigned default '0' not null,		# taille du cheptel
	primary key (_IDpa)
	) ENGINE = MyISAM COMMENT = "Table des types de productions animales";

###############################################################################
# table des productions végétales
# ver 1.0

create table prod_pv (
	_IDpv		int unsigned not null auto_increment,		# ID de production végétale
	_IDlieu		int unsigned not null,				# ID lieu de stage
	_IDcat		int unsigned not null,				# ID de la catégorie de production
	_devenir	enum('A', 'V') not null,			# devenir de la production (A : Autoconsommé, V : Vendu)
	_taille		int unsigned default '0' not null,		# surfaces destinées a la production
	primary key (_IDpv)
	) ENGINE = MyISAM COMMENT = "Table des types de productions végétales";

###############################################################################
# table des ateliers complémentaires
# ver 1.0

create table prod_atcomp (
	_IDatcomp	int unsigned not null auto_increment,		# ID de l'atelier complémentaire
	_IDlieu		int unsigned not null,				# ID lieu de stage
	_IDcat		int unsigned not null,				# ID de la catégorie de production
	_taille		int unsigned default '0' not null,		# taille de l'atelier
	primary key (_IDatcomp)
	) ENGINE = MyISAM COMMENT = "Table des ateliers complémentaires";

###############################################################################
# table des catégories de productions
# ver 1.2
#
## modification clef unique

create table prod_categorie (
	_IDcat		int unsigned not null,				# ID de la catégorie de production
	_type		enum ('A', 'V', 'C') not null,			# type de production(A : animale, V : Végétale, C : complémentaire)
	_text		varchar(30) not null,				# identification de la catégorie de production
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDcat, _lang),
	unique key _key(_type, _text, _lang)
	) ENGINE = MyISAM COMMENT = "Table des catégories de productions";

###############################################################################
# table des races de productions
# ver 1.3
#
## suppression clef unique

create table prod_race (
	_IDrace		int unsigned not null auto_increment,		# ID de la race
	_IDcat		int unsigned not null,				# ID de la catégorie de production
	_race		varchar(20) not null, 				# race élevée
	primary key (_IDrace)
	) ENGINE = MyISAM COMMENT = "Table des types de race de productions";

###############################################################################
# table des CV
# ver 1.0

create table cv (
	_IDcv		int unsigned not null auto_increment,		# ID du CV
	_IDuser		int unsigned not null,				# ID de l'utilisateur (voir table user_id)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de création du CV
	_titre		varchar(80) not null,				# intitulé du CV
	_texte		mediumtext not null,				# description du poste recherché
	_dispo		varchar(80) not null,				# dates de disponibilité
	_salaire	varchar(80) not null,				# salaire souhaité
	_IDposte	int unsigned not null,				# ID du type de poste (voir table cv_poste)
	_IDlevel	int unsigned not null,				# niveau de qualification (voir table cv_level)
	_IDcontrat	int unsigned not null,				# ID du type de contrat (voir table cv_contrat)
	_IDregion	int unsigned not null,				# ID de la région (voir table cv_region)
	_lieu		varchar(80) not null,				# lieu du travail
	_divers		mediumtext not null,				# le divers du CV
	_vus		int unsigned default '0' not null,		# nbr de lecture du CV
	_visible	enum('O', 'N') default 'O' not null,		# CV publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDcv),
	unique key (_IDuser, _lang)
	) ENGINE = MyISAM COMMENT = "Table des CV";

###############################################################################
# table de l'expérience professionnelle
# ver 1.0

create table cv_exp (
	_IDexp		int unsigned not null auto_increment,		# ID de l'expérience professionnelle
	_IDcv		int unsigned not null,				# ID du CV
	_IDposte	int unsigned not null,				# ID de la catégorie du poste (voir table cv_poste)
	_ident		tinytext not null,				# société, lieu
	_text		mediumtext not null,				# description de l'emploi (poste, tâches)
	_start		date not null, 					# début de l'emploi
	_end		date not null, 					# fin de l'emploi (vide si toujours en poste)
	primary key (_IDexp)
	) ENGINE = MyISAM COMMENT = "Table des expériences professionnelles";

###############################################################################
# table des diplômes
# ver 1.0

create table cv_form (
	_IDdegree	int unsigned not null auto_increment,		# ID de la catégorie de diplômes
	_IDcv		int unsigned not null,				# ID du CV
	_year		int unsigned not null,				# année d'obtention
	_IDlevel	int unsigned not null,				# niveau de qualification (voir table cv_degree)
	_text		mediumtext not null,				# description diplôme
	primary key (_IDdegree)
	) ENGINE = MyISAM  COMMENT = "Table des diplômes";

###############################################################################
# table des langues
# ver 1.0

create table cv_lang (
	_IDlang		int unsigned not null auto_increment,		# ID des langues connues
	_IDcv		int unsigned not null,				# ID du CV
	_IDtype		int unsigned not null,				# ID de la langue
	_IDlevel	int unsigned not null,				# ID du niveau de maîtrise
	primary key (_IDlang)
	) ENGINE = MyISAM  COMMENT = "Table des langues connues";

###############################################################################
# table des catégories de diplômes
# ver 1.0

create table cv_degree (
	_IDdegree	int unsigned not null auto_increment,		# ID de la catégorie de diplômes
	_ident		varchar(40) not null,				# description diplôme
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDdegree),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des catégories de diplômes";

###############################################################################
# table des pays
# ver 1.0

create table cv_country (
	_IDcountry	int unsigned not null auto_increment,		# ID des pays
	_ident		varchar(40) not null,				# intitulé pays
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDcountry),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des pays";

###############################################################################
# table des catégories de qualifications
# ver 1.0

create table cv_level (
	_IDlevel	int unsigned not null auto_increment,		# ID de la catégorie de qualifications
	_ident		varchar(40) not null,				# intitulé des qualifications
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDlevel),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des catégories de qualifications";

###############################################################################
# table des langues
# ver 1.0

create table cv_langtype (
	_IDtype		int unsigned not null auto_increment,		# ID de la langue
	_ident		varchar(40) not null,				# intitulé de la langue
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDtype),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des langues";

###############################################################################
# table de la maîtrise des langues
# ver 1.0

create table cv_langlevel (
	_IDlevel	int unsigned not null auto_increment,		# ID de la langue
	_ident		varchar(40) not null,				# intitulé de la maîtrise
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDlevel),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table de la maîtrise des langues";

###############################################################################
# table des offres d'emploi
# ver 1.0

create table cv_offre (
	_IDoffre	int unsigned not null auto_increment,		# ID de l'offre d'emploi
	_IDuser		int unsigned not null,				# ID de l'utilisateur (voir table user_id)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de création du CV
	_IDsociete	int unsigned not null,				# ID de la societé (voir table stage_lieu)
	_titre		varchar(80) not null,				# intitulé de l'offre
	_texte		mediumtext not null,				# description de l'offre
	_dispo		varchar(80) not null,				# dates de disponibilité
	_salaire	varchar(80) not null,				# salaire souhaité
	_IDposte	int unsigned not null,				# ID du type de poste (voir table cv_poste)
	_IDlevel	int unsigned not null,				# niveau de qualification (voir table cv_level)
	_IDcontrat	int unsigned not null,				# ID du type de contrat (voir table cv_contrat)
	_IDregion	int unsigned not null,				# ID de la région (voir table cv_region)
	_lieu		varchar(80) not null,				# lieu du travail
	_IDdegree	int unsigned not null,				# ID de la catégorie de diplômes (voir table cv_degree)
	_IDlangtype	int unsigned not null,				# ID de la langue (voir table cv_langtype)
	_IDlanglvl	int unsigned not null,				# niveau de maitrise de la langue (voir table cv_langlevel)
	_vus		int unsigned default '0' not null,		# nbr de lecture de l'offre
	_visible	enum('O', 'N') default 'O' not null,		# offre publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDoffre)
	) ENGINE = MyISAM COMMENT = "Table des offres d'emploi";

###############################################################################
# table des recruteurs
# ver 1.0

create table cv_user (
	_IDsociete	int unsigned not null,				# ID de l'entreprise (voir table stage_lieu)
	_IDuser		int unsigned not null,				# ID de l'utilisateur (voir table user_id)
	unique key (_IDsociete, _IDuser)
	) ENGINE = MyISAM  COMMENT = "Table des recruteurs";

###############################################################################
# table des catégories de postes
# ver 1.0

create table cv_poste (
	_IDposte	int unsigned not null auto_increment,		# ID de la catégorie du poste
	_ident		varchar(40) not null,				# intitulé des catégories
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDposte, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des catégories de postes";

###############################################################################
# table des catégories de contrats
# ver 1.0

create table cv_contrat (
	_IDcontrat	int unsigned not null auto_increment,		# ID de la catégorie du contrat
	_ident		varchar(40) not null,				# intitulé des contrats
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDcontrat),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des catégories de contrats";

###############################################################################
# table des régions
# ver 1.0

create table cv_region (
	_IDregion	int unsigned not null auto_increment,		# ID de la région
	_ident		varchar(40) not null,				# intitulé des régions
	_lang		varchar(2) not null,				# langue utilisée
	primary key (_IDregion, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des régions";

###############################################################################
# table des CV et des offres vus
# ver 1.0

create table cv_vu (
	_IDitem		bigint not null,				# ID de l'item : CV (> 0) ou offre (< 0)
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de lecture
	unique key _key(_IDitem, _ID)
	) ENGINE = MyISAM COMMENT = "Table de log des CV ou des offres lus";

###############################################################################