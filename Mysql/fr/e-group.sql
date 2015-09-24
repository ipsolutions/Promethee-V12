##############################################################################
#    Copyright (c) 2007 by Dominique Laporte (C-E-D@wanadoo.fr)              #
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
# création de la dba des types de e-groupes
###############################################################################
insert into egroup_items values('1','Expression culturelle','O', 'fr');
insert into egroup_items values('2','Groupes de travail','O','fr');
insert into egroup_items values('3','FOAD','O','fr');
###############################################################################
# création de la dba des e-groupes
###############################################################################
insert into egroup values('1', '1','0','0','0','255','2005-01-01','','Internet','','N','O','fr');
insert into egroup values('2', '1','0','0','0','255','2005-01-01','','Informatique','','N','O','fr');
insert into egroup values('3', '1','0','0','0','255','2005-01-01','','Culture & Art','','N','O','fr');
insert into egroup values('4', '1','0','0','0','255','2005-01-01','','Jeux','','N','O','fr');
insert into egroup values('5', '1','0','0','0','255','2005-01-01','','Hobbies & Bricolage','','N','O','fr');
insert into egroup values('6', '1','0','0','0','255','2005-01-01','','Musique','','N','O','fr');
insert into egroup values('7', '1','0','0','0','255','2005-01-01','','Sports','','N','O','fr');
insert into egroup values('8', '1','0','0','0','255','2005-01-01','','Education','','N','O','fr');
insert into egroup values('9', '1','0','0','0','255','2005-01-01','','Science','','N','O','fr');
insert into egroup values('10','2','0','0','0','255','2005-01-01','','Commissions internes','','N','O','fr');
insert into egroup values('11','2','0','0','0','255','2005-01-01','','Périscolaire','','N','O','fr');
insert into egroup values('12','3','0','0','0','255','2005-01-01','','Économie et gestion','','N','O','fr');
insert into egroup values('13','3','0','0','0','255','2005-01-01','','Travail et société','','N','O','fr');
insert into egroup values('14','3','0','0','0','255','2005-01-01','','Sciences et TIC','','N','O','fr');
insert into egroup values('15','3','0','0','0','255','2005-01-01','','Sciences et techniques industrielles','','N','O','fr');

insert into egroup values('','1','1','0','0','255','2005-01-01','','Réseaux','','N','O','fr');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Cyberculture','','N','O','fr');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Education','','N','O','fr');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Internet','','N','O','fr');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Projets','','N','O','fr');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Multimedia','','N','O','fr');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Logiciels','','N','O','fr');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Langages de programmation','','N','O','fr');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Sécurité','','N','O','fr');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Matériel','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Acteurs et Actrices','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Peinture','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Cinéma','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Arts culinaires','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Mythologie et Folklore','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Noms','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Radio','','N','O','fr');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Télévision','','N','O','fr');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Jeux de plateau','','N','O','fr');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Jeux de cartes','','N','O','fr');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Jeux vidéos','','N','O','fr');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Jeux par correspondance','','N','O','fr');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Jeux de rôles','','N','O','fr');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Wargames','','N','O','fr');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Collections','','N','O','fr');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Bricolage','','N','O','fr');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Hobbies','','N','O','fr');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Modélisme','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Blues','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Celtique','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Classique','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Country','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Electronic','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Expérimentale','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Jazz','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Reggae','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Rock and Pop','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Disco','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Funk','','N','O','fr');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Opéra','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Basketball','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Boxe','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Cyclisme','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Sports extrêmes','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Golf','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Gymnastique','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Handball','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Hockey','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Arts Martiaux','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Jeux Olympiques','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Rugby','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Ski','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Snowboarding','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Football (Européen)','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Tennis de table','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Tennis','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Triathlon','','N','O','fr');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Volleyball','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Biologie','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Chimie','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Sciences de la Terre','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Géographie','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Histoire','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Mathématiques','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Langues','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Physique','','N','O','fr');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Economie','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Astronomie','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Biologie','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Chimie','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Sciences de la Terre','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Ecologie','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Ingénierie','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Mathématiques','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Nanotechnologie','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Physique','','N','O','fr');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Exploration spatiale','','N','O','fr');
insert into egroup values('','2','10','0','0','255','2005-01-01','','CHSCT','','N','O','fr');
insert into egroup values('','2','10','0','0','255','2005-01-01','','Commission TIM','','N','O','fr');
insert into egroup values('','2','10','0','0','255','2005-01-01','','Suivi de Travaux','','N','O','fr');
insert into egroup values('','2','11','0','0','255','2005-01-01','','Association des élèves','','N','O','fr');
insert into egroup values('','2','11','0','0','255','2005-01-01','','Anciens élèves','','N','O','fr');
insert into egroup values('','2','11','0','0','255','2005-01-01','','Parents d\'élèves','','N','O','fr');
insert into egroup values('','2','11','0','0','255','2005-01-01','','UNSS','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Assurance, banque, finance','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Logistique - Transport - Tourisme','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Urbanisme - Aménagement - Gestion des collectivités locales','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Comptabilité, contrôle, audit','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Commerce, marketing, vente, achat','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Gestion et développement de la santé','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Management','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Economie et commerce international','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Histoire des techniques','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Droit des affaires','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Innovation, prospective, technosciences et société','','N','O','fr');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Formations générales en EG','','N','O','fr');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Ergonomie - Handicap','','N','O','fr');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Droit social - Relations humaines - Organisation','','N','O','fr');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Psychologie du travail - Psychanalyse et orientation','','N','O','fr');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Communication - Langues','','N','O','fr');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Formation et parcours professionnels','','N','O','fr');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Formations du 1er cycle STS','','N','O','fr');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Sociologie - Travail social - Protection sociale','','N','O','fr');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Electronique - Automatique','','N','O','fr');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Information et communication scientifiques et techniques','','N','O','fr');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Informatique','','N','O','fr');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Mathématiques','','N','O','fr');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Chimie - Alimentation - Santé et Environnement','','N','O','fr');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Matériaux','','N','O','fr');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Energétique - Electrotechnique','','N','O','fr');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Mécanique, Acoustique, Aérodynamique','','N','O','fr');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Génie civil - Bâtiment - Géotechnique','','N','O','fr');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Sciences et techniques de l\’analyse de la mesure','','N','O','fr');
###############################################################################
# création de la dba des intitulés des menus des egroups des utilisateurs
###############################################################################
insert into egroup_menu values('1', '1','Forums',  'Discuter avec les autres usagers au travers de sujets de discussion.',    'item=3',           'O','255','O','N','O','fr');
insert into egroup_menu values('2', '1','Fichiers','Stocker et partager des documents.',                                      'item=31',          'O','255','O','N','O','fr');
insert into egroup_menu values('3', '1','Agendas', 'Organiser un agenda partagé en saisissant les évènements qui le compose.','item=8',           'O','255','O','N','O','fr');
insert into egroup_menu values('4', '1','Photos',  'Déposer et publier facilement des photos.',                               'item=5',           'O','255','O','N','O','fr');
insert into egroup_menu values('5', '1','Sondages','Lancer des sondages pour demander l\'avis des membres du e-groupe.',      'item=99&cmde=visu','O','255','O','N','O','fr');
insert into egroup_menu values('6', '1','Weblog',  'Rédiger et publier des articles',                                         'item=36&cmde=visu','O','255','O','N','O','fr');
insert into egroup_menu values('7', '1','Wiki',    'Créer et partager des documents collaboratifs',                           'item=34',          'O','255','O','N','O','fr');
insert into egroup_menu values('8', '1','Tchache', 'Discuter en direct avec les autres membres.',                             'item=14&cmde=chat','O','255','O','N','O','fr');
insert into egroup_menu values('9', '1','Liens',   'Partager des adresses de sites utiles.',                                  'item=22',          'O','255','O','N','O','fr');
insert into egroup_menu values('10','1','Membres', 'Connaitre les membres de ce groupe.',                                     'item=17&cmde=user','O','255','O','N','O','fr');
insert into egroup_menu values('11','1','Post-it', 'Envoyer un message aux membres de ce groupe.',                            'item=4&cmde=post', 'O','255','O','N','O','fr');
insert into egroup_menu values('12','1','Annonces','Visualiser et partager des annonces',                                     'item=15',          'O','255','O','N','O','fr');

insert into egroup_menu values('1', '2','Forums',  'Discuter avec les autres usagers au travers de sujets de discussion.',    'item=3',           'O','255','O','N','O','fr');
insert into egroup_menu values('2', '2','Fichiers','Stocker et partager des documents.',                                      'item=31',          'O','255','O','N','O','fr');
insert into egroup_menu values('3', '2','Agendas', 'Organiser un agenda partagé en saisissant les évènements qui le compose.','item=8',           'O','255','O','N','O','fr');
insert into egroup_menu values('4', '2','Photos',  'Déposer et publier facilement des photos.',                               'item=5',           'O','255','O','N','O','fr');
insert into egroup_menu values('5', '2','Weblog',  'Rédiger et publier des articles',                                         'item=36&cmde=visu','O','255','O','N','O','fr');
insert into egroup_menu values('6', '2','Wiki',    'Créer et partager des documents collaboratifs',                           'item=34',          'O','255','O','N','O','fr');
insert into egroup_menu values('7', '2','Liens',   'Partager des adresses de sites utiles.',                                  'item=22',          'O','255','O','N','O','fr');
insert into egroup_menu values('8', '2','Membres', 'Connaitre les membres de ce groupe.',                                     'item=17&cmde=user','O','255','O','N','O','fr');
insert into egroup_menu values('9', '2','Annonces','Visualiser et partager des annonces',                                     'item=15',          'O','255','O','N','O','fr');

insert into egroup_menu values('1', '3','Documents',       'Accéder à des documents pédagogiques',          'item=31',                'O','255','O','N','O','fr');
insert into egroup_menu values('2', '3','Forums',          'Envoyer des messages dans un forum',            'item=3',                 'O','255','O','N','O','fr');
insert into egroup_menu values('3', '3','Galeries',        'Visualiser des galeries d\'images',             'item=5',                 'O','255','O','N','O','fr');
insert into egroup_menu values('4', '3','Travail à rendre','Déposer des travaux ou des devoirs maison',     'item=9&cmde=work',       'O','255','O','N','O','fr');
insert into egroup_menu values('5', '3','Exercices',       'Effectuer des exercices en ligne',              'item=50',                'O','255','O','N','O','fr');
insert into egroup_menu values('6', '3','Cours',           'Télécharger des supports de cours',             'item=33',                'O','255','O','N','O','fr');
insert into egroup_menu values('7', '3','Référentiels',    'Télécharger les référentiels de formation',     'item=35&cmde=cursus',    'O','255','O','N','O','fr');
insert into egroup_menu values('8', '3','Annonces',        'Visualiser des annonces',                       'item=9&cmde=breve',      'O','255','O','N','O','fr');
insert into egroup_menu values('9', '3','Agenda',          'Consulter les agendas des cours et des examens','item=8',                 'O','255','O','N','O','fr');
insert into egroup_menu values('10','3','Sondages',        'Répondre à des sondages',                       'item=99&cmde=visu',      'O','255','O','N','O','fr');
insert into egroup_menu values('11','3','B2i-C2i',         'Consulter votre carnet électronique du B2i-C2i','item=1&visu=1&cmde=show','O','255','O','N','O','fr');
insert into egroup_menu values('12','3','Liens',           'Consulter des liens',                           'item=9&cmde=link',       'O','255','O','N','O','fr');
insert into egroup_menu values('13','3','e-Portfolio',     'Gérer les compétences scolaires',               'item=1&visu=1&cmde=show','O','255','O','N','O','fr');
insert into egroup_menu values('14','3','Tchache',         'Dialoguer en direct',                           'item=14&cmde=chat',      'O','255','O','N','O','fr');
insert into egroup_menu values('15','3','Cahier de texte', 'Consulter le cahier de texte numérique',        'item=13',                'O','255','O','N','O','fr');
insert into egroup_menu values('16','3','Membres',         'Connaitre les membres de ce groupe.',           'item=17&cmde=user',      'O','255','O','N','O','fr');
###############################################################################
# création de la dba des des droits d'accès des utilisateurs pour les e-groupes
###############################################################################
insert into egroup_access values('-1', 'En attente','fr');
insert into egroup_access values('0',  'Bannis','fr');
insert into egroup_access values('1',  'Lecteur','fr');
insert into egroup_access values('3',  'Membre','fr');
insert into egroup_access values('7',  'Modérateur','fr');
###############################################################################