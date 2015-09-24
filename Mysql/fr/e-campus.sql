##############################################################################
#    Copyright (c) 2002-2003 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# cr�ation de la dba des campus virtuel
###############################################################################
insert into campus values('', 'mati�res', 'campus_data',   'O', 'fr');
insert into campus values('', 'classes',  'campus_classe', 'N', 'fr');
###############################################################################
# cr�ation de la dba du menu du campus virtuel
###############################################################################
insert into campus_menu values('','Documents',       'acc�der � des documents p�dagogiques',          'item=31',                        'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Forums',          'envoyer des messages dans un forum',            'item=3&cmde=visu',               'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Galeries',        'visualiser des galeries d\'images',             'item=5',                         'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Travail � rendre','d�poser des travaux ou des devoirs maison',     'item=9&cmde=work',               'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Exercices',       'effectuer des exercices en ligne',              'item=50',                        'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Cours',           't�l�charger des supports de cours',             'item=33',                        'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','R�f�rentiels',    't�l�charger les r�f�rentiels de formation',     'item=35&cmde=cursus',            'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Annonces',        'visualiser des annonces',                       'item=9&cmde=breve',              'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Agenda',          'consulter les agendas des cours et des examens','item=8',                         'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Sondages',        'r�pondre � des sondages',                       'item=99&cmde=visu',              'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','B2i-C2i',         'consulter votre carnet �lectronique du B2i-C2i','item=16&cmde=visu&ident=B2i-C2i','O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Liens',           'consulter des liens',                           'item=9&cmde=link',               'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','e-Portfolio',     'g�rer les comp�tences scolaires',               'item=16&cmde=visu',              'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Tchache',         'dialoguer en direct',                           'item=14&cmde=chat',              'O', '255', 'O', 'N', 'O', '0','fr');
insert into campus_menu values('','Cahier de texte', 'consulter le cahier de texte num�rique',        'item=13',                        'O', '255', 'O', 'N', 'O', '0','fr');
###############################################################################
# cr�ation de la dba des classes
###############################################################################
insert into campus_classe values('', '0','2','255', '1', '4�me agr',          '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', '3�me agr',          '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', '2GT',               '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BEPA CPA 1',        '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BEPA CPA 2',        '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BEPA EER 1',        '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '1', 'BEPA EER 2',        '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '1', 'BAC PRO CGEA 1',    '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BAC PRO CGEA 2',    '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BAC PRO EER 1',     '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '1', 'BAC PRO EER 2',     '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '1', 'BEPA service 1',    '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BEPA service 2',    '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BAC PRO SMR 1',     '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'BAC PRO SMR 2',     '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'STAV PA 1',         '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'STAV PA 2',         '', '0', '0', 'N', 'N', '', 'O');
insert into campus_classe values('', '0','2','255', '1', 'STAV SMR 1',        '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '1', 'STAV SMR 2',        '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '1', 'BTSA 1',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '1', 'BTSA 2',            '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '2', '2nde',              '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', '1�re L',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', '1�re S',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', 'Term L',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', 'Term S',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', 'Pr�pa 1',           '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', 'Pr�pa 2',           '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', 'BTS 1',             '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '2', 'BTS 2',             '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '3', '6�me',              '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '3', '5�me',              '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '3', '4�me',              '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '3', '3�me',              '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '4', 'BEP 1',             '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '4', 'BEP 2',             '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '4', 'BAC PRO 1',         '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '4', 'BAC PRO 2',         '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '5', 'CAP 1',             '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '5', 'CAP 2',             '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '6', 'stage',             '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '7', '',                  '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '8', 'DEUG 1',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '8', 'DEUG 2',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '8', 'Licence',           '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '8', 'Master 1',          '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '8', 'Master 2',          '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '8', 'Doctorat',          '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '9', 'DUT 1',             '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '9', 'DUT 2',             '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '9', 'Licence pro',       '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '10','DPCT',              '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '10','DEST',              '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '10','Licence',           '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '10','Master',            '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '10','cycle C',           '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '11','ann�e 1',           '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '11','ann�e 2',           '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '11','ann�e 3',           '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '12','stage',             '', '0', '0', 'N', 'N', '', 'N');

insert into campus_classe values('', '0','2','255', '13','CP',                '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '13','CE1',               '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '13','CE2',               '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '13','CM1',               '', '0', '0', 'N', 'N', '', 'N');
insert into campus_classe values('', '0','2','255', '13','CM2',               '', '0', '0', 'N', 'N', '', 'N');
###############################################################################
# cr�ation de la dba des mati�res du campus virtuel
###############################################################################
insert into campus_data values('1', '0','2','255','','Agronomie',      'Bienvenue sur la page d\'Agronomie.',                     '10','N','N','','O','fr','');
insert into campus_data values('2', '0','2','255','','Anglais',        'Bienvenue sur la page d\'Anglais.',                       '10','N','N','','O','fr','');
insert into campus_data values('3', '0','2','255','','Allemand',       'Bienvenue sur la page d\'Allemand.',                      '10','N','N','','O','fr','');
insert into campus_data values('4', '0','2','255','','Biologie',       'Bienvenue sur la page de Biologie.',                      '10','N','N','','O','fr','');
insert into campus_data values('5', '0','2','255','','Economie',       'Bienvenue sur la page d\'Economie.',                      '10','N','N','','O','fr','');
insert into campus_data values('6', '0','2','255','','EPS',            'Bienvenue sur la page d\'Education Physique et Sportive.','10','N','N','','O','fr','');
insert into campus_data values('7', '0','2','255','','ESC',            'Bienvenue sur la page d\'Education Socio-Culturelle.',    '10','N','N','','O','fr','');
insert into campus_data values('8', '0','2','255','','Fran�ais',       'Bienvenue sur la page de Fran�ais.',                      '10','N','N','','O','fr','');
insert into campus_data values('9', '0','2','255','','Hist-G�o',       'Bienvenue sur la page d\'Histoire et G�ographie.',        '10','N','N','','O','fr','');
insert into campus_data values('10','0','2','255','','Informatique',   'Bienvenue sur la page d\'Informatique.',                  '10','N','N','','O','fr','');
insert into campus_data values('11','0','2','255','','Italien',        'Bienvenue sur la page d\'Italien.',                       '10','N','N','','O','fr','');
insert into campus_data values('12','0','2','255','','Machinisme',     'Bienvenue sur la page de Machinisme.',                    '10','N','N','','O','fr','');
insert into campus_data values('13','0','2','255','','Maths',          'Bienvenue sur la page de Math�matiques.',                 '10','N','N','','O','fr','');
insert into campus_data values('14','0','2','255','','Philosophie',    'Bienvenue sur la page de Philosophie.',                   '10','N','N','','O','fr','');
insert into campus_data values('15','0','2','255','','Phytotechnie',   'Bienvenue sur la page de Phytotechnie.',                  '10','N','N','','O','fr','');
insert into campus_data values('16','0','2','255','','Sc. Physiques',  'Bienvenue sur la page de Sciences Physiques.',            '10','N','N','','O','fr','');
insert into campus_data values('17','0','2','255','','Zootechnie',     'Bienvenue sur la page de Zootechnie.',                    '10','N','N','','O','fr','');
insert into campus_data values('18','0','2','255','','Educ. civique',  'Bienvenue sur la page d\'Education civique.',             '10','N','N','','O','fr','');
insert into campus_data values('19','0','2','255','','Dessin',         'Bienvenue sur la page des Arts graphiques.',              '10','N','N','','O','fr','');
insert into campus_data values('20','0','2','255','','Musique',        'Bienvenue sur la page d\'Education musicale.',            '10','N','N','','O','fr','');
insert into campus_data values('21','0','2','255','','Arts plastiques','Bienvenue sur la page des Arts plastiques.',              '10','N','N','','O','fr','');
insert into campus_data values('22','0','2','255','','Espagnol',       'Bienvenue sur la page d\'Espagnol.',                      '10','N','N','','O','fr','');
###############################################################################
# cr�ation de la dba des liens du campus virtuel
###############################################################################
insert into campus_link values('','1', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','2', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','3', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','4', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','5', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','6', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','7', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','8', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','9', '0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','10','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.comp','','fr.png','0','fr');
insert into campus_link values('','10','0',  '0', 'Linux entre Amis',                 'http://lea-linux.org','L�a, site d\'aide Linux francophone.','fr.png','0','fr');
insert into campus_link values('','10','0',  '0', 'Comment �a marche ?',              'http://www.commentcamarche.net/','Encyclop�die informatique.','fr.png','0','fr');
insert into campus_link values('','11','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','12','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','13','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education.entraide.maths','','fr.png','0','fr');
insert into campus_link values('','14','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','15','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
insert into campus_link values('','16','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education.entraide.physique-chimie','','fr.png','0','fr');
insert into campus_link values('','17','0',  '0', 'newsgroup d\'entraide p�dagogique','http://groups.google.fr/groups?hl=fr&lr=&ie=UTF-8&group=fr.education','','fr.png','0','fr');
###############################################################################
# cr�ation de la dba des niveaux scolaire
###############################################################################
insert into campus_level values('1', 'Maternelle : PS',     'O','fr');
insert into campus_level values('2', 'Maternelle : MS',     'O','fr');
insert into campus_level values('3', 'Maternelle : GS',     'O','fr');
insert into campus_level values('4', 'Primaire : CP',       'O','fr');
insert into campus_level values('5', 'Primaire : CE1',      'O','fr');
insert into campus_level values('6', 'Primaire : CE2',      'O','fr');
insert into campus_level values('7', 'Primaire : CM1',      'O','fr');
insert into campus_level values('8', 'Primaire : CM2',      'O','fr');
insert into campus_level values('9', 'Secondaire : 6�me',   'O','fr');
insert into campus_level values('10','Secondaire : 5�me',   'O','fr');
insert into campus_level values('11','Secondaire : 4�me',   'O','fr');
insert into campus_level values('12','Secondaire : 3�me',   'O','fr');
insert into campus_level values('13','Secondaire : BEP',    'O','fr');
insert into campus_level values('14','Secondaire : Bac Pro','O','fr');
insert into campus_level values('15','Secondaire : 2GT',    'O','fr');
insert into campus_level values('16','Secondaire : 1�re',   'O','fr');
insert into campus_level values('17','Secondaire : Term',   'O','fr');
insert into campus_level values('18','Sup�rieur : BTS-DUT', 'O','fr');
insert into campus_level values('19','Sup�rieur : Licence', 'O','fr');
insert into campus_level values('20','Sup�rieur : Master',  'O','fr');
insert into campus_level values('21','Sup�rieur : Doctorat','O','fr');
###############################################################################
# cr�ation de la dba des des droits d'acc�s des utilisateurs pour les e-campus
###############################################################################
insert into campus_access values('-1', 'En attente','fr');
insert into campus_access values('0',  'Bannis',    'fr');
insert into campus_access values('1',  'Lecteur',   'fr');
insert into campus_access values('3',  'Membre',    'fr');
insert into campus_access values('7',  'Mod�rateur','fr');
###############################################################################
# cr�ation de la dba des cursus
###############################################################################
insert into cursus values('1', 'Formation Initiale',       '', 'O', 'fr');
insert into cursus values('2', 'Formation Continue',       '', 'N', 'fr');
insert into cursus values('3', 'Formation par Alternance', '', 'N', 'fr');
###############################################################################
