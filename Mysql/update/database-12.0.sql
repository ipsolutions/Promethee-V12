##############################################################################
#    Copyright (c) 2010 by IP-Solutions (contact@ip-solutions.fr)            #
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
ALTER TABLE `config` ADD `_bandeau` INT( 2 ) NOT NULL DEFAULT '0' ;
###############################################################################
ALTER TABLE `campus_data` ADD `_color` INT( 10 ) NOT NULL DEFAULT '0' ;
###############################################################################
ALTER TABLE `edt_data` ADD `_nosemaine` INT( 10 ) NOT NULL DEFAULT '0' ;
ALTER TABLE `edt_data` ADD `_etat` INT( 10 ) NULL DEFAULT '0' ;
ALTER TABLE `edt_data` ADD `_IDx` INT( 10 ) NULL DEFAULT '0' ;
ALTER TABLE `edt_data` ADD INDEX ( `_IDx` ) ;
ALTER TABLE `edt_data` CHANGE `_IDdata` `_IDdata` INT( 10 ) UNSIGNED NOT NULL ;
ALTER TABLE `edt_data` CHANGE `_IDx` `_IDx` INT( 10 ) NULL AUTO_INCREMENT ;
ALTER TABLE `edt_data` ADD INDEX ( `_IDx` ) ;
ALTER TABLE `edt_data` DROP INDEX `PRIMARY` ;
ALTER TABLE `edt_data` DROP INDEX `_IDx` , ADD PRIMARY KEY ( `_IDx` ) ;
ALTER TABLE `edt_data` DROP INDEX `_IDx_2` ;
ALTER TABLE `edt_data` ADD `_annee` INT( 10 ) NULL DEFAULT '0' ;
###############################################################################
ALTER TABLE `config_centre` ADD `_semaines` TEXT NOT NULL ;
ALTER TABLE `config_centre` ADD `_vacances` TEXT NOT NULL ;
###############################################################################
ALTER TABLE `ctn_items` ADD `_type` INT( 11 ) NOT NULL DEFAULT '0' ;
ALTER TABLE `ctn_items` ADD `_IDcours` INT( 11 ) NOT NULL DEFAULT '0' ;
ALTER TABLE `ctn_items` ADD `_nosemaine` INT( 11 ) NOT NULL DEFAULT '0' ;
###############################################################################
update config_centre set _semaines = '[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]' ;
update config_centre set _vacances = '{"start":[""],"end":[""]}';
###############################################################################


