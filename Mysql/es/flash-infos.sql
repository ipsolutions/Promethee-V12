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
# cr�ation de la dba des flash infos
###############################################################################
insert into flash values('', '0', '0', '0', '0', '255', '2002-09-01', 'N', 'Prom�th�e',      'C', '', 'promethee.htm', 'F', 'N', 'O', 'O', 'O', '0', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '1', '0', '255', '2002-09-01', 'N', 'Alumnos',        'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '0', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '2', '0', '255', '2002-09-01', 'N', 'instituto',      'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '2', '0', '255', '2002-09-01', 'N', 'colegio',        'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '2', '0', '255', '2002-09-01', 'N', 'IP, IPA',        'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '3', '0', '255', '2002-09-01', 'N', 'ATOSS',          'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '4', '0', '255', '2002-09-01', 'N', 'Administracion', 'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '5', '0', '255', '2002-09-01', 'N', 'Exploitacion',   'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '2', '0', '255', '2002-09-01', 'N', 'CDI',            'C', '', 'flash.htm',     'F', 'N', 'O', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '6', '0', '255', '2002-09-01', 'N', 'CFA',            'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '6', '0', '255', '2002-09-01', 'N', 'CFPPA',          'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '1', '0', '255', '2002-09-01', 'N', 'ASC',            'C', '', 'flash.htm',     'F', 'N', 'N', 'O', 'O', '1', 'O', 'O', 'N', 'es');
insert into flash values('', '0', '0', '4', '0', '255', '2002-09-01', 'N', 'Vida escolar',   'C', '', 'flash.htm',     'F', 'N', 'O', 'O', 'O', '0', 'N', 'O', 'N', 'es');
insert into flash values('', '0', '0', '4', '0', '255', '2002-09-01', 'N', 'Cantina',        'C', '', 'flash.htm',     'F', 'N', 'O', 'O', 'O', '0', 'N', 'O', 'N', 'es');
###############################################################################
# cr�ation de la dba du marquee
###############################################################################
insert into marquee values('', 'forum',   'Foros',                 '2', 'O', 'es');
insert into marquee values('', 'doc',     'Documentos repositorio','2', 'O', 'es');
insert into marquee values('', 'flash',   'Flash-info',            '2', 'O', 'es');
insert into marquee values('', 'fil',     'Noticias ',             '2', 'O', 'es');
insert into marquee values('', 'galerie', 'Galerias',              '2', 'O', 'es');
###############################################################################