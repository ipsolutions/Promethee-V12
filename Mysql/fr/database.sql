##############################################################################
#    Copyright (c) 2002-2007 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# création de la dba des configurations
###############################################################################
insert into config values('', 'default',     'Prométhée, l\'ENT « clef en main » Libre et gratuit', 'Bienvenue sur votre intranet', 'Prométhée,intranet,extranet,GNU/GPL,GPL,Logiciels libres,open source,CMS,groupware,workflow,e-learning,e-formation,e-campus,FOD,FOAD,education,ENT,Espace Numérique de Travail', 'FFFFFF', 'C', '3 comptes par défaut sont disponibles :\n->{{admin}}, pas de mot de passe\n->{{prof}}, pas de mot de passe\n->{{élève}}, pas de mot de passe', 'Le site est provisoirement inaccessible pour cause de maintenance.\nMerci de bien vouloir revenir plus tard.', '1', 'N', 'blue.gif', 'geometric.gif', 'N', 'streak2.gif', 'votre adresse ici', 'code postal', 'ville', 'votre tel ici', 'votre fax ici', 'votre site ici', 'votre email ici', 'O', 'O', 'email du webmestre', 'N', 'fr','0');
insert into config values('', 'LEGTA Gap',   'Prométhée, l\'ENT « clef en main » Libre et gratuit', 'Bienvenue sur l\'intranet du', 'Prométhée,intranet,extranet,GNU/GPL,GPL,Logiciels libres,open source,CMS,groupware,workflow,e-learning,e-formation,e-campus,FOD,FOAD,education,ENT,Espace Numérique de Travail', 'FFFFFF', 'D', 'Veuillez taper votre ID utilisateur et votre mot de passe pour vous connecter.', 'Le site est provisoirement inaccessible pour cause de maintenance.\nMerci de bien vouloir revenir plus tard.', '1', 'N', 'red.gif', 'mountain.gif', 'N', 'streak7.gif', '127, route de Valserres', 'F-05000', 'Gap', '+33 (0) 492.51.04.36', '+33 (0) 492.53.57.93', 'www.gap.educagri.fr', 'lpa.gap@educagri.fr', 'O', 'O', 'email du webmestre', 'N', 'fr','0');
insert into config values('', 'LEGTA Digne', 'Prométhée, l\'ENT « clef en main » Libre et gratuit', 'Bienvenue',                    'Prométhée,intranet,extranet,GNU/GPL,GPL,Logiciels libres,open source,CMS,groupware,workflow,e-learning,e-formation,e-campus,FOD,FOAD,education,ENT,Espace Numérique de Travail', 'FFFFFF', 'G', 'Veuillez taper votre ID utilisateur et votre mot de passe pour vous connecter.', 'Le site est provisoirement inaccessible pour cause de maintenance.\nMerci de bien vouloir revenir plus tard.', '2', 'N', 'round.gif',  'hills.gif', 'N', 'streak7.gif', 'Le Chaffaut', 'F-04510', 'Carmejane', '+33 (0) 492.30.35.70', '+33 (0) 492.30.35.79', 'www.digne-carmejane.educagri.fr', 'lpa.digne@educagri.fr', 'O', 'O', 'email du webmestre', 'N', 'fr','0');
insert into config values('', '',            '',                                                    '',                             'Prométhée,intranet,extranet,GNU/GPL,GPL,Logiciels libres,open source,CMS,groupware,workflow,e-learning,e-formation,e-campus,FOD,FOAD,education,ENT,Espace Numérique de Travail', 'FFFFFF', 'C', '', 'Le site est provisoirement inaccessible pour cause de maintenance.\nMerci de bien vouloir revenir plus tard.', '2', 'N', 'dash.gif', 'geometric.gif', 'N', 'blurred.jpg', '', '', '', '', '', '', '', 'O', 'O', '', 'N', 'fr','0');
###############################################################################
# création de la dba des centres par établissement
###############################################################################
insert into config_centre values('1',  'EPL',                 '', '', '', '', '', 'O', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('2',  'Lycée',               '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('3',  'Collège',             '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('4',  'LEP, LPA',            '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('5',  'CFA, CFPPA',          '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('6',  'Ecole primaire',      '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('7',  'Université',          '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('8',  'IUT, IUP',            '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('9',  'CNAM, Institut',      '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('10', 'Ecole d\'ingénieurs', '', '', '', '', '', 'N', 'fr','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
###############################################################################
# création de la dba des définitions des mot-clefs
###############################################################################
insert into config_def values('', '1', '_STUDENT', 'ELEVES', 'fr');
insert into config_def values('', '1', '_COURSE',  'COURS',  'fr');
insert into config_def values('', '1', '_CLASS',   'CLASSE', 'fr');

insert into config_def values('', '2', '_STUDENT', 'ELEVES', 'fr');
insert into config_def values('', '2', '_COURSE',  'COURS',  'fr');
insert into config_def values('', '2', '_CLASS',   'CLASSE', 'fr');

insert into config_def values('', '3', '_STUDENT', 'ELEVES', 'fr');
insert into config_def values('', '3', '_COURSE',  'COURS',  'fr');
insert into config_def values('', '3', '_CLASS',   'CLASSE', 'fr');

insert into config_def values('', '4', '_STUDENT', 'ELEVES', 'fr');
insert into config_def values('', '4', '_COURSE',  'COURS',  'fr');
insert into config_def values('', '4', '_CLASS',   'CLASSE', 'fr');

insert into config_def values('', '5', '_STUDENT', 'APPRENTIS', 'fr');
insert into config_def values('', '5', '_COURSE',  'COURS',     'fr');
insert into config_def values('', '5', '_CLASS',   'FORMATION', 'fr');

insert into config_def values('', '6', '_STUDENT', 'APPRENANTS', 'fr');
insert into config_def values('', '6', '_COURSE',  'module',     'fr');
insert into config_def values('', '6', '_CLASS',   'FORMATION',  'fr');

insert into config_def values('', '7', '_STUDENT', 'STAGIAIRES', 'fr');
insert into config_def values('', '7', '_COURSE',  'COURS',      'fr');
insert into config_def values('', '7', '_CLASS',   'FILIERE',    'fr');

insert into config_def values('', '8', '_STUDENT', 'ETUDIANTS', 'fr');
insert into config_def values('', '8', '_COURSE',  'UV',        'fr');
insert into config_def values('', '8', '_CLASS',   'FORMATION', 'fr');

insert into config_def values('', '9', '_STUDENT', 'ETUDIANTS', 'fr');
insert into config_def values('', '9', '_COURSE',  'COURS',     'fr');
insert into config_def values('', '9', '_CLASS',   'FORMATION', 'fr');

insert into config_def values('', '10', '_STUDENT', 'AUDITEURS', 'fr');
insert into config_def values('', '10', '_COURSE',  'UV',        'fr');
insert into config_def values('', '10', '_CLASS',   'FORMATION', 'fr');

insert into config_def values('', '11', '_STUDENT', 'ELEVES',  'fr');
insert into config_def values('', '11', '_COURSE',  'COURS',   'fr');
insert into config_def values('', '11', '_CLASS',   'FILIERE', 'fr');

insert into config_def values('', '12', '_STUDENT', 'STAGIAIRES', 'fr');
insert into config_def values('', '12', '_COURSE',  'UV',         'fr');
insert into config_def values('', '12', '_CLASS',   'FORMATION',  'fr');

insert into config_def values('', '13', '_STUDENT', 'ECOLIERS', 'fr');
insert into config_def values('', '13', '_COURSE',  'COURS',    'fr');
insert into config_def values('', '13', '_CLASS',   'SECTION',  'fr');
###############################################################################
# création de la dba des groupes
###############################################################################
insert into user_group values('1',  'Elève',          '', '1024', '1', 'O', 'fr');
insert into user_group values('2',  'Enseignant',     '', '1024', '2', 'O', 'fr');
insert into user_group values('3',  'ATOSS',          '', '1024', '2', 'O', 'fr');
insert into user_group values('4',  'Administration', '', '1024', '2', 'O', 'fr');
insert into user_group values('5',  'Exploitation',   '', '1024', '2', 'O', 'fr');
insert into user_group values('6',  'Formateur',      '', '1024', '2', 'N', 'fr');
insert into user_group values('7',  'Professeur',     '', '1024', '2', 'N', 'fr');
insert into user_group values('8',  'Doctorant',      '', '1024', '2', 'N', 'fr');
insert into user_group values('9',  'Intervenant',    '', '1024', '3', 'N', 'fr');
insert into user_group values('10', 'Entreprise ',    '', '1024', '3', 'N', 'fr');
insert into user_group values('11', 'Parent',         '', '1024', '3', 'O', 'fr');
insert into user_group values('12', 'Visiteur',       '', '1024', '3', 'O', 'fr');
###############################################################################
# création de la dba des droits
###############################################################################
insert into user_admin values('0',   'Bannis',       'fr');
insert into user_admin values('1',   'Utilisateur',  'fr');
insert into user_admin values('2',   'Membre',       'fr');
insert into user_admin values('4',   'Modérateur',   'fr');
insert into user_admin values('8',   'Gestionnaire', 'fr');
insert into user_admin values('255', 'Grand Chef',   'fr');
###############################################################################
# création de la dba des catégories d'utilisateurs
###############################################################################
insert into user_category values('1', 'Apprenant', 'fr');
insert into user_category values('2', 'Personnel', 'fr');
insert into user_category values('3', 'Extérieur', 'fr');
###############################################################################
# création de la dba des identifiants
###############################################################################
insert into user_id values('','2', '1','0','','2002-09-01','2002-09-01','2002-09-01','255','admin',   '',        'Webmestre', '','H','Administrateur de cet intranet','On m\'appelle Big Brother.',                                       '','','','','','','','','','D\'un Z qui veut dire Zorro !','0','0','0','0','0','N','O','E','N','N','O','','0','','fr','0','0');
insert into user_id values('','2', '1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'prof',    '',        'Enseignant','','H','Enseignant de l\'établissement','Je fais des trous, des p\'tits trous, toujours des p\'tits trous.','','','','','','','','','','My name is Bond, James Bond.', '0','0','0','0','0','O','N','E','N','N','O','','0','','fr','0','0');
insert into user_id values('','1', '1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'élève',   '',        'Elève',     '','H','Elève de l\'établissement',     '','','','','','','','','','','','0','0','0','0','0','O','N','E','N','N','O','','0','','fr','0','0');
insert into user_id values('','12','1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'visiteur','visiteur','Visiteur',  '','A','Connexion anonyme',             '','','','','','','','','','','','0','0','0','0','0','N','N','E','N','N','O','','0','','fr','0','0');
###############################################################################
# création de la dba des fichiers mime
###############################################################################
insert into config_mime values('', 'htm',  'page web htm',                        'O', 'fr');
insert into config_mime values('', 'html', 'page web html',                       'O', 'fr');
insert into config_mime values('', 'pdf',  'document Acrobat Reader',             'O', 'fr');
insert into config_mime values('', 'xls',  'Micro$oft Excel',                     'O', 'fr');
insert into config_mime values('', 'doc',  'Micro$oft Word',                      'O', 'fr');
insert into config_mime values('', 'ppt',  'Micro$oft PowerPoint',                'O', 'fr');
insert into config_mime values('', 'pps',  'Micro$oft PowerPoint',                'O', 'fr');
insert into config_mime values('', 'pub',  'Micro$oft Publisher',                 'O', 'fr');
insert into config_mime values('', 'mdb',  'Micro$oft Access',                    'O', 'fr');
insert into config_mime values('', 'jpg',  'image au format jpeg',                'O', 'fr');
insert into config_mime values('', 'png',  'image au format png',                 'O', 'fr');
insert into config_mime values('', 'gif',  'image au format gif',                 'O', 'fr');
insert into config_mime values('', 'bmp',  'image au format bitmap',              'O', 'fr');
insert into config_mime values('', '7z',   'document compressé format 7-zip',     'O', 'fr');
insert into config_mime values('', 'zip',  'document compressé format zip',       'O', 'fr');
insert into config_mime values('', 'rar',  'document compressé format rar',       'O', 'fr');
insert into config_mime values('', 'mp3',  'fichier son au format mp3',           'O', 'fr');
insert into config_mime values('', 'wav',  'fichier son au format wav',           'O', 'fr');
insert into config_mime values('', 'mpg',  'fichier son au format mpeg',          'O', 'fr');
insert into config_mime values('', 'ogg',  'fichier son au format ogg vorbis',    'O', 'fr');
insert into config_mime values('', 'txt',  'document texte sans mise en page',    'O', 'fr');
insert into config_mime values('', 'sxw',  'OpenOffice texteur',                  'O', 'fr');
insert into config_mime values('', 'sxc',  'OpenOffice tableur',                  'O', 'fr');
insert into config_mime values('', 'sxd',  'OpenOffice dessin',                   'O', 'fr');
insert into config_mime values('', 'sxi',  'OpenOffice présentation',             'O', 'fr');
insert into config_mime values('', 'sxm',  'OpenOffice formules',                 'O', 'fr');
insert into config_mime values('', 'swf',  'document Flash',                      'O', 'fr');
insert into config_mime values('', 'ods',  'open document tableur',               'O', 'fr');
insert into config_mime values('', 'odt',  'open document texteur',               'O', 'fr');
insert into config_mime values('', 'odp',  'open document présentation',          'O', 'fr');
insert into config_mime values('', 'odb',  'open document base de données',       'O', 'fr');
insert into config_mime values('', 'rtf',  'document Rich Text Format',           'O', 'fr');
insert into config_mime values('', 'hlp',  'fichier d\'aide',                     'O', 'fr');
insert into config_mime values('', 'php',  'fichier PHP',                         'O', 'fr');
insert into config_mime values('', 'c++',  'fichier C++',                         'O', 'fr');
insert into config_mime values('', 'wmv',  'fichier vidéo au format wmv',         'O', 'fr');
insert into config_mime values('', 'avi',  'fichier vidéo au format avi',         'O', 'fr');
insert into config_mime values('', 'tgz',  'document compressé format tar.gz',    'O', 'fr');
insert into config_mime values('', 'sql',  'script sql',                          'O', 'fr');
insert into config_mime values('', 'cer',  'certificat numérique',                'O', 'fr');
###############################################################################
# création de la dba des menus de la page d'accueil
###############################################################################
insert into config_menu values('1', 'MENU',              '', '-1', 'N', 'home.png', '255', 'O', '', 'N', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '1', 'Accueil',            'item=0',                         'O', '1',  '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Qui fait quoi ?',    'item=1',                         'O', '2',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Annuaires',          'item=11&cmde=lidi',              'O', '3',  '255', 'N', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Post-it',            'item=4',                         'O', '4',  '254', 'N', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Messagerie',         'http://www.horde.org/imp/',      'O', '5',  '254', 'N', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Réservations',       'item=10',                        'O', '6',  '254', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Agendas',            'item=8',                         'O', '7',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Forums',             'item=3',                         'O', '8',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Tchache',            'item=14',                        'O', '9',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Galeries',           'item=5',                         'O', '10', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Publications',       'item=6',                         'O', '11', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Absences',           'item=63&cmde=visu',              'O', '12', '255', 'N', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Edt',                'item=64',                        'O', '13', '255', 'N', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'e-groupes',          'item=17',                        'O', '14', '255', 'N', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Statistiques',       'item=7',                         'O', '15', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '1', 'Déconnexion',        'item=-1',                        'O', '16', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_menu values('2', 'INFOS',             '', '1', 'N', 'infos.png', '255', 'O', 'item=20&cmde=gestion', 'O', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '2', 'Message du jour', 'item=18',                           'O', '1', '0',   'N', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '2', 'FIL en continu',  'item=15',                           'O', '2', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_menu values('3', 'DOCUMENTS',         '', '-3', 'N', 'doc.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '3', 'Référentiels',       'item=35',                        'O', '1',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Administration',     'item=31&IDres=1',                'O', '2',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Pédagogie',          'item=31&IDres=2',                'O', '3',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'En ligne',           'item=31&IDres=3&cmde=online',    'O', '4',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Collaboratifs',      'item=34',                        'O', '5',  '254', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Weblogs',            'item=36',                        'O', '6',  '254', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Ressources',         'item=32',                        'O', '7',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Registre CHS',       'item=37',                        'O', '8',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Espaces Numériques', 'item=45',                        'O', '9',  '255', 'N', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '3', 'Base documentaire',  'http://www.sigb.net/',           'O', '10', '255', 'N', 'N', '', 'O', '0', 'fr');
insert into config_menu values('4', 'ENTREPRISES',       '', '-5',  'N', 'company.png', '255', 'O', 'item=40&cmde=gestion&IDmenu=1', 'O', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '4', 'Mise à jour',        'item=40&cmde=lieu',              'O', '1', '254', 'N', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '4', 'Visites',            'item=40&cmde=visit',             'O', '2', '254', 'N', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '4', 'Fiches liaison',     'item=38',                        'O', '3', '254', 'N', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '4', 'Recherche',          'item=40&cmde=search',            'O', '4', '255', 'N', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '4', 'Dépôt de CV',        'item=40&cmde=cv',                'O', '5', '255', 'N', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '4', 'Espace pro.',        'item=40&cmde=pro',               'O', '6', '255', 'N', 'N', '', 'O', '0', 'fr');
insert into config_menu values('5', 'AIDE EN LIGNE',     '', '-9', 'N', 'support.png', '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '5', 'Installation',   'http://promethee.eu.org/download/ftp/docs/documentation francaise/Guide installation.pdf',    'O', '1', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '5', 'Administrateur', 'http://promethee.eu.org/download/ftp/docs/documentation francaise/Guide administrateur.pdf',  'O', '2', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '5', 'Utilisateur',    'http://promethee.eu.org/download/ftp/docs/documentation francaise/Guide utilisateur.pdf',     'O', '3', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '5', 'Enseignant',     'http://promethee.eu.org/download/ftp/docs/documentation francaise/Guide enseignant.pdf',      'O', '4', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_menu values('6', 'LIENS',             '', '5',  'N', 'url.png', '255', 'O', 'item=22&IDgroup=0', 'O', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_menu values('7', 'SONDAGE',           '', '9',  'N', 'poll.png', '255', 'O', 'item=99&IDdata=0&cmde=gestion', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_menu values('8', 'ADMINISTRATEUR',    '', '-2', 'N', 'admin.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '1', 'fr');
insert into config_submenu values('', '8', 'Accès',              'item=21&cmde=access',            'O', '1', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Configuration',      'item=21',                        'O', '2', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Identification',     'item=23',                        'O', '3', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Logs de connexion',  'item=92',                        'O', '4', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Logs IP',            'item=24',                        'O', '5', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Webmail',            'item=25',                        'O', '6', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'phpMyAdmin',         'http://www.phpmyadmin.net/',     'O', '7', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Gestion de parc',    'http://glpi-project.org/',       'O', '8', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Sauvegardes',        'item=27&cmde=backup',            'O', '9', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'Import',             'item=27&cmde=import',            'O','10', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_submenu values('', '8', 'RAZ tables',         'item=27&cmde=reset',             'O','11', '255', 'N', 'N', '', 'O', '1', 'fr');
insert into config_menu values('9', 'FETE DU JOUR',      '', '4', 'N', 'today.png', '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '9', 'Blague du jour', '#', 'O', '1', '255', 'N', 'N', 'N', 'N', '0', 'fr');
insert into config_submenu values('', '9', 'Citation',       '#', 'O', '2', '255', 'N', 'N', 'N', 'O', '0', 'fr');
insert into config_submenu values('', '9', 'Perles',         '#', 'O', '3', '255', 'N', 'N', 'N', 'O', '0', 'fr');
insert into config_menu values('10', 'RECHERCHER',       '', '6', 'N', 'search.png',  '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_menu values('11', '_STUDENT',         '', '-4',  'N', 'student.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '11', 'Absences',          'item=63&cmde=show',               'O', '1',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Anciens _STUDENT',  'item=38&visu=N',                  'O', '2',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Liste _STUDENT',    'item=38',                         'O', '3',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Délégués',          'item=38&delegue=O',               'O', '4',  '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Liste _CLASSs',     'item=9&cmde=class',               'O', '5',  '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'e-Portfolio',       'item=16&cmde=visu',               'O', '6',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'B2i-C2i',           'item=16&ident=B2i-C2i&cmde=visu', 'O', '7',  '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Bulletins notes',   'item=60',                         'O', '8',  '255', 'N', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Bulletins CCF',     'item=61',                         'O', '9',  '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Examens',           'item=62',                         'O', '10', '255', 'O', 'N', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Cahier de Texte',   'item=13',                         'O', '11', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Carnet de Corres.', 'item=68',                         'O', '12', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Cahier de Liaison', 'item=12',                         'O', '13', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Carnets à points',  'item=66',                         'O', '14', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Consignes',         'item=67',                         'O', '15', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'FOAD',              'item=17&IDitem=3',                'O', '16', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Infirmerie',        'item=63&cmde=sick',               'O', '17', '255', 'O', 'O', '', 'O', '0', 'fr');
insert into config_submenu values('', '11', 'Liste parents' ,    'item=38&cmde=parent',             'O', '18', '128', 'N', 'N', '', 'O', '0', 'fr');
insert into config_menu values('12', 'QUI EST LA ?',     '', '8',  'N', 'who.png',   '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_menu values('13', 'STATS',            '', '10', 'N', 'stats.png', '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_menu values('14', 'LOGICIELS LIBRES', 'Signez la <a href="http://petition.eurolinux.org">pétition</a> pour une Europe sans brevets logiciels.', '11', 'N', 'gnu.png', '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '14', 'GNU/Linux',         'http://www.linux.org',      'O', '1', '255', 'O', 'N', 'linuxpow.jpg',  'O', '0', 'fr');
insert into config_submenu values('', '14', 'Apache',            'http://www.apache.org',     'O', '2', '255', 'O', 'N', 'apache.gif',    'O', '0', 'fr');
insert into config_submenu values('', '14', 'MySQL',             'http://www.mysql.com',      'O', '3', '255', 'O', 'N', 'mysql.gif',     'O', '0', 'fr');
insert into config_submenu values('', '14', 'PHP',               'http://www.php.net',        'O', '4', '255', 'O', 'N', 'php.gif',       'O', '0', 'fr');
insert into config_submenu values('', '14', 'HORDE',             'http://www.horde.org/imp/', 'O', '5', '255', 'O', 'N', 'horde.png',     'O', '0', 'fr');
insert into config_submenu values('', '14', 'fckEditor',         'http://www.fckeditor.net',  'O', '6', '255', 'O', 'N', 'fckeditor.gif', 'O', '0', 'fr');
insert into config_submenu values('', '14', 'Logiciel Libre',    'http://www.linuxfr.org',    'O', '7', '255', 'O', 'N', 'LL.png',        'O', '0', 'fr');
insert into config_menu values('15', 'DU NOUVEAU ?',     '', '4',  'O', 'news.png',     '255', 'O', 'item=30&cmde=gestion', 'O', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_menu values('16', 'CALENDRIER',       '', '3', 'N', 'calendar.png', '255', 'O', 'item=15&cmde=post&IDflash=0', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_menu values('17', 'e-CAMPUS',         '', '2', 'N', 'campus.png',   '255', 'O', 'item=9&IDres=2&cmde=gestion', 'O', 'O', 'O', 'campus_menu', '0', 'fr');
insert into config_menu values('18', 'BOITE A IDEES',    '', '5', 'N', 'box.png',      '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'fr');
insert into config_menu values('19', 'e-GROUPES',        '', '3', 'N', 'egroup.png',   '255', 'O', 'item=17&cmde=gestion', 'O', 'O', 'O', 'egroup_menu', '0', 'fr');
insert into config_menu values('20', 'MON ENT',          '', '-2',  'N', 'manager.png',  '255', 'O', '', 'N', 'O', 'O', 'config_submenu', '0', 'fr');
insert into config_submenu values('', '20', 'Mon compte',           'item=1&cmde=account&show=0', 'O', '1',  '254', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mon espace',           'item=45&cmde=visu',          'O', '2',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mon agenda',           'item=8&cmde=mvc',            'O', '3',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mon blog',             'item=36&cmde=visu',          'O', '4',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mon annuaire',         'item=11&cmde=address',       'O', '5',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mon e-portfolio',      'item=16&cmde=mvc',           'O', '6',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mes stages',           'item=40&cmde=mvc',           'O', '7',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mes absences',         'item=63&cmde=mvc',           'O', '8',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Cahier de texte',      'item=13&cmde=mvc',           'O', '9',  '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Cahier de liaison',    'item=12&cmde=mvc',           'O', '10', '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Carnet à points',      'item=66&cmde=mvc',           'O', '11', '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Correspondance',       'item=68&cmde=mvc',           'O', '12', '255', 'N', 'N', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Signaler un incident', 'item=39',                    'O', '13', '255', 'N', 'O', '', 'O', '2', 'fr');
insert into config_submenu values('', '20', 'Mes préférences',      'item=1&cmde=skin',           'O', '14', '255', 'N', 'N', '', 'O', '0', 'fr');
insert into config_menu values('21', 'DONATION',         '', '-12', 'N', 'money.png',   '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'fr');

###############################################################################
# création de la dba des types de messages
###############################################################################
insert into postit_type values('0', 'Message système',    'N', 'fr');
insert into postit_type values('1', 'Message',            'O', 'fr');
insert into postit_type values('2', 'Fiche téléphonique', 'O', 'fr');
###############################################################################
# création de la dba des liens
###############################################################################
insert into link values('', '0', '0', '255', 'Messagerie',         'http://mail.educagri.fr/login/',                         'La messagerie interne du ministère de l\'enseignement agricole.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '0', '0', '255', 'Le JO',              'http://www.journal-officiel.gouv.fr',                    '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '0', '0', '255', 'Gestionnaire BCD',   'http://www.sigb.net',                                    'PMB, le logiciel de gestion de bibliothèque sous licence libre CeCILL.', 'fr.png', 'N', '0', 'fr');
insert into link values('', '0', '0', '255', 'Pages blanches',     'http://www.pagesjaunes.fr/pb.cgi?',                      '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '0', '0', '255', 'Pages jaunes',       'http://www.pagesjaunes.fr',                              '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '0', '0', '255', 'Météo',              'http://www.meteofrance.com',                             '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '0', '0', '255', 'Recherche www',      'http://www.google.fr',                                   'Un moteur de recherche très réputé.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '0', '0', '255', 'Prométhée',          'http://promethee.eu.org',                                'L\'Espace Numérique de Travail « clef en main » Libre et gratuit.', 'fr.png', 'O', '0', 'fr');
insert into link_data values('1', '0', '0', '0', 'Agriculture', '', 'O', 'fr');
insert into link values('', '1', '0', '255', 'Educagri',           'http://www.educagri.fr',                                 'Le site du ministère de l\'enseignement agricole.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '1', '0', '255', 'NOCIA',              'http://www.educagri.fr/nocia',                           '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '1', '0', '255', 'Concours',           'http://www.concours.agriculture.gouv.fr',                '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '1', '0', '255', 'Les diplômes du MAP','http://www.enfa.fr/ldea',                                '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '1', '0', '255', 'Annuaire Agricole',  'http://perso.wanadoo.fr/ardenne.agricole/annuaire.html', '', 'fr.png', 'O', '0', 'fr');
insert into link_data values('2', '0', '0', '0', 'Culture', '', 'O', 'fr');
insert into link values('', '2', '0', '255', 'L\'ATLAS géographique',            'http://www.atlasgeo.net/_index.htm',            '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '2', '0', '255', 'Wikipédia, l\'encyclopédie libre', 'http://fr.wikipedia.org/wiki/Accueil',          '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '2', '0', '255', 'Encyclopedia Universalis',         'http://www.universalis-edu.com/',               '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '2', '0', '255', 'Cartes satellites',                'http://maps.google.com/',                       '', 'fr.png', 'O', '0', 'fr');
insert into link_data values('3', '0', '0', '0', 'Logiciels Libres', '', 'O', 'fr');
insert into link values('', '3', '0', '255', 'Le projet GNU',                    'http://www.gnu.org/home.fr.html',               'Le début de tout !', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'Free Software Foundation',         'http://www.france.fsfeurope.org/index.fr.html', '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'L\'AFUL',                          'http://www.aful.org/index.html',                'Association Francophone des Utilisateurs de Linux et des Logiciels Libres.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'The GIMP',                         'http://www.gimp-fr.org/news.php',               'Le logiciel de dessin et de retouches photos.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'MySQL',                            'http://www.mysql.com/',                         'La base de données Open Source.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'OpenOffice',                       'http://fr.openoffice.org',                      'La suite bureautique Libre.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'Je suis Libre',                    'http://www.jesuislibre.org',                    'Le portails des projets Libres.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'FireFox',                          'http://www.mozilla-europe.org/fr/',             'Le navigateur qui vous permet de redécouvrir le web.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', '7-zip',                            'http://www.7-zip.org/fr/',                      'Logiciel d\'archivage de fichiers avec un taux de compression très élevé.', 'fr.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'Scribus',                          'http://www.scribus.net/',                       'Publication Assistée par Ordinateur.', 'uk.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'Pidgin',                           'http://www.pidgin.im/',                         'Client de messagerie instantannée.', 'uk.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'Nvu',                              'http://www.nvu.com/',                           'Editeur de page web WYSIWYG.', 'uk.png', 'O', '0', 'fr');
insert into link values('', '3', '0', '255', 'VideoLAN',                         'http://www.videolan.org/',                      'Lecteur audio et vidéo (ogg, mp3, divx, dvd, ...).', 'uk.png', 'O', '0', 'fr');
insert into link_data values('4', '0', '0', '0', 'Informatique', '', 'O', 'fr');
insert into link values('', '4', '0', '255', 'Da Linux French Page',             'http://linuxfr.org/',                           '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '4', '0', '255', 'ZDnet France',                     'http://www.zdnet.fr/',                          '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '4', '0', '255', '01net',                            'http://www.01net.com/',                         '', 'fr.png', 'O', '0', 'fr');
insert into link_data values('5', '0', '0', '0', 'Education', '', 'O', 'fr');
insert into link values('', '5', '0', '255', 'Educ. France 5',                   'http://education.france5.fr/',                  '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '5', '0', '255', 'Educnet',                          'http://www.educnet.education.fr/',              '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '5', '0', '255', 'Le café pédagogique',              'http://www.cafepedagogique.net/',               '', 'fr.png', 'O', '0', 'fr');
insert into link values('', '5', '0', '255', 'ONISEP',                           'http://www.onisep.fr/',                         '', 'fr.png', 'O', '0', 'fr');
###############################################################################
# création de la dba ftp
###############################################################################
insert into ftp values('1', '0', '30', '31', 'serveur Intranet', 'download/ftp/serveur', 'Documents divers en libre téléchargement.', '', '', 'C', '1', 'O', 'fr');
insert into ftp values('2', '0',  '2', '11', 'sujets CCF',       'download/ftp/ccf',     'Les sujets CCF de ce serveur sont accessibles sous certaines conditions.', '', '', 'C', '1', 'O', 'fr');
###############################################################################
# création de la dba des ressources
###############################################################################
insert into resource values('1','0','0','0','Administration','Documents administratifs à l\'usage des utilisateurs.', '11', 'N', 'N', 'O', 'fr');
insert into resource values('2','0','0','0','Pédagogie',     'Documents pédagogiques à l\'usage des élèves.',         '11', 'N', 'N', 'O', 'fr');
insert into resource values('3','0','0','0','En ligne',      'Ressources pédagogiques en ligne.',                     '11', 'N', 'O', 'O', 'fr');
insert into resource values('4','0','0','0','e-groupe',      'Ressources des groupes virtuels.',                      '11', 'N', 'O', 'O', 'fr');
###############################################################################
# création de la dba des catégories de ressources
###############################################################################
insert into resource_data values('','1','0','8','255','Documents types (modèles)','', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','1','0','8','255','Notes de services',        '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','1','0','8','255','Comptes Rendus CA, CI, CE','', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','1','0','8','255','Projets PUS, PAE, etc',    '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','1','0','8','255','Structures pédagogiques',  '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','1','0','8','255','Divers',                   '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Agronomie',                '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Anglais',                  '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Allemand',                 '', '0', '1', 'N', '1', 'O', 'N', 'fr');
insert into resource_data values('','2','0','2','255','Biologie',                 '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Economie',                 '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','EPS',                      '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','ESC',                      '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Espagnol',                 '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Français',                 '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Hist-Géo',                 '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Informatique',             '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Italien',                  '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Machinisme',               '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Maths',                    '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Philosophie',              '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Phytotechnie',             '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Sc. Physiques',            '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','2','0','2','255','Zootechnie',               '', '0', '1', 'N', '1', 'O', 'O', 'fr');
insert into resource_data values('','3','0','2','255','En ligne',                 '', '0', '1', 'N', '1', 'O', 'O', 'fr');
###############################################################################
# création de la dba des licences des ressources
###############################################################################
insert into resource_license values('1', '??',         'type de licence inconnu','O','fr');
insert into resource_license values('2', 'GPL',        'GNU General Public License','O','fr');
insert into resource_license values('3', 'LGPL',       'GNU Lesser General Public License','O','fr');
insert into resource_license values('4', 'FDL',        'licence par défaut pour les documents personnels','O','fr');
insert into resource_license values('5', 'Free Art',   'Licence Art Libre','O','fr');
insert into resource_license values('6', 'DP',         'document du domaine public','O','fr');
insert into resource_license values('7', 'CC-by',      'licence Creative Commons (by)','O','fr');
insert into resource_license values('8', 'CC-by-nd',   'licence Creative Commons (by-nd)','O','fr');
insert into resource_license values('9', 'CC-by-nc-nd','licence Creative Commons (by-nc-nd)','O','fr');
insert into resource_license values('10','CC-by-nc',   'licence Creative Commons (by-nc)','O','fr');
insert into resource_license values('11','CC-by-nc-sa','licence Creative Commons (by-nc-sa)','O','fr');
insert into resource_license values('12','CC-by-sa',   'licence Creative Commons (by-sa)','O','fr');
insert into resource_license values('13','(C)',        'document sous copyright','O','fr');
###############################################################################
# création de la dba des types des ressources
###############################################################################
insert into resource_type values('1', 'Scénarios pédagogiques','O','fr');
insert into resource_type values('2', 'Progressions et programmations','O','fr');
insert into resource_type values('3', 'Évaluations','O','fr');
insert into resource_type values('4', 'Sites pédagogiques','O','fr');
insert into resource_type values('5', 'Site pour les enfants','O','fr');
insert into resource_type values('6', 'Emplois du temps','O','fr');
insert into resource_type values('7', 'Autres sites','O','fr');
insert into resource_type values('8', 'Logiciels','O','fr');
insert into resource_type values('9', 'Images','O','fr');
insert into resource_type values('10','Vidéos','O','fr');
insert into resource_type values('11','Sons','O','fr');
insert into resource_type values('12','Trucs et astuces','O','fr');
insert into resource_type values('13','Encyclopédies/Dictionnaires','O','fr');
###############################################################################
# création de la dba des fonctions associées aux ressources
###############################################################################
insert into resource_function values('1','Pour préparer la classe','O','fr');
insert into resource_function values('2','Pour gérer une école','O','fr');
insert into resource_function values('3','Pour se former et s\'informer','O','fr');
insert into resource_function values('4','Pour l\'accompagnement et le soutien scolaire','O','fr');
###############################################################################
# création de la dba des absences
###############################################################################
insert into absent_data values('1',  'Absence', 'O','fr');
insert into absent_data values('2',  'Retard', 'O','fr');
insert into absent_data values('3',  'Infirmerie', 'O','fr');
insert into absent_data values('4',  'Sortie', 'O','fr');
insert into absent_data values('5',  'Exploitation', 'O','fr');
insert into absent_data values('6',  'Convocation externe', 'O','fr');
insert into absent_data values('7',  'Convocation interne', 'O','fr');
insert into absent_data values('8',  'Dispense atelier', 'O','fr');
insert into absent_data values('9',  'Dispense EPS', 'O','fr');
insert into absent_data values('10', 'Exclusion', 'O','fr');
insert into absent_data values('11', 'Problème de transport', 'O','fr');
insert into absent_data values('12', 'Rdv médical', 'O','fr');
insert into absent_data values('13', 'Radié', 'O','fr');
insert into absent_data values('14', 'Stage', 'O','fr');
insert into absent_data values('15', 'Maladie', 'O','fr');
insert into absent_data values('16', 'Autre', 'O','fr');
###############################################################################
# création de la dba des pages des documents collaboratifs
###############################################################################
insert into wiki_page values('', '0', '0', 'répertoire racine', '2002-09-01',  '2002-09-01', '0', '254', '254', 'O', '0', 'O', 'fr');
###############################################################################
# création de la dba des intitulés des résultats aux examens
###############################################################################
insert into exam_items values('1', '-', 'fr');
insert into exam_items values('2', 'Reçu', 'fr');
insert into exam_items values('3', 'Ajourné', 'fr');
insert into exam_items values('4', 'Rattrapage', 'fr');
insert into exam_items values('5', 'Oral', 'fr');
insert into exam_items values('6', 'Absent', 'fr');
###############################################################################
# création de la dba des intitulés des edt
###############################################################################
insert into edt values('1', '0', '0', '255', 'salles',    '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'fr');
insert into edt values('2', '0', '0', '255', 'personnel', '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'fr');
insert into edt values('3', '0', '0', '255', 'élèves',    '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'fr');
###############################################################################
# création de la dba des intitulés des salles
###############################################################################
insert into edt_items values('1', '1', 'labo Physique-Chimie', 'fr');
insert into edt_items values('2', '1', 'labo Biologie', 'fr');
insert into edt_items values('3', '1', 'labo Informatique', 'fr');
insert into edt_items values('4', '1', 'salle vidéo', 'fr');
insert into edt_items values('5', '1', 'salle examens', 'fr');
insert into edt_items values('6', '1', 'amphithéâtre', 'fr');
insert into edt_items values('7', '1', 'CDI', 'fr');
###############################################################################
# création de la dba des semaines des edt
###############################################################################
insert into edt_week values('1', 'S1', 'fr');
insert into edt_week values('2', 'S2', 'fr');
###############################################################################
# création de la dba des type d'incidents techniques
###############################################################################
insert into support_data values('1', 'Informatique (matériel)', 'fr');
insert into support_data values('2', 'Informatique (logiciel)', 'fr');
insert into support_data values('3', 'Utilisation de l\'ENT',   'fr');
insert into support_data values('4', 'Autre',                   'fr');
###############################################################################
# création de la dba des catégories de sanctions du carnet à points
###############################################################################
insert into carnet_type values('1', 'Comportement', 'fr');
insert into carnet_type values('2', 'Internat', 'fr');
insert into carnet_type values('3', 'Travail', 'fr');
###############################################################################
# création de la dba du barême du carnet à points
###############################################################################
insert into carnet_items values('1',  '1', '-2',  'ponctualité (retards répétés non justifiés)', 'fr');
insert into carnet_items values('2',  '1', '-2',  'Bavardages répétés', 'fr');
insert into carnet_items values('3',  '1', '-2',  'Attitude bruyante', 'fr');
insert into carnet_items values('4',  '1', '-2',  'Tenue vestimentaire et/ou attitude jugées provocantes ou dérangeantes', 'fr');
insert into carnet_items values('5',  '1', '-3',  'Non respect de la propreté dans l\'établissement et les alentours (papiers, mégôts,...)', 'fr');
insert into carnet_items values('6',  '1', '-3',  'Utilisation du téléphone portable en cours ou pendant les études obligatoires.', 'fr');
insert into carnet_items values('7',  '1', '-3',  'Absentéisme / absence injustifiée', 'fr');
insert into carnet_items values('8',  '1', '-3',  'Non respect du règlement intérieur (ex : zone « fumeurs »)', 'fr');
insert into carnet_items values('9',  '1', '-3',  'Agitation / exclusion de cours', 'fr');
insert into carnet_items values('10', '1', '-4',  'Insolence caractérisée / propos irrespectueux', 'fr');
insert into carnet_items values('11', '1', '-5',  'Dégradation (locaux / matériel)', 'fr');
insert into carnet_items values('12', '1', '-12', 'Déclenchement volontaire d\'une alarme incendie', 'fr');
insert into carnet_items values('13', '1', '-5',  'Possession d\'objets dangereux (cutters, etc... hors usage scolaire ou professionnel)', 'fr');
insert into carnet_items values('14', '1', '-6',  'Sortie sans autorisation', 'fr');
insert into carnet_items values('15', '1', '-6',  'Falsification de signature ou de documents', 'fr');
insert into carnet_items values('16', '1', '-12', 'Violence verbale, agression physique, propos discriminatoires', 'fr');
insert into carnet_items values('17', '1', '-12', 'Introduction et /ou consommation de produits illicites dans l\'établissement', 'fr');
insert into carnet_items values('18', '1', '-12', 'Vol / complicité de vol / racket', 'fr');

insert into carnet_items values('1',  '2', '-2',  'Non respect des horaires', 'fr');
insert into carnet_items values('2',  '2', '-2',  'Chambre désordonnée', 'fr');
insert into carnet_items values('3',  '2', '-2',  'Attitude bruyante', 'fr');
insert into carnet_items values('4',  '2', '-5',  'Dégradation du mobilier (+ réparation et/ou facturation à l\'élève)', 'fr');
insert into carnet_items values('5',  '2', '-1',  'Sortie non autorisée', 'fr');
insert into carnet_items values('6',  '2', '-1',  'Bizutage (* application de la loi)', 'fr');

insert into carnet_items values('1',  '3', '-1',  'Oubli du matériel', 'fr');
insert into carnet_items values('2',  '3', '-1',  'Travail remis en retard', 'fr');
insert into carnet_items values('3',  '3', '-2',  'Travail non fait', 'fr');
insert into carnet_items values('4',  '3', '-4',  'Non prise du cours', 'fr');
insert into carnet_items values('5',  '3', '-6',  'Refus d\'obtempérer', 'fr');
insert into carnet_items values('6',  '3', '-6',  'Fraude / tricherie', 'fr');

insert into carnet_items values('7',  '3', '1',   'motivation et régularité dans le travail durant plusieurs semaines consécutives.', 'fr');
insert into carnet_items values('8',  '3', '1',   'attitude irréprochable durant plusieurs semaines consécutives.', 'fr');
insert into carnet_items values('9',  '3', '1',   'participation à la vie associative durant plusieurs semaines consécutives.', 'fr');
insert into carnet_items values('10', '3', '1',   'prise d\'initiative sociale ou culturelle durant plusieurs semaines consécutives.', 'fr');
###############################################################################
# création de la dba des passages à l'infirmerie
###############################################################################
insert into absent_motif values('1', 'Soins',              'fr');
insert into absent_motif values('2', 'Repos infirmerie',   'fr');
insert into absent_motif values('3', 'Retour au domicile', 'fr');
insert into absent_motif values('4', 'Passage abusif',     'fr');
insert into absent_motif values('5', 'Non présentation',   'fr');
###############################################################################

