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
# création de la dba des thèmes des galeries d'images
###############################################################################
insert into gallery values('1', '0', '254', '254', '2002-09-01', 'Vie scolaire', 'Ce thème est destiné à visualiser les photos prises lors des PAE, PUS ou d\'autres projets pédagogiques.', '0', 'O', 'O', 'fr');
insert into gallery values('2', '0', '254', '254', '2002-09-01', 'Pédagogie', 'Ce thème présente les photos servant de support aux différents cours pédagogiques.', '0', 'O', 'O', 'fr');
insert into gallery values('3', '0', '254', '254', '2002-09-01', 'e-groupe', 'Ce thème présente les photos des groupes virtuels.', '0', 'O', 'O', 'fr');
###############################################################################