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
insert into egroup_items values('1','expresion cultural','O','es');
insert into egroup_items values('2','Grupos de trabajo', 'O','es');
insert into egroup_items values('3','SGA',               'O','es');
###############################################################################
# création de la dba des e-groupes
###############################################################################
insert into egroup values('','1','0','0','0','255','2005-01-01','','Internet','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Informatica','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Cultura y Arte','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Juegos','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Entretenimientos y bricolaje','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Musica','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Deporte','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Educacion','','N','O','es');
insert into egroup values('','1','0','0','0','255','2005-01-01','','Ciencia','','N','O','es');
insert into egroup values('','2','0','0','0','255','2005-01-01','','Comisiares internas','','N','O','es');
insert into egroup values('','2','0','0','0','255','2005-01-01','','Extraescolar','','N','O','es');
insert into egroup values('','3','0','0','0','255','2005-01-01','','Économia y gestion','','N','O','es');
insert into egroup values('','3','0','0','0','255','2005-01-01','','Trabajo y sociedad','','N','O','es');
insert into egroup values('','3','0','0','0','255','2005-01-01','','Ciencias y TIC','','N','O','es');
insert into egroup values('','3','0','0','0','255','2005-01-01','','Ciencias y tecnicas industriales','','N','O','es');

insert into egroup values('','1','1','0','0','255','2005-01-01','','Redes','','N','O','es');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Cibercultura','','N','O','es');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Educacion','','N','O','es');
insert into egroup values('','1','1','0','0','255','2005-01-01','','Internet','','N','O','es');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Proyectos','','N','O','es');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Multimedia','','N','O','es');
insert into egroup values('','1','2','0','0','255','2005-01-01','','software','','N','O','es');
insert into egroup values('','1','2','0','0','255','2005-01-01','','lenguajes de programación','','N','O','es');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Seguridad','','N','O','es');
insert into egroup values('','1','2','0','0','255','2005-01-01','','Material','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Actores y Actrices','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Pintura','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Cinema','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Artes culinarios','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Mitologia y Folklore','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Apellidos','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Radio','','N','O','es');
insert into egroup values('','1','3','0','0','255','2005-01-01','','Télévision','','N','O','es');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Juegos de bandejas','','N','O','es');
insert into egroup values('','1','4','0','0','255','2005-01-01','','juego de tarjetas  ','','N','O','es');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Juego vidéo','','N','O','es');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Juego por correspondancia','','N','O','es');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Juego de dramatizaciones','','N','O','es');
insert into egroup values('','1','4','0','0','255','2005-01-01','','Wargames','','N','O','es');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Colecciones','','N','O','es');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Bricolaje','','N','O','es');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Entretenimientos','','N','O','es');
insert into egroup values('','1','5','0','0','255','2005-01-01','','Modelismo','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Blues','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Celtico','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Clasico','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Country','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Electronico','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Expérimental','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Jazz','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Reggae','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Rock and Pop','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Disco','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Funk','','N','O','es');
insert into egroup values('','1','6','0','0','255','2005-01-01','','Opera','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Baloncesto','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Boxeo','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Ciclismo','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Deportes extremos ','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Golf','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Gimnasia','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Balonmano','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Hockey','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Artes Martiales','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Juegos olímpicos ','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Rugby','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','esquí ','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Snowboarding','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','fútbol','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Tenis de mesa','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Tenis','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','Triatlon','','N','O','es');
insert into egroup values('','1','7','0','0','255','2005-01-01','','ballonvolea','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Biologia','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Química ','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Ciencias naturales','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Geografía','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Historia','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Matematicas','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Idiomas','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Ciencia fisica','','N','O','es');
insert into egroup values('','1','8','0','0','255','2005-01-01','','Economia','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Astronomia','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Biologia','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Quimica','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Ciencias naturales','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Ecología','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Ingenieria','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Matématicas','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Nanotecnologia','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','ciencia fisica','','N','O','es');
insert into egroup values('','1','9','0','0','255','2005-01-01','','Exploracion espatial','','N','O','es');
insert into egroup values('','2','10','0','0','255','2005-01-01','','CHSCT','','N','O','es');
insert into egroup values('','2','10','0','0','255','2005-01-01','','Comision TIM','','N','O','es');
insert into egroup values('','2','10','0','0','255','2005-01-01','','Control de trabajos','','N','O','es');
insert into egroup values('','2','11','0','0','255','2005-01-01','','Asociacion de alumnos','','N','O','es');
insert into egroup values('','2','11','0','0','255','2005-01-01','','Antiguos alumnos','','N','O','es');
insert into egroup values('','2','11','0','0','255','2005-01-01','','Padres de alumnos','','N','O','es');
insert into egroup values('','2','11','0','0','255','2005-01-01','','UNSS','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Seguros, banco, finanzas','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Logistica - Transporte - Turismo','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Urbanismo - Acondicionamiento - Gestion de las administraciones locales','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Contabilidad, control, auditoria','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Comercio, marqueting, venta, compra','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Gestion y desarrollo de salud','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Gestion de empresas','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Economia y comercio internacional','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Historia de las tecnicas','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Derecho de los negocios','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Innovacion, prospectiva, tecnociencias y sociedad','','N','O','es');
insert into egroup values('','3','12','0','0','255','2005-01-01','','Formaciones generales en EG','','N','O','es');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Ergonomia - Handicap','','N','O','es');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Derecho social - Relaciones humanas - Organizacion','','N','O','es');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Psicologia del trabajo, psicoanalisis','','N','O','es');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Comunicacion - Idiomas','','N','O','es');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Formacion y recorridos profesionales','','N','O','es');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Formaciones de primer ciclo','','N','O','es');
insert into egroup values('','3','13','0','0','255','2005-01-01','','Sociologia - Trabajo social - Proteccion social','','N','O','es');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Electronica - Automatico','','N','O','es');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Informacion y comunicacion cientificas y tecnicas','','N','O','es');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Informatica','','N','O','es');
insert into egroup values('','3','14','0','0','255','2005-01-01','','Matematicas','','N','O','es');
insert into egroup values('','3','15','0','0','255','2005-01-01','','química - Alimentacion - Salud y medio ambiente','','N','O','es');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Materiales','','N','O','es');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Energetica - Electrotecnica','','N','O','es');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Mecanica, acústica , Aerodinamica','','N','O','es');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Ingeniera civil - Edificio - Géotecnica','','N','O','es');
insert into egroup values('','3','15','0','0','255','2005-01-01','','Ciencias y técnicas del análisis de la medida ','','N','O','es');
###############################################################################
# création de la dba des intitulés des menus des egroups des utilisateurs
###############################################################################
insert into egroup_menu values('1', '1','Foros',   'Charlar con los otros usuarios a través de temas de debate.',           'item=3',           'O','255','O','N','O','es');
insert into egroup_menu values('2', '1','Ficheros','Almacenar y compartir documentos',                                      'item=31',          'O','255','O','N','O','es');
insert into egroup_menu values('3', '1','Agendas', 'Organizar una agenda compartido cogiendo los sucesos que lo componen.', 'item=8',           'O','255','O','N','O','es');
insert into egroup_menu values('4', '1','Fotos',   'Deponer y publicar facilmente fotos.',                                  'item=5',           'O','255','O','N','O','es');
insert into egroup_menu values('5', '1','Sondeos', 'Lanzar sondeos par pedir la opinion de los miembros del e-grupo.',      'item=99&cmde=visu','O','255','O','N','O','es');
insert into egroup_menu values('6', '1','Weblog',  'Redactar y publicar articulos',                                         'item=36&cmde=visu','O','255','O','N','O','es');
insert into egroup_menu values('7', '1','Wiki',    'Crear y compartir documentos colaborativos',                            'item=34',          'O','255','O','N','O','es');
insert into egroup_menu values('8', '1','Charlas', 'Charlar en vivo con los otros miembros.',                               'item=14&cmde=chat','O','255','O','N','O','es');
insert into egroup_menu values('9', '1','vínculos','Compartir direcciones de sitios utiles.',                               'item=22',          'O','255','O','N','O','es');
insert into egroup_menu values('10','1','Miembros','Conocer los membros de este grupo.',                                    'item=17&cmde=user','O','255','O','N','O','es');
insert into egroup_menu values('11','1','Post-it', 'Para enviar un mensaje a los miembros de este e-grupo.',                'item=4&cmde=post', 'O','255','O','N','O','es');
insert into egroup_menu values('12','1','Anuncios','Visualizar y compartir los anuncios',                                   'item=15',          'O','255','O','N','O','es');

insert into egroup_menu values('1','2','Forums',  'Charlar con los otros usuarios a través de temas de debate.',            'item=3',           'O','255','O','N','O','es');
insert into egroup_menu values('2','2','Fichiers','Almacenar y compartir documentos.',                                      'item=31',          'O','255','O','N','O','es');
insert into egroup_menu values('3','2','Agendas', 'Organizar una agenda compartido cogiendo los sucesos que lo componen..', 'item=8',           'O','255','O','N','O','es');
insert into egroup_menu values('4','2','Fotos',   'Deponer y publicar facilmente fotos.',                                   'item=5',           'O','255','O','N','O','es');
insert into egroup_menu values('5','2','Weblog',  'Redactar y publicar articulos',                                          'item=36&cmde=visu','O','255','O','N','O','es');
insert into egroup_menu values('6','2','Wiki',    'Crear y compartir documentos colaborativos',                             'item=34',          'O','255','O','N','O','es');
insert into egroup_menu values('7','2','vínculos','Compartir direcciones de sitios utiles.',                                'item=22',          'O','255','O','N','O','es');
insert into egroup_menu values('8','2','Miembros','Conocer los membros de este grupo.',                                     'item=17&cmde=user','O','255','O','N','O','es');
insert into egroup_menu values('9','2','Anuncios','Visualizar y compartir los anuncios',                                    'item=15',          'O','255','O','N','O','es');

insert into egroup_menu values('1', '3','Documents',                 'acceder a documentos pedagogicos',        'item=31',                'O','255','O','N','O','es');
insert into egroup_menu values('2', '3','Foros',                     'enviar mensajes a un foro',               'item=3',                 'O','255','O','N','O','es');
insert into egroup_menu values('3', '3','Galerias',                  'visualizar galerias de imágenes',         'item=5',                 'O','255','O','N','O','es');
insert into egroup_menu values('4', '3','Trabajo para devolver',     'depositar trabajos o examenes hechos',    'item=9&cmde=work',       'O','255','O','N','O','es');
insert into egroup_menu values('5', '3','Ejercicios',                'efectuar ejercicios en linea',            'item=50',                'O','255','O','N','O','es');
insert into egroup_menu values('6', '3','Cursos',                    'telecargar soportes de cursos o apuntes', 'item=33',                'O','255','O','N','O','es');
insert into egroup_menu values('7', '3','Referencias',               'telecargar las referencias de formacion', 'item=35&cmde=cursus',    'O','255','O','N','O','es');
insert into egroup_menu values('8', '3','Anuncios',                  'visualizar anuncios',                     'item=9&cmde=breve',      'O','255','O','N','O','es');
insert into egroup_menu values('9', '3','Agenda',                    'consultar agendas de cursos o apuntes',   'item=8',                 'O','255','O','N','O','es');
insert into egroup_menu values('10','3','Sondeos ',                  'responder a sondeos',                     'item=99&cmde=visu',      'O','255','O','N','O','es');
insert into egroup_menu values('11','3','B2i-C2i',                   'consultar su cuaderno electronico',       'item=1&visu=1&cmde=show','O','255','O','N','O','es');
insert into egroup_menu values('12','3','Vínculos',                  'consultar vínculos',                      'item=9&cmde=link',       'O','255','O','N','O','es');
insert into egroup_menu values('13','3','e-Portafolio',              'dirigir las competencias escolares',      'item=1&visu=1&cmde=show','O','255','O','N','O','es');
insert into egroup_menu values('14','3','Chateo',                    'dialogo en directo',                      'item=14&cmde=chat',      'O','255','O','N','O','es');
insert into egroup_menu values('15','3','Cuaderno de textos y datos','consultar el cuaderno numerico',          'item=13',                'O','255','O','N','O','es');
insert into egroup_menu values('16','3','Miembros',                  'Conocer los miembros de este grupo.',     'item=17&cmde=user',      'O','255','O','N','O','es');
###############################################################################
# création de la dba des des droits d'accès des utilisateurs pour les e-groupes
###############################################################################
insert into egroup_access values('-1', 'En espera','es');
insert into egroup_access values('0',  'Proscritos','es');
insert into egroup_access values('1',  'Lector','es');
insert into egroup_access values('3',  'Miembros','es');
insert into egroup_access values('7',  'Moderador','es');
###############################################################################