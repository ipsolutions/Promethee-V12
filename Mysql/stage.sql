##############################################################################
#    Copyright (c) 2002-2005 by Dominique Laporte (C-E-D@wanadoo.fr)         #
#                                                                            #
#    This file is part of Prom�th�e.                                         #
#                                                                            #
#    Prom�th�e is free software: you can redistribute it and/or modify       #
#    it under the terms of the GNU General Public License as published by    #
#    the Free Software Foundation, either version 3 of the License, or       #
#    (at your option) any later version.                                     #
#                                                                            #
#    Prom�th�e is distributed in the hope that it will be useful,            #
#    but WITHOUT ANY WARRANTY; without even the implied warranty of          #
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           #
#    GNU General Public License for more details.                            #
#                                                                            #
#    You should have received a copy of the GNU General Public License       #
#    along with Prom�th�e.  If not, see <http://www.gnu.org/licenses/>.      #
##############################################################################


use `##DATABASE##`;

###############################################################################
# table des stages professionnels
# ver 1.2
#
## ajout champ _IDclasse

create table stage (
	_IDstage	int unsigned not null auto_increment,		# ID du stage
	_IDlieu		int unsigned not null, 				# ID lieu de stage choisi par l'�l�ve
	_IDeleve	int unsigned not null,				# ID de l'�l�ve
	_IDclasse	int unsigned not null,				# classe de l'�l�ve au moment du stage
	_convention	int unsigned not null,				# n� de convention de stage
	_travaux	tinytext not null, 				# travaux r�alis�s sur le lieu de stage
	_problem	tinytext not null, 				# probl�matique envisag�e (UNIQUEMENT POUR LES STAE)
	_commstage  	tinytext not null, 				# commentaires du maitre de stage sur le stagiaire
	_commeleve  	tinytext not null, 				# commentaires de l'�l�ve sur son stage
	primary key _key(_IDstage)
	) ENGINE = MyISAM COMMENT = "Table des stages professionnels";

###############################################################################
# table des droits d'acc�s aux modules des stages professionnels
# ver 1.2
#
## ajout champ _rss

create table stage_data (
	_mod		varchar(10) not null,				# ID du module des stages
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_rss		enum('O', 'N') default 'N' not null,		# alimenter le flus rss (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# menu publiable (O : Oui, N : Non)
	primary key (_mod)
	) ENGINE = MyISAM COMMENT = "Table droits d'acc�s aux modules des stages professionnels";

###############################################################################
# table des p�riodes des stages professionnels
# ver 1.1

create table stage_periode (
	_IDperiode	int unsigned not null auto_increment,		# ID p�riode de stage
	_IDstage	int unsigned not null,				# ID du stage
	_nbstage	int unsigned default '1' not null,		# indice de la p�riode pendant le stage
	_debut 		varchar(10) not null,				# date de d�but de stage
	_fin	 	varchar(10) not null,				# date de fin de stage
	_ID		int unsigned default '0' not null,		# ID prof (0 si non attribu�)
	_mode       	enum ('T', 'D') default 'D' not null,		# mode de "visite" (T : T�l�phone, D : D�placement)
	_commlieu   	tinytext not null,				# commentaires du professeur sur le lieu et le ma�tre de stage
	primary key (_IDperiode)
	) ENGINE = MyISAM COMMENT = "Table des p�riodes de stages professionnels";

###############################################################################
# table des stages professionnels adapt�s aux fili�res
# ver 1.0

create table stage_ok (
	_IDlieu		int unsigned not null ,				# ID lieu de stage
	_IDclasse	int unsigned not null,				# ID classe � laquelle le stage est le plus adapt�
	unique key _key(_IDlieu, _IDclasse)
	) ENGINE = MyISAM COMMENT = "Table des fili�res adapt�es aux stages professionnels";

###############################################################################
# table des ma�tres de stage
# ver 1.5
#
# remarque : les fichiers images du secteur et des pictogrammes sont plac�s dans le r�pertoire images/stage/<_secteur>.gif
#
## modification index unique (ajout ville)

create table stage_lieu (
	_IDlieu		int unsigned not null auto_increment,		# ID lieu de stage
	_date		datetime,					# date et heure de saisie
	_secteur	int unsigned default '1' not null,		# secteur d'activit� (voir table stage_secteur)
	_societe	varchar(60) not null, 				# nom de l'entreprise
	_statut		varchar(20) not null,				# statut juridique de l'entreprise (GAEC, EARL...)
	_activite	varchar(80) not null,				# activit� principale de l'entreprise (ex: bovin lait, accueil personnes ag�es, photographe, etc...)
	_text		mediumtext not null,				# description de l'entreprise
	_adresse	varchar(40) not null, 				# adresse de l'entreprise
	_cp 		varchar(5) not null, 				# code postal de l'entreprise
	_ville 		varchar(40) not null, 				# ville de l'entreprise
	_tel		varchar(20) not null, 				# t�l�phone de l'entreprise
	_fax		varchar(20) not null,				# fax de l'entreprise
	_email		varchar(40) not null, 				# email de l'entreprise
	_web		varchar(40) not null, 				# site web de l'entreprise
	_directeur	varchar(40) not null, 				# directeur de l'entreprise
	_resp		varchar(40) not null,				# responsable du stagiaire dans l'entreprise
	_taille		int unsigned default '0' not null,		# taille de l'entrepise (en nombre d'employ�s)
	_periode	varchar(80) not null,				# p�riodes de travail ou de surcharge de travail 
	_mineur		enum('O', 'N') default 'O' not null,		# stagiaire mineur accept� : Oui ou Non
	_fille		enum('O', 'N') default 'O' not null,		# stagiaire fille accept� : Oui ou Non
	_loge		enum('O', 'N') default 'N' not null,		# stagiaire log� : Oui ou Non
	_remark1	varchar(80) not null,				# remarque concernant le logement
	_nourri		enum('O', 'N') default 'N' not null,		# stagiaire nourri : Oui ou Non
	_remark2	varchar(80) not null,				# remarque concernant la nourriture
	_comment	mediumtext not null,				# commentaires
	##### CHAMPS SPECIFIQUES AUX EXPLOITATIONS AGRICOLES : _secteur = A #####
	_uth		int unsigned default '0' not null,		# Unit� Temps Horaire
	_st		int unsigned default '0' not null,		# Surface Totale
	_sau		int unsigned default '0' not null,		# Surface Agricole Utile
	_sfp		int unsigned default '0' not null,		# Surface Fourrag�re Principale
	_tl		int unsigned default '0' not null,		# Surface Terre Labourable
	_extra		varchar(40) not null,				# responsabilit�s extra-professionelles de l'exploitant
	_tva		enum('O', 'N') default 'N' not null,		# exploitant assujetti � la TVA : Oui ou Non
	_compta		enum('O', 'N') default 'N' not null,		# exploitant capable de fournir la comptabilit� de gestion des 2 derni�res ann�es au minimum : Oui ou Non
	_sol		enum('O', 'N') default 'N' not null,		# travail du sol r�alis� sur les surf agricoles : Oui ou Non
	##### CHAMPS SPECIFIQUES AUX AUTRES SECTEURS D'ACTIVITE #####
	_actif		enum('O', 'N') default 'N' not null,		# participe � toutes les activit�s
	_accueil	enum('O', 'N') default 'N' not null,		# activit� d'accueil
	_anim		enum('O', 'N') default 'N' not null,		# activit� d'animation
	_resto		enum('O', 'N') default 'N' not null,		# activit� de service restauration
	_autre		enum('O', 'N') default 'N' not null,		# autres services
	_negocier	enum('O', 'N') default 'N' not null,		# activit�s � n�gocier avant de commencer le stage
	##########
	_visible	enum('O', 'N') default 'O' not null,		# Oui ou Non (visible dans la liste)
	primary key (_IDlieu),
	unique key _key(_societe, _secteur, _ville)
	) ENGINE = MyISAM COMMENT = "Table des maitres de stages professionnels";

###############################################################################
# table des secteurs d'activit�s
# ver 1.2
#
## modification clef unique

create table stage_secteur (
	_IDsecteur	int unsigned not null auto_increment,		# ID du secteur de production
	_IDblock	int unsigned not null,				# ID bloc langue
	_ident		varchar(20) not null,				# intitul� du secteur
	_infos		enum('O', 'N') default 'N' not null,		# informations compl�mentaires (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# secteur visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDsecteur),
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des secteurs d'activit�s des stages professionnels";

###############################################################################
# table des productions animales
# ver 1.0

create table prod_pa (
	_IDpa		int unsigned not null auto_increment,		# ID de production animale
	_IDlieu		int unsigned not null,				# ID lieu de stage
	_IDcat		int unsigned not null,				# ID de la cat�gorie de production
	_IDrace		int unsigned not null,				# ID de la race �lev�e
	_upra		enum('O', 'N') default 'N' not null,		# troupeau enregistr� � l'UPRa : Oui ou Non
	_control	enum('O', 'N') default 'N' not null,		# contr�le des performances : Oui ou Non
	_quality	enum('O', 'N') default 'N' not null,		# vente de produits sous signe de qualit� : Oui ou Non
	_devenir	enum('L', 'C', 'E'),				# d�bouch� UNIQUEMENT POUR LES EQUINS (L : Loisir, C : Comp�tition, E : Elevage)
	_taille		int unsigned default '0' not null,		# taille du cheptel
	primary key (_IDpa)
	) ENGINE = MyISAM COMMENT = "Table des types de productions animales";

###############################################################################
# table des productions v�g�tales
# ver 1.0

create table prod_pv (
	_IDpv		int unsigned not null auto_increment,		# ID de production v�g�tale
	_IDlieu		int unsigned not null,				# ID lieu de stage
	_IDcat		int unsigned not null,				# ID de la cat�gorie de production
	_devenir	enum('A', 'V') not null,			# devenir de la production (A : Autoconsomm�, V : Vendu)
	_taille		int unsigned default '0' not null,		# surfaces destin�es a la production
	primary key (_IDpv)
	) ENGINE = MyISAM COMMENT = "Table des types de productions v�g�tales";

###############################################################################
# table des ateliers compl�mentaires
# ver 1.0

create table prod_atcomp (
	_IDatcomp	int unsigned not null auto_increment,		# ID de l'atelier compl�mentaire
	_IDlieu		int unsigned not null,				# ID lieu de stage
	_IDcat		int unsigned not null,				# ID de la cat�gorie de production
	_taille		int unsigned default '0' not null,		# taille de l'atelier
	primary key (_IDatcomp)
	) ENGINE = MyISAM COMMENT = "Table des ateliers compl�mentaires";

###############################################################################
# table des cat�gories de productions
# ver 1.2
#
## modification clef unique

create table prod_categorie (
	_IDcat		int unsigned not null,				# ID de la cat�gorie de production
	_type		enum ('A', 'V', 'C') not null,			# type de production(A : animale, V : V�g�tale, C : compl�mentaire)
	_text		varchar(30) not null,				# identification de la cat�gorie de production
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDcat, _lang),
	unique key _key(_type, _text, _lang)
	) ENGINE = MyISAM COMMENT = "Table des cat�gories de productions";

###############################################################################
# table des races de productions
# ver 1.3
#
## suppression clef unique

create table prod_race (
	_IDrace		int unsigned not null auto_increment,		# ID de la race
	_IDcat		int unsigned not null,				# ID de la cat�gorie de production
	_race		varchar(20) not null, 				# race �lev�e
	primary key (_IDrace)
	) ENGINE = MyISAM COMMENT = "Table des types de race de productions";

###############################################################################
# table des CV
# ver 1.0

create table cv (
	_IDcv		int unsigned not null auto_increment,		# ID du CV
	_IDuser		int unsigned not null,				# ID de l'utilisateur (voir table user_id)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de cr�ation du CV
	_titre		varchar(80) not null,				# intitul� du CV
	_texte		mediumtext not null,				# description du poste recherch�
	_dispo		varchar(80) not null,				# dates de disponibilit�
	_salaire	varchar(80) not null,				# salaire souhait�
	_IDposte	int unsigned not null,				# ID du type de poste (voir table cv_poste)
	_IDlevel	int unsigned not null,				# niveau de qualification (voir table cv_level)
	_IDcontrat	int unsigned not null,				# ID du type de contrat (voir table cv_contrat)
	_IDregion	int unsigned not null,				# ID de la r�gion (voir table cv_region)
	_lieu		varchar(80) not null,				# lieu du travail
	_divers		mediumtext not null,				# le divers du CV
	_vus		int unsigned default '0' not null,		# nbr de lecture du CV
	_visible	enum('O', 'N') default 'O' not null,		# CV publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDcv),
	unique key (_IDuser, _lang)
	) ENGINE = MyISAM COMMENT = "Table des CV";

###############################################################################
# table de l'exp�rience professionnelle
# ver 1.0

create table cv_exp (
	_IDexp		int unsigned not null auto_increment,		# ID de l'exp�rience professionnelle
	_IDcv		int unsigned not null,				# ID du CV
	_IDposte	int unsigned not null,				# ID de la cat�gorie du poste (voir table cv_poste)
	_ident		tinytext not null,				# soci�t�, lieu
	_text		mediumtext not null,				# description de l'emploi (poste, t�ches)
	_start		date not null, 					# d�but de l'emploi
	_end		date not null, 					# fin de l'emploi (vide si toujours en poste)
	primary key (_IDexp)
	) ENGINE = MyISAM COMMENT = "Table des exp�riences professionnelles";

###############################################################################
# table des dipl�mes
# ver 1.0

create table cv_form (
	_IDdegree	int unsigned not null auto_increment,		# ID de la cat�gorie de dipl�mes
	_IDcv		int unsigned not null,				# ID du CV
	_year		int unsigned not null,				# ann�e d'obtention
	_IDlevel	int unsigned not null,				# niveau de qualification (voir table cv_degree)
	_text		mediumtext not null,				# description dipl�me
	primary key (_IDdegree)
	) ENGINE = MyISAM  COMMENT = "Table des dipl�mes";

###############################################################################
# table des langues
# ver 1.0

create table cv_lang (
	_IDlang		int unsigned not null auto_increment,		# ID des langues connues
	_IDcv		int unsigned not null,				# ID du CV
	_IDtype		int unsigned not null,				# ID de la langue
	_IDlevel	int unsigned not null,				# ID du niveau de ma�trise
	primary key (_IDlang)
	) ENGINE = MyISAM  COMMENT = "Table des langues connues";

###############################################################################
# table des cat�gories de dipl�mes
# ver 1.0

create table cv_degree (
	_IDdegree	int unsigned not null auto_increment,		# ID de la cat�gorie de dipl�mes
	_ident		varchar(40) not null,				# description dipl�me
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDdegree),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des cat�gories de dipl�mes";

###############################################################################
# table des pays
# ver 1.0

create table cv_country (
	_IDcountry	int unsigned not null auto_increment,		# ID des pays
	_ident		varchar(40) not null,				# intitul� pays
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDcountry),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des pays";

###############################################################################
# table des cat�gories de qualifications
# ver 1.0

create table cv_level (
	_IDlevel	int unsigned not null auto_increment,		# ID de la cat�gorie de qualifications
	_ident		varchar(40) not null,				# intitul� des qualifications
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDlevel),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des cat�gories de qualifications";

###############################################################################
# table des langues
# ver 1.0

create table cv_langtype (
	_IDtype		int unsigned not null auto_increment,		# ID de la langue
	_ident		varchar(40) not null,				# intitul� de la langue
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDtype),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des langues";

###############################################################################
# table de la ma�trise des langues
# ver 1.0

create table cv_langlevel (
	_IDlevel	int unsigned not null auto_increment,		# ID de la langue
	_ident		varchar(40) not null,				# intitul� de la ma�trise
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDlevel),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table de la ma�trise des langues";

###############################################################################
# table des offres d'emploi
# ver 1.0

create table cv_offre (
	_IDoffre	int unsigned not null auto_increment,		# ID de l'offre d'emploi
	_IDuser		int unsigned not null,				# ID de l'utilisateur (voir table user_id)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de cr�ation du CV
	_IDsociete	int unsigned not null,				# ID de la societ� (voir table stage_lieu)
	_titre		varchar(80) not null,				# intitul� de l'offre
	_texte		mediumtext not null,				# description de l'offre
	_dispo		varchar(80) not null,				# dates de disponibilit�
	_salaire	varchar(80) not null,				# salaire souhait�
	_IDposte	int unsigned not null,				# ID du type de poste (voir table cv_poste)
	_IDlevel	int unsigned not null,				# niveau de qualification (voir table cv_level)
	_IDcontrat	int unsigned not null,				# ID du type de contrat (voir table cv_contrat)
	_IDregion	int unsigned not null,				# ID de la r�gion (voir table cv_region)
	_lieu		varchar(80) not null,				# lieu du travail
	_IDdegree	int unsigned not null,				# ID de la cat�gorie de dipl�mes (voir table cv_degree)
	_IDlangtype	int unsigned not null,				# ID de la langue (voir table cv_langtype)
	_IDlanglvl	int unsigned not null,				# niveau de maitrise de la langue (voir table cv_langlevel)
	_vus		int unsigned default '0' not null,		# nbr de lecture de l'offre
	_visible	enum('O', 'N') default 'O' not null,		# offre publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
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
# table des cat�gories de postes
# ver 1.0

create table cv_poste (
	_IDposte	int unsigned not null auto_increment,		# ID de la cat�gorie du poste
	_ident		varchar(40) not null,				# intitul� des cat�gories
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDposte, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des cat�gories de postes";

###############################################################################
# table des cat�gories de contrats
# ver 1.0

create table cv_contrat (
	_IDcontrat	int unsigned not null auto_increment,		# ID de la cat�gorie du contrat
	_ident		varchar(40) not null,				# intitul� des contrats
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDcontrat),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des cat�gories de contrats";

###############################################################################
# table des r�gions
# ver 1.0

create table cv_region (
	_IDregion	int unsigned not null auto_increment,		# ID de la r�gion
	_ident		varchar(40) not null,				# intitul� des r�gions
	_lang		varchar(2) not null,				# langue utilis�e
	primary key (_IDregion, _lang),
	unique key (_ident, _lang)
	) ENGINE = MyISAM  COMMENT = "Table des r�gions";

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