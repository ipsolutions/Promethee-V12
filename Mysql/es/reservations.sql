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
# création de la dba des réservations
###############################################################################
insert into reservation values('1', '1', '0', '254', '254', 'Matérial pedagogico', 'el material no se puede tomar prestado por una persona de otro centro.',         '-', 'N', 'O', '255', '00:00,01:00,02:00,03:00,04:00,05:00,06:00,07:00,07:30,08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,19:00,20:00,21:00,22:00,23:00', 'N', 'O', 'es');
insert into reservation values('2', '1', '0', '254', '254', 'Salas', 'el personal de cada centro es prioritario para las salas de sus centros respectivos.',         '-', 'N', 'O', '255', '00:00,01:00,02:00,03:00,04:00,05:00,06:00,07:00,07:30,08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,19:00,20:00,21:00,22:00,23:00', 'N', 'O', 'es');
insert into reservation values('3', '1', '0', '254', '254', 'Vehiculos', 'el personal de cada centro es prioritario para los vehiculos de sus centros respectivos.', '-', 'N', 'O', '255', '00:00,01:00,02:00,03:00,04:00,05:00,06:00,07:00,07:30,08:00,08:30,09:00,09:30,10:00,10:30,11:00,11:30,12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,17:30,18:00,19:00,20:00,21:00,22:00,23:00', 'N', 'O', 'es');
###############################################################################