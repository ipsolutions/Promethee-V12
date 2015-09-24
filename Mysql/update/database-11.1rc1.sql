##############################################################################
#    Copyright (c) 2010 by Dominique Laporte (C-E-D@wanadoo.fr)              #
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
ALTER TABLE `notes_text` CHANGE `_text` `_text` MEDIUMTEXT NOT NULL ;
###############################################################################
delete from notes_type where _lang = 'fr' ;
###############################################################################
# cr�ation de la dba des notes
###############################################################################
insert into notes_type values('1', 'DS', 'Devoir Surveill�',      'fr');
insert into notes_type values('2', 'DM', 'Devoir Maison',         'fr');
insert into notes_type values('3', 'TP', 'Travail Pratique',      'fr');
insert into notes_type values('4', 'CC', 'Controle Connaisances', 'fr');
insert into notes_type values('5', 'CO', 'Compr�hension Orale',   'fr');
insert into notes_type values('6', 'EO', 'Expression Orale',      'fr');
insert into notes_type values('7', 'EE', 'Expression Ecrite',     'fr');
insert into notes_type values('8', 'CE', 'Compr�hension Ecrite',  'fr');
insert into notes_type values('9', 'TD', 'Travail dirig�',        'fr');
###############################################################################
ALTER TABLE `motd_items` CHANGE `_persistent` `_persistent` ENUM( '0', '1', '2' ) NOT NULL DEFAULT '0' ;
###############################################################################
