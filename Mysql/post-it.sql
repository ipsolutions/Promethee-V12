##############################################################################
#    Copyright (c) 2002-2007 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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



# que l'on utilise
use `##DATABASE##`;


###############################################################################
# table de la gestion des post-it
# ver 1.0

create table postit (
	_IDcentre	int unsigned default '1' not null,		# ID du centre
	_IDgrpwr	int unsigned default '0' not null,		# ID des r�dacteurs (voir table groupe)
	_IDgrprd	int unsigned default '0' not null,		# ID des lecteurs (voir table groupe)
	_IDgrppj	int unsigned default '0' not null,		# ID pour autorisation des pi�ces jointes (voir table groupe)
	unique key _key(_IDcentre)
	) ENGINE = MyISAM COMMENT = "Table de la gestion des messages instantann�s";

###############################################################################
# table des r�pertoires des post-it
# ver 1.0

create table postit_data (
	_IDdata		int unsigned not null auto_increment,		# ID du r�pertoire
	_IDparent	int unsigned not null,				# ID du r�pertoire parent (0 si racine)
	_ID		int unsigned not null,				# ID du propri�taire du r�pertoire
	_IP		bigint default '0' not null,			# ID de l'IP (station du posteur)
	_date		datetime not null,				# date et heure de cr�ation
	_ident		varchar(40) not null,				# nom du r�pertoire
	primary key (_IDdata),
	unique key _key(_IDparent, _ident)
	) ENGINE = MyISAM  COMMENT = "Table des r�pertoires des post-it";

###############################################################################
# table de la messagerie instantann�e
# ver 1.5
#
## ajout champs : _IDdata, _type, _priority

create table postit_items (
	_IDpost		int unsigned not null auto_increment,		# ID du post-it
	_IDdata		int unsigned default '0' not null,		# ID du r�pertoire parent (0 si racine)
	_IDdst		int not null,					# ID du destinataire (< 0 pour liste de diffusion)
	_IDexp		int unsigned not null,				# ID de l'exp�diteur
	_IP		bigint default '0' not null,			# ID de l'IP (station de l'exp�diteur)
	_date		datetime not null,				# date et heure de l'exp�dition du message
	_type		int unsigned default '1' not null,		# type de message (voir table postit_type)
	_titre		varchar(80) not null,				# intitul� du message
	_texte		mediumtext not null,				# texte du message				
	_priority	int unsigned default '0' not null,		# niveau de priorit� du message (0 le plus faible)
	_sign		enum('O', 'N') default 'N' not null,		# message signe (O : Oui, N : Non)
	_vu		datetime,					# date et heure de r�ception du message
	_ack		datetime,					# date et heure de l'acquittement du message
	_deldst		enum('O', 'N') default 'N' not null,		# demande d'effa�age du message par le destinataire (O : Oui, N : Non)
	_delexp		enum('O', 'N') default 'N' not null,		# demande d'effa�age du message par l'exp�diteur (O : Oui, N : Non)
	_timer		datetime not null,				# timer d'affichage d'un message
	primary key (_IDpost)
	) ENGINE = MyISAM COMMENT = "Table des messages instantann�s";

###############################################################################
# table des types de message
# ver 1.0

create table postit_type (
	_IDtype		int unsigned default '1' not null,		# type de message (0 : syst�me, 1 : utilisateur, 2 : fiche t�l�phonique, ...)
	_ident		varchar(80) not null,				# intitul� du type de message
	_visible	enum('O', 'N') default 'O' not null,		# intitul� visible (O : Oui, N : Non)
	_lang		varchar(2) not null,				# langue utilis�e
	unique key _key(_ident, _lang)
	) ENGINE = MyISAM COMMENT = "Table des types de message";

###############################################################################
# table des Pi�ces Jointes de la messagerie instantann�e
# ver 1.1
#
# remarques : les PJ sont plac�es dans le r�pertoire download/post-it/<_IDpost>.<_ext>
#
## ajout champ _title

create table postit_pj (
	_IDpj		int unsigned not null auto_increment,		# ID de la PJ
	_IDpost		int unsigned not null,				# ID du post-it
	_title		varchar(80) not null,				# titre de la PJ
	_ext		varchar(5) not null,				# extension du fichier en PJ
	_size		int unsigned not null,				# taille du fichier
	_hit		datetime not null,				# date et heure du t�l�chargement de la PJ
	primary key (_IDpj)
	) ENGINE = MyISAM COMMENT = "Table des PJ de la messagerie instantann�e";

###############################################################################
# table de la gestion des quotas pour les postit
# ver 1.0

create table postit_quotas (
	_IDuser		int not null,					# ID de l'utilisateur (ou du groupe si < 0 : voir table user_group)
	_maxsize	bigint unsigned default '1024000' not null,	# espace disque autoris� (1 Mo par d�faut, 0 si illimit�)
	_size		bigint unsigned default '0' not null,		# espace disque occup�
	_delay		int unsigned default '0' not null,		# d�lais en semaines avant effacement des messages (0 : pas de d�lais)
	unique key _key(_IDuser)
	) ENGINE = MyISAM COMMENT = "Table de la gestion des quotas";

###############################################################################
# table des listes de diffusion de la messagerie instantann�e
# ver 1.2
#
## modification champ _public

create table postit_lidi (
	_IDlidi		int unsigned not null auto_increment,		# ID de la liste de diffusion
	_ID		int unsigned not null,				# ID connexion
	_nom		varchar(40) not null,				# nom de la liste de diffusion
	_AR		enum('O', 'N') default 'N' not null,		# lidi avec Accus� de R�ception (O : Oui, N : Non)
	_public		enum('O', 'N', 'M') default 'N' not null,		# lidi publique (O : Oui, N : Non, M : Membres)
	_email		enum('O', 'N') default 'N' not null,		# envoi sur email (O : Oui, N : Non)
	primary key (_IDlidi),
	unique key _key(_ID, _nom)
	) ENGINE = MyISAM COMMENT = "Table des listes de diffusion de la messagerie instantann�e";

###############################################################################
# table des destinataires des listes de diffusion de la messagerie instantann�e
# ver 1.0

create table postit_address (
	_IDlidi		int unsigned not null,				# ID de la liste de diffusion
	_ID		int unsigned not null,				# ID utilisateur
	unique key _key(_IDlidi, _ID)
	) ENGINE = MyISAM COMMENT = "Table des carnets d'adresses de la messagerie instantann�e";


###############################################################################