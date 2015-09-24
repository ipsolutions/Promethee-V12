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
# création de la dba des forums
###############################################################################
insert into forum_data values('', '0', '0', '0', '254', '254', '2002-09-01', '', 'Internal', 'This space is reserved to the personnel of the establishment. It is intended to receive your comments, remarks, reflexions, questions or even your small advertisements.', 'O', 'O', 'N', 'N', 'N', '-', 'F', 'N', 'N', 'N', 'N', 'N', 'http://www.imageshack.us/', 'en');
insert into forum_data values('', '0', '0', '0', '255', '255', '2002-09-01', '', '_STUDENT', 'This public space makes it possible to express you. It is intended to receive your comments, remarks, reflexions, questions or even your small advertisements.', 'O', 'N', 'N', 'N', 'N', '-', 'F', 'N', 'N', 'N', 'N', 'N', '', 'en');
###############################################################################