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
# table des agendas
# ver 1.6
#
## ajout champ _rss

create table agenda (
	_IDdata		int unsigned not null auto_increment,		# ID de l'agenda
	_IDgroup	int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_private	int unsigned default '0' not null,		# ID du propriétaire pour les agendas privés (0 si public)
	_date		datetime,					# date et heure de création de l'agenda
	_titre		varchar(40) not null,				# intitulé de l'agenda
	_texte		tinytext not null,				# description de l'agenda
	_visible	enum('O', 'N') default 'O' not null,		# agenda publiable (O : Oui, N : Non)
	_PJ		enum('O', 'N') default 'N' not null,		# autoriser les Pièces Jointes (O : Oui, N : Non)
	_update		enum('O', 'N') default 'N' not null,		# autoriser la modification des annonces (O : Oui, N : Non)
	_erase		enum('O', 'N') default 'N' not null,		# autoriser la suppression des annonces (O : Oui, N : Non)
	_default	enum('O', 'N') default 'N' not null,		# agenda par défaut (O : Oui, N : Non)
	_chrono		enum('O', 'N') default 'O' not null,		# ordre chronologique des annonces (O : Oui, N : Non)
	_rss		enum('O', 'N') default 'N' not null,		# utilisation d'un flux rss (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue de l'agenda
	primary key (_IDdata, _lang),
	unique key _key(_IDgroup, _titre, _lang)
	) ENGINE = MyISAM COMMENT = "Table des agendas";

###############################################################################
# table des annonces des agendas
# ver 1.2
#
## modification champ _texte : tinytext -> mediumtext

create table agenda_items (
	_IDitem		int unsigned not null auto_increment,		# ID de l'annonce
	_IDdata		int unsigned not null,				# ID de l'agenda
	_parent		int unsigned default '0' not null,		# annonce parent sur report
	_ID		int unsigned not null,				# ID de l'auteur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de l'enregistrement de l'annonce
	_update		datetime,					# date et heure de modification de l'annonce
	_erase		datetime,					# date et heure de suppression de l'annonce
	_priority	enum('H', 'B') default 'B' not null,		# priorité de l'annonce (H : Haute, B : Basse)
	_start		datetime,					# date et heure de début de l'annonce
	_end		datetime,					# date et heure de fin de l'annonce
	_titre		varchar(40) not null,				# intitulé de l'annonce
	_texte		mediumtext not null,				# texte de l'annonce				
	_hit		int unsigned not null,				# compteur de visualisation de l'annonce
	_calendar	enum('O', 'N') default 'N' not null,		# afficher dans le calendrier (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des annonces des agendas";

###############################################################################
# table des Pièces Jointes des agendas
# ver 1.0
#
# remarques : les PJ sont placées dans le répertoire download/agenda/<_IDpost>.<_ext>

create table agenda_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDitem		int unsigned not null,				# ID de l'annonce de l'agenda
	_texte		varchar(80) not null,				# description de la PJ
	_ext		varchar(5) not null,				# extension du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ des agendas";

###############################################################################
# table des annonces lues  dans les agendas
# ver 1.0

create table agenda_vu (
	_IDitem		int unsigned not null,				# ID de l'annonce
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# IP de la station
	_date		datetime not null,				# date et heure de 1ère lecture
	unique key _key(_IDitem, _ID)
	) ENGINE = MyISAM COMMENT = "Table des annonces lues des agendas";

###############################################################################
# table du paramétrage des agendas personnels
# ver 1.0

create table agenda_user (
	_IDdata		int unsigned not null,		# ID de l'agenda
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_default		int unsigned default '0' not null,		# agenda par défaut à l'affichage (0: aucun)
	_weekly		enum('O', 'N') default 'O' not null,		# affichage (O : hebdo, N : mensuel)
	_start		int unsigned default '7' not null,		# heure de début de l'agenda
	_end		int unsigned default '20' not null,		# heure de fin de l'agenda
	_delta		enum('0', '1', '2') default '0' not null,		# précision des hhoraires (0 : heure, 1 : 1/2 heure, 2 : 1/4 heure)
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table du paramétrage des agendas personnels";

###############################################################################