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
# table des réservations
# ver 1.7
#
## ajout champs _maximize

create table reservation (
	_IDres		int unsigned not null,				# ID du menu des réservations
	_IDcentre	int unsigned default '1' not null,		# ID du centre de formation (voir table config_centre)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (modérateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des rédacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_titre		varchar(30) not null,				# intitulé des réservations (salles, véhicules, ...)
	_texte		tinytext not null,				# remarques éventuelles
	_email		enum('-', 'P', 'E') default '-' not null,	# email pour avertissement (- : aucun, P : Post-it, E : Email)
	_autoval	enum('O', 'N') default 'O' not null,		# validation automatique des demandes (O : Oui, N : Non)
	_weekly		enum('O', 'N') default 'O' not null,		# affichage (O : hebdo, N : mensuel)
	_IDweek		int unsigned default '0' not null,		# index des jours de la semaine (1 : Lundi, 2 : Mardi, ...)
	_horaire	tinytext not null,				# plages horaires (séparateur ,)
	_maximize	enum('O', 'N') default 'N' not null,		# déployer la liste des réservations (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# réservation publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue des réservations
	primary key (_IDres, _IDcentre, _lang),
	unique key _key(_IDcentre, _titre, _lang)
	) ENGINE = MyISAM COMMENT = "Table du menu des réservations";

###############################################################################
# table des articles de réservations
# ver 1.1
#
## modification champ _IDcentre : int -> text

create table reservation_data (
	_IDdata		int unsigned not null auto_increment,		# ID de l'article des réservations
	_IDcentre	text not null, 					# ID du centre de formation	
	_IDres		int unsigned not null,				# ID du menu des réservations
	_titre		varchar(30) not null,				# intitulé des articles (rétro, portable, ...)
	_texte		tinytext not null,				# fiche signalétique des articles (places, garantie, ...)
	_ident		varchar(30) not null,				# lieu géographique de l'article
	_visible	enum('O', 'N') default 'O' not null,		# article publiable (O : Oui, N : Non)
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des articles des réservations";

###############################################################################
# table des périodes de réservation
# ver 1.2
#
## ajout champ _note
## modification champ _comment : varchar(80) -> tinytext

create table reservation_items (
	_IDitem		int unsigned not null auto_increment,		# ID de la période de réservation
	_IDdata		int unsigned not null,				# ID de l'article des réservations
	_parent		int unsigned default '0' not null,		# réservation parent sur report
	_ID		int unsigned not null,				# ID de l'utilisateur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de l'enregistrement de la réservation
	_update		datetime,					# date et heure de modification de la réservation
	_erase		datetime,					# date et heure de suppression de la réservation
	_valid		datetime,					# date et heure de validation de la réservation
	_priority	enum('H', 'B') default 'B' not null,		# priorité de la réservation (H : Haute, B : Basse)
	_start		datetime,					# date et heure de début de la réservation
	_end		datetime,					# date et heure de fin de la réservation
	_comment	tinytext not null,				# commentaires (motif réservation, ...)
	_note		tinytext not null,				# notes sur acceptation/refus de la réservation
	_visible	enum('O', 'N') default 'N' not null,		# réservation validée (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des dates de réservation";

###############################################################################