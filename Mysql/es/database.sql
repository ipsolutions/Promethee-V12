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
insert into config values('', 'default',     'Prométhée, el ENT « llave en mano » Libre y gratuito', 'Bienvenido en su intranet',     'Prométhée,intranet,extranet,GNU/GPL,GPL,Software libre,open source,CMS,groupware,workflow,e-learning,e-campus,education,ENT,Espacio Numérico de Trabajo', 'FFFFFF', 'C', '3 cuentas están disponibles :\n->{{director}}, no contraseña \n->{{profesor}}, no contraseña \n->{{alumno}}, no contraseña', 'El sitio está temporalmente fuera de servicio por tareas de mantenimiento.\nGracias por su comprensión.', '1', 'N', 'blue.gif', 'geometric.gif', 'N', 'streak2.gif', 'su direccion aqui', 'código postal', 'ciudad', 'su telefono aqui', 'su fax aqui', 'su sitio aqui', 'su email aqui', 'O', 'O', 'email del Administrador', 'N', 'es','0');
insert into config values('', 'LEGTA Gap',   'Prométhée, el ENT « llave en mano » Libre y gratuito', 'Bienvenido en su intranet del', 'Prométhée,intranet,extranet,GNU/GPL,GPL,Software libre,open source,CMS,groupware,workflow,e-learning,e-campus,education,ENT,Espacio Numérico de Trabajo', 'FFFFFF', 'D', 'Por favor teclee su ID usuario y su contrasena para conectarse.', 'El sitio está temporalmente fuera de servicio por tareas de mantenimiento.\nGracias por su comprensión.', '1', 'N', 'red.gif', 'mountain.gif', 'N', 'streak7.gif', '127, route de Valserres', 'F-05000', 'Gap', '+33 (0) 492.51.04.36', '+33 (0) 492.53.57.93', 'www.gap.educagri.fr', 'lpa.gap@educagri.fr', 'O', 'O', 'email del Administrador', 'N', 'es','0');
insert into config values('', 'LEGTA Digne', 'Prométhée, el ENT « llave en mano » Libre y gratuito', 'Bienvenido',                    'Prométhée,intranet,extranet,GNU/GPL,GPL,Software libre,open source,CMS,groupware,workflow,e-learning,e-campus,education,ENT,Espacio Numérico de Trabajo', 'FFFFFF', 'G', 'Por favor teclee su ID usuario y su contrasena para conectarse.', 'El sitio está temporalmente fuera de servicio por tareas de mantenimiento.\nGracias por su comprensión.', '2', 'N', 'round.gif',  'hills.gif', 'N', 'streak7.gif', 'Le Chaffaut', 'F-04510', 'Carmejane', '+33 (0) 492.30.35.70', '+33 (0) 492.30.35.79', 'www.digne-carmejane.educagri.fr', 'lpa.digne@educagri.fr', 'O', 'O', 'email del Administrador', 'N', 'es','0');
insert into config values('', '',            '',                                                     '',                              'Prométhée,intranet,extranet,GNU/GPL,GPL,Software libre,open source,CMS,groupware,workflow,e-learning,e-campus,education,ENT,Espacio Numérico de Trabajo', 'FFFFFF', 'C', '', 'El sitio está temporalmente fuera de servicio por tareas de mantenimiento.\nGracias por su comprensión.', '2', 'N', 'dash.gif', 'geometric.gif', 'N', 'blurred.jpg', '', '', '', '', '', '', '', 'O', 'O', '', 'N', 'es','0');
###############################################################################
# création de la dba des centres par établissement
###############################################################################
insert into config_centre values('1',  'Escuela de agricultura', '', '', '', '', '', 'O', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('2',  'Escuela secundaria',     '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('3',  'Colegio',                '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('4',  'Escuela profesional',    '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('5',  'CFA, CFPPA',             '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('6',  'Escuela primaria',       '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('7',  'Universidad',            '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('8',  'IUT, IUP',               '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('9',  'Instituto',              '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
insert into config_centre values('10', 'Escuela de ingeniera',   '', '', '', '', '', 'N', 'es','[1,"1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2","1","2"]','{"start":[""],"end":[""]}');
###############################################################################
insert into config_def values('', '1', '_STUDENT', 'alumnos', 'es');
insert into config_def values('', '1', '_COURSE',  'curso',   'es');
insert into config_def values('', '1', '_CLASS',   'clase',   'es');

insert into config_def values('', '2', '_STUDENT', 'alumnos', 'es');
insert into config_def values('', '2', '_COURSE',  'curso',   'es');
insert into config_def values('', '2', '_CLASS',   'clase',   'es');

insert into config_def values('', '3', '_STUDENT', 'alumnos', 'es');
insert into config_def values('', '3', '_COURSE',  'curso',   'es');
insert into config_def values('', '3', '_CLASS',   'clase',   'es');

insert into config_def values('', '4', '_STUDENT', 'alumnos', 'es');
insert into config_def values('', '4', '_COURSE',  'curso',   'es');
insert into config_def values('', '4', '_CLASS',   'clase',   'es');

insert into config_def values('', '5', '_STUDENT', 'aprendices', 'es');
insert into config_def values('', '5', '_COURSE',  'curso',      'es');
insert into config_def values('', '5', '_CLASS',   'formación',  'es');

insert into config_def values('', '6', '_STUDENT', 'alumnos',   'es');
insert into config_def values('', '6', '_COURSE',  'módulo',    'es');
insert into config_def values('', '6', '_CLASS',   'formación', 'es');

insert into config_def values('', '7', '_STUDENT', 'curcillistas', 'es');
insert into config_def values('', '7', '_COURSE',  'curso',        'es');
insert into config_def values('', '7', '_CLASS',   'formación',    'es');

insert into config_def values('', '8', '_STUDENT', 'estudiantes', 'es');
insert into config_def values('', '8', '_COURSE',  'UC',          'es');
insert into config_def values('', '8', '_CLASS',   'formación',   'es');

insert into config_def values('', '9', '_STUDENT', 'estudiantes', 'es');
insert into config_def values('', '9', '_COURSE',  'curso',       'es');
insert into config_def values('', '9', '_CLASS',   'formación',   'es');

insert into config_def values('', '10', '_STUDENT', 'auditores', 'es');
insert into config_def values('', '10', '_COURSE',  'UC',        'es');
insert into config_def values('', '10', '_CLASS',   'formación', 'es');

insert into config_def values('', '11', '_STUDENT', 'alumnos',   'es');
insert into config_def values('', '11', '_COURSE',  'curso',     'es');
insert into config_def values('', '11', '_CLASS',   'formación', 'es');

insert into config_def values('', '12', '_STUDENT', 'curcillistas', 'es');
insert into config_def values('', '12', '_COURSE',  'UC',           'es');
insert into config_def values('', '12', '_CLASS',   'formación',    'es');

insert into config_def values('', '13', '_STUDENT', 'alumnos', 'es');
insert into config_def values('', '13', '_COURSE',  'curso',   'es');
insert into config_def values('', '13', '_CLASS',   'arroyo',  'es');
###############################################################################
# création de la dba des groupes
###############################################################################
insert into user_group values('1',  'Alumnos',       '', '1024', '1', 'O', 'es');
insert into user_group values('2',  'Profesor',      '', '1024', '2', 'O', 'es');
insert into user_group values('3',  'técnico',       '', '1024', '2', 'O', 'es');
insert into user_group values('4',  'Administracion','', '1024', '2', 'O', 'es');
insert into user_group values('5',  'Exploitacion',  '', '1024', '2', 'O', 'es');
insert into user_group values('6',  'Formador',      '', '1024', '2', 'N', 'es');
insert into user_group values('7',  'Conferenciante','', '1024', '2', 'N', 'es');
insert into user_group values('8',  'PhD',           '', '1024', '2', 'N', 'es');
insert into user_group values('9',  'Interventor',   '', '1024', '2', 'N', 'es');
insert into user_group values('10', 'Empresa ',      '', '1024', '3', 'N', 'es');
insert into user_group values('11', 'Padre',         '', '1024', '3', 'O', 'es');
insert into user_group values('12', 'Visitante',     '', '1024', '3', 'O', 'es');
###############################################################################
# création de la dba des droits
###############################################################################
insert into user_admin values('0',   'Proscritos', 'es');
insert into user_admin values('1',   'Usuario',    'es');
insert into user_admin values('2',   'Miembro',    'es');
insert into user_admin values('4',   'Moderador',  'es');
insert into user_admin values('8',   'Gerente',    'es');
insert into user_admin values('255', 'Gran jefe',  'es');
###############################################################################
# création de la dba des catégories d'utilisateurs
###############################################################################
insert into user_category values('1', 'Estudiante', 'es');
insert into user_category values('2', 'Personal',   'es');
insert into user_category values('3', 'Exterior',   'es');
###############################################################################
# création de la dba des identifiants
###############################################################################
insert into user_id values('','2', '1','0','','2002-09-01','2002-09-01','2002-09-01','255','director', '','Administrador','','H','Administrador de este intranet','mellaman gran hermano.',                                         '','','','','','','','','','De una zeta que significa Zorro !','0','0','0','0','0','O','N','E','N','N','O','','0','','es','0','0');
insert into user_id values('','2', '1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'profesor', '','Profesor',     '','H','Profesor del Establecimiento',  'Hago agujeros , pequeños agujeros , siempre pequeños agujeros .','','','','','','','','','','My name is Bond, James Bond.', '0','0','0','0','0','O','N','E','N','N','O','','0','','es','0','0');
insert into user_id values('','1', '1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'alumno',   '','Alumno',       '','H','Alumno del establecimiento',    '','','','','','','','','','','','0','0','0','0','0','N','N','E','N','N','O','','0','','es','0','0');
insert into user_id values('','12','1','0','','2002-09-01','2002-09-01','2002-09-01','1',  'visitante','','visitante',    '','A','Conexion anonima',              '','','','','','','','','','','','0','0','0','0','0','N','N','E','N','N','O','','0','','es','0','0');
###############################################################################
# création de la dba des fichiers mime
###############################################################################
insert into config_mime values('', 'htm',  'pagina web htm',                      'O', 'es');
insert into config_mime values('', 'html', 'pagina web html',                     'O', 'es');
insert into config_mime values('', 'pdf',  'documento Acrobat Reader',            'O', 'es');
insert into config_mime values('', 'xls',  'Micro$oft Excel',                     'O', 'es');
insert into config_mime values('', 'doc',  'Micro$oft Word',                      'O', 'es');
insert into config_mime values('', 'ppt',  'Micro$oft PowerPoint',                'O', 'es');
insert into config_mime values('', 'pps',  'Micro$oft PowerPoint',                'O', 'es');
insert into config_mime values('', 'pub',  'Micro$oft Publisher',                 'O', 'es');
insert into config_mime values('', 'mdb',  'Micro$oft Access',                    'O', 'es');
insert into config_mime values('', 'jpg',  'imagen al formato jpeg',              'O', 'es');
insert into config_mime values('', 'png',  'imagen al formato png',               'O', 'es');
insert into config_mime values('', 'gif',  'imagen al formato gif',               'O', 'es');
insert into config_mime values('', 'bmp',  'imagen al formato bitmap',            'O', 'es');
insert into config_mime values('', '7z',   'documento comprimido 7-zip',          'O', 'es');
insert into config_mime values('', 'zip',  'documento comprimido zip',            'O', 'es');
insert into config_mime values('', 'rar',  'documento comprimido rar',            'O', 'es');
insert into config_mime values('', 'mp3',  'fichero suido al formato mp3',        'O', 'es');
insert into config_mime values('', 'wav',  'fichero suido al formato wav',        'O', 'es');
insert into config_mime values('', 'mpg',  'fichero suido al formato mpeg',       'O', 'es');
insert into config_mime values('', 'ogg',  'fichero suido al formato ogg vorbis', 'O', 'es');
insert into config_mime values('', 'txt',  'documento texto sin compaginacion',   'O', 'es');
insert into config_mime values('', 'sxw',  'OpenOffice texteur',                  'O', 'es');
insert into config_mime values('', 'sxc',  'OpenOffice hoja de calculo',          'O', 'es');
insert into config_mime values('', 'sxd',  'OpenOffice dibujo',                   'O', 'es');
insert into config_mime values('', 'sxi',  'OpenOffice presentacion',             'O', 'es');
insert into config_mime values('', 'sxm',  'OpenOffice formulas',                 'O', 'es');
insert into config_mime values('', 'swf',  'documento Flash',                     'O', 'es');
insert into config_mime values('', 'ods',  'open documento hoja de calculo',      'O', 'es');
insert into config_mime values('', 'odt',  'open documento texteur',              'O', 'es');
insert into config_mime values('', 'odp',  'open documento présentacion',         'O', 'es');
insert into config_mime values('', 'odb',  'open documento base de dato',         'O', 'es');
insert into config_mime values('', 'rtf',  'documento Rich Text Format',          'O', 'es');
insert into config_mime values('', 'hlp',  'fichero Ayuda',                       'O', 'es');
insert into config_mime values('', 'php',  'fichero PHP',                         'O', 'es');
insert into config_mime values('', 'c++',  'fichero C++',                         'O', 'es');
insert into config_mime values('', 'wmv',  'fichero video al formato wmv',        'O', 'es');
insert into config_mime values('', 'avi',  'fichero video al formato avi',        'O', 'es');
insert into config_mime values('', 'tgz',  'documento comprimido tar.gz',         'O', 'es');
insert into config_mime values('', 'sql',  'script sql',                          'O', 'es');
insert into config_mime values('', 'cer',  'digital certificate',                 'O', 'es');
###############################################################################
# création de la dba des menus de la page d'accueil
###############################################################################
insert into config_menu values('1', 'MENU',            '', '1', 'N', 'home.png', '255', 'O', '', 'N', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '1', 'Inicio',           'item=0',                         'O', '1',  '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '1', '¿Quién es quién?', 'item=1',                         'O', '2',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Anuarios',         'item=11&cmde=lidi',              'O', '3',  '255', 'N', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Post-it',          'item=4',                         'O', '4',  '254', 'N', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Mensajeria',       'http://www.horde.org/imp/',      'O', '5',  '254', 'N', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Reservas',         'item=10',                        'O', '6',  '254', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Agendas',          'item=8',                         'O', '7',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Foros',            'item=3',                         'O', '8',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Charlas',          'item=14',                        'O', '9',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Galerias',         'item=5',                         'O', '10', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Publicaciones',    'item=6',                         'O', '11', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Ausencias',        'item=63&cmde=visu',              'O', '12', '255', 'N', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'horario',          'item=64',                        'O', '13', '255', 'N', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'e-grupo',          'item=17',                        'O', '14', '255', 'N', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Estadísticas ',    'item=7',                         'O', '15', '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '1', 'Desconexion',      'item=-1',                        'O', '16', '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_menu values('2', 'INFORMACION',     '', '3', 'N', 'infos.png',  '255', 'O', 'item=20&cmde=gestion', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '2', 'Mensajes del dia', 'item=18',                        'O', '1', '0',   'N', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '2', 'Noticias',         'item=15',                        'O', '2', '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_menu values('3', 'DOCUMENTOS',      '', '5', 'N', 'doc.png',    '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '3', 'Referenciales',    'item=35',                        'O', '1',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Administracion',   'item=31&IDres=1',                'O', '2',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Pedagogia',        'item=31&IDres=2',                'O', '3',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'En linea',         'item=31&IDres=3&cmde=online',    'O', '4',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Colaborativo',     'item=34',                        'O', '5',  '254', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Weblogs',          'item=36',                        'O', '6',  '254', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Recursos',         'item=32',                        'O', '7',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Registro CHS',     'item=37',                        'O', '8',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Espacio Numérico', 'item=45',                        'O', '9',  '255', 'N', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '3', 'Base documental',  'http://www.sigb.net/',           'O', '10', '255', 'N', 'N', '', 'O', '0', 'es');
insert into config_menu values('4', 'EMPRESAS',        '', '7',  'N', 'company.png', '255', 'O', 'item=40&cmde=gestion&IDmenu=1', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '4', 'Actualización',    'item=40&cmde=lieu',              'O', '1', '254', 'N', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '4', 'Visitas',          'item=40&cmde=visit',             'O', '2', '254', 'N', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '4', 'Fichas conexión',  'item=38',                        'O', '3', '254', 'N', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '4', 'Busqueda',         'item=40&cmde=search',            'O', '4', '255', 'N', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '4', 'Deposito de CV',   'item=40&cmde=cv',                'O', '5', '255', 'N', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '4', 'Espacio pro.',     'item=40&cmde=pro',               'O', '6', '255', 'N', 'N', '', 'O', '0', 'es');
insert into config_menu values('5', 'AYUDA',           '', '-9', 'N', 'support.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '5', 'Instalacion',      'http://promethee.eu.org/download/ftp/docs/documentos espanoles/Guia de instalacion.pdf', 'O', '1', '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '5', 'Presentacion',     'http://promethee.eu.org/download/ftp/docs/documentos espanoles/presentacion-es.pdf',     'O', '2', '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_menu values('6', 'VINCULOS',        '', '7',  'N', 'url.png',     '255', 'O', 'item=22&IDgroup=0', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('7', 'SONDEO',          '', '9',  'N', 'poll.png',    '255', 'O', 'item=99&IDdata=0&cmde=gestion', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('8', 'ADMINISTRADOR',   '', '-7', 'N', 'admin.png',   '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '1', 'es');
insert into config_submenu values('', '8', 'Acceso',             'item=21&cmde=access',            'O', '1', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Configuración',      'item=21',                        'O', '2', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Identificación',     'item=23',                        'O', '3', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Registros conexión', 'item=92',                        'O', '4', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Registros IP',       'item=24',                        'O', '5', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Webmail',            'item=25',                        'O', '6', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'phpMyAdmin',         'http://www.phpmyadmin.net/',     'O', '7', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Gerencia inventario','http://glpi-project.org/',       'O', '8', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Copia de seguridad', 'item=27&cmde=backup',            'O', '9', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Importación',        'item=27&cmde=import',            'O','10', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_submenu values('', '8', 'Perdí tablas',       'item=27&cmde=reset',             'O','11', '255', 'N', 'N', '', 'O', '1', 'es');
insert into config_menu values('9', 'SANTO DEL DIA',   '', '-4', 'N', 'today.png',   '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '9', 'Broma del día', '', 'O', '1', '255', 'N', 'N', 'N', 'N', '0', 'es');
insert into config_submenu values('', '9', 'Cotizaciones',  '', 'O', '2', '255', 'N', 'N', 'N', 'O', '0', 'es');
insert into config_submenu values('', '9', 'Perlas',        '', 'O', '3', '255', 'N', 'N', 'N', 'O', '0', 'es');
insert into config_menu values('10', 'BUSCAR',         '', '-6', 'N', 'search.png',  '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('11', '_STUDENT',       '', '6',  'N', 'student.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '11', 'Ausencias',           'item=63&cmde=show',               'O', '1',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Anterior _STUDENT',   'item=38&visu=N',                  'O', '2',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Lista _STUDENT',      'item=38',                         'O', '3',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Delegados',           'item=38&delegue=O',               'O', '4',  '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Lista de _CLASSs',    'item=9&cmde=class',               'O', '5',  '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'e-Porfolio',          'item=16&cmde=visu',               'O', '6',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'B2i-C2i',             'item=16&ident=B2i-C2i&cmde=visu', 'O', '7',  '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Hojas de notas',      'item=60',                         'O', '8',  '255', 'N', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Hojas de CCF',        'item=61',                         'O', '9',  '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Exámenes ',           'item=62',                         'O', '10', '255', 'O', 'N', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Cuaderno',            'item=13',                         'O', '11', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Cuaderno de Corres.', 'item=68',                         'O', '12', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Cuaderno de relacion','item=12',                         'O', '13', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Libreta de puntos',   'item=66',                         'O', '14', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Consignas',           'item=67',                         'O', '15', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'SGA',                 'item=17&IDitem=3',                'O', '16', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Enfermería',          'item=63&cmde=sick',               'O', '17', '255', 'O', 'O', '', 'O', '0', 'es');
insert into config_submenu values('', '11', 'Lista de los padres', 'item=38&cmde=parent',             'O', '18', '128', 'N', 'N', '', 'O', '0', 'es');
insert into config_menu values('12', '¿CUYO ALLI?',    '', '-8',  'N', 'who.png',     '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('13', 'ESTADISTICAS',   '', '-10', 'N', 'stats.png',   '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('14', 'SOFTWARE LIBRES', 'Firmar la <a href="http://petition.eurolinux.org">petición</a> para una Europa sin software patentado.', '-11', 'N', 'gnu.png', '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '14', 'GNU/Linux',         'http://www.linux.org',      'O', '1', '255', 'O', 'N', 'linuxpow.jpg',  'O', '0', 'es');
insert into config_submenu values('', '14', 'Apache',            'http://www.apache.org',     'O', '2', '255', 'O', 'N', 'apache.gif',    'O', '0', 'es');
insert into config_submenu values('', '14', 'MySQL',             'http://www.mysql.com',      'O', '3', '255', 'O', 'N', 'mysql.gif',     'O', '0', 'es');
insert into config_submenu values('', '14', 'PHP',               'http://www.php.net',        'O', '4', '255', 'O', 'N', 'php.gif',       'O', '0', 'es');
insert into config_submenu values('', '14', 'HORDE',             'http://www.horde.org/imp/', 'O', '5', '255', 'O', 'N', 'horde.png',     'O', '0', 'es');
insert into config_submenu values('', '14', 'fckEditor',         'http://www.fckeditor.net',  'O', '6', '255', 'O', 'N', 'fckeditor.gif', 'O', '0', 'es');
insert into config_submenu values('', '14', 'software libre',    'http://www.linuxfr.org',    'O', '7', '255', 'O', 'N', 'LL.png',        'O', '0', 'es');
insert into config_menu values('15', '¿ALGO NUEVO?',    '', '3',  'O', 'news.png',     '255', 'O', 'item=30&cmde=gestion', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('16', 'CALENDARIO',      '', '-3', 'N', 'calendar.png', '255', 'O', 'item=15&cmde=post&IDflash=0', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('17', 'e-CAMPO',         '', '-1', 'N', 'campus.png',   '255', 'O', 'item=9&IDres=2&cmde=gestion', 'O', 'O', 'O', 'campus_menu', '0', 'es');
insert into config_menu values('18', 'CAJA DE IDEAS',   '', '-5', 'N', 'box.png',      '255', 'O', '', 'O', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_menu values('19', 'e-GROUPOS',       '', '-2', 'N', 'egroup.png',   '255', 'O', 'item=17&cmde=gestion', 'O', 'O', 'O', 'egroup_menu', '0', 'es');
insert into config_menu values('20', 'MI ENT',          '', '2',  'N', 'manager.png',  '255', 'O', '', 'N', 'O', 'O', 'config_submenu', '0', 'es');
insert into config_submenu values('', '20', 'Mi cuenta',            'item=1&cmde=account&show=0', 'O', '1',  '254', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mi espacio',           'item=45&cmde=visu',          'O', '2',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mi agenda',            'item=8&cmde=mvc',            'O', '3',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mi blog',              'item=36&cmde=visu',          'O', '4',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mi anuario',           'item=11&cmde=address',       'O', '5',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mi e-portfolio',       'item=16&cmde=mvc',           'O', '6',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mis formaciones',      'item=40&cmde=mvc',           'O', '7',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mis ausencias',        'item=63&cmde=mvc',           'O', '8',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Cuaderno',             'item=13&cmde=mvc',           'O', '9',  '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Cuaderno de relacion', 'item=12&cmde=mvc',           'O', '10', '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Libreta de puntos',    'item=66&cmde=mvc',           'O', '11', '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Correspondencia',      'item=68&cmde=mvc',           'O', '12', '255', 'N', 'N', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Informe incidente',    'item=39',                    'O', '13', '255', 'N', 'O', '', 'O', '2', 'es');
insert into config_submenu values('', '20', 'Mis preferencias',     'item=1&cmde=skin',           'O', '14', '255', 'N', 'N', '', 'O', '0', 'es');
insert into config_menu values('21', 'DONACIÓN',         '', '-12', 'N', 'money.png',   '255', 'O', '', 'O', 'O', 'N', 'config_submenu', '0', 'es');
###############################################################################
# création de la dba des types de messages
###############################################################################
insert into postit_type values('0', 'Mensaje sistema',     'N', 'es');
insert into postit_type values('1', 'Mensaje',             'O', 'es');
insert into postit_type values('2', 'Detallada teléfonoe', 'O', 'es');
###############################################################################
# création de la dba des liens
###############################################################################
insert into link values('', '0', '0', '255', 'Investigación www',                'http://www.google.com',       'un Search Engine muy popular.', 'uk.png', 'O', '0', 'es');
insert into link values('', '0', '0', '255', 'Prométhée',                        'http://promethee.eu.org',     'El Espacio Numérico de Trabajo « llave en mano » Libre y gratuito.', 'es.png', 'O', '0', 'es');
insert into link_data values('8', '0', '0', '0', 'Cultura',      '', 'O', 'es');
insert into link values('', '8', '0', '255', 'Wikipedia, la enciclopedia libre', 'http://www.wikipedia.org/',   '', 'uk.png', 'O', '0', 'es');
insert into link values('', '8', '0', '255', 'Mapas satélites',                  'http://maps.google.com/',     '', 'uk.png', 'O', '0', 'es');
insert into link_data values('9', '0', '0', '0', 'Free sofware', '', 'O', 'es');
insert into link values('', '9', '0', '255', 'Proyecto GNU',                     'http://www.gnu.org/',         'donde todos comenzaron!', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'Free Software Foundation',         'http://www.fsfeurope.org/',   '', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'MySQL',                            'http://www.mysql.com/',       'La base de datos abierta más popular de la fuente del mundo.', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'OpenOffice',                       'http://www.openoffice.org',   'OpenOffice.org es un multiplatform y una habitación multilingüe de la oficina y un proyecto de la abrir-fuente.', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'FireFox',                          'http://www.mozilla.org/',     'El redescubrimiento de la tela.', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'Scribus',                          'http://www.scribus.net/',     'Scribus es un programa de la abrir-fuente que trae la disposición de página profesional premiada con una combinación salida “presionar-lista de la” y de los nuevos acercamientos a la disposición de página.', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'Pidgin',                           'http://www.pidgin.im/',       'Pidgin es un cliente inmediato multi-protocol de la mensajería que permite que utilices todas tus cuentas IM inmediatamente.', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'Nvu',                              'http://www.nvu.com/',         'Hace el manejo de un Web site un broche de presión.', 'uk.png', 'O', '0', 'es');
insert into link values('', '9', '0', '255', 'VideoLAN',                         'http://www.videolan.org/',    'VideoLAN es un proyecto del software, que produce el software libre para el vídeo (ogg, mp3, divx, dvd, ...).', 'uk.png', 'O', '0', 'es');
###############################################################################
# création de la dba ftp
###############################################################################
insert into ftp values('', '0', '30', '31', 'servidor de Intranet', 'download/ftp/serveur', 'Varios documentos para descargar.', '', '', 'C', '1', 'O', 'es');
###############################################################################
# création de la dba des ressources
###############################################################################
insert into resource values('1','0','0','0','Administracion','Documentos administrativos al uso de los usuarios.', '11', 'N', 'N', 'O', 'es');
insert into resource values('2','0','0','0','Pedagogia',     'Documentos pédagogicos al uso de los alumnos.',      '11', 'N', 'N', 'O', 'es');
insert into resource values('3','0','0','0','En linea',      'Recursos pédagogicos en linea.',                     '11', 'N', 'O', 'O', 'es');
insert into resource values('4','0','0','0','e-grupo',       'Recursos de grupos virtuales.',                      '11', 'N', 'O', 'O', 'es');
###############################################################################
# création de la dba des catégories de ressources
###############################################################################
insert into resource_data values('','1','0','8','255','Documentos modelo',       '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','1','0','8','255','Nota de servicio',        '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','1','0','8','255','Informes CA, CI, CE',     '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','1','0','8','255','Proyectos PUS, PAE, etc', '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','1','0','8','255','Estructuras pedagogicas', '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','1','0','8','255','Diverso',                 '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Agronomia',               '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Ingles',                  '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Aleman',                  '', '0', '1', 'N', '1', 'O', 'N', 'es');
insert into resource_data values('','2','0','2','255','Biologia',                '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Economia',                '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','EFD',                     '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','ESC',                     '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','español',                 '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Frances',                 '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Historia y Geografia',    '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Informatica',             '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Italiano',                '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Maquinismo',              '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Matematicas',             '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Filosofia',               '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Fitotecnia',              '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Ciencias Fisicas',        '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','2','0','2','255','Zootecnia',               '', '0', '1', 'N', '1', 'O', 'O', 'es');
insert into resource_data values('','3','0','2','255','En linea',                '', '0', '1', 'N', '1', 'O', 'O', 'es');
###############################################################################
# création de la dba des licences des ressources
###############################################################################
insert into resource_license values('1', '??',         'tipo de licencia','O','es');
insert into resource_license values('2', 'GPL',        'GNU General Public License','O','es');
insert into resource_license values('3', 'LGPL',       'GNU Lesser General Public License','O','es');
insert into resource_license values('4', 'FDL',        'licencia en rebeldia para los documentos personales','O','es');
insert into resource_license values('5', 'Free Art',   'Licencia arte Libre','O','es');
insert into resource_license values('6', 'DP',         'documento del ámbito público','O','es');
insert into resource_license values('7', 'CC-by',      'licenciae Creative Commons (by)','O','es');
insert into resource_license values('8', 'CC-by-nd',   'licence Creative Commons (by-nd)','O','es');
insert into resource_license values('9', 'CC-by-nc-nd','licence Creative Commons (by-nc-nd)','O','es');
insert into resource_license values('10','CC-by-nc',   'licence Creative Commons (by-nc)','O','es');
insert into resource_license values('11','CC-by-nc-sa','licence Creative Commons (by-nc-sa)','O','es');
insert into resource_license values('12','CC-by-sa',   'licence Creative Commons (by-sa)','O','es');
insert into resource_license values('13','(C)',        'documento bajo copyright','O','es');
###############################################################################
# création de la dba des types des ressources
###############################################################################
insert into resource_type values('1', 'Situaciones pedagógicas','O','es');
insert into resource_type values('2', 'Progresiones y programaciones','O','es');
insert into resource_type values('3', 'Évaluaciones','O','es');
insert into resource_type values('4', 'sitios pedagogicos','O','es');
insert into resource_type values('5', 'sitios para minos','O','es');
insert into resource_type values('6', 'Horarios','O','es');
insert into resource_type values('7', 'Otros sitios','O','es');
insert into resource_type values('8', 'Software','O','es');
insert into resource_type values('9', 'imágenes ','O','es');
insert into resource_type values('10','Videos','O','es');
insert into resource_type values('11','Sonidos ','O','es');
insert into resource_type values('12','Trucos y astucias','O','es');
insert into resource_type values('13','Enciclopedias y Diccionarios','O','es');
###############################################################################
# création de la dba des fonctions associées aux ressources
###############################################################################
insert into resource_function values('1','Para preparar la clase','O','es');
insert into resource_function values('2','Para administrar una escuela','O','es');
insert into resource_function values('3','Para formarse e informarse','O','es');
insert into resource_function values('4','Para el acompañamiento escolar','O','es');
###############################################################################
# création de la dba des absences
###############################################################################
insert into absent_data values('1',  'Ausencia ', 'O','es');
insert into absent_data values('2',  'Retraso', 'O','es');
insert into absent_data values('3',  'Enfermeria', 'O','es');
insert into absent_data values('4',  'Salida', 'O','es');
insert into absent_data values('5',  'Explotación ', 'O','es');
insert into absent_data values('6',  'Convocatoria externa', 'O','es');
insert into absent_data values('7',  'Convocatoria interna', 'O','es');
insert into absent_data values('8',  'Dispensa taller', 'O','es');
insert into absent_data values('9',  'Dispensa EFD', 'O','es');
insert into absent_data values('10', 'Exclusion', 'O','es');
insert into absent_data values('11', 'Problema de transporte', 'O','es');
insert into absent_data values('12', 'Cita medical', 'O','es');
insert into absent_data values('13', 'Excluido', 'O','es');
insert into absent_data values('14', 'Cursillo', 'O','es');
insert into absent_data values('15', 'Enfermedad', 'O','es');
insert into absent_data values('16', 'Otro', 'O','es');
###############################################################################
# création de la dba des pages des documents collaboratifs
###############################################################################
insert into wiki_page values('', '0', '0', 'repertorio raiz', '2002-09-01',  '2002-09-01', '0', '254', '254', 'O', '0', 'O', 'es');
###############################################################################
# création de la dba des intitulés des résultats aux examens
###############################################################################
insert into exam_items values('1', '-', 'es');
insert into exam_items values('2', 'Aprobado', 'es');
insert into exam_items values('3', 'Suspendido', 'es');
insert into exam_items values('4', 'Seconda sesion', 'es');
insert into exam_items values('5', 'Oral', 'es');
insert into exam_items values('6', 'Ausente', 'es');
###############################################################################
# création de la dba des intitulés des edt
###############################################################################
insert into edt values('1', '0', '0', '255', 'salas',          '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'es');
insert into edt values('2', '0', '0', '255', 'cuerpo docente', '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'es');
insert into edt values('3', '0', '0', '255', 'alumnos',        '255', '8:00;8:30;9:00;9:30;10:00;10:30;11:00;11:30;12:00;12:30;13:00;13:30;14:00;14:30;15:00;15:30;16:00;16:30;17:00;17:30;18:00;18:30;19:00', 'O', 'es');
###############################################################################
# création de la dba des intitulés des salles
###############################################################################
insert into edt_items values('1', '1', 'laboratorio fisica-quimica', 'es');
insert into edt_items values('2', '1', 'laboratorio Biologia', 'es');
insert into edt_items values('3', '1', 'laboratorio Informatica', 'es');
insert into edt_items values('4', '1', 'sala video', 'es');
insert into edt_items values('5', '1', 'sala de examenes', 'es');
insert into edt_items values('6', '1', 'anfiteatro', 'es');
insert into edt_items values('7', '1', 'Centro de documentacion', 'es');
###############################################################################
# création de la dba des semaines des edt
###############################################################################
insert into edt_week values('1', 'S1', 'es');
insert into edt_week values('2', 'S2', 'es');
###############################################################################
# création de la dba des type d'incidents techniques
###############################################################################
insert into support_data values('1', 'Informática (hardware)', 'es');
insert into support_data values('2', 'Informática (software)', 'es');
insert into support_data values('3', 'Uso de los ENT',         'es');
insert into support_data values('4', 'Otros',                  'es');
###############################################################################
# création de la dba des catégories de sanctions du carnet à points
###############################################################################
insert into carnet_type values('1', 'Comportamiento', 'es');
insert into carnet_type values('2', 'Internado', 'es');
insert into carnet_type values('3', 'Trabajo', 'es');
###############################################################################
# création de la dba du barême du carnet à points
###############################################################################
insert into carnet_items values('1',  '1', '-2',  'puntualidad  (retrasos repetidos sin justificacion)', 'es');
insert into carnet_items values('2',  '1', '-2',  'Charlas continuas', 'es');
insert into carnet_items values('3',  '1', '-2',  'Actitud ruidosa', 'es');
insert into carnet_items values('4',  '1', '-2',  'Ropa o actitud provocadora o perturbadora', 'es');
insert into carnet_items values('5',  '1', '-3',  'No respecto de la limpieza en el establecimiento y sus alrededores (papeles, colillas,...)', 'es');
insert into carnet_items values('6',  '1', '-3',  'Utilización del teléfono movil en clase o durante los estudios obligatorios.', 'es');
insert into carnet_items values('7',  '1', '-3',  'Ausentismo / ausencia injustificada', 'es');
insert into carnet_items values('8',  '1', '-3',  'No respecto del reglamento interior (ex : zona « fumadores »)', 'es');
insert into carnet_items values('9',  '1', '-3',  'Agitacion / exclusion de clase', 'es');
insert into carnet_items values('10', '1', '-4',  'Insolencia caractarezida / palabra irrespetuosas', 'es');
insert into carnet_items values('11', '1', '-5',  'Dégradacion (lugares / matérieles)', 'es');
insert into carnet_items values('12', '1', '-12', 'Disparo voluntario de una alarma incendio', 'es');
insert into carnet_items values('13', '1', '-5',  'Posesion de objetos peligrosos (cutters, etc... fuera del escolar o profesional)', 'es');
insert into carnet_items values('14', '1', '-6',  'Salida sin autorizacion', 'es');
insert into carnet_items values('15', '1', '-6',  'Falsificacion de firma o de documentos', 'es');
insert into carnet_items values('16', '1', '-12', 'Violencia verbal, agresion fisica, palabras discriminatorias', 'es');
insert into carnet_items values('17', '1', '-12', 'Introduccion y / o consumo de productos prohibidos en el establecimiento', 'es');
insert into carnet_items values('18', '1', '-12', 'Robo / complicidad de robo / extorsion', 'es');

insert into carnet_items values('1',  '2', '-2',  'No respeto  de los horarios', 'es');
insert into carnet_items values('2',  '2', '-2',  'Cuarto desordenado', 'es');
insert into carnet_items values('3',  '2', '-2',  'Actitud ruidosa', 'es');
insert into carnet_items values('4',  '2', '-5',  'Dégradacion del mobiliario', 'es');
insert into carnet_items values('5',  '2', '-1',  'Salida no permitida', 'es');
insert into carnet_items values('6',  '2', '-1',  'Novatada  (* aplication de la lex)', 'es');

insert into carnet_items values('1',  '3', '-1',  'Olvido de material', 'es');
insert into carnet_items values('2',  '3', '-1',  'Trabajo entreyado con retraso', 'es');
insert into carnet_items values('3',  '3', '-2',  'Trabajo no hecho', 'es');
insert into carnet_items values('4',  '3', '-4',  'No apuntar el curso', 'es');
insert into carnet_items values('5',  '3', '-6',  'Negarse  a obedecer', 'es');
insert into carnet_items values('6',  '3', '-6',  'Fraude / trampa', 'es');

insert into carnet_items values('7',  '3', '1',   'motivacion y regularidad en el trabajo durante varias semanas consecutivas.', 'es');
insert into carnet_items values('8',  '3', '1',   'actitud irreprochable durante varias semanas consecutivas.', 'es');
insert into carnet_items values('9',  '3', '1',   'participacion a la vida asociativa durante varias semanas consecutivas.', 'es');
insert into carnet_items values('10', '3', '1',   'toma de iniciativa social o cultural durante varias semanas consecutivas.', 'es');
###############################################################################
insert into absent_motif values('1 ', 'atención',                  'es');
insert into absent_motif values('2 ', 'descanso el de enfermería', 'es');
insert into absent_motif values('3 ', 'Volver a hogar',            'es');
insert into absent_motif values('4 ', 'visita incorrecta',         'es');
insert into absent_motif values('5 ', 'si no se presenta',         'es');
###############################################################################