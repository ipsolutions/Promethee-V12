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
# cr�ation de la dba des th�mes des galeries d'images
###############################################################################
insert into gallery values('1', '0', '254', '254', '2002-09-01', 'Vie scolaire', 'Ce th�me est destin� � visualiser les photos prises lors des PAE, PUS ou d\'autres projets p�dagogiques.', '0', 'O', 'O', 'fr');
insert into gallery values('2', '0', '254', '254', '2002-09-01', 'P�dagogie', 'Ce th�me pr�sente les photos servant de support aux diff�rents cours p�dagogiques.', '0', 'O', 'O', 'fr');
insert into gallery values('3', '0', '254', '254', '2002-09-01', 'e-groupe', 'Ce th�me pr�sente les photos des groupes virtuels.', '0', 'O', 'O', 'fr');
###############################################################################