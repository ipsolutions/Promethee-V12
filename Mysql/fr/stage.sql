##############################################################################
#    Copyright (c) 2002-2005 by Dominique Laporte (C-E-D@wanadoo.fr)         #
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
# création de la dba des types de qualifications
###############################################################################
insert into cv_level values('', '< 1 an', 'fr');
insert into cv_level values('', '1 à 2 ans', 'fr');
insert into cv_level values('', '2 à 5 ans', 'fr');
insert into cv_level values('', '5 à 10 ans', 'fr');
insert into cv_level values('', '> 10 ans', 'fr');
###############################################################################
# création de la dba des diplômes
###############################################################################
insert into cv_degree values('', 'Agrégation', 'fr');
insert into cv_degree values('', 'Baccalauréat', 'fr');
insert into cv_degree values('', 'BEP', 'fr');
insert into cv_degree values('', 'BTS', 'fr');
insert into cv_degree values('', 'CAP', 'fr');
insert into cv_degree values('', 'CAPES', 'fr');
insert into cv_degree values('', 'DEA', 'fr');
insert into cv_degree values('', 'DESS', 'fr');
insert into cv_degree values('', 'DEST Cnam', 'fr');
insert into cv_degree values('', 'DEUG', 'fr');
insert into cv_degree values('', 'Diplôme d\'ingénieur', 'fr');
insert into cv_degree values('', 'Diplôme école de commerce', 'fr');
insert into cv_degree values('', 'Doctorat', 'fr');
insert into cv_degree values('', 'DU', 'fr');
insert into cv_degree values('', 'DUT', 'fr');
insert into cv_degree values('', 'IUP', 'fr');
insert into cv_degree values('', 'Licence', 'fr');
insert into cv_degree values('', 'Magistère', 'fr');
insert into cv_degree values('', 'Maitrise', 'fr');
insert into cv_degree values('', 'MST', 'fr');
insert into cv_degree values('', 'TOEIC', 'fr');
###############################################################################
# création de la dba des langues connues
###############################################################################
insert into cv_langtype values('', 'Allemand', 'fr');
insert into cv_langtype values('', 'Anglais', 'fr');
insert into cv_langtype values('', 'Arabe', 'fr');
insert into cv_langtype values('', 'Chinois', 'fr');
insert into cv_langtype values('', 'Corse', 'fr');
insert into cv_langtype values('', 'Danois', 'fr');
insert into cv_langtype values('', 'Espagnol', 'fr');
insert into cv_langtype values('', 'Esperanto', 'fr');
insert into cv_langtype values('', 'Finnois', 'fr');
insert into cv_langtype values('', 'Français', 'fr');
insert into cv_langtype values('', 'Grecque', 'fr');
insert into cv_langtype values('', 'Hongrois', 'fr');
insert into cv_langtype values('', 'Islandais', 'fr');
insert into cv_langtype values('', 'Italien', 'fr');
insert into cv_langtype values('', 'Japonais', 'fr');
insert into cv_langtype values('', 'Laotien', 'fr');
insert into cv_langtype values('', 'Néerlandais', 'fr');
insert into cv_langtype values('', 'Norvégien', 'fr');
insert into cv_langtype values('', 'Polonais', 'fr');
insert into cv_langtype values('', 'Portugais', 'fr');
insert into cv_langtype values('', 'Roumain', 'fr');
insert into cv_langtype values('', 'Russe', 'fr');
insert into cv_langtype values('', 'Suédois', 'fr');
insert into cv_langtype values('', 'Tcheques', 'fr');
insert into cv_langtype values('', 'Thailandais', 'fr');
insert into cv_langtype values('', 'Turque', 'fr');
insert into cv_langtype values('', 'Vietnamien', 'fr');
insert into cv_langtype values('', 'Yougoslave', 'fr');
###############################################################################
# création de la dba des pays
###############################################################################
insert into cv_country values('', 'Algérie', 'fr');
insert into cv_country values('', 'Allemagne', 'fr');
insert into cv_country values('', 'Argentine', 'fr');
insert into cv_country values('', 'Australie', 'fr');
insert into cv_country values('', 'Belgique', 'fr');
insert into cv_country values('', 'Bresil', 'fr');
insert into cv_country values('', 'Cameroun', 'fr');
insert into cv_country values('', 'Canada', 'fr');
insert into cv_country values('', 'Chine', 'fr');
insert into cv_country values('', 'Côte d\'Ivoire', 'fr');
insert into cv_country values('', 'Espagne', 'fr');
insert into cv_country values('', 'Etats Unis', 'fr');
insert into cv_country values('', 'Finlande', 'fr');
insert into cv_country values('', 'France', 'fr');
insert into cv_country values('', 'Gabon', 'fr');
insert into cv_country values('', 'Hongrie', 'fr');
insert into cv_country values('', 'Irlande', 'fr');
insert into cv_country values('', 'Italie', 'fr');
insert into cv_country values('', 'Japon', 'fr');
insert into cv_country values('', 'Luxembourg', 'fr');
insert into cv_country values('', 'Mali', 'fr');
insert into cv_country values('', 'Maroc', 'fr');
insert into cv_country values('', 'Norvege', 'fr');
insert into cv_country values('', 'Pays Bas', 'fr');
insert into cv_country values('', 'Pologne', 'fr');
insert into cv_country values('', 'Roumanie', 'fr');
insert into cv_country values('', 'Royaume uni', 'fr');
insert into cv_country values('', 'Russie', 'fr');
insert into cv_country values('', 'Sénégal', 'fr');
insert into cv_country values('', 'Suède', 'fr');
insert into cv_country values('', 'Suisse', 'fr');
insert into cv_country values('', 'Togo', 'fr');
insert into cv_country values('', 'Tunisie', 'fr');
###############################################################################
# création de la dba de maîtrise des langues
###############################################################################
insert into cv_langlevel values('', 'Notions', 'fr');
insert into cv_langlevel values('', 'Lu', 'fr');
insert into cv_langlevel values('', 'Lu, parlé', 'fr');
insert into cv_langlevel values('', 'Lu, parlé, écrit', 'fr');
insert into cv_langlevel values('', 'Langue maternelle', 'fr');
insert into cv_langlevel values('', 'Parfaitement maîtrisé', 'fr');
###############################################################################
# création de la dba des type de contrats
###############################################################################
insert into cv_contrat values('', 'Apprentissage', 'fr');
insert into cv_contrat values('', 'CDD', 'fr');
insert into cv_contrat values('', 'CDI', 'fr');
insert into cv_contrat values('', 'Freelance', 'fr');
insert into cv_contrat values('', 'Stage', 'fr');
###############################################################################
# création de la dba des type de postes
###############################################################################
insert into cv_poste values('10000', 'Agriculture', 'fr');
insert into cv_poste values('10100', '- Chef d’exploitation', 'fr');
insert into cv_poste values('10200', '- Ouvrier agricole', 'fr');
insert into cv_poste values('20000', 'Service Technique', 'fr');
insert into cv_poste values('20100', '- Chef de projet', 'fr');
insert into cv_poste values('20101', '-- Chef de projet junior', 'fr');
insert into cv_poste values('20102', '-- Chef de projet senior', 'fr');
insert into cv_poste values('20200', '- Consultant', 'fr');
insert into cv_poste values('20300', '- Directeur technique', 'fr');
insert into cv_poste values('20400', '- Ingénieur d\'étude', 'fr');
insert into cv_poste values('20500', '- Ingénieur support', 'fr');
insert into cv_poste values('20600', '- Responsable R & D', 'fr');
insert into cv_poste values('20700', '- Technicien', 'fr');
insert into cv_poste values('20701', '-- Technicien hotline', 'fr');
insert into cv_poste values('20702', '-- Technicien maintenance', 'fr');
insert into cv_poste values('20800', '- Webmaster', 'fr');
insert into cv_poste values('30000', 'Service Commercial', 'fr');
insert into cv_poste values('30100', '- Commercial', 'fr');
insert into cv_poste values('30200', '- Directeur commercial', 'fr');
insert into cv_poste values('30300', '- Technico commercial', 'fr');
insert into cv_poste values('40000', 'Service Marketing', 'fr');
insert into cv_poste values('40100', '- Responsable Marketing', 'fr');
insert into cv_poste values('50000', 'Service qualité', 'fr');
insert into cv_poste values('50100', '- Assistant qualité', 'fr');
insert into cv_poste values('50200', '- Responsable qualité', 'fr');
insert into cv_poste values('60000', 'Formateur', 'fr');
insert into cv_poste values('70000', 'Journaliste', 'fr');
insert into cv_poste values('70100', '- Assistant(e) de direction', 'fr');
insert into cv_poste values('80000', 'Stagiaire', 'fr');
insert into cv_poste values('90000', 'Traducteur', 'fr');
###############################################################################
# création de la dba des régions
###############################################################################
insert into cv_region values('10000', 'France entière', 'fr');
insert into cv_region values('10100', '- France métropolitaine', 'fr');
insert into cv_region values('10101', '-- Alsace', 'fr');
insert into cv_region values('10102', '-- Auvergne', 'fr');
insert into cv_region values('10103', '-- Aquitaine', 'fr');
insert into cv_region values('10104', '-- Bourgogne', 'fr');
insert into cv_region values('10105', '-- Bretagne', 'fr');
insert into cv_region values('10106', '-- Centre', 'fr');
insert into cv_region values('10107', '-- Champagne-Ardenne', 'fr');
insert into cv_region values('10108', '-- Corse', 'fr');
insert into cv_region values('10109', '-- Franche-Comté', 'fr');
insert into cv_region values('10110', '-- Ile de France', 'fr');
insert into cv_region values('10111', '-- Languedoc-Roussillon', 'fr');
insert into cv_region values('10112', '-- Limousin', 'fr');
insert into cv_region values('10113', '-- Lorraine', 'fr');
insert into cv_region values('10114', '-- Midi-Pyrénées', 'fr');
insert into cv_region values('10115', '-- Nord-Pas-de-Calais', 'fr');
insert into cv_region values('10116', '-- Normandie', 'fr');
insert into cv_region values('10117', '-- Pays-de-Loire', 'fr');
insert into cv_region values('10118', '-- Picardie', 'fr');
insert into cv_region values('10119', '-- Poitou-Charentes', 'fr');
insert into cv_region values('10120', '-- PACA', 'fr');
insert into cv_region values('10121', '-- Rhône Alpes', 'fr');
insert into cv_region values('10200', '- DOM et TOM', 'fr');
insert into cv_region values('10201', '-- Guadeloupe', 'fr');
insert into cv_region values('10202', '-- Guyane', 'fr');
insert into cv_region values('10203', '-- Martinique', 'fr');
insert into cv_region values('10204', '-- Réunion', 'fr');
insert into cv_region values('10205', '-- St-Pierre et Miquelon', 'fr');
insert into cv_region values('20000', 'Etranger', 'fr');
###############################################################################
# création de la dba des secteurs de production
###############################################################################
insert into stage_secteur values('', '1', 'Tourisme',    'N', 'O', 'fr');
insert into stage_secteur values('', '2', 'Social',      'N', 'O', 'fr');
insert into stage_secteur values('', '3', 'Agriculture', 'O', 'O', 'fr');
insert into stage_secteur values('', '4', 'Aménagement', 'N', 'O', 'fr');
insert into stage_secteur values('', '5', 'Service',     'N', 'O', 'fr');
insert into stage_secteur values('', '6', 'Commerce',    'N', 'O', 'fr');
insert into stage_secteur values('', '7', 'Autre',       'N', 'O', 'fr');
###############################################################################
# création de la dba des catégories de production
###############################################################################
insert into prod_categorie values('1',  'A', 'bovins lait', 'fr');
insert into prod_categorie values('2',  'A', 'bovins viande', 'fr');
insert into prod_categorie values('3',  'A', 'ovins viande', 'fr');
insert into prod_categorie values('4',  'A', 'ovins lait', 'fr');
insert into prod_categorie values('5',  'A', 'caprins lait', 'fr');
insert into prod_categorie values('6',  'A', 'caprins laine', 'fr');
insert into prod_categorie values('7',  'A', 'porcins', 'fr');
insert into prod_categorie values('8',  'A', 'équins', 'fr');
insert into prod_categorie values('9',  'A', 'poules pondeuses', 'fr');
insert into prod_categorie values('10', 'A', 'volailles de chair', 'fr');
insert into prod_categorie values('11', 'V', 'maïs', 'fr');
insert into prod_categorie values('12', 'V', 'maïs ensilage', 'fr');
insert into prod_categorie values('13', 'V', 'blé', 'fr');
insert into prod_categorie values('14', 'V', 'orge', 'fr');
insert into prod_categorie values('15', 'V', 'triticale', 'fr');
insert into prod_categorie values('16', 'V', 'avoine', 'fr');
insert into prod_categorie values('17', 'V', 'seigle', 'fr');
insert into prod_categorie values('18', 'V', 'tournesol', 'fr');
insert into prod_categorie values('19', 'V', 'colza', 'fr');
insert into prod_categorie values('20', 'V', 'soja', 'fr');
insert into prod_categorie values('21', 'V', 'pos', 'fr');
insert into prod_categorie values('22', 'V', 'betterave', 'fr');
insert into prod_categorie values('23', 'V', 'vigne', 'fr');
insert into prod_categorie values('24', 'V', 'verger', 'fr');
insert into prod_categorie values('25', 'V', 'maraichage', 'fr');
insert into prod_categorie values('26', 'V', 'fleurs', 'fr');
insert into prod_categorie values('27', 'V', 'prairies naturelles', 'fr');
insert into prod_categorie values('28', 'V', 'prairies temporaires', 'fr');
insert into prod_categorie values('29', 'V', 'céréales à paille', 'fr');
insert into prod_categorie values('30', 'C', 'accueil à la ferme', 'fr');
insert into prod_categorie values('31', 'C', 'artisanat', 'fr');
insert into prod_categorie values('32', 'C', 'transformation à la ferme', 'fr');
insert into prod_categorie values('33', 'C', 'emplois saisonniers', 'fr');
insert into prod_categorie values('34', 'C', 'culture de petits fruits', 'fr');
insert into prod_categorie values('35', 'C', 'ruches', 'fr');
insert into prod_categorie values('36', 'C', 'élevage de volailles', 'fr');
###############################################################################
# création de la dba des races animales
###############################################################################
insert into prod_race values('', '1', 'Abondance');
insert into prod_race values('', '1', 'Brune');
insert into prod_race values('', '1', 'Montbéliarde');
insert into prod_race values('', '1', 'Normande');
insert into prod_race values('', '1', 'Pie Rouge des Plaines');
insert into prod_race values('', '1', 'Prim\'Holstein');
insert into prod_race values('', '1', 'Simmental');
insert into prod_race values('', '1', 'Tarentaise');
insert into prod_race values('', '1', 'Autre');
insert into prod_race values('', '1', 'Croisé');
insert into prod_race values('', '2', 'Aubrac');
insert into prod_race values('', '2', 'Blonde d\'Aquitaine');
insert into prod_race values('', '2', 'Charolaise');
insert into prod_race values('', '2', 'Gasconne');
insert into prod_race values('', '2', 'Limousine');
insert into prod_race values('', '2', 'Salers');
insert into prod_race values('', '2', 'Autre');
insert into prod_race values('', '2', 'Croisé');
insert into prod_race values('', '3', 'Berrichon du Cher');
insert into prod_race values('', '3', 'Bizet');
insert into prod_race values('', '3', 'Causse du Lot');
insert into prod_race values('', '3', 'Hampshire');
insert into prod_race values('', '3', 'Ile de France');
insert into prod_race values('', '3', 'Lacaune-viande');
insert into prod_race values('', '3', 'Limousine');
insert into prod_race values('', '3', 'Manech');
insert into prod_race values('', '3', 'Mérinos');
insert into prod_race values('', '3', 'Mourerous');
insert into prod_race values('', '3', 'Charolais');
insert into prod_race values('', '3', 'Corse');
insert into prod_race values('', '3', 'Préalpes du Sud');
insert into prod_race values('', '3', 'Romanov');
insert into prod_race values('', '3', 'Rouge de l\'Ouest');
insert into prod_race values('', '3', 'Texel');
insert into prod_race values('', '3', 'Autre');
insert into prod_race values('', '3', 'Croisé');
insert into prod_race values('', '4', 'Basco-Béarnaise');
insert into prod_race values('', '4', 'Corse');
insert into prod_race values('', '4', 'Lacaune-lait');
insert into prod_race values('', '4', 'Autre');
insert into prod_race values('', '4', 'Croisé');
insert into prod_race values('', '5', 'Alpine-Chamoisée');
insert into prod_race values('', '5', 'Poitevine');
insert into prod_race values('', '5', 'Saanen');
insert into prod_race values('', '5', 'Rove');
insert into prod_race values('', '5', 'Autre');
insert into prod_race values('', '5', 'Croisé');
insert into prod_race values('', '6', 'Angora');
insert into prod_race values('', '6', 'Mohair');
insert into prod_race values('', '6', 'Autre');
insert into prod_race values('', '6', 'Croisé');
insert into prod_race values('', '7', 'Cul Noir Limousin');
insert into prod_race values('', '7', 'Landrace');
insert into prod_race values('', '7', 'Large White');
insert into prod_race values('', '7', 'Piétrain');
insert into prod_race values('', '7', 'Porc Basque');
insert into prod_race values('', '7', 'Porc de Bayeux');
insert into prod_race values('', '7', 'Autre');
insert into prod_race values('', '7', 'Croisé');
insert into prod_race values('', '8', 'Arabe');
insert into prod_race values('', '8', 'Anglo-arabe');
insert into prod_race values('', '8', 'Camargue');
insert into prod_race values('', '8', 'Selle français');
insert into prod_race values('', '8', 'Pur sang');
insert into prod_race values('', '8', 'Trotteur');
insert into prod_race values('', '8', 'Ardennais');
insert into prod_race values('', '8', 'Boulonnais');
insert into prod_race values('', '8', 'Breton');
insert into prod_race values('', '8', 'Cob normand');
insert into prod_race values('', '8', 'Comtois');
insert into prod_race values('', '8', 'Poitevin');
insert into prod_race values('', '8', 'Percheron');
insert into prod_race values('', '8', 'Autre');
insert into prod_race values('', '8', 'Croisé');
insert into prod_race values('', '9', '-');
insert into prod_race values('', '10', '-');
###############################################################################