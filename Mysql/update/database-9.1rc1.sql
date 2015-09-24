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
ALTER TABLE `flash` CHANGE `_chrono` `_chrono` ENUM( 'O', 'N', 'S' ) NOT NULL DEFAULT 'O' ;
ALTER TABLE `flash_items` ADD `_order` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `_img` ;
ALTER TABLE `flash` 
ADD `_autoval` ENUM( 'O', 'N' ) NOT NULL DEFAULT 'O' AFTER `_visible` ,
ADD `_poster` ENUM( 'O', 'N' ) NOT NULL DEFAULT 'O' AFTER `_autoval` ;
ALTER TABLE `wiki_page` ADD `_lang` VARCHAR( 2 ) default 'fr' NOT NULL AFTER `_visible` ;
###############################################################################
update `flash_items` set _order = _IDitem ;
###############################################################################

