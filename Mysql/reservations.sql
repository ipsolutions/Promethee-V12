##############################################################################
#    Copyright (c) 2002-2004 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des r�servations
# ver 1.7
#
## ajout champs _maximize

create table reservation (
	_IDres		int unsigned not null,				# ID du menu des r�servations
	_IDcentre	int unsigned default '1' not null,		# ID du centre de formation (voir table config_centre)
	_IDmod		int unsigned default '0' not null,		# ID de connexion (mod�rateur)
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_titre		varchar(30) not null,				# intitul� des r�servations (salles, v�hicules, ...)
	_texte		tinytext not null,				# remarques �ventuelles
	_email		enum('-', 'P', 'E') default '-' not null,	# email pour avertissement (- : aucun, P : Post-it, E : Email)
	_autoval	enum('O', 'N') default 'O' not null,		# validation automatique des demandes (O : Oui, N : Non)
	_weekly		enum('O', 'N') default 'O' not null,		# affichage (O : hebdo, N : mensuel)
	_IDweek		int unsigned default '0' not null,		# index des jours de la semaine (1 : Lundi, 2 : Mardi, ...)
	_horaire	tinytext not null,				# plages horaires (s�parateur ,)
	_maximize	enum('O', 'N') default 'N' not null,		# d�ployer la liste des r�servations (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# r�servation publiable (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue des r�servations
	primary key (_IDres, _IDcentre, _lang),
	unique key _key(_IDcentre, _titre, _lang)
	) ENGINE = MyISAM COMMENT = "Table du menu des r�servations";

###############################################################################
# table des articles de r�servations
# ver 1.1
#
## modification champ _IDcentre : int -> text

create table reservation_data (
	_IDdata		int unsigned not null auto_increment,		# ID de l'article des r�servations
	_IDcentre	text not null, 					# ID du centre de formation	
	_IDres		int unsigned not null,				# ID du menu des r�servations
	_titre		varchar(30) not null,				# intitul� des articles (r�tro, portable, ...)
	_texte		tinytext not null,				# fiche signal�tique des articles (places, garantie, ...)
	_ident		varchar(30) not null,				# lieu g�ographique de l'article
	_visible	enum('O', 'N') default 'O' not null,		# article publiable (O : Oui, N : Non)
	primary key (_IDdata)
	) ENGINE = MyISAM COMMENT = "Table des articles des r�servations";

###############################################################################
# table des p�riodes de r�servation
# ver 1.2
#
## ajout champ _note
## modification champ _comment : varchar(80) -> tinytext

create table reservation_items (
	_IDitem		int unsigned not null auto_increment,		# ID de la p�riode de r�servation
	_IDdata		int unsigned not null,				# ID de l'article des r�servations
	_parent		int unsigned default '0' not null,		# r�servation parent sur report
	_ID		int unsigned not null,				# ID de l'utilisateur
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime,					# date et heure de l'enregistrement de la r�servation
	_update		datetime,					# date et heure de modification de la r�servation
	_erase		datetime,					# date et heure de suppression de la r�servation
	_valid		datetime,					# date et heure de validation de la r�servation
	_priority	enum('H', 'B') default 'B' not null,		# priorit� de la r�servation (H : Haute, B : Basse)
	_start		datetime,					# date et heure de d�but de la r�servation
	_end		datetime,					# date et heure de fin de la r�servation
	_comment	tinytext not null,				# commentaires (motif r�servation, ...)
	_note		tinytext not null,				# notes sur acceptation/refus de la r�servation
	_visible	enum('O', 'N') default 'N' not null,		# r�servation valid�e (O : Oui, N : Non)
	primary key (_IDitem)
	) ENGINE = MyISAM COMMENT = "Table des dates de r�servation";

###############################################################################