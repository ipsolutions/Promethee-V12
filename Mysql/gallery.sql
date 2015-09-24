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
# table des thèmes des galeries
# ver 1.4
#
## ajout champ _autoval

create table gallery (
	_IDgal		int unsigned not null,				# ID du thème de la galerie
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_date		datetime,					# date et heure de création du thème
	_title		varchar(40) not null,				# intitulé du thème
	_texte		tinytext not null,				# description du thème
	_sort		int unsigned default '0' not null,		# tri des dosiers et des galeries
	_autoval	enum('O', 'N') default 'O' not null,		# validation automatique à la création (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# thème publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue du thème
	primary key (_IDgal, _lang),
	unique key _key(_title, _lang)
	) ENGINE = MyISAM COMMENT = "Table des thèmes des photothèques";

###############################################################################
# table des répertoires des galeries
# ver 1.2
#
## rajout champs _IP et _date

create table gallery_root (
	_IDroot		int unsigned not null auto_increment,		# ID du répertoire
	_IDparent	int unsigned not null,				# ID du répertoire parent (0 si racine)
	_IDgal		int unsigned not null,				# ID du thème
	_IDgroup	int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_titre		varchar(40) not null,				# nom du répertoire
	_IDmod		int unsigned not null,				# ID du propriétaire du répertoire
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_date		datetime,					# date et heure de création du répertoire
	_private	enum('O', 'N') default 'N' not null,		# répertoire privé (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# répertoire accessible (O : Oui, N : Non)
	primary key (_IDroot),
	unique key _key(_IDparent, _IDgal, _IDgroup, _titre)
	) ENGINE = MyISAM  COMMENT = "Table des répertoires des galeries";

###############################################################################
# table des galeries d'images pour un thème
# ver 2.1
#
## modification clef unique

create table gallery_data (
	_IDdata		int unsigned not null auto_increment,		# ID de la galerie
	_IDgal		int unsigned not null,				# ID du thème associé
	_IDroot		int unsigned default '0' not null,		# ID du répertoire
	_IDgroup	int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_date		datetime,					# date et heure de création de la galerie
	_title		varchar(40) not null,				# intitulé de la galerie
	_texte		tinytext not null,				# description de la galerie
	_wiki		enum('O', 'N') default 'O' not null,		# galerie avec wiki (O : Oui, N : Non)
	_file		enum('O', 'N') default 'O' not null,		# afficher le nom des fichiers (O : Oui, N : Non)
	_private	enum('O', 'N') default 'N' not null,		# galerie privée (O : Oui, N : Non)
	_PJ		enum('O', 'N') default 'N' not null,		# autorise les Pièces Jointes (O : Oui, N : Non)
	_imgwidth	int unsigned default '0' not null,		# largeur max des images (non défini si 0)
	_visible	enum('O', 'N') default 'O' not null,		# galerie publiable (O : Oui, N : Non)
	primary key (_IDdata),
	unique key _key(_IDgal, _IDroot, _IDgroup, _title)
	) ENGINE = MyISAM COMMENT = "Table des photothèques";

###############################################################################
# table des images d'une galerie
# ver 1.2
#
# remarques : les images sont placées dans le répertoire download/galerie/<_IDdata>

create table gallery_items (
	_IDitem		int unsigned not null auto_increment,		# ID de l'image
	_IDdata		int unsigned not null,				# ID de la galerie associée
	_ID		int unsigned not null,				# ID de l'auteur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de l'enregistrement de l'image
	_file		varchar(80) not null,				# nom du fichier image
	_size		int unsigned not null,				# taille du fichier image
	_width		int unsigned not null,				# largeur de l'image
	_height		int unsigned not null,				# hauteur de l'image
	_hit		int unsigned not null,				# compteur de visualisation de l'image
	_titre		varchar(40) not null,				# titre de l'image
	_texte		tinytext not null,				# description de l'image				
	_visible	enum('O', 'N') default 'O' not null,		# réservation validée (O : Oui, N : Non)
	primary key (_IDitem),
	unique key _key(_IDdata, _file)
	) ENGINE = MyISAM COMMENT = "Table des images des photothèques";

###############################################################################
# table des Pièces Jointes des galeries
# ver 1.0
#
# remarques : les PJ sont placées dans le répertoire download/galerie/<_IDdata>

create table gallery_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDdata		int unsigned not null,				# ID de la galerie associée
	_file		varchar(40) not null,				# nom du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ des galeries";

###############################################################################