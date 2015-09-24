##############################################################################
#    Copyright (c) 2010 by Dominique Laporte (C-E-D@wanadoo.fr)              #
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
ALTER TABLE `ctn` ADD `_rss` ENUM( 'O', 'N' ) NOT NULL DEFAULT 'N' ;
ALTER TABLE `config` 
ADD `_cp` VARCHAR( 6 ) NOT NULL AFTER `_adresse` ,
ADD `_ville` VARCHAR( 20 ) NOT NULL AFTER `_cp` ;
ALTER TABLE `p2p_data` 
ADD `_zip` VARCHAR( 6 ) NOT NULL AFTER `_adresse` ,
ADD `_city` VARCHAR( 20 ) NOT NULL AFTER `_zip` ;
ALTER TABLE `p2p_data` ADD `_public` ENUM( 'O', 'N' ) NOT NULL DEFAULT 'N' ;
ALTER TABLE `reservation_data` CHANGE `_IDcentre` `_IDcentre` TEXT NOT NULL ;
ALTER TABLE `forum_data` CHANGE `_texte` `_texte` MEDIUMTEXT NOT NULL ;
ALTER TABLE `forum_items` DROP `_vus` ;
###############################################################################
# table des tuteurs
# ver 1.0
create table user_tutors (
	_index		int unsigned not null auto_increment,		# index
	_ID		int unsigned not null,				# ID de l'élève
	_IDtutor	int unsigned not null,				# ID du tuteur
	primary key (_index),
	unique key _key(_ID, _IDtutor)
	) TYPE = MyISAM COMMENT = "Table des tuteurs";
###############################################################################
# table des logs d'erreurs des imports
# ver 1.0
create table admin_log (
	_IDlog		int unsigned not null auto_increment,		# ID du log
	_IDimport	int unsigned not null,				# ID de l'import
	_text		mediumtext not null,				# diagnostic erreur
	primary key (_IDlog)
	) TYPE = MyISAM COMMENT = "Table des logs d'erreurs des imports";
###############################################################################
