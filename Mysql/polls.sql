##############################################################################
#    Copyright (c) 2002-2007 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# table des sondages
# ver 1.6
#
## ajout champ : _lang

create table sondage_data (
	_IDpoll		int unsigned not null auto_increment,		# ID du sondage
	_IDdata		int default '0' not null,			# sélecteur (0 : accueil, > 0 : e-groupe, < 0 : e-campus)
	_IDmod		int unsigned not null,				# ID du modérateur
	_IDgrpwr	int unsigned default '255' not null,		# qui peut voter : voir table groupe
	_IDgrprd	int unsigned default '255' not null,		# qui peut voir le sondage : voir table groupe
	_date		datetime not null,				# date et heure de création du sondage
	_close		datetime not null,				# date et heure de fermeture du sondage (0 si fermeture manuelle)
	_title		varchar(80) not null,				# question du sondage
	_single		enum('O', 'N') default 'O' not null,		# réponse unique (O : Oui, N : Non)
	_anonyme	enum('O', 'N') default 'O' not null,		# vote anonyme (O : Oui, N : Non)
	_result		enum('O', 'N') default 'N' not null,		# affichage du résultat en fin de sondage (O : Oui, N : Non)
	_visible	enum('O', 'N') default 'O' not null,		# sondage ouvert (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue du sondage
	primary key (_IDpoll)
	) ENGINE = MyISAM COMMENT = "Table des sondages";

###############################################################################
# table des questions associées au sondage
# ver 1.2
#
## renommage table : sondage_data -> sondage_items

create table sondage_items (
	_IDpoll		int unsigned not null,				# ID du sondage
	_IDq		int unsigned not null,				# n° de question du sondage
	_q		varchar(40) not null,				# question du sondage
	_r		int unsigned default '0' not null,		# le nbr de vote pour la question
	unique key _key(_IDpoll, _IDq)
	) ENGINE = MyISAM COMMENT = "Table des questions associées au sondage";

###############################################################################
# table des votes sur un sondage
# ver 1.2
#
## ajout champ _IP

create table sondage_vote (
	_IDpoll		int unsigned not null,				# ID du sondage
	_ID		int unsigned not null,				# ID de connexion
	_IP		bigint not null,				# station de connexion
	_date		datetime,					# date et heure du vote
	_vote		int unsigned not null,				# le vote
	unique key _key(_IDpoll, _ID)
	) ENGINE = MyISAM COMMENT = "Table des votes sur un sondage";

###############################################################################