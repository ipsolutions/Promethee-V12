##############################################################################
#    Copyright (c) 2002-2004 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des répertoires des forums
# ver 1.2
#
## ajout champs _i18n et _maximize

create table forum (
	_IDroot		int unsigned not null auto_increment,		# ID du répertoire des forums
	_IDgroup	int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur du répertoire)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_date		datetime not null,				# date et heure de création du forum
	_title		varchar(40) not null,				# intitulé du répertoire
	_texte		tinytext not null,				# description du répertoire
	_i18n		enum('O', 'N') default 'N' not null,		# répertoire multilingue (O : Oui, N : Non)
	_maximize	enum('O', 'N') default 'N' not null,		# répertoire déployé (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# répertoire ouvert (O : Oui, N : Non)
	primary key (_IDroot),
	unique key _key(_IDroot, _IDgroup, _title)
	) ENGINE = MyISAM COMMENT = "Table des répertoires des forums";

###############################################################################
# table des forums
# ver 3.2
#
# remarque : les forums pédagogiques sont disponibles s'ils ont été préalablement créés par l'administrateur
#            les forums sont accessibles en écriture ou en lecture selon les champs _IDgrpwr et _IDgrprd
#            les forums privés sont accessibles sur invitation du modérateur
#
## modification champ _texte : tinytext -> mediumtext

create table forum_data (
	_IDforum	int unsigned not null auto_increment,		# ID de forum
	_IDroot		int unsigned default '0' not null,		# ID du répertoire du forum (0 : répertoire racine)
	_IDgroup	int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur du forum)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_date		datetime not null,				# date et heure de création du forum
	_access		datetime not null,				# date et heure du dernier message posté dans le forum
	_title		varchar(40) not null,				# intitulé du forum
	_texte		mediumtext not null,				# description du forum
	_visible	enum('O', 'N') default 'O' not null,		# forum ouvert (O : Oui, N : Non)
	_PJ		int unsigned default '0' not null,		# nombre de Pièces Jointes autorisées
	_update		enum('O', 'N') default 'N' not null,		# autoriser la modification des posts (O : Oui, N : Non)
	_erase		enum('O', 'N') default 'N' not null,		# autoriser la suppression des posts (O : Oui, N : Non)
	_private	enum('O', 'N') default 'N' not null,		# forum privé (O : Oui, N : Non)
	_email		enum('-', 'P', 'E') default '-' not null,	# email du posteur (- : aucun, P : Post-it, E : Email)
	_showmode	enum('F', 'E') default 'F' not null,		# mode d'affichage (F : FAQ, E : egroup)
	_autoval	enum('O', 'N') default 'N' not null,		# validation automatique des messages (O : Oui, N : Non)
	_chrono		enum('O', 'N', 'P') default 'N' not null,	# ordre chronologique des messages (O : Oui, N : Non, P : dernier post)
	_mailcp		enum('O', 'N') default 'N' not null,		# envoi des messages par email (O : Oui, N : Non)
	_rss		enum('O', 'N') default 'N' not null,		# utilisation d'un flux rss (O : Oui, N : Non)
	_maximize	enum('O', 'N') default 'N' not null,		# items déployés (O : Oui, N : Non)
	_image		varchar(40) not null,				# url pour hébergement d'images
	_lang		varchar(2) not null,				# langue du forum
	primary key (_IDforum),
	unique key _key(_IDgroup, _title, _lang)
	) ENGINE = MyISAM COMMENT = "Table des forums";

###############################################################################
# table des messages des forums
# ver 2.0
#
## suppression champ _vu

create table forum_items (
	_IDmsg		int unsigned not null auto_increment,		# ID du message
	_IDforum	int unsigned not null,				# ID de forum
	_ID		int unsigned not null,				# ID de connexion (posteur du message)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date de création du message
	_update		datetime not null,				# date de modification du message
	_access		datetime not null,				# date et heure du dernier message posté dans le fil de discussion
	_thread		int unsigned default '0' not null,		# ID du fil de discussion
	_parent		int unsigned default '0' not null,		# ID de l'article parent
	_title		varchar(80) not null,				# titre du message
	_IDsmile	int unsigned default '1' not null,		# ID du smiley du titre du message
	_texte		mediumtext not null,				# texte du message
	_post		int unsigned default '0' not null,		# nbr de réponse au message
	_type		enum('M', 'P') default 'M' not null,		# M : Message ou P : Post-it
	_sign		enum('O', 'N') default 'O' not null,		# signature jointe (O : Oui, N : Non)
	_censor		enum('O', 'N') default 'N' not null,		# message censuré (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# message publiable (O : Oui, N : Non)
	primary key (_IDmsg)
	) ENGINE = MyISAM COMMENT = "Table des messages des forums";

###############################################################################
# table des messages lus dans les forums
# ver 1.1

create table forum_vu (
	_IDmsg		int unsigned not null auto_increment,		# ID du message
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de lecture
	unique key _key(_IDmsg, _ID)
	) ENGINE = MyISAM COMMENT = "Table de log des messages lus";

###############################################################################
# table des Pièces Jointes des forums
# ver 1.0
#
# remarques : les PJ sont placées dans le répertoire download/forum/<_IDmsg>.<_ext>

create table forum_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDmsg		int unsigned not null,				# ID du message
	_title		varchar(80) not null,				# titre de la PJ
	_ext		varchar(5) not null,				# extension du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ des forums";

###############################################################################
# table des messages à envoyé par email
# ver 1.0

create table forum_list (
	_IDforum	int unsigned not null,				# ID de forum
	_ID		int unsigned not null,				# ID de connexion
	_visible	enum('O', 'N') default 'N' not null,		# ID en liste brûlée (O : Oui, N : Non)
	unique key _key(_IDforum, _ID)
	) ENGINE = MyISAM COMMENT = "Table des messages à envoyé par email";

###############################################################################